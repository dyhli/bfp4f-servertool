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
 
class User {
	
	protected $db,
			  $config;
	#public $status;
	
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * checkLogin()
	 * Check if the user is logged in
	 * 
	 * @param $redirect boolean - Redirect the user to loginpage? true=yes,false=no
	 * @return bool $redirect=false - True=user is logged in, false=user is not logged in/session is invalid
	 */
	public function checkLogin($redirect = false) {
		
		$login = false;
		
		if(isset($_SESSION['USER_ID']) && isset($_SESSION['USER_USERNAME']) && isset($_SESSION['USER_SESSION_HASH'])) {
			$check = $this->checkSession($_SESSION['USER_ID'], $_SESSION['USER_SESSION_HASH']);
			
			if($check['code'] == 'OK') {
				$login = true;
			}
		}
		
		if($redirect) {
			if(!$login) {
				header('Location: ' . HOME_URL . 'panel/login.php');
				die();
			}
		}
		
		return $login;
		
	}
	
	/**
	 * fetchUser()
	 * Gets the user info from DB
	 * 
	 * @return array - User info
	 */
	public function fetchUser() {
		if($this->checkLogin()) {
			if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "users WHERE
			user_id='" . $this->db->real_escape_string($_SESSION['USER_ID']) . "'
			AND user_username='" . $this->db->real_escape_string($_SESSION['USER_USERNAME']) . "'")) {
				
				if($result->num_rows == 1) {
					return $result->fetch_array();
				}
				
				$result->free();
				
			} else {
				die('Could not fetch user: ' . $this->db->error);
			}
		}
		
		return null;
	}
	
	/**
	 * Login()
	 * Checks the given account details, creates the session and inserts it in the DB
	 * 
	 * @param $username str - Username
	 * @param $password str - Password
	 * @return array - Status
	 */
	public function Login($username, $password) {
		
		if($result = $this->db->query("SELECT user_id, user_username FROM " . $this->config['db_prefix'] . "users WHERE
		user_username='" . $this->db->real_escape_string($username) . "'
		AND user_password='" . hash('sha256', $password) . "'")) {
			
			if($result->num_rows == 1) {
				
				$user = $result->fetch_array();
				
				$session = $this->createSession($user['user_id']);
				if($session['code'] == 'OK') {
					
					$_SESSION['USER_ID'] = $user['user_id'];
					$_SESSION['USER_USERNAME'] = $user['user_username'];
					$_SESSION['USER_SESSION_HASH'] = $session['hash'];
					
					return array('code' => 'OK');
					
				} else {
					return array('code' => 'ERROR', 'message' => '{%cp_error_login_sessions%}');
				}
				
			} else {
				return array('code' => 'ERROR', 'message' => '{%cp_error_login%}');
			}
			
			$result->free();
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * Logout()
	 * Logout, simply destroy the session
	 * 
	 * @return array - Status
	 */
	public function Logout() {
		session_destroy();
		
		return array('code' => 'OK');
	}
	
	/**
	 * createSession()
	 * Generates a session, which is valid for two hours
	 * 
	 * @param $user_id int - User ID
	 * @return array - Status + session hash
	 */
	protected function createSession($user_id) {
		
		// Random generated session hash
		$hash = hash('sha256', time().mt_rand());
		
		// Insert the session into the database
		if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "users_sessions (user_id,session_hash,session_date,session_expire,user_ip) VALUES (
			'" . $this->db->real_escape_string($user_id) . "',
			'" . $hash . "',
			NOW(),
			NOW() + INTERVAL 1 WEEK,
			'" . $this->db->real_escape_string($_SERVER['REMOTE_ADDR']) . "'
		)")) {
			return array('code' => 'OK', 'hash' => $hash);
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
	}
	
	/**
	 * checkSession()
	 * Check if the session is valid
	 * 
	 * @param $user_id int - User ID
	 * @param $hash - Session hash
	 * @return array - Status + session status
	 */
	public function checkSession($user_id, $hash) {
		
		if($result = $this->db->query("SELECT session_id FROM " . $this->config['db_prefix'] . "users_sessions
		WHERE user_id='" . $this->db->real_escape_string($user_id) . "'
		AND session_hash='" . $this->db->real_escape_string($hash) . "'
		AND session_expire > NOW()")) {
			
			// Check if match is found
			if($result->num_rows == 1) {
				return array('code' => 'OK');
			} else {
				return array('code' => 'ERROR', 'message' => 'No session found');
			}
			
			$result->free();
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * updateAccount()
	 * Update the account
	 * 
	 * @param $name str - User name
	 * @param $pass str - Password
	 * @return array - Status
	 */
	public function updateAccount($name, $pass='') {
		
		if($this->checkLogin()) {
			
			$sqlPass = '';
			if(!empty($pass)) {
				$sqlPass = ", user_password = '" . hash('sha256', $pass) . "'";
			}
			
			if($this->db->query("UPDATE " . $this->config['db_prefix'] . "users SET
			user_name='" . $this->db->real_escape_string($name) . "'" . $sqlPass . " WHERE
			user_id='" . $this->db->real_escape_string($_SESSION['USER_ID']) . "'
			AND user_username='" . $this->db->real_escape_string($_SESSION['USER_USERNAME']) . "'")) {
				
				return array('code' => 'OK');
				
			} else {
				return array('code' => 'ERROR', 'message' => $this->db->error);
			}
			
		} else {
			return array('code' => 'ERROR', 'message' => '{%msg_user_not_loggedin%}');
		}
		
	}
	
	/**
	 * checkIgaAdmin()
	 * Checks if the player is an IGA
	 * 
	 * @param $profileId str - ProfileId aka nucleusId
	 * @return bool
	 */
	public function checkIgaAdmin($profileId) {
		
		if($result = $this->db->query("SELECT user_id FROM " . $this->config['db_prefix'] . "users WHERE
		user_profile_id='" . $this->db->real_escape_string($profileId) . "'
		AND rights_ingameadmin='yes'")) {
			
			if($result->num_rows == 1) {
				return true;
			}
			
			$result->free();
			
		}
		
		return false;
		
	}
	
}
?>