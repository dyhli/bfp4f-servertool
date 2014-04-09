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
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * 
 * Run this script every 30 seconds is recommended.
 */
define('IS_CRONJOB', TRUE);
require_once(dirname(dirname(__FILE__)) . '/core/init.php');

use T4G\BFP4F\Rcon as rcon;

/**
 * Check if the limiters are enabled
 */
if($settings['tool_limiters'] == 'false') {
	
	die('[' . date($settings['cp_date_format_full']) . '] Limiters are disabled.' . PHP_EOL);
	
}

if($rc->connect($cn, $cs) && $rc->init()) {

	/**
	 * Initialize the classes and stuff...
	 */
	$pl = new rcon\Players();
	$ct = new rcon\Chat();
	$sv = new rcon\Server();
	$it = new Itemlist($db, $config);
	$bl = new Blacklist($db, $config);
	$wl = new WhiteList($db, $config);
	$tm = new TimedMessages($db, $config);
	
	/**
	 * LIMITERS
	 *
	 * NOTE: The blacklist comes first before the whitelist
	 */
	
	/**
	 * Fetch the players
	 */
	$players = $pl->fetch();
	
	/**
	 * Fetch the itemlist
	 */
	$itemList = $it->fetchItems();
	$items = $itemList['items'];
	
	/**
	 * Admins
	 */
	$admins = array( );
	
	/**
	 * Count the classes and other stuff per team
	 */
	$counter[1] = array('Assaults' => 0, 'Engineers' => 0, 'Medics' => 0, 'Recons' => 0, 'Shotguns' => 0);
	$counter[2] = array('Assaults' => 0, 'Engineers' => 0, 'Medics' => 0, 'Recons' => 0, 'Shotguns' => 0);
	
	foreach($players as $player) {
		
		/**
		 * Skip if the player is not connected yet
		 * Or else the player will get stuck in the loadingscreen
		 * Tip: be evil and disable this to troll them :P
		 */
		if($player->connected != 1) {
			continue;
		}
		
		/**
		 * RANK -1 KICKER
		 * 
		 * Kicks a player with rank -1
		 */
		if($settings['tool_minusone']) {
			if($player->level == -1) {
				$reason = 'Rank -1';
				
				// Kick the player
				// We use the index instead of the playername, or else playernames with numbers only won't be kicked
				$pl->kick($player->index, $reason);
				// Log the kick
				$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
			
				// Skip, don't check for other limiters and stuff
				continue;
			}
		}
		
		/**
		 * BLACKLIST
		 * 
		 * Checks if the player is in the blacklist, if yes: kick
		 */
		
		/**
		 * Delete all the expired bans
		 */
		$bl->deleteExpired();
		 
		$ban = $bl->checkPlayer($player->nucleusId);
		if($ban['code'] == 'OK') {
		 				
			$reason = replace($settings['tool_bl_msg'], array(
				'%reason%' => $ban['info']['reason'],
				'%until%' => ((!$ban['info']['until']) ? 'PERMANENTLY' : date("d-m-Y H:i", strtotime($ban['info']['until']))),
			));
			
			// Kick the player
			// We use the index instead of the playername, or else playernames with numbers only won't be kicked
			$pl->kick($player->index, $reason);
			// Log the kick
			$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
			
			// Skip, don't check for other limiters and stuff
			continue;
		 
		}
		
		/**
		 * Get the class of the player
		 * 
		 * - UPDATE v0.6.0: More simple and efficient way
		 */
		$kit = (($player->kit == 'none') ? 'Dead' : str_replace(array('_','kit','US','RU'), '', $player->kit));
		
		// Count +1
		// Classes
		if($kit != 'Dead') {
			$counter[$player->team][$kit.'s']++;
		}
		
		/**
		 * IN-GAME ADMIN MESSAGES
		 * 
		 * - Checks if the player is an IGA
		 */			
		if($user->checkIgaAdmin($player->nucleusId)) {
			$admins[] = $player->name;
		}
		
		/**
		 * PLAYER STATS MESSAGE
		 * 
		 * - Displays a message with the following data:
		 * 	- Name
		 * 	- Ping
		 * 	- Class
		 * 	- Rank
		 * 	- Kills and deaths
		 *  - KD
		 * 	- Score
		 * 	- VIP
		 */
		if($settings['tool_sm'] > 0 && (time()-$settings['tool_sm_last']) >= $settings['tool_sm']) {
			
			// The message			
			$message = replace($settings['tool_sm_msg'], array(
				'%name%' => $player->name,
				'%ping%' => $player->ping,
				'%class%' => $kit,
				'%rank%' => $player->level,
				'%kills%' => $player->kills,
				'%deaths%' => $player->deaths,
				'%kd%' => round($player->kills/$player->deaths, 2, PHP_ROUND_HALF_UP),
				'%score%' => $player->score,
				'%vip%' => (($player->vip == '1') ? 'Yes' : 'No'),
			));
			
			// Send it to the player
			$ct->sendPlayer($player->index, $message);
			
			// Wait 0.5 seconds
			//sleep(.5);
			
		}
		
		/**
		 * WHITELIST 
		 *
		 * Check if the player is in the whitelist and whitelist is enabled, if yes: skip
		 */
		if($settings['tool_wl'] == 'true' && $wl->checkPlayer($player->nucleusId)) {
			continue;
		}
		
		/**
		 * LEVEL LIMITER
		 * 
		 * - Checks minimum level
		 * - Checks maximum level
		 */
		if($settings['tool_ll'] == 'true') {
			// Check if ignorevip is false and he isn't a VIP
			if($settings['tool_ll_ignorevip'] == 'false' || ($settings['tool_ll_ignorevip'] == 'true' && $player->vip == '0')) {
				// Check the min. level
				if($player->level < $settings['tool_ll_min']) {
					$reason = replace($settings['tool_ll_msg_min'], array(
						'%min%' => $settings['tool_ll_min'],
						'%lvl%' => $player->level,
					));
					
					// Kick the player
					// We use the index instead of the playername, or else playernames with numbers only won't be kicked
					$pl->kick($player->index, $reason);
					// Log the kick
					$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
					
					// Skip, don't check for other limiters and stuff
					continue;
				}
				
				// Check the max. level
				if($player->level > $settings['tool_ll_max']) {
					$reason = replace($settings['tool_ll_msg_max'], array(
						'%max%' => $settings['tool_ll_max'],
						'%lvl%' => $player->level,
					));
					
					// Kick the player
					// We use the index instead of the playername, or else playernames with numbers only won't be kicked
					$pl->kick($player->index, $reason);
					// Log the kick
					$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
					
					// Skip, don't check for other limiters and stuff
					continue;
				}
			}
		}

		/**
		 * CLASS LIMITER
		 * 
		 * - Checks if there are too many of one class
		 * - Option to ignore VIPs
		 */
		if($settings['tool_cl'] == 'true') {
			
			// Check if VIPs are ignored
			if(($settings['tool_cl_ignorevip'] == 'true' && $player->vip == '0') || $settings['tool_cl_ignorevip'] == 'false') {
				
				// Check if he's not dead
				if($kit != 'Dead') {
					if($counter[$player->team][$kit.'s'] > $settings['tool_cl_' . $kit . 's']) {
						
						$reason = replace($settings['tool_cl_msg'], array(
							'%amount%' => $settings['tool_cl_' . $kit . 's'],
							'%class%' => strtolower($kit.'s'),
						));
						
						// Kick the player
						// We use the index instead of the playername, or else playernames with numbers only won't be kicked
						$pl->kick($player->index, $reason);
						// Log the kick
						$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
						
						// Skip, don't check for other limiters and stuff
						continue;
						
					}
				}
				
			}
			
		}
		
		/**
		 * Fetch the player's loadout
		 * 
		 * Meh, we don't use caches...
		 */
		$playerLoadout = new rcon\Stats((string) $player->nucleusId, $player->cdKeyHash);
		
		/**
		 * Prepare the weapon limiter items
		 */
		$wlItems = json_decode($settings['tool_wl_items'], true);
		
		/**
		 * Prepare the prebuy limiter items
		 */
		$plItems = $settings['tool_pl_items'];
		if($plItems != 'all') {
			$plItems = json_decode($settings['tool_pl_items'], true);
		}
		
		/**
		 * Every limiter that has to do with his loadout
		 * 
		 * - Weapon limiter
		 * - Prebuy limiter
		 * - Attachments limiter
		 * - Shotgun limiter
		 * - Dual-slot limiter
		 */
		$loadout = $playerLoadout->retrieveLoadout();
			
		/**
		 * Get the weaponId (BFP4F ID)
		 */
		$weapons = array( );
		$weaponsGroup = array( );
		foreach($loadout['data']['equipment'] as $key => $value) {
			$weapons[] = $value['id'];
			$weaponsGroup[] = $value['validationGroup'];
		}
		$primaryWeapons = 0;
		
		/**
		 * DUAL-SLOT LIMITER
		 * 
		 * - Checks if the player has two primary weapons
		 */
		if($settings['tool_dsl'] == 'true') {
			// Check if ignorevip is false and he isn't a VIP
			if($settings['tool_dsl_ignorevip'] == 'false' || ($settings['tool_dsl_ignorevip'] == 'true' && $player->vip == '0')) {
				
				// Count the primary weapons
				foreach($weaponsGroup as $group) {
					if($group == 'primary') {
						$primaryWeapons++;
					}
				}
				
				// Checks if he has got two primary weapons
				if($primaryWeapons == 2) {
				
					$reason = $settings['tool_dsl_msg'];
					
					// Kick the player
					// We use the index instead of the playername, or else playernames with numbers only won't be kicked
					$pl->kick($player->index, $reason);
					// Log the kick
					$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
						
					// Skip, don't check for other limiters and stuff
					continue;
					
				}
			}
		}

		/**
		 * Check weapons
		 */
		 foreach($weapons as $weaponId) {
				
			/**
			 * Check if weapon is shotgun, then count +1
			 */
			if($items[$weaponId]['item_subcat'] == 'shotgun') {
				$counter[$player->team]['Shotguns']++;
			}
			
			/**
			 * WEAPON LIMITER
			 * 
			 * - Checks if the weapon is allowed
			 */
			if($settings['tool_wl'] == 'true') {
				
				// Check which items are selected
				if(($settings['tool_wl_inverse'] == 'true' && !in_array($weaponId, $wlItems)) || ($settings['tool_wl_inverse'] == 'false' && in_array($weaponId, $wlItems))) {
											
					$reason = replace($settings['tool_wl_msg'], array(
						'%weapon%' => $items[$weaponId]['item_name'],
					));
					
					// Kick the player
					// We use the index instead of the playername, or else playernames with numbers only won't be kicked
					$pl->kick($player->index, $reason);
					// Log the kick
					$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
						
					// Skip, don't check for other limiters and stuff
					continue;
	
				}
				
			}
		
			/**
			 * PREBUY LIMITER
			 * 
			 * - Checks if the player's level is too low for the weapon
			 */
			if($settings['tool_pl'] == 'true') {
				
				// Check which items are selected
				if($plItems == 'all' || (is_array($plItems) && in_array($weaponId, $plItems))) {
					// Check if the player level is lower than the required level
					// Check if the item is not a gadget
					if($player->level < $items[$weaponId]['item_min_lvl'] && $items[$weaponId]['item_category'] != 'gadget') {
						
						$reason = replace($settings['tool_pl_msg'], array(
							'%weapon%' => $items[$weaponId]['item_name'],
							'%lvl%' => $player->level,
							'%req%' => $items[$weaponId]['item_min_lvl'],
						));
						
						// Kick the player
						// We use the index instead of the playername, or else playernames with numbers only won't be kicked
						$pl->kick($player->index, $reason);
						// Log the kick
						$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
							
						// Skip, don't check for other limiters and stuff
						continue;
							
					}
				}
				
			}
			
			/**
			 * SHOTGUN LIMITER
			 * 
			 * - Checks if there are too many shotgun users
			 */
			if($settings['tool_sl'] == 'true') {
				
				// If his weapon is a shotgun and there is already the maximum amount of shotgun users -> kick
				if(($items[$weaponId]['item_subcat'] == 'shotgun' && $counter[$player->team]['Shotguns'] > $settings['tool_sl_max']) && ($settings['tool_sl_ignorevip'] == 'false' || ($settings['tool_sl_ignorevip'] == 'true' && $player->vip == '0'))) {
					
					$reason = replace($settings['tool_sl_msg'], array(
						'%amount%' => $settings['tool_sl_max'],
					));
						
					// Kick the player
						// We use the index instead of the playername, or else playernames with numbers only won't be kicked
					$pl->kick($player->index, $reason);
					// Log the kick
					$log->insertKickLog($player->nucleusId, $player->cdKeyHash, $player->name, $reason);
						
					// Skip, don't check for other limiters and stuff
					continue;
					
				}
				
			}
		
		} // END WEAPONS
		
	} // END PLAYER

	/**
	 * IN-GAME ADMIN MESSAGES
	 * 
	 * - Displays a message with the currently in-game admins
	 */
	if($settings['tool_am'] > 0 && (time()-$settings['tool_am_last']) >= $settings['tool_am']) {
		if(count($admins) > 0) {
			$message = replace($settings['tool_am_msg'], array(
				'%admins%' => implode(', ', $admins),
			));
		} else {
			$message = replace($settings['tool_am_msg_alt']);
		}

		$ct->send($message);
		updateSetting('tool_am_last', time());
	}
	
	/**
	 * TIMED MESSAGES
	 * 
	 * - Displays timed messages
	 */
	if($settings['tool_tmsg'] == 'true') {
		// Fetch messages
		$tmsgs = $tm->fetchMessages();
		if($tmsgs['code'] == 'OK') {
			foreach($tmsgs['msg'] as $msg) {
				// Check how many seconds between now and the last message and check if it is active or not
				if(time()-$msg['msg_last'] >= $msg['msg_time'] && $msg['msg_active'] == 'yes') {
					// Send message
					$ct->send($msg['msg_content']);
					
					// Update last message
					$tm->updateMessage($msg['msg_id'], array(
						'msg_last' => time(),
					));
				}
			}
		}
	}
	
	/**
	 * THE SMALL ADVERTISMENT
	 * I would really appreciate it if you enable this! :3
	 */
	if($settings['iga_ad'] > 0 && (time()-$settings['iga_ad_last']) >= $settings['iga_ad']) {
		$ct->send(replace($settings['iga_ad_msg']));
		updateSetting('iga_ad_last', time());
	}
	
	/**
	 * Display message
	 */
	die('[' . date($settings['cp_date_format_full']) . '] Executed' . PHP_EOL);
	
} else {
	
	/**
	 * Failed...
	 */
	die('[' . date($settings['cp_date_format_full']) . '] Could not connect' . PHP_EOL);
	
}
?>