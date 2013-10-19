<?php
/**
 * Battlefield Play4free Servertool
 * Version 0.59b
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
 
/**
 * updateSetting()
 * Update the setting in the DB
 * 
 * @param $name str - Setting name
 * @param $value str - New value
 * @return bool
 */
function updateSetting($name, $value) {
	global $db;
	global $config;
	
	if($db->query("UPDATE " . $config['db_prefix'] . "settings SET setting_value = '" . $db->real_escape_string($value) . "' WHERE setting_name = '" . $db->real_escape_string($name) . "'")) {
		return true;
	} else {
		return false;
	}
}
?>
