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
 
class Whitelist {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * addPlayer()
	 * Add a player to the whitelist
	 * 
	 * @param $admin int - Admin ID
	 * @param $profileId str - ProfileId aka nucleusId
	 */
	public function addPlayer($admin, $profileId) {
		
		// First check if the player already has a permanent ban
		$check = $this->checkPlayer($profileId);
		if($check) {
			return '{%tool_wlist_err1%}';
		} else {
			
			// Get the soldiernames
			$data = json_decode(file_get_contents("http://battlefield.play4free.com/en/profile/soldiers/" . $profileId), true);
			if(count($data['data']) == 0) {
				return '{%tool_wlist_err2%}';
			} else {
				
				foreach($data['data'] as $soldier) {
					$soldiers[] = $soldier['name'];
				}
				$soldiers = implode(' / ', $soldiers);
				
				if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "whitelist (added_by,profile_id,soldier_names,add_date) VALUES (
					'" . $this->db->real_escape_string($admin) . "',
					'" . $this->db->real_escape_string($profileId) . "',
					'" . $this->db->real_escape_string($soldiers) . "',
					NOW()
				)")) {
					return true;
				} else {
					return $this->db->error;
				}
			
			}
			
		}
		
	}
	
	/**
	 * fetchList()
	 * Fetch the whitelisted players
	 * 
	 * @return array
	 */
	public function fetchList() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "whitelist")) {
			
			if($result->num_rows > 0) {
				$items = array();
				while($a = $result->fetch_assoc()) {
					$items[] = $a;
				}
				
				return array('code' => 'OK', 'list' => $items);
				
			} else {
				return array('code' => 'ERROR', 'message' => '{%tool_wlist_err3%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error());
		}
		
	}
	
	/**
	 * checkPlayer()
	 * Check if a user is in the whitelist
	 * 
	 * @param $profileId str - ProfileId aka nucleusId
	 * @return array - Status
	 */
	public function checkPlayer($profileId) {
		
		if($result = $this->db->query("SELECT list_id FROM " . $this->config['db_prefix'] . "whitelist WHERE
		profile_id='" . $this->db->real_escape_string($profileId) . "'")) {
			
			if($result->num_rows > 0) {
				return true;
			}
						
			$result->free();
			
		}
		
		return false;
		
	}
	
	/**
	 * deletePlayer()
	 * Delete a player from the whitelist
	 * 
	 * @param $id int - List ID
	 * @return bool
	 */
	public function deletePlayer($id) {
		
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "whitelist WHERE
		list_id = '" . $this->db->real_escape_string($id) . "'");
		
	}
	
}
 
?>

