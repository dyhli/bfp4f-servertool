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