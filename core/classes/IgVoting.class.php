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

class IgVoting {
	
	protected $db,
			  $config,
			  $settings;
	
	public	  $rc,
			  $sv,
			  $ct,
			  $pl,
			  $igc;
	
	function __construct($rc, $sv, $ct, $pl, $db, $config, $settings) {
		$this->rc = $rc;
		$this->sv = $sv;
		$this->ct = $ct;
		$this->pl = $pl;
		$this->db = $db;
		$this->config = $config;
		$this->settings = $settings;
	}
	
	public function setIgc($igc) {
		$this->igc = $igc;
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * getActivePoll()
	 * Get the active poll
	 * 
	 * @return array - Status + info
	 */
	public function getActivePoll() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "igvote WHERE vote_status='pending' LIMIT 1")) {
			
			if($result->num_rows == 1) {
				return array('code' => 'OK', 'poll' => $result->fetch_array());
			} else {
				return array('code' => 'ERROR', 'message' => '{%tool_igcmds_err1%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * checkPollActive()
	 * Check if a poll is active
	 * 
	 * @return bool
	 */
	public function checkPollActive() {
		
		$result = $this->getActivePoll();
		if($result['code'] == 'OK') {
			return true;
		}
		
		return false;
		
	}
	
	/**
	 * closeActivePoll()
	 * Close active poll
	 * 
	 * @return void
	 */
	public function closeActivePoll() {
		
		$result = $this->getActivePoll();
		if($result['code'] == 'OK') {
			$this->closePoll($result['poll']['vote_id']);
			$this->ct->send('|ccc| Poll closed.');
		}
		return array(
			'code' => 'OK'
		);
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * closePoll()
	 * Close a poll
	 * 
	 * @param $pollId int - Poll ID
	 * @return bool
	 */
	public function closePoll($pollId) {
		
		return $this->db->query("UPDATE " . $this->config['db_prefix'] . "igvote SET vote_status='closed' WHERE vote_id='" . $this->db->real_escape_string($pollId) . "' LIMIT 1");
		
	}
	
	/**
	 * executedPoll()
	 * Set as executed a poll
	 * 
	 * @param $pollId int - Poll ID
	 * @return bool
	 */
	public function executedPoll($pollId) {
		
		return $this->db->query("UPDATE " . $this->config['db_prefix'] . "igvote SET vote_status='executed' WHERE vote_id='" . $this->db->real_escape_string($pollId) . "' LIMIT 1");
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * createPoll()
	 * Create a poll
	 * 
	 * @param $cmd str - Command to execute
	 * @param $nucleusId str - Profile ID a.k.a. nucleusID
	 * @param $cdKeyHash str - Soldier ID a.k.a. cdKeyHash
	 * @param $args array - Args
	 */
	public function createPoll($cmd, $nucleusId, $cdKeyHash, $args) {
		
		$args = json_encode($args);
		
		return $this->db->query("INSERT INTO " . $this->config['db_prefix'] . "igvote (c_profile_id,c_soldier_id,vote_action,vote_votes,vote_args,vote_date) VALUES (
			'" . $this->db->real_escape_string($nucleusId) . "',
			'" . $this->db->real_escape_string($cdKeyHash) . "',
			'" . $this->db->real_escape_string($cmd) . "',
			'" . $this->db->real_escape_string(json_encode($nucleusId)) . "',
			'" . $this->db->real_escape_string($args) . "',
			NOW()
		)");
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * voteYes()
	 * Vote yes
	 * 
	 * @param $cmdInfo array - Command info
	 * @return array - Status + info
	 */
	public function voteYes($cmdInfo) {
		
		$poll = $this->getActivePoll();
		
		if($poll['code'] == 'OK') {
		
			$votes = json_decode($poll['poll']['vote_votes'], true);
			
			if(in_array($cmdInfo['origin']['nucleusId'], $votes)) {
				return array('code' => 'ERROR', 'message' => '|ccc| ' . $cmdInfo['origin']['name'] . ', you\'ve already voted');
			} else {
				$votes[] = $cmdInfo['origin']['nucleusId'];
				
				if($result = $this->db->query("UPDATE " . $this->config['db_prefix'] . "igvote SET vote_votes='" . $this->db->real_escape_string(json_encode($votes)) . "' WHERE vote_id='" . $this->db->real_escape_string($poll['poll']['vote_id']) . "' AND vote_status='pending' LIMIT 1")) {
					$this->ct->send('|ccc| ' . $cmdInfo['origin']['name'] . ' voted yes. Votes status: ' . count($votes) . ' / ' . $this->settings['tool_igcmds_votes']);
					return array('code' => 'OK');
					$result->free();
				} else {
					return array('code' => 'ERROR', 'message' => $this->db->error);
				}
			}

		} else {
			return array('code' => 'ERROR', 'message' => '|ccc| There is currently no poll active');
		}
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * voteKick()
	 * Create votekick
	 * 
	 * @param $cmdInfo array - Command info
	 * @return array
	 */
	public function voteKick($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!$this->checkPollActive()) {
			if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
					
				$varsSplit = explode(' ', $cmdInfo['vars'], 2);
				
				if(!empty($varsSplit[0])) {
					$result = $this->igc->findPlayerByName($varsSplit[0]);
									
					if($result['code'] == 'OK') {
						$this->createPoll('cmdVotekickExec', $cmdInfo['origin']['nucleusId'], $cmdInfo['origin']['cdKeyHash'], array(
							'index' => $result['player']['index'],
							'reason' => ((isset($varsSplit[1])) ? $varsSplit[1] : 'Unknown')
						));
						$return['code'] = 'OK';
						$this->ct->send('|ccc| Votekick poll created for player \'' . $result['player']['name'] . '\'. ' . ($this->settings['tool_igcmds_votes']-1) . ' more votes needed. Type !yes to approve.');
					} else {
						$return['message'] = $result['message'];
					}
				} else {
					$return['message'] = '|ccc| Please specify a player to votekick';
				}
				
			} else {
				$return['message'] = '|ccc| Please specify a player to votekick';
			}
		} else {
			$return['message'] = '|ccc| There\'s already a poll going on. Please wait until that poll ends...';
		}
		
		return $return;
		
	}
	
	/**
	 * voteMap()
	 * Votemap
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function voteMap($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!$this->checkPollActive()) {
			if(!empty($cmdInfo['vars']) || $cmdInfo['vars'] != null) {
					
				$varsSplit = explode(' ', $cmdInfo['vars'], 2);
				
				if(!empty($varsSplit[0])) {
					$result = searchMapKey($varsSplit[0]);
					$mode = ((isset($varsSplit[1])) ? searchGameModeKey($varsSplit[1]) : 'gpm_sa');
					if($result != false) {
						
						$mc = new GameMaps();
						$mapName = $mc->getMapName($result);
						$modeName = $mc->getGameMode(searchGameModeKey($mode));
						
						$this->createPoll('cmdVotemapExec', $cmdInfo['origin']['nucleusId'], $cmdInfo['origin']['cdKeyHash'], array(
							'map' => $result,
							'map_name' => $mapName,
							'gamemode' => searchGameModeKey($mode),
							'gamemode_name' => $modeName,
						));
						$return['code'] = 'OK';
						$this->ct->send('|ccc| Votemap poll created for map ' . $mapName . ' ' . $modeName . '. ' . ($this->settings['tool_igcmds_votes']-1) . ' more votes needed. Type !yes to approve.');
					
					} else {
						$return['message'] = '|ccc| Map \'' . $varsSplit[0] . '\' was not found!';
					}
				} else {
					$return['message'] = '|ccc| Please specify a map, parameters: {map} {gamemode}';
				}
				
			} else {
				$return['message'] = '|ccc| Please specify a map';
			}
		} else {
			$return['message'] = '|ccc| There\'s already a poll going on. Please wait until that poll ends...';
		}
		
		return $return;
		
	}

/**
	 * voteRestart()
	 * Voterestart
	 * 
	 * @param $cmdInfo - Command info
	 * @return array - Status
	 */
	public function voteRestart($cmdInfo) {
		
		$return = array(
			'code' => 'ERROR',
			'message' => '',
		);
		
		if(!$this->checkPollActive()) {

			$this->createPoll('cmdVoteRestartExec', $cmdInfo['origin']['nucleusId'], $cmdInfo['origin']['cdKeyHash'], array());
			$return['code'] = 'OK';
			$this->ct->send('|ccc| Voterestart poll created. ' . ($this->settings['tool_igcmds_votes']-1) . ' more votes needed. Type !yes to approve.');
					
		} else {
			$return['message'] = '|ccc| There\'s already a poll going on. Please wait until that poll ends...';
		}
		
		return $return;
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
	/**
	 * cmdVotekickExec()
	 * Execute votekick
	 * 
	 * @param $poll array - Poll
	 * @return void
	 */
	public function cmdVotekickExec($poll) {
		
		$args = json_decode($poll['vote_args'], true);
		$this->pl->kick($args['index'], '[VOTEKICK] for ' . $args['reason']);
		
	}
	
	/**
	 * cmdVotemapExec()
	 * Execute votemap
	 * 
	 * @param $poll array - Poll
	 * @return void
	 */
	public function cmdVotemapExec($poll) {
		
		$args = json_decode($poll['vote_args'], true);
		$this->sv->changeMap($args['map'], $args['gamemode']);
		$this->ct->send('|ccc| VOTEMAP success! Changing map to ' . $args['map_name'] . ' ' . $args['gamemode_name'] . '...');
		
	}
	
	/**
	 * cmdVoteRestartExec()
	 * Execute voterestart
	 * 
	 * @param $poll array - Poll
	 * @return void
	 */
	public function cmdVoteRestartExec($poll) {
		
		$this->sv->restartMap();
		$this->ct->send('|ccc| VOTERESTART success! Restarting round...');
		
	}
	
	// ------------------------------------------------------------------------------------------------------------ //
	
}
