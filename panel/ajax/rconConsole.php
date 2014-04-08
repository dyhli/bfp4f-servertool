<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.7.2
 *
 * Copyright (C) 2014 <Danny Li> a.k.a. SharpBunny
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

require_once('../../core/init.php');

use T4G\BFP4F\Rcon as rcon;

if($user->checkLogin()) {
			
	// Connect to server
	
	if(!$rc->connect($cn, $cs) || !$rc->init()) {
		$response = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
	} else {
		
		if($userInfo['rights_rcon'] == 'yes') {
			
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmd'])) {
				$response = nl2br(htmlentities($rc->query($_POST['cmd']), ENT_QUOTES, 'UTF-8'));
				$response = str_replace(array("\t", '    '), '&nbsp;&nbsp;&nbsp;&nbsp;', $response);
				if(empty($response)) {
					$response = 'Empty response...';
				}
			} else {
				$response = $lang['word_error'];
			}
			
		} else {
			$response = $lang['msg_cmd_noaccess'];
		}
	
	}
	
} else {
	$response = $lang['msg_nologin'];
}

echo $response;
?>