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

/** 
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * RUN THIS SCRIPT WITH A CRONJOB!
 * 
 * Run this script every 30 seconds is recommended.
 */
 
require_once('../core/init.php');

use T4G\BFP4F\Rcon as rcon;

$rc->connect($cn, $cs);

if($rc->init()) {
	
	/**
	 * Update the notifier
	 */
	updateSetting('notify_sent', 'false');
	
	/**
	 * Initialize the classes and stuff...
	 */
	$pl = new rcon\Players();
	$ct = new rcon\Chat();
	$sv = new rcon\Server();
	$it = new Itemlist($db, $config);
	$bl = new Blacklist($db, $config);
	$wl = new WhiteList($db, $config);
	
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
		 	
			$reason = '[Blacklist] You are banned for: ' . $ban['info']['reason'] . '. Until: ' . ((!$ban['info']['until']) ? 'PERMANENTLY' : date("d-m-Y H:i", strtotime($ban['info']['until'])));
			
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
		 */
		switch(true) {
	        case strpos($player->kit, 'Medic') !== false:
	            $kit = "Medic";
	            break;
	    
	        case strpos($player->kit, 'Assault') !== false:
	            $kit = "Assault";
	            break;
	    
	        case strpos($player->kit, 'Recon') !== false:
	            $kit = "Recon";
	            break;
	    
	        case strpos($player->kit, 'Engineer') !== false:
	            $kit = "Engineer";
	            break;
	
	        default:
	            //soldier is dead
	            $kit = "Dead"; 
	            break;
	    }
		
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
				'%score%' => $player->score,
				'%vip%' => (($player->vip == '1') ? 'Yes' : 'No'),
			));
			
			// Send it to the player
			$ct->sendPlayer($player->name, $message);
			
			// Wait 0.5 seconds
			sleep(.5);
			
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
					$reason = '[Level limiter] Min. required lvl is ' . $settings['tool_ll_min'] . ', your level is ' . $player->level;
					
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
					$reason = '[Level limiter] Max. required lvl is ' . $settings['tool_ll_max'] . ', your level is ' . $player->level;
					
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
						
						$reason = '[Class limiter] Max. ' . $settings['tool_cl_' . $kit . 's'] . ' ' . strtolower($kit.'s') . ' in one team';
						
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
		 */
		$loadout = $playerLoadout->retrieveLoadout();
			
		/**
		 * Get the weaponId (BFP4F ID)
		 */
		$weapons = array( );
		foreach($loadout['data']['equipment'] as $key => $value) {
			$weapons[] = $value['id'];
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
				if(in_array($weaponId, $wlItems)) {
											
					$reason = '[Weapon limiter] Disallowed weapon: ' . $items[$weaponId]['item_name'];
					
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
						
						$reason = '[Prebuy limiter] Prebought ' . $items[$weaponId]['item_name'] . ' already on rank ' . $player->level . '. Required level: ' . $items[$weaponId]['item_min_lvl'];
						
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
				if($items[$weaponId]['item_subcat'] == 'shotgun' && $counter[$player->team]['Shotguns'] > $settings['tool_sl_max']) {
					
					$reason = '[Shotgun limiter] Max. ' . $settings['tool_sl_max'] . ' shotgun users in one team';
						
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
	die('Executed: '  . date($settings['cp_date_format_full']));
	
} else {
	
	/**
	 * Failed...
	 */
	die('Could not connect ' . date($settings['cp_date_format_full']));
	
}
?>
