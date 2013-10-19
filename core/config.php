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
 
// CHANGE THIS!
// CHANGE THIS!
// CHANGE THIS!

// Your home URL, end with a backslash
define('HOME_URL', 'http://localhost/path/to/this/tool/');

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
	
	// Max available player level in BFP4F (do not change)
	'max_player_lvl' => 30,
	
);

// DON'T CHANGE
// DON'T CHANGE
// DON'T CHANGE

define('TOOL_VERSION', 'v0.4.1');
?>