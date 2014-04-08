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
