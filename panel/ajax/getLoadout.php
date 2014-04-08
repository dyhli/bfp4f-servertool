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
 
require_once('../../core/init.php');

use T4G\BFP4F\Rcon as rcon;

if($user->checkLogin()) {
	
	if(isset($_GET['nucleusId']) && isset($_GET['cdKeyHash'])) {
		
		// Fetch the player loadout
		$playerLoadout = new rcon\Stats((string) $_GET['nucleusId'], $_GET['cdKeyHash']);
		$loadout = $playerLoadout->retrieveLoadout();
		
		// Weapons
		$weapons = array( );
		foreach($loadout['data']['equipment'] as $key => $value) {
			$weapons[$value['id']] = array(
				(isset($value['attachments']) ? $value['attachments'] : null ),
				$value['name'],
				$value['categoryname'],
			);
		}
		// Attachments
		$attachments = array( );
		foreach($loadout['data']['attachments'] as $attachment) {
			$attachments[$attachment['id']] = array(
				$attachment['categoryname'],
				$attachment['name'],
			);
		}
		
		// Display
		echo '<ul>';
		foreach($weapons as $id => $value) {
			echo '<li>' . $value[2] . ': ' . $value[1];
			if(count($value[0]) > 0) {
				echo '<ul>';
				foreach($value[0] as $aId) {
					if(isset($attachments[$aId][0])) echo '<li>' . $attachments[$aId][0] . ': ' . $attachments[$aId][1] . '</li>';
				}
				echo '</ul>';
			}
			echo '</li>';
		}
		echo '</ul>';
	} else {
		echo $lang['msg_cmd_missingvars'];
	}

} else {
	echo $lang['msg_nologin'];
}
?>