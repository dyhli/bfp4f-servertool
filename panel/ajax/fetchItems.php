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
$response = array( );

if($user->checkLogin()) {
			
	// Connect to server
	
	if(!$rc->connect($cn, $cs) || !$rc->init()) {
		$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
	} else {
		
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
	
	}
	
} else {
	$response[] = $lang['msg_nologin'];
}

// Output response
echo json_encode($response);
?>