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
$sv = new rcon\Server();

header('Content-type: application/json');

// Logs class
$log = new Log($db, $config);

// Whitelist class
$wl = new Whitelist($db, $config);

// Blacklist class
$bl = new Blacklist($db, $config);

// Accounts class
$acc = new Accounts($db, $config);

// Default response template
$response = array(
	'status' => 'ERROR',
	'msg' => ''
);

if($user->checkLogin()) {
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmd']) && isset($_POST['vars'])) {

		$sv = new rcon\Server();
		$pl = new rcon\Players();
		$ct = new rcon\Chat();
		
		// Commands
		switch($_POST['cmd']) {
			
			/**
			 * Start the server
			 */
			case 'startServer':
				if($userInfo['rights_superadmin'] == 'yes') {
					if($settings['i3d_active'] == 'true') {
						$i3d->action = 'start';
						$result = (array) $i3d->doRequest(array( 
							'gameserverId' => decrypt($settings['i3d_gameserverid']),
						));
						if($result['status'] == 'Success') {
							$response['status'] = 'OK';
							$response['msg'] = $lang['i3d_msg1'];
							$log->insertActionLog($userInfo['user_id'], 'i3D API: Server started');
						} else {
							$response['msg'] = $lang['i3d'] . ': ' . $result['message'];
						}
					} else {
						$response['msg'] = $lang['i3d_err2'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Stop the server
			 */
			case 'stopServer':
				if($userInfo['rights_superadmin'] == 'yes') {
					if($settings['i3d_active'] == 'true') {
						$i3d->action = 'stop';
						$result = (array) $i3d->doRequest(array( 
							'gameserverId' => decrypt($settings['i3d_gameserverid']),
						));
						if($result['status'] == 'Success') {
							$response['status'] = 'OK';
							$response['msg'] = $lang['i3d_msg2'];
							$log->insertActionLog($userInfo['user_id'], 'i3D API: Server stopped');
						} else {
							$response['msg'] = $lang['i3d'] . ': ' . $result['message'];
						}
					} else {
						$response['msg'] = $lang['i3d_err2'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Restart the server
			 */
			case 'restartServer':
				if($userInfo['rights_superadmin'] == 'yes') {
					if($settings['i3d_active'] == 'true') {
						$i3d->action = 'restart';
						$result = (array) $i3d->doRequest(array( 
							'gameserverId' => decrypt($settings['i3d_gameserverid']),
						));
						if($result['status'] == 'Success') {
							$response['status'] = 'OK';
							$response['msg'] = $lang['i3d_msg3'];
							$log->insertActionLog($userInfo['user_id'], 'i3D API: Server restarted');
						} else {
							$response['msg'] = $lang['i3d'] . ': ' . $result['message'];
						}
					} else {
						$response['msg'] = $lang['i3d_err2'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Add a VIP
			 */
			case 'addVip':
				if(isset($_POST['vars']['name']) && isset($_POST['vars']['profileId'])) {
					if($userInfo['rights_vips'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							$sv->setVip($_POST['vars']['name'], $_POST['vars']['profileId'], 1);
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_vipm_vipadded'];
							$log->insertActionLog($userInfo['user_id'], 'VIP added: ' . $_POST['vars']['profileId']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete a VIP
			 */
			case 'deleteVip':
				if(isset($_POST['vars']['name']) && isset($_POST['vars']['profileId'])) {
					if($userInfo['rights_vips'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							$sv->setVip($_POST['vars']['name'], $_POST['vars']['profileId'], 0);
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_vipm_vipdeleted'];
							$log->insertActionLog($userInfo['user_id'], 'VIP deleted: ' . $_POST['vars']['profileId']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Switch to next map
			 */
			case 'nextMap':
				if($userInfo['rights_server'] == 'yes') {
					if($rc->connect($cn, $cs) && $rc->init()) {
						$ct->send('|ccc| Skipping to next map...');
						$sv->runNextMap();
						$response['status'] = 'OK';
						$response['msg'] = $lang['tool_server_nextmap_msg'];
						$log->insertActionLog($userInfo['user_id'], 'Map skipped (next)');
					} else {
						$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
					}
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Restart the round
			 */
			case 'restartRound':
				if($userInfo['rights_server'] == 'yes') {
					if($rc->connect($cn, $cs) && $rc->init()) {
						$ct->send('|ccc| Round is being restared...');
						$sv->restartMap();
						$response['status'] = 'OK';
						$response['msg'] = $lang['tool_server_restartround_msg'];
						$log->insertActionLog($userInfo['user_id'], 'Round restarted');
					} else {
						$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
					}
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Edit RCON information
			 */
			case 'editRconInfo':
				if(isset($_POST['vars']['serverIp']) && isset($_POST['vars']['adminPort']) && isset($_POST['vars']['rconPass'])) {
					if(!empty($_POST['vars']['serverIp']) && !empty($_POST['vars']['adminPort']) && !empty($_POST['vars']['rconPass'])) {
						if($userInfo['rights_rcon'] == 'yes') {
							if(updateSetting('server_ip',encrypt(trim($_POST['vars']['serverIp']))) && updateSetting('server_admin_port',encrypt(trim($_POST['vars']['adminPort']))) && updateSetting('server_rcon_password',encrypt(trim($_POST['vars']['rconPass'])))) {
								$response['status'] = 'OK';
								$response['msg'] = $lang['msg_settings_saved'];
								
								$log->insertActionLog($userInfo['user_id'], 'RCON info edited!');
							} else {
								$response['msg'] = $lang['msg_cmd_failed'];
							}
						} else {
							$response['msg'] = $lang['msg_cmd_noaccess'];
						}
					} else {
						$response['msg'] = $lang['msg_cmd_missingvars'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Warn a player
			 */
			case 'warnPlayer':
				if(isset($_POST['vars']['player']) && isset($_POST['vars']['index']) && isset($_POST['vars']['reason'])) {
					if($userInfo['rights_server'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							// We use the index instead of the playername, or else playernames with numbers only won't be warned
							$pl->warn($_POST['vars']['index'], $_POST['vars']['reason']);
							
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_server_warnpl_msg'];
							
							$log->insertActionLog($userInfo['user_id'], 'Warned player: ' . $_POST['vars']['player'] . ' for: ' . $_POST['vars']['reason']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Kick a player
			 */
			case 'kickPlayer':
				if(isset($_POST['vars']['player']) && isset($_POST['vars']['index']) && isset($_POST['vars']['reason'])) {
					if($userInfo['rights_server'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							// We use the index instead of the playername, or else playernames with numbers only won't be kicked
							$pl->kick($_POST['vars']['index'], $_POST['vars']['reason']);
							
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_server_kickpl_msg'];
							
							$log->insertActionLog($userInfo['user_id'], 'Kicked player: ' . $_POST['vars']['player'] . ' for: ' . $_POST['vars']['reason']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Switch a player
			 */
			case 'switchPlayer':
				if(isset($_POST['vars']['player']) && isset($_POST['vars']['index'])) {
					if($userInfo['rights_server'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							// We use the index instead of the playername, or else playernames with numbers only won't be kicked
							$pl->switchPlayer($_POST['vars']['index']);
							
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_server_switchpl_msg'];
							
							$log->insertActionLog($userInfo['user_id'], 'Switched player: ' . $_POST['vars']['player']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Enable/Disable a tool
			 */
			case 'toggleTool':
				if(isset($_POST['vars']['tool'])) {
					if($userInfo['rights_limiters'] == 'yes') {
						
						/**
						 * Allowed tools to enable/disable
						 * 
						 * wl = Weapon limiter
						 * pl = Prebuy limiter
						 * al = Attachments limiter
						 * sl = Shotgun limiter
						 * ll = Level limiter
						 * cl = Class limiter
						 * whl = Whitelist
						 * dsl = Dual-slot limiter
						 * igcmds = In-game commands
						 */
						$tools = array('wl','pl','al','sl','ll','cl','whl','dsl','igcmds');
						
						if(in_array($_POST['vars']['tool'], $tools)) {
							
							if($settings['tool_'.$_POST['vars']['tool']] == 'true') {
								updateSetting('tool_'.$_POST['vars']['tool'], 'false');
								
								$response['status'] = 'OK';
								$response['msg'] = $lang['word_disabled'];
						
								$log->insertActionLog($userInfo['user_id'], 'tool_' . $_POST['vars']['tool'] . ' disabled');
							} else {
								updateSetting('tool_'.$_POST['vars']['tool'], 'true');
								
								$response['status'] = 'OK';
								$response['msg'] = $lang['word_enabled'];
						
								$log->insertActionLog($userInfo['user_id'], 'tool_' . $_POST['vars']['tool'] . ' enabled');
							}
							
						} else {
							$response['msg'] = $lang['msg_cmd_noaccess'];
						}
						
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Add to whitelist
			 */
			case 'addWhitelist':
				if(isset($_POST['vars']['profileId'])) {
					if($userInfo['rights_whitelist'] == 'yes') {
						
						$result = $wl->addPlayer($userInfo['user_id'], $_POST['vars']['profileId']);
						
						if(is_bool($result)) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_wlist_added'];
							
							$log->insertActionLog($userInfo['user_id'], 'Player ' . $_POST['vars']['profileId'] . ' added to the whitelist');
						} else {
							$response['msg'] = getLang($result);
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete from whitelist
			 */
			case 'deleteWhitelist':
				if(isset($_POST['vars']['id'])) {
					if($userInfo['rights_whitelist'] == 'yes') {
						if($wl->deletePlayer($_POST['vars']['id'])) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_wlist_deleted'];
							
							$log->insertActionLog($userInfo['user_id'], 'Player deleted from the whitelist');
						} else {
							$response['msg'] = $lang['msg_cmd_failed'];
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Add to blacklist
			 */
			case 'addBlacklist':
				if(isset($_POST['vars']['profileId']) && isset($_POST['vars']['reason']) && isset($_POST['vars']['until'])) {
					if($userInfo['rights_blacklist'] == 'yes') {
						
						$result = $bl->addBan($userInfo['user_id'], $_POST['vars']['profileId'], $_POST['vars']['reason'], $_POST['vars']['until']);
						
						if(is_bool($result)) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_bl_added'];
							
							$log->insertActionLog($userInfo['user_id'], 'Ban added for player ' . $_POST['vars']['profileId'] . ' added to the blacklist');
						} else {
							$response['msg'] = getLang($result);
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete from blacklist
			 */
			case 'deleteBlacklist':
				if(isset($_POST['vars']['id'])) {
					if($userInfo['rights_blacklist'] == 'yes') {
						if($bl->deleteBan($_POST['vars']['id'])) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_bl_deleted'];
							
							$log->insertActionLog($userInfo['user_id'], 'Ban deleted from the blacklist');
						} else {
							$response['msg'] = $lang['msg_cmd_failed'];
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete user
			 */
			case 'deleteUser':
				if(isset($_POST['vars']['id'])) {
					if($userInfo['rights_superadmin'] == 'yes') {
						if($_POST['vars']['id'] != $userInfo['user_id']) {
							if($acc->deleteUser($_POST['vars']['id'])) {
								$response['status'] = 'OK';
								$response['msg'] = '';
								
								$log->insertActionLog($userInfo['user_id'], 'User deleted');
							} else {
								$response['msg'] = $lang['msg_cmd_failed'];
							}
						} else {
							$response['msg'] = $lang['msg_cmd_failed'];
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Send servermessage
			 */
			case 'sendSrvMsg':
				if(isset($_POST['vars']['msg']) && !empty($_POST['vars']['msg'])) {
					if($userInfo['rights_server'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							$ct->send($_POST['vars']['msg']);
							
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_server_msg_sent'];
							$log->insertActionLog($userInfo['user_id'], 'Sent servermessage: ' . $_POST['vars']['msg']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete from in-game commands
			 */
			case 'deleteIgcmd':
				if(isset($_POST['vars']['id'])) {
					if($userInfo['rights_igcmds'] >= 100) {
						$igc = new IgCommands(null, null, null, null, $db, $config, null, $settings);
						if($igc->deleteCommand($_POST['vars']['id'])) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_igcmds_deleted'];
							
							$log->insertActionLog($userInfo['user_id'], 'In-game command deleted');
						} else {
							$response['msg'] = $lang['msg_cmd_failed'];
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Delete from in-game commands
			 */
			case 'deleteTmsg':
				if(isset($_POST['vars']['id'])) {
					if($userInfo['rights_igcmds'] >= 100) {
						$tmsg = new TimedMessages($db, $config);
						if($tmsg->deleteMessage($_POST['vars']['id'])) {
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_tmsg_deleted'];
							
							$log->insertActionLog($userInfo['user_id'], 'Timed message deleted');
						} else {
							$response['msg'] = $lang['msg_cmd_failed'];
						}

					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Close active poll
			 */
			case 'closePoll':
				if($userInfo['rights_server'] == 'yes') {
					$igv = new IgVoting(null, null, null, null, $db, $config, $settings);
					
					$response['status'] = 'OK';
					$response['msg'] = $lang['tool_server_closepoll_msg'];
					
					$log->insertActionLog($userInfo['user_id'], 'Active poll closed');
				} else {
					$response['msg'] = $lang['msg_cmd_noaccess'];
				}
			break;
			
			/**
			 * Switch map
			 */
			case 'switchMap':
				if(isset($_POST['vars']['map']) && !empty($_POST['vars']['map'])) {
					if($userInfo['rights_server'] == 'yes') {
						if($rc->connect($cn, $cs) && $rc->init()) {
							$map = explode($_POST['map'], '|');
							$sv->changeMap($map[0], $map[1]);
							
							$response['status'] = 'OK';
							$response['msg'] = $lang['tool_server_switchmap_msg'];
							$log->insertActionLog($userInfo['user_id'], 'Switched map to: ' . $_POST['vars']['map']);
						} else {
							$response['msg'] = $lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream']);
						}
					} else {
						$response['msg'] = $lang['msg_cmd_noaccess'];
					}
				} else {
					$response['msg'] = $lang['msg_cmd_missingvars'];
				}
			break;
			
			/**
			 * Unknown command
			 */
			default: $response['msg'] = $lang['msg_cmd_noaccess'];
		}
		
	} else {
		/**
		 * Not a POST request with the required fields...
		 */
		$response['msg'] = $lang['msg_cmd_noaccess'];
	}
	
} else {
	/**
	 * Not logged in
	 */
	$response['msg'] = $lang['msg_nologin'];
}

// Output response
echo json_encode($response);
?>
