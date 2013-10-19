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
 
class Accounts {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * getNameById()
	 * Get the name by ID
	 * 
	 * @param $id int - Admin ID
	 * @return str - Name
	 */
	public function getNameById($id) {
		
		if($result = $this->db->query("SELECT user_name FROM " . $this->config['db_prefix'] . "users WHERE
		user_id='" . $this->db->real_escape_string($id) . "' LIMIT 1")) {
			
			if($result->num_rows == 1) {
				$user = $result->fetch_array();
				
				return $user['user_name'];
			}
			
			$result->free();
			
		}
		
		return null;
		
	}
	
	/**
	 * checkUsername()
	 * Check if the username already exists
	 * 
	 * @param $username str - Username to check
	 * @return bool
	 */
	public function checkUsername($username) {
		
		if($result = $this->db->query("SELECT user_id FROM " . $this->config['db_prefix'] . "users WHERE
		user_username='" . $this->db->real_escape_string(strtolower($username)) . "' LIMIT 1")) {
			
			if($result->num_rows == 1) {
				return false;
			}
			
			$result->free();
			
		}
		
		return true;
		
	}
	
	/**
	 * fetchUsers()
	 * Fetch all the users
	 * 
	 * @return array - Status + info
	 */
	public function fetchUsers() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "users")) {
			
			if($result->num_rows > 0) {
				
				$return = array( );
				
				while($user = $result->fetch_assoc()) {
					$return[] = $user;
				}
				
				return array('code' => 'OK', 'users' => $return);
			} else {
				return array('code' => 'ERROR', 'message' => '{%cp_itemlist_err1%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * fetchUser()
	 * Fetch a user
	 * 
	 * @param $id int - Admin ID
	 * @return array - Status + array
	 */
	public function fetchUser($id) {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "users WHERE
		user_id='" . $this->db->real_escape_string($id) . "'")) {
			
			if($result->num_rows == 1) {
				return array('code' => 'OK', 'user' => $result->fetch_array());
			} else {
				return array('code' => 'ERROR', 'message' => '{%tool_acc_err6%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * createUser()
	 * Create a user
	 * 
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function createUser($info) {
		
		$keys = "";
		$vars = "";
		foreach($info as $key => $value) {
			$keys .= $key . ",";
			$vars .= "'" . $this->db->real_escape_string($value) . "',";
		}
		$keys = substr($keys, 0, -1);
		$vars = substr($vars, 0, -1);
		
		$sql = "INSERT INTO " . $this->config['db_prefix'] . "users (" . $keys . ")
		VALUES (" . $vars . ")";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * updateUser()
	 * Update a user
	 * 
	 * @param $id int - Admin ID
	 * @param $info array - All the information
	 * @return str - Status
	 */
	public function updateUser($id, $info) {
		
		$vars = "";
		foreach($info as $key => $value) {
			$vars .= "{$key} = '" . $this->db->real_escape_string($value) . "',";
		}
		$vars = substr($vars, 0, -1);
		
		$sql = "UPDATE " . $this->config['db_prefix'] . "users SET " . $vars . " WHERE user_id='" . $this->db->real_escape_string($id) . "'";
		
		if($this->db->query($sql)) {
			return 'OK';
		} else {
			return $this->db->error;
		}
		
	}
	
	/**
	 * deleteUser()
	 * Delete a user
	 * 
	 * @param $id int - Admin ID
	 * @return array - Status
	 */
	public function deleteUser($id) {
		
		return $this->db->query("DELETE FROM " . $this->config['db_prefix'] . "users WHERE
		user_id='" . $this->db->real_escape_string($id) . "'");
		
	}
	
}
 
?>

