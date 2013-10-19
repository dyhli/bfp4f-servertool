<?php
/**
 * Battlefield Play4free Servertool
 * Version 0.4.1
 * 
 * Copyright 2013 Danny Li <SharpBunny> <bfp4f.sharpbunny@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 
require_once('../../core/init.php');

use T4G\BFP4F\Rcon as rcon;
header('Content-type: application/json');

// Default response template
$response = array(
	'status' => 'ERROR',
	'msg' => '',
	'request_date' => date($settings['cp_date_format_full']),
	'info' => array( ),
	'players' => array( ),
	'chat' => array( ),
	'igaAdmins' => array ( ),
);

if($user->checkLogin()) {
			
	// Connect to server
	
	if(!$rc->connect($cn, $cs) || !$rc->init()) {
		$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
	} else {
	
		$sv = new rcon\Server();
		$pl = new rcon\Players();
		$ct = new rcon\Chat();
		
		if($userInfo['rights_server'] == 'yes') {
			
			$response['status'] = 'OK';
			$response['info'] = $sv->fetch();
			if(isset($_GET['players'])) {
				$response['players'] = $pl->fetch();
			}
			if(isset($_GET['chat'])) {
				$response['chat'] = $ct->fetch();
			}
			if(isset($_GET['igaAdmins'])) {
				$response['igaAdmins'] = $sv->fetchIgaAdmins();
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