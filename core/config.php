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
 
// CHANGE THIS!
// CHANGE THIS!
// CHANGE THIS!

// Your home URL, end with a backslash
define('HOME_URL', 'http://MYDOMAIN.COM/TOOL/');

// A random string, please change this to your own random string!
// Do NOT change this after the installation
// THIS IS AN IMPORTANT STRING FOR SECURITY PURPOSES!
// THIS IS AN IMPORTANT STRING FOR SECURITY PURPOSES!
// THIS IS AN IMPORTANT STRING FOR SECURITY PURPOSES!
define('RANDOM_STRING', 'D&*(;ShDF&^v&*)SDF[SDFc87&*^]');

$config = array(
	
	# DATABASE SETTINGS (MYSQL ONLY)
	
	// Database host, usually localhost
	'db_host' => 'localhost',
	// Database username
	'db_username' => '',
	// Database password
	'db_password' => '',
	// Database name
	'db_name' => '',
	// Database table prefix (optional)
	'db_prefix' => '',
	
	// Prefixes for commands
	'cmd_prefixes' => array(
		'!', // !{cmd}
		'/', // /{cmd}
		'|', // |{cmd}
	),
	
	// Max available player level in BFP4F (do not change)
	'max_player_lvl' => 30,
	
);

// DON'T CHANGE
// DON'T CHANGE
// DON'T CHANGE

define('TOOL_VERSION', 'v0.6.0');
?>