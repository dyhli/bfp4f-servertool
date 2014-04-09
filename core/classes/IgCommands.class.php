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
 
class IgCommands {
	
	protected $db,
			  $config,
			  $voting,
			  $settings;
			  
	public	  $rc,
			  $sv,
			  $ct,
			  $pl,
			  $userId = 0;
			  
	function __construct($rc, $sv, $ct, $pl, $db, $config, $voting, $settings) {
		$this->rc = $rc;
		$this->sv = $sv;
		$this->ct = $ct;
		$this->pl = $pl;
		$this->db = $db;
		$this->config = $config;
		$this->voting = $voting;
		$this->settings = $settings;
	}
	
	/**
	 * getAvailableCmdFunctions()
	 * Get the available command functions
	 * 
	 * @return array
	 */
	public function getAvailableCmdFunctions() {
		
		return array(
			
			/**
			 * Admin commands
			 */
			'cmdKickPlayer' => 'Kick player {!player} {reason}', // Kicking players
			'cmdWarnPlayer' => 'Warn player {!player} {reason}', // Warning players
			'cmdBanPlayer' => 'Ban player {!time} {!player} {reason}', // Banning players
			'cmdChangeMap' => 'Change map {!map} {mode}', // Change map
			'cmdNextMap' => 'Next map', // Skip to next map
			'cmdVip' => 'Add/Remove VIP {!player}', // Add / Delete as VIP
			'cmdRestartRound' => 'Restart round', // Restarts round
			'cmdSwitchPlayer' => 'Switch player {!player}', // Switch player
			'cmdExecRcon' => 'Execute RCON {cmd}', // Execute RCON Command and return RCON response
			'cmdClosePoll' => 'Close active poll session', // Close poll (map or kick)
			'cmdWhiteList' => 'Add/Remove from whitelist {!player}', // Whitelist a player
			
			/**
			 * Public commands
			 */
			'cmdRequestPlayerstats' => 'Request playerstats {!player}', // Request playerstats (HS ratio and stuff)
			'cmdReportPlayer' => 'Report player to BattlefieldTools Blacklist {!player} {!reason}', // Report player to the BattlefieldTools.com Blacklist
			'cmdVotekick' => 'Votekick {!player} {reason}', // Votekicking
			'cmdVoteMap' => 'Votemap {!map} {mode}', // Votemap
			'cmdVoteRestart' => 'Voterestart', // Voterestart
			'cmdMessage' => 'Custom message', // Custom command + custom message (e.g. !rules /rules |rules -> Do not this that blah blah)
			'cmdFunnyWord' => 'Funny word {player}', // {player} {word} {player2} e.g. SharpBunny slaps FakeBunny :D (EASTER EGG)
			'cmdRagequit' => 'Ragequit', // Kicks the player himself :D (EASTER EGG)
			'cmdVoteYes' => 'Vote yes', // Vote yes
			'cmdGetLoadout' => 'Request playerloadout {!player}', // Get the player's loadout
			'cmdGetAttachments' => 'Request attachments {!player}', // Get the player's attachments
			
		);
		
	}
	
	/**
	 * getCommand()
	 * Get a command by name
	 * 
	 * @param $str str - Command name or ID
	 * @return array - Status + info
	 */
	public function getCommand($str) {
		
		if($result = $this->db->query("SELECT cmd_id,cmd_rights,cmd_function,cmd_name,cmd_response,cmd_response_private,cmd_active FROM " . $this->config['db_prefix'] . "igcmds WHERE
		(cmd_name='" . $this->db->real_escape_string($str) . "' AND
		cmd_active='yes') OR (cmd_id='" . $this->db->real_escape_string($str) . "')")) {
			
			if($result->num_rows == 1) {				
				return array('code' => 'OK', 'cmd' => $result->fetch_array());
			} else {
				return array('code' => 'ERROR', 'message' => 'Command not found');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * getCommands()
	 * Get commands
	 * 
	 * @return array - Status + info
	 */
	public function getCommands() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "igcmds ORDER BY cmd_rights DESC, cmd_name ASC")) {
			
			if($result->num_rows > 0) {
				while($a = $result->fetch_assoc()) {
					$return[] = $a;
				}				
				return array('code' => 'OK', 'cmds' => $return);
			} else {
				return array('code' => 'ERROR', 'message' => 'No commands not found');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * createCommand()
	 * Create a command
	 * 
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function createCommand($info) {
		
		$keys = "";
		$vars = "";
		foreach($info as $key => $value) {
			$keys .= $key . ",";
			$vars .= "'" . $this->db->real_escape_string($value) . "',";
		}
		$keys = substr($keys, 0, -1);
		$vars = substr($vars, 0, -1);
		
		$sql = "INSERT INTO " . $this->config['db_prefix'] . "igcmds (" . $keys . ")
		VALUES (" . $vars . ")";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * updateCommand()
	 * Update a user
	 * 
	 * @param $id int - Command ID
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function updateCommand($id, $info) {
		
		$vars = "";
		foreach($info as $key => $value) {
			$vars .= "{$key} = '" . $this->db->real_escape_string($value) . "',";
		}
		$vars = substr($vars, 0, -1);
		
		$sql = "UPDATE " . $this->config['db_prefix'] . "igcmds SET " . $vars . " WHERE cmd_id='" . $this->db->real_escape_string($id) . "'";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * deleteIgcmd()
	 * Delete an in-game command
	 * 
	 * @param $id int - Command ID
	 * @return array
	 */
	public function deleteCommand($id) {
		
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "igcmds WHERE
		cmd_id = '" . $this->db->real_escape_string($id) . "'");
		
	}
	
	/**
	 * getUserRights()
	 * Get the rights of the user
	 * 
	 * @param $nucleusId str - nucleusId aka profileId of the user
	 * @return int - Rights level
	 */
	public function getUserRights($nucleusId) {
		
		if($result = $this->db->query("SELECT user_id,rights_igcmds FROM " . $this->config['db_prefix'] . "users WHERE
		user_profile_id='" . $this->db->real_escape_string($nucleusId) . "' LIMIT 1")) {
			
			if($result->num_rows == 1) {				
				$return = $result->fetch_array();
				$this->userId = $return['user_id'];
				
				return (int) $return['rights_igcmds'];
			} else {
				$this->userId = 0;
				return (int) 0;
			}
			
			$result->free();
			
		} else {
			$this->userId = 0;
			return (int) 0;
		}
		
	}
	
	/**
	 * findPlayerByName()
	 * Find player by name (used for origin)
	 * 
	 * @param $name str - Playername
	 * @return array - Playerinfo
	 */
	public function findPlayerByName($name) {
		
		$results = 0;
		
		foreach($this->pl->fetch() as $player) {
						
			if(strpos(strtolower($player->name), strtolower($name)) !== false) {
				
				$results++;
				$return = (array) $player;
				$return['class'] = 'Unknown';
				
				/**
				 * Get class
				 */
				$return['class'] = (($player->kit == 'none') ? 'Dead' : str_replace(array('_','kit','US','RU'), '', $player->kit));
				
			}
			
		}
		
		if($results == 0) {
			return array('code' => 'ERROR', 'message' => '|ccc| Player with \'' . $name . '\' was not found');
		} elseif($results > 1) {
			return array('code' => 'ERROR', 'message' => '|ccc| There are ' . $results . ' players found with \'' . $name . '\', please be more specific');
		} elseif($results == 1) {
			return array('code' => 'OK', 'player' => $return);
		}
				
	}
	
	/**
	 * checkExpiredCmd()
	 * Check if the command is already executed
	 * 
	 * @param $cmdInfo array - Command info
	 * @return bool
	 */
	public function checkExpiredCmd($cmdInfo) {
		
		
		if($result = $this->db->query("SELECT date FROM " . $this->config['db_prefix'] . "log_igcmds WHERE
		profile_id='" . $this->db->real_escape_string($cmdInfo['origin']['nucleusId']) . "' AND
		soldier_id='" . $this->db->real_escape_string($cmdInfo['origin']['cdKeyHash']) . "' AND
		cmd='" . $this->db->real_escape_string($cmdInfo['cmd']) . "' AND
		cmd_index='" . $this->db->real_escape_string($cmdInfo['origin']['index']) . "' AND
		cmd_origin='" . $this->db->real_escape_string($cmdInfo['origin']['name']) . "' AND
		cmd_time='" . $this->db->real_escape_string($cmdInfo['chat']['time']) . "' AND
		cmd_message='" . $this->db->real_escape_string($cmdInfo['chat']['message']) . "' LIMIT 1")) {
							
			if($result->num_rows == 1) {
				
				return false;
				
			}
			
			$result->free();
			
		}
		
		return true;
		
	}
	
	/**
	 * logCmd()
	 * Logs a command
	 * 
	 * @param $cmdInfo array - Command info
	 * @return bool
	 */
	public function logCmd($cmdInfo, $status='failed') {
		
		return $this->db->query("INSERT INTO " . $this->config['db_prefix'] . "log_igcmds 
		(
			profile_id,
			soldier_id,
			soldier_name,
			cmd,
			cmd_index,
			cmd_origin,
			cmd_time,
			date,
			cmd_message,
			cmd_status
		)
		VALUES(
			'" . $this->db->real_escape_string($cmdInfo['origin']['nucleusId']) . "',
			'" . $this->db->real_escape_string($cmdInfo['origin']['cdKeyHash']) . "',
			'" . $this->db->real_escape_string($cmdInfo['origin']['name']) . "',
			'" . $this->db->real_escape_string($cmdInfo['cmd']) . "',
			'" . $this->db->real_escape_string($cmdInfo['origin']['index']) . "',
			'" . $this->db->real_escape_string($cmdInfo['origin']['name']) . "',
			'" . $this->db->real_escape_string($cmdInfo['chat']['time']) . "',
			NOW(),
			'" . $this->db->real_escape_string($cmdInfo['chat']['message']) . "',
			'" . $this->db->real_escape_string($status) . "'
		)");
		
	}
	
	/**
	 * executeCommand()
	 * Executes command and checks
	 * 
	 * @param $cmdInfo array - Command info
	 * @return void
	 */
	public function executeCommand($cmdInfo) {
		
		if($this->checkExpiredCmd($cmdInfo)) {
			
			$function = $cmdInfo['_cmd']['cmd_function'];
			
			$result = $this->$function($cmdInfo);
			
			if($result['code'] == 'OK') {
				
				$this->logCmd($cmdInfo, 'success');
				
			} else {
				
				$this->logCmd($cmdInfo);
				$this->ct->send($result['message']);
				
			}
		
		}
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * ALL THE COMMANDS
	 * ALL THE COMMANDS
	 * ALL THE COMMANDS
	 * ALL THE COMMANDS
	 */
	
	/**
	 * cmdKickPlayer()
	 * Kicks player
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdKickPlayer($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 2);
			
			if(!empty($varsSplit[0])) {
				$result = $this->findPlayerByName($varsSplit[0]);
								
				if($result['code'] == 'OK') {
					$this->pl->kick($result['player']['index'], ((isset($varsSplit[1])) ? $varsSplit[1] : ((!empty($cmdInfo['_cmd']['cmd_response'])) ? $cmdInfo['_cmd']['cmd_response'] : 'Unknown')));
					$return['code'] = 'OK';
				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to kick';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to kick';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdWarnPlayer()
	 * Warns player
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdWarnPlayer($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 2);
						
			if(!empty($varsSplit[0])) {
				$result = $this->findPlayerByName($varsSplit[0]);
								
				if($result['code'] == 'OK') {					
					$this->ct->send('|ccc| WARNING ' . $result['player']['name'] . ': ' . ((isset($varsSplit[1])) ? $varsSplit[1] : ((!empty($cmdInfo['_cmd']['cmd_response'])) ? $cmdInfo['_cmd']['cd']['cmd_response'] : 'Unknown')));
					$return['code'] = 'OK';
				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to warn';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to warn';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdBanPlayer()
	 * Bans player
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdBanPlayer($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 3);
						
			if(($varsSplit[0] == '0' || !empty($varsSplit[0])) && is_numeric(trim($varsSplit[0]))) {
				
				if(isset($varsSplit[1]) && !empty($varsSplit[1])) {
					$result = $this->findPlayerByName($varsSplit[1]);
					
					$reason = ((isset($varsSplit[2])) ? $varsSplit[2] : ((!empty($cmdInfo['_cmd']['cmd_response'])) ? $cmdInfo['_cmd']['cmd_response'] : 'Unknown'));
					if($varsSplit[0] == 0) {
						$until = '0000-00-00 00:00:00';
					} else {
						$until = time() + $varsSplit[0] * 3600;
						$until = date('Y-m-d H:i:s', $until);
					}
					
					if($result['code'] == 'OK') {
						
						$bl = new Blacklist($this->db, $this->config);
						
						$ban = $bl->addBan($cmdInfo['origin']['userId'], $result['player']['nucleusId'], $reason, $until);
						
						if($ban == true) {
							$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| ' . $result['player']['name'] . ' is succesfully banned');
							$return['code'] = 'OK';
						} else {
							$return['message'] = '|ccc| Could not ban the player, probably this player already has a ban';
						}
						
					} else {
						$return['message'] = $result['message'];
					}
				} else {
					$return['message'] = '|ccc| Please specify a player to ban';
				}

			} else {
				$return['message'] = '|ccc| Please specify a amount of hours for how long the ban lasts, 0 = permanent';
			}
			
		} else {
			$return['message'] = '|ccc| There are missing parameters for this command: {time} {player} {reason}';
		}
		
		return $return;
		
	}

	// ------------------------------------------------------------------------------------------------------------ //

	/**
	 * cmdChangeMap()
	 * Change map
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdChangeMap($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 2);
			
			if(!empty($varsSplit[0])) {
				$result = searchMapKey($varsSplit[0]);
				$mode = ((isset($varsSplit[1])) ? searchGameModeKey($varsSplit[1]) : 'gpm_sa');
				if($result != false) {
					$this->sv->changeMap($result, searchGameModeKey($mode));
					$this->ct->send('|ccc| Changing map...');
					$return['code'] = 'OK';
				} else {
					$return['message'] = '|ccc| Map \'' . $varsSplit[0] . '\' was not found!';
				}
			} else {
				$return['message'] = '|ccc| Please specify a map, parameters: {map} {gamemode}';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a map';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdNextMap()
	 * Switch to next map
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdNextMap($cmdInfo) {
		
		$this->ct->send("|ccc| Switching to next map...");
		$this->sv->skipToNextMap();
		
		return array(
			'code' => 'OK'
		);
		
	}
	
	/**
	 * cmdVip()
	 * Add or delete a player as VIP
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdVip($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
										
			if(!empty($cmdInfo['vars'])) {
				$result = $this->findPlayerByName($cmdInfo['vars']);
								
				if($result['code'] == 'OK') {
					
					if($result['player']['vip'] == '1') {
						$this->pl->setVip($result['player']['name'], $result['player']['nucleusId'], 0);
						$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| ' . $result['player']['name'] . ' is deleted as a VIP!');
						$return['code'] = 'OK';
					} else {
						$this->pl->setVip($result['player']['name'], $result['player']['nucleusId'], 1);
						$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| ' . $result['player']['name'] . ' is added as a VIP!');
						$return['code'] = 'OK';
					}
					
				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to add or delete as VIP';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to add or delete as VIP';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdRestartRound()
	 * Restarts round
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdRestartRound($cmdInfo) {
		
		$this->ct->send('|ccc| Round is being restarted...');
		$this->sv->restartMap();
		
		return array(
			'code' => 'OK'
		);
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdSwitchPlayer()
	 * Switches a player to the other team
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdSwitchPlayer($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$result = $this->findPlayerByName($cmdInfo['vars']);
							
			if($result['code'] == 'OK') {
								
				$this->pl->switchPlayer($result['player']['index']);
				$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| Switched ' . $result['player']['name'] . ' to the other team');
				$return['code'] = 'OK';
				
			} else {
				$return['message'] = $result['message'];
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to switch';
		}
		
		return $return;
		
	}

	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdExecRcon()
	 * Execute RCON command
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdExecRcon($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
			
			$return['code'] = 'OK';
			$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| RCON response: ' . $this->rc->query($cmdInfo['vars']));
			
		} else {
			$return['message'] = '|ccc| Please specify a RCON command';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdWhiteList()
	 * Add/Remove player from the whitelist
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdWhiteList($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
										
			if(!empty($cmdInfo['vars'])) {
				$result = $this->findPlayerByName($cmdInfo['vars']);
								
				if($result['code'] == 'OK') {
					
					$wl = new Whitelist($this->db, $this->config);
					$check = $wl->checkPlayer($result['player']['nucleusId']);
					
					if($check) {
						$wl->deletePlayer($wl->listId);
						$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| ' . $result['player']['name'] . ' is deleted as from the whitelist!');
						$return['code'] = 'OK';
					} else {
						$wl->addPlayer($cmdInfo['origin']['userId'], $result['player']['nucleusId']);
						$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| ' . $result['player']['name'] . ' is added to the whitelist!');
						$return['code'] = 'OK';
					}
					
				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to add or delete from the whitelist';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to add or delete from the whitelist';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdRequestPlayerstats()
	 * Requests the global statistics of a player
	 * 
	 * @param $cmdInfo - Command Info
	 * @return array - Status
	 */
	public function cmdRequestPlayerStats($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
										
			if(!empty($cmdInfo['vars'])) {
				$result = $this->findPlayerByName($cmdInfo['vars']);
								
				if($result['code'] == 'OK') {
					
					$st = new T4G\BFP4F\Rcon\Stats($result['player']['nucleusId'], $result['player']['cdKeyHash']);
					
					$data = $st->retrieveCoreStats();
					
					$stats = (array) $data->data->CoreStats;
					
					$msg = 'Stats of |ccc| ' . $result['player']['name'] . ': |ccc| || Level: |ccc| ' . $result['player']['level'] . ' |ccc| || Class: |ccc| ' . $result['player']['class'] . ' |ccc| || KD: |ccc| ' . $stats['killratio'] . ' |ccc| || Accuracy: |ccc| ' . $stats['accuracy']*100 . '% |ccc| || HS ratio: |ccc| ' . $stats['headshotratio']*100 . '% |ccc| || Killstreak: |ccc| ' . $stats['killStreak'] . ' |ccc| || Deathstreak: |ccc| ' . $stats['deathStreak'];
					
					$this->ct->sendPlayer($cmdInfo['origin']['index'], $msg);
					
					$return['code'] = 'OK';

				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to check';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to check';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdReportPlayer()
	 * Report a player to the global blacklist
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdReportPlayer($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 2);
			if(isset($varsSplit[0]) && !empty($varsSplit[0])) {
				
				$result = $this->findPlayerByName($varsSplit[0]);
				if($result['code'] == 'OK') {
					
					if(isset($varsSplit[1]) && strlen($varsSplit[1]) > 25) {
						$api = new BT\API\Base;
						
						$api->init(
							'blacklist',
							array(
								'cmd' => 'submitPlayer',
								'reporter' => $cmdInfo['origin']['nucleusId'],
								'bfp4fId' => $result['player']['nucleusId'],
								'reason' => 'cheating',
								'desc' => $varsSplit[1]
							)
						);
						
						$api->execute();
						
						if($api->requestStatus[0] == 'success') {
							$msg = '|ccc| Player ' . $result['player']['name'] . ' has been reported to the BattlefieldTools Global Blacklist!';
							$this->ct->sendPlayer($cmdInfo['origin']['index'], $msg);
							$return['code'] = 'OK';
						} else {
							$return['message'] = '|ccc| ' . $api->requestStatus[1];
						}
						
					} else {
						$return['message'] = '|ccc| The reason has to be 25 characters or more';
					}
					
				} else {
					$return['message'] = '|ccc| Please specify a player to report';
				}
				
			} else {
				$return['message'] = '|ccc| Please specify a player to report';
			}
			
		} else {
			$return['message'] = '|ccc| There are missing parameters for this command: {player} {reason}';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdFunnyWord()
	 * {player1} {word} {player2}
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdFunnyWord($cmdInfo) {
			
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
			$result = $this->findPlayerByName($cmdInfo['vars']);
			
			if($result['code'] == 'OK') {
				$this->ct->send('|ccc| ' . $cmdInfo['origin']['name'] . ' ' . $cmdInfo['_cmd']['cmd_response'] . ' ' . $result['player']['name']);
			} else {
				$this->ct->send('|ccc| ' . $cmdInfo['origin']['name'] . ' ' . $cmdInfo['_cmd']['cmd_response'] . ' ' . $cmdInfo['vars']);
			}
		} else {
			$this->ct->send('|ccc| ' . $cmdInfo['origin']['name'] . ' ' . $cmdInfo['_cmd']['cmd_response'] . ' something');
		}
		
		return array(
			'code' => 'OK'
		);
		
	}

	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdRagequit()
	 * Kicks the player because he wants to ragequit
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdRagequit($cmdInfo) {
				
		$this->pl->kick($cmdInfo['chat']['index'], 'Requested kick, he is going to ragequit, poor guy!');
		
		return array(
			'code' => 'OK'
		);
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdMessage()
	 * Sends a message back
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdMessage($cmdInfo) {
		
		$return = replace($cmdInfo['_cmd']['cmd_response'], array(
			'%player%' => $cmdInfo['origin']['name'],
			'%ping%' => $cmdInfo['origin']['ping'],
			'%class%' => str_replace(array('_','kit','RU','US'), '', $cmdInfo['origin']['kit']),
			'%rank%' => $cmdInfo['origin']['level'],
			'%kills%' => $cmdInfo['origin']['kills'],
			'%deaths%' => $cmdInfo['origin']['deaths'],
			'%kd%' => round($cmdInfo['origin']['kills']/(($cmdInfo['origin']['deaths'] == 0) ? 1 : $cmdInfo['origin']['deaths']), 2, PHP_ROUND_HALF_UP),
			'%score%' => $cmdInfo['origin']['score'],
			'%vip%' => (($cmdInfo['origin']['vip'] == '1') ? 'Yes' : 'No'),
			'%position%' => $cmdInfo['origin']['position'],
		));
		
		if($cmdInfo['_cmd']['cmd_response_private'] == 'yes') {
			$this->ct->sendPlayer($cmdInfo['origin']['index'], $return);
		} else {
			$this->ct->send($return);
		}
		
		return array(
			'code' => 'OK'
		);
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdPm()
	 * Sends a PM (private message) to other player
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdPm($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
				
			$varsSplit = explode(' ', $cmdInfo['vars'], 2);
						
			if(!empty($varsSplit[0])) {
				$result = $this->findPlayerByName($varsSplit[0]);
								
				if($result['code'] == 'OK') {
										
					$this->ct->sendPlayer($result['player']['index'], '|ccc| PM from ' . $cmdInfo['origin']['name'] . ': ' . ((isset($varsSplit[1])) ? $varsSplit[1] : 'No message given'));
					$this->ct->sendPlayer($cmdInfo['origin']['index'], '|ccc| PM is sent to ' . $result['player']['name']);
					$return['code'] = 'OK';
					
				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to send a PM';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to send a PM';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * Voting functions
	 */
	public function cmdVotekick($cmdInfo) {
		return $this->cmdVoting('voteKick', $cmdInfo);
	}
	
	public function cmdVoteMap($cmdInfo) {
		return $this->cmdVoting('voteMap', $cmdInfo);
	}
	
	public function cmdVoteRestart($cmdInfo) {
		return $this->cmdVoting('voteRestart', $cmdInfo);
	}
	
	public function cmdVoteYes($cmdInfo) {
		return $this->cmdVoting('voteYes', $cmdInfo);
	}
	
	public function cmdClosePoll($cmdInfo) {
		return $this->cmdVoting('closeActivePoll', $cmdInfo);
	}
	
	/**
	 * cmdVoting()
	 * Call a function @ IgVoting class
	 * 
	 * @param $function str - Function to call
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function cmdVoting($function, $cmdInfo) {
		$result = $this->voting->$function($cmdInfo);
		return $result;
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	public function cmdGetLoadout($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
										
			if(!empty($cmdInfo['vars'])) {
				$result = $this->findPlayerByName($cmdInfo['vars']);
								
				if($result['code'] == 'OK') {
					
					$st = new T4G\BFP4F\Rcon\Stats($result['player']['nucleusId'], $result['player']['cdKeyHash']);
					$loadout = $st->retrieveLoadout();
					$weapons = array( );
					$msg = '';
					foreach($loadout['data']['equipment'] as $key => $value) {
						$msg[] = $value['name'];
					}
					
					$msg = implode(', ', $msg);
					$msg = '|ccc| Loadout of ' . $result['player']['name'] . ': ' . $msg;
					
					$this->ct->sendPlayer($cmdInfo['origin']['index'], $msg);
					
					$return['code'] = 'OK';

				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to get the loadout of';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to get the loadout of';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	public function cmdGetAttachments($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
										
			if(!empty($cmdInfo['vars'])) {
				$result = $this->findPlayerByName($cmdInfo['vars']);
								
				if($result['code'] == 'OK') {
					
					$st = new T4G\BFP4F\Rcon\Stats($result['player']['nucleusId'], $result['player']['cdKeyHash']);
					$loadout = $st->retrieveLoadout();
					$weapons = array( );
					$msg = '';
					foreach($loadout['data']['equipment'] as $key => $value) {
						if(isset($value['attachments']) && count($value['attachments']) > 0) {
							$weapons[$value['id']] = array(
								$value['attachments'],
								$value['name'],
							);
						}
					}
					
					$attachments = array( );
					foreach($loadout['data']['attachments'] as $attachment) {
						$attachments[$attachment['id']] = $attachment['name'];
					}
					
					foreach($weapons as $weapon) {
						$attachments0 = array( );
						foreach($weapon[0] as $aId) {
							$attachments0[] = $attachments[$aId];
						}
						$msg .= $weapon[1] . ': ' . implode(', ', $attachments0) . '. ';
					}
					
					$msg = '|ccc| Attachments of ' . $result['player']['name'] . ': ' . $msg;
					
					$this->ct->sendPlayer($cmdInfo['origin']['index'], $msg);
					
					$return['code'] = 'OK';

				} else {
					$return['message'] = $result['message'];
				}
			} else {
				$return['message'] = '|ccc| Please specify a player to get the attachments of';
			}
			
		} else {
			$return['message'] = '|ccc| Please specify a player to get the attachments of';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
}
?>