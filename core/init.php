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
ob_start();
session_start();

// Rcon classes namespace
use T4G\BFP4F\Rcon as rcon;

// Do not display errors
#error_reporting(0);

// Define some stuff
define('CORE_DIR', __DIR__);
 
// Include the configuration file
require_once(CORE_DIR . '/config.php');

// Measuring pageload time
$pageStart = microtime(true);

// Connect to database using MySQLi
$db = new mysqli($config['db_host'], $config['db_username'], $config['db_password'], $config['db_name']);

if($db->connect_errno) {
	die('Could not connect to the database ('.$db->connect_errno.') '.$db->connect_error);
}

// Characterset utf8
$db->set_charset('utf8');

// Include all the functions
foreach(glob(CORE_DIR . '/functions/*.php') as $file) {
	require_once($file);
}
// Include all the classes
foreach(glob(CORE_DIR . '/classes/*.php') as $file) {
	require_once($file);
}
// RCON classes
foreach(glob(CORE_DIR . '/classes/RCON/*.php') as $file) {
	require_once($file);
}

/**
 * Only execute when it's not the installation page
 */
if(!defined('INSTALL_PAGE')) {
	
	// Get the settings from DB
	$settings = array();
	
	function fetchSettings() {
		
		global $db;
		global $config;
		global $settings;
		
		if($result = $db->query("SELECT setting_name, setting_value FROM " . $config['db_prefix'] . "settings")) {
			
			while($setting = $result->fetch_assoc()) {
				$settings[$setting['setting_name']] = $setting['setting_value'];
			}
			
			$result->free();
		} else {
			// Redirect to installation page
			header('Location: ' . HOME_URL . 'install.php');
			die('Could not fetch the settings from the database ('.$db->connect_errno.') '.$db->connect_error);
		}
	}
	
	fetchSettings();
	
	
	
	
	
	/**
	 * INITIALZE CLASSES AND STUFF
	 */
	
	// Language preference
	// Stores the language preference using a cookie, if no cookie is set, use the default language
	if(isset($_COOKIE['LangPref'])) {
		if(file_exists(CORE_DIR . '/lang/' . $_COOKIE['LangPref'] . '.php')) {
			require_once(CORE_DIR . '/lang/' . $_COOKIE['LangPref'] . '.php');
		} else {
			require_once(CORE_DIR . '/lang/' . $settings['cp_default_lang'] . '.php');
		}
	} else {
		require_once(CORE_DIR . '/lang/' . $settings['cp_default_lang'] . '.php');
	}
	
	// Switch language
	if(isset($_GET['lang'])) {
		if(file_exists(CORE_DIR . '/lang/' . $_GET['lang'] . '.php')) {
			setcookie('LangPref', $_GET['lang'], time()+31449600, '/');
			require_once(CORE_DIR . '/lang/' . $_GET['lang'] . '.php');
		}
	}
	
	$rc = new rcon\Base();
	$rc->ip = decrypt($settings['server_ip']);
	$rc->port = decrypt($settings['server_admin_port']);
	$rc->pwd = decrypt($settings['server_rcon_password']);
	
	// User class
	$user = new User($db, $config);
	
	// Log class
	$log = new Log($db, $config);
	
	// If user is logged in, then fetch the user
	if($user->checkLogin()) {
		$userInfo = $user->fetchUser();
	}

}
?>
