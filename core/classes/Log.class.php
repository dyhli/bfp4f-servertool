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
 
class Log {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * insertActionLog()
	 * Insert in the action log
	 * 
	 * @param $user_id int - User ID
	 * @param $desc str - Description of action
	 * @return array - Status
	 */
	public function insertActionLog($user_id, $desc) {
		
		if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "log_cp_actions (user_id,description,action_date) VALUES (
			'" . $this->db->real_escape_string($user_id) . "',
			'" . $this->db->real_escape_string($desc) . "',
			NOW()
		)")) {
			
			return array('code' => 'OK');
			
		} else {
			
			return array('code' => 'ERROR', 'message' => $this->db->error);
			
		}
		
	}
	
	/**
	 * insertKickLog()
	 * Insert in the kick log
	 * 
	 * @param $profile_id str - Profile ID
	 * @param $soldier_id str - Soldier ID
	 * @param $soldier_name str - Soldier name
	 * @param $reason - Reason of the kick
	 * @return array - Status
	 */
	public function insertKickLog($profile_id, $soldier_id, $soldier_name, $reason='Unknown') {
		
		if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "log_autokick (profile_id,soldier_id,soldier_name,kick_reason,kick_date) VALUES (
			'" . $this->db->real_escape_string($profile_id) . "',
			'" . $this->db->real_escape_string($soldier_id) . "',
			'" . $this->db->real_escape_string($soldier_name) . "',
			'" . $this->db->real_escape_string($reason) . "',
			NOW()
		)")) {
			
			return array('code' => 'OK');
			
		} else {
			
			return array('code' => 'ERROR', 'message' => $this->db->error);
			
		}
		
	}
	
	/**
	 * fetchLog()
	 * Fetch a log
	 * 
	 * @param $log str - Name of log
	 * @return array - Status + info
	 */
	public function fetchLog($log) {
		
		// Available logs
		$aLogs = array('autokick', 'cp_actions', 'igcmds');
		
		if(in_array($log, $aLogs)) {
			
			if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "log_" . $log . " ORDER BY id DESC")) {
				
				$items = array();
				while($a = $result->fetch_assoc()) {
					$items[] = $a;
				}
				
				return array('code' => 'OK', 'items' => $items);
				
				$result->free();
				
			} else {
				return array('code' => 'ERROR', 'message' => $this->db->error);
			}
			
		} else {
			return array('code' => 'ERROR', 'message' => '{%tool_logs_err1%}');
		}
		
	}
	
}
 
?>