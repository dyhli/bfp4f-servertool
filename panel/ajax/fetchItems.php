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
header('Content-type: application/json');

// Default response template
$response = array( );

if($user->checkLogin()) {
			
	if($userInfo['rights_limiters'] == 'yes') {
		
		$it = new Itemlist($db, $config);
		$items = $it->fetchItems();
		if($items['code'] == 'OK') {
			
			foreach($items['items'] as $item) {
				if(!isset($_GET['weapons']) || (isset($_GET['weapons']) && $item['item_category'] == 'weapon')) {
					$response[] = array(
						'value' => $item['item_bf_id'],
						'text' => $item['item_name']
					);
				}
			}
							
		} else {
			$response[] = getLang($items['message']);
		}
		
	} else {
		$response[] = $lang['msg_cmd_noaccess'];
	}
	
} else {
	$response[] = $lang['msg_nologin'];
}

// Output response
echo json_encode($response);
?>