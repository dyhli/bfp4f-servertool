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
 * replace()
 * Replace vars in string
 * 
 * @param $str str - The string
 * @param $other array - Other stuff to be replaced
 * @return str - The replaced string
 */
function replace($str, $other='') {
	global $settings;
	
	$replace = array(
	
		// DATES
		'%date%' => date($settings['cp_date_format']),
		'%full_date%' => date($settings['cp_date_format_full']),
		'%year%' => date("Y"),
		'%month%' => date("m"),
		'%day%' => date("d"),
		'%hour%' => date("H"),
		'%minute%' => date("i"),
		'%second%' => date("s"),
		
		// TOOL
		'%version%' => TOOL_VERSION,
		
		// SERVER
		'%ip%' => ((isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null),
		
	);
	
	foreach($replace as $key => $value) {
		$str = str_replace($key,$value,$str);
	}
	
	if(is_array($other)) {
		foreach($other as $key => $value) {
			$str = str_replace($key,$value,$str);
		}
	}
	
	return $str;
}
?>
