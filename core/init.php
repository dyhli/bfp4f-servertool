<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.6.0
 *
 * Copyright (C) 2013 <Danny Li> a.k.a. SharpBunny
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
ob_start();
session_start();

// Namespaces
use T4G\BFP4F\Rcon as rcon;
use BT\API as Api;

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

// Language preference
// Stores the language preference using a cookie, if no cookie is set, use the default language
if(isset($_COOKIE['LangPref'])) {
	if(file_exists(CORE_DIR . '/lang/' . $_COOKIE['LangPref'] . '.php')) {
		require_once(CORE_DIR . '/lang/' . $_COOKIE['LangPref'] . '.php');
	} else {
		require_once(CORE_DIR . '/lang/' . $settings['cp_default_lang'] . '.php');
	}
} else {
	require_once(CORE_DIR . '/lang/en.php');
}

// Switch language
if(isset($_GET['lang'])) {
	if(file_exists(CORE_DIR . '/lang/' . $_GET['lang'] . '.php')) {
		setcookie('LangPref', $_GET['lang'], time()+31449600, '/');
		require_once(CORE_DIR . '/lang/' . $_GET['lang'] . '.php');
	}
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
	
	$rc = new rcon\Base();
	$rc->ip = decrypt($settings['server_ip']);
	$rc->port = (int) decrypt($settings['server_admin_port']);
	$rc->pwd = decrypt($settings['server_rcon_password']);
	
	// User class
	$user = new User($db, $config);
	
	// Log class
	$log = new Log($db, $config);
	
	// BattlefieldTools API class
	$api = new Api\Base();
	$api->setUser(decrypt($settings['api_username']));
	$api->setKey(decrypt($settings['api_key']));
	
	// If user is logged in, then fetch the user
	if($user->checkLogin()) {
		$userInfo = $user->fetchUser();
	}

}
?>