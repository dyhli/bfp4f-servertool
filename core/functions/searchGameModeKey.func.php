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
 * searchGameMapKey()
 * Search a gamemode key
 * 
 * @param $str str - String
 * @return str
 */
function searchGameModeKey($str) {
	
	$cmg = new GameMaps();
	foreach($cmg->gamemodes as $key => $value) {
		if(preg_match('/' . strtolower($str) . '/', strtolower($key))) {
			return $key;
			break;
		} elseif(preg_match('/' . strtolower($str) . '/', strtolower($value))) {
			return $key;
			break;
		}
	}
	return 'gpm_sa';
	
}
?>