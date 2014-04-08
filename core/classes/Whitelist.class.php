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
 
class Whitelist {
	
	protected $db,
			  $config;
			  
	public $listId = null;
			  
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
				$a = $result->fetch_array();
				$this->listId = $a['list_id'];
				
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