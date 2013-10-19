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
 
class Blacklist {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * addBan()
	 * Add a ban to the blacklist
	 * 
	 * @param $admin int - Admin ID
	 * @param $profileId str - ProfileId aka nucleusId
	 * @param $reason str - Reason
	 * @param $until str - Ban until? (0000-00-00 00:00:00 = forever)
	 */
	public function addBan($admin, $profileId, $reason='Unknown', $until='0000-00-00 00:00:00') {
		
		// First check if the player already has a permanent ban
		$check = $this->checkPlayer($profileId);
		if($check['code'] == 'OK' && $until == '0000-00-00 00:00:00') {
			return '{%tool_bl_err1%}';
		} else {
			
			// Get the soldiernames
			$data = json_decode(file_get_contents("http://battlefield.play4free.com/en/profile/soldiers/" . $profileId), true);
			if(count($data['data']) == 0) {
				return '{%tool_bl_err2%}';
			} else {
				
				foreach($data['data'] as $soldier) {
					$soldiers[] = $soldier['name'];
				}
				$soldiers = implode(' / ', $soldiers);
				
				if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "blacklist (ban_by,profile_id,soldier_names,ban_date,ban_until,ban_reason) VALUES (
					'" . $this->db->real_escape_string($admin) . "',
					'" . $this->db->real_escape_string($profileId) . "',
					'" . $this->db->real_escape_string($soldiers) . "',
					NOW(),
					'" . $this->db->real_escape_string($until) . "',
					'" . $this->db->real_escape_string($reason) . "'
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
	 * Fetch the bans
	 * 
	 * @return array
	 */
	public function fetchList() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "blacklist")) {
			
			if($result->num_rows > 0) {
				$items = array();
				while($a = $result->fetch_assoc()) {
					$items[] = $a;
				}
				
				return array('code' => 'OK', 'list' => $items);
				
			} else {
				return array('code' => 'ERROR', 'message' => '{%tool_bl_err3%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error());
		}
		
	}
	
	/**
	 * checkPlayer()
	 * Check if a user is in the blacklist
	 * 
	 * @param $profileId str - ProfileId aka nucleusId
	 * @return array - Status + ban info
	 */
	public function checkPlayer($profileId) {
		
		if($result = $this->db->query("SELECT ban_until as until,ban_reason as reason FROM " . $this->config['db_prefix'] . "blacklist WHERE
		profile_id='" . $this->db->real_escape_string($profileId) . "'
		AND (ban_until > NOW() OR ban_until = '0000-00-00 00:00:00')")) {
			
			if($result->num_rows > 0) {
				
				$data = $result->fetch_array();
				
				if($data['until'] == '0000-00-00 00:00:00') {
					$data['until'] = false;
				}
				return array('code' => 'OK', 'info' => $data);

			}
						
			$result->free();
			
		}
		
		return array('code' => 'ERROR', 'message' => $this->db->error);
		
	}
	
	/**
	 * deleteExpired()
	 * Deletes expired bans
	 * 
	 * @return bool
	 */
	public function deleteExpired() {
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "blacklist WHERE
		ban_until < NOW() AND ban_until != '0000-00-00 00:00:00'");
	}
	
	/**
	 * deleteBan()
	 * Delete a ban
	 * 
	 * @param $id int - Ban ID
	 * @return bool
	 */
	public function deleteBan($id) {
		
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "blacklist WHERE
		ban_id = '" . $this->db->real_escape_string($id) . "'");
		
	}
	
}
 
?>

