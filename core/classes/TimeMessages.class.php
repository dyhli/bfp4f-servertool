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
 
class TimedMessages {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * fetchMessages()
	 * Fetch all the messages
	 * 
	 * @return array - Status + info
	 */
	public function fetchMessages() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "timed_msg")) {
			
			if($result->num_rows > 0) {
				
				$return = array( );
				
				while($msg = $result->fetch_assoc()) {
					$return[] = $msg;
				}
				
				return array('code' => 'OK', 'msg' => $return);
			} else {
				return array('code' => 'ERROR', 'message' => '{%cp_itemlist_err1%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * fetchMessage()
	 * Fetch a message
	 * 
	 * @param $id int - Admin ID
	 * @return array - Status + array
	 */
	public function fetchMessage($id) {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "timed_msg WHERE
		msg_id='" . $this->db->real_escape_string($id) . "'")) {
			
			if($result->num_rows == 1) {
				return array('code' => 'OK', 'msg' => $result->fetch_array());
			} else {
				return array('code' => 'ERROR', 'message' => '{%tool_tmsg_err1%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * createMessage()
	 * Create a message
	 * 
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function createMessage($info) {
		
		$keys = "";
		$vars = "";
		foreach($info as $key => $value) {
			$keys .= $key . ",";
			$vars .= "'" . $this->db->real_escape_string($value) . "',";
		}
		$keys = substr($keys, 0, -1);
		$vars = substr($vars, 0, -1);
		
		$sql = "INSERT INTO " . $this->config['db_prefix'] . "timed_msg (" . $keys . ")
		VALUES (" . $vars . ")";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * updateMessage()
	 * Update a message
	 * 
	 * @param $id int - Admin ID
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function updateMessage($id, $info) {
		
		$vars = "";
		foreach($info as $key => $value) {
			$vars .= "{$key} = '" . $this->db->real_escape_string($value) . "',";
		}
		$vars = substr($vars, 0, -1);
		
		$sql = "UPDATE " . $this->config['db_prefix'] . "timed_msg SET " . $vars . " WHERE msg_id='" . $this->db->real_escape_string($id) . "'";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * deleteMessage()
	 * Delete a message
	 * 
	 * @param $id int - Admin ID
	 * @return array - Status
	 */
	public function deleteMessage($id) {
		
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "timed_msg WHERE
		msg_id='" . $this->db->real_escape_string($id) . "'");
		
	}
	
}
 
?>