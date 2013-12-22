<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.6.0
 *
 * Copyright (C) 2013 <Danny Li> a.k.a. SharpBunny
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 */
 
require_once('../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_logs'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

header('Content-type: text/plain');

if(isset($_GET['log'])) {
	
	$result = $log->fetchLog($_GET['log']);
	
	if($result['code'] == 'OK') {
		
		$i = 0;
		
		foreach($result['items'] as $value) {
			$i++;
			
			echo '[#' . $i . '] ';
			foreach($value as $key => $value) {
				echo $key . ': ' . $value . ' || ';
			}
			echo PHP_EOL;
		}
		
	} else {
		echo $result['message'];
	}
	
}
?>