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
 
class GameMaps {
	
	public $maps = array(
	
		'gulf_of_oman' => 'Oman',
		'dragon_valley' => 'Dragon Valley',
		'dalian_plant' => 'Dalian Plant',
		'mashtuur_city' => 'Mashtuur',
		'strike_at_karkand' => 'Karkand',
		'karkand_rush' => 'Karkand',
		'sharqi' => 'Sharqi',
		'Sharqi' => 'Sharqi',
		'downtown' => 'Basra',
		'trail' => 'Myanmar',
	
	);
	
	public $gamemodes = array(
	
		'gpm_sa' => 'Assault',
		'gpm_rush' => 'Rush',
	
	);
	
	public $combos = array(
	
		'gpm_sa' => array(
			'gulf_of_oman',
			'dragon_valley',
			'dalian_plant',
			'mashtuur_city',
			'strike_at_karkand',
			'sharqi',
			'downtown',
			'trail',
		),
		
		'gpm_rush' => array(
			'Sharqi',
			'karkand_rush',
			'dalian_plant',
			'downtown',
		),
	
	);
	
	public $mapsAlt, $gamemodesAlt;
	
	public function __construct() {
		$this->mapsAlt = array_flip($this->maps);
		$this->gamemodesAlt = array_flip($this->gamemodes);
	}
	
	/**
	 * getMapName()
	 * Gets the mapname by key
	 * 
	 * @param $key str - Key e.g. strike_at_karkand
	 * @return str - Mapname
	 */
	public function getMapName($key) {
		if(isset($this->maps[strtolower($key)])) {
			return $this->maps[strtolower($key)];
		}
		
		return 'Unknown';
	}
	
	/**
	 * getGameMode()
	 * Gets the gamemode name by key
	 * 
	 * @param $key str - Key e.g. gpm_sa
	 * @return str - Gamemode name
	 */
	public function getGameMode($key) {
		if(isset($this->gamemodes[$key])) {
			return $this->gamemodes[$key];
		}
		
		return 'Unknown';
	}
	
	/**
	 * getMapNameKey()
	 * Gets the mapkey by map name
	 * 
	 * @param $name str - Mapname e.g. Karkand
	 * @return str - Key
	 */
	public function getMapNameKey($name) {
		if(isset($this->mapsAlt[$name])) {
			return $this->mapsAlt[$name];
		}
		
		return 'strike_at_karkand';
	}
	
	/**
	 * getGameModeKey()
	 * Gets the gamemode key by gamemode name
	 * 
	 * @param $name str - Gamemode name e.g. Assault
	 * @return str - Key
	 */
	public function getGameModeKey($name) {
		if(isset($this->gamemodesAlt[$name])) {
			return $this->gamemodesAlt[$name];
		}
		
		return 'gpm_sa';
	}
	
}
 
?>