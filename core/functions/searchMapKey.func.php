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
 * searchMapKey()
 * Search map key
 * 
 * @param $str str - String
 * @param $mode str - Gamemode
 * @return str
 */
function searchMapKey($str, $mode='gpm_sa') {
	
	$cmg = new GameMaps();
	foreach($cmg->combos[$mode] as $key) {
		if(preg_match('/' . strtolower($str) . '/', strtolower($key))) {
			return $key;
			break;
		} elseif(preg_match('/' . strtolower($str) . '/', strtolower($cmg->getMapName($key)))) {
			return $key;
			break;
		}
	}
	return false;
	
}
?>