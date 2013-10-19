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
		$aLogs = array('autokick', 'cp_actions');
		
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
			return array('code' => 'ERROR', 'message' => 'Unknown log');
		}
		
	}
	
}
 
?>

