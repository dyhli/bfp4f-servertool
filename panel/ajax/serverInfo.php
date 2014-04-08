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
$response = array(
	'status' => 'ERROR',
	'msg' => '',
	'request_date' => date($settings['cp_date_format_full']),
	'last_stream' => date($settings['cp_date_format_full'], $settings['server_last_stream']),
	'info' => array( ),
	'players' => array( ),
	'chat' => array( ),
	'igaAdmins' => array ( ),
);

function aasort(&$array, $key) {
	$sorter = array( );
	$ret = array( );
	reset($array);
	foreach($array as $ii => $va) {
		$sorter[$ii] = $va[$key];
	}
	asort($sorter);
	foreach($sorter as $ii => $va) {
		$ret[$ii] = $array[$ii];
	}
	$array=$ret;
}

if($user->checkLogin()) {
			
	// Connect to server
	
	if(!$rc->connect($cn, $cs) || !$rc->init()) {
		$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
	} else {
		
		$cmg = new GameMaps();
		$sv = new rcon\Server();
		$pl = new rcon\Players();
		$ct = new rcon\Chat();
		
		if($userInfo['rights_server'] == 'yes') {
			
			$response['status'] = 'OK';
			$response['info'] = (array) $sv->fetch();
			$response['info']['mapName'] = $cmg->getMapName($response['info']['map']);
			$response['info']['gameModeName'] = $cmg->getGameMode($response['info']['gameMode']);
			if(isset($_GET['players'])) {
				$players = $pl->fetch();
				$score = array( );
				foreach($players as $key => $row) {
					$score[$key] = $row->score;
				}
				array_multisort($score, SORT_DESC, $players);
				$response['players'] = $players;
			}
			if(isset($_GET['chat'])) {
				$response['chat'] = $ct->fetch();
			}
			if(isset($_GET['igaAdmins'])) {
				$response['igaAdmins'] = $sv->fetchIgaAdmins();
			}
			if(isset($_GET['ping'])) {
				$ping = ping(decrypt($settings['server_ip']) . ':' . decrypt($settings['server_admin_port']));
				$response['ping'] = ((is_float($ping)) ? $ping . 'ms' : '999+ms');
			}
			
		} else {
			$response['msg'] = $lang['msg_cmd_noaccess'];
		}
	
	}
	
} else {
	$response['msg'] = $lang['msg_nologin'];
}

// Output response
echo json_encode($response);
?>