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
 * RUN THIS SCRIPT WITH THE BASH SCRIPT
 * RUN THIS SCRIPT WITH THE BASH SCRIPT
 * RUN THIS SCRIPT WITH THE BASH SCRIPT
 * RUN THIS SCRIPT WITH THE BASH SCRIPT
 * RUN THIS SCRIPT WITH THE BASH SCRIPT
 * 
 * Run this script every 5 seconds is recommended.
 */
define('IS_CRONJOB', TRUE);
require_once(dirname(dirname(__FILE__)) . '/core/init.php');

use T4G\BFP4F\Rcon as rcon;

/**
 * Check if the in-game commands are enabled
 */
if($settings['tool_igcmds'] == 'false') {
	
	die('[' . date($settings['cp_date_format_full']) . '] In-game commands are disabled.' . PHP_EOL);
	
}

if($rc->connect($cn, $cs) && $rc->init()) {
	
	/**
	 * Initialize server class
	 */
	$sv = new rcon\Server();
	 
	/**
	 * Initialize chat class
	 */
	$ct = new rcon\Chat();
	
	/**
	 * Initialize players class
	 */
	$pl = new rcon\Players();
	
	/**
	 * Initialize IgVoting class
	 */
	$igv = new IgVoting($rc, $sv, $ct, $pl, $db, $config, $settings);
	
	/**
	 * Initialize IgaCommands class
	 */
	$igc = new IgCommands($rc, $sv, $ct, $pl, $db, $config, $igv, $settings);
	$igv->setIgc($igc);
	
	/**
	 * Fetch the messages
	 */
	$chats = $ct->fetch();

	/**
	 * Read chatmessages
	 */
	foreach($chats as $chat) {
		
		/**
		 * Check if the message begins with one of the prefixes
		 * Check if it's not a message from the Admin
		 */
		if(in_array(substr($chat->message,0,1), $config['cmd_prefixes']) && $chat->origin != 'Admin') {
			
			/**
			 * The message in different pieces
			 */
			$pieces = explode(' ', $chat->message, 2);
			
			/**
			 * Prepare command information
			 */
			$cmdInfo = array(
				/**
				 * Chat info
				 */
				'chat' => (array) $chat,
				/**
				 * Used prefix
				 */
				'prefix' => substr($pieces[0], 0, 1),
				/**
				 * The command
				 */
				'cmd' => strtolower(substr($pieces[0], 1)),
			);
			

			/**
			 * The variables in the command (optional)
			 */
			$cmdInfo['vars'] = null;
			if(isset($pieces[1])) {
				$cmdInfo['vars'] = trim($pieces[1]);
			}
						
			/**
			 * Get playerinformation about the origin
			 */
			$result = $igc->findPlayerByName($chat->origin);
			if($result['code'] == 'OK') {
				
				$cmdInfo['origin'] = $result['player'];
				
				/**
				 * Check if the command is already executed
				 */
				if($igc->checkExpiredCmd($cmdInfo)) {
				
					/**
					 * Fetch the command info and check if it exists
					 */
					$result = $igc->getCommand($cmdInfo['cmd']);
					$userRights = $igc->getUserRights($cmdInfo['origin']['nucleusId']);
					
					if($result['code'] == 'OK') {
						
						/**
						 * Check the user rights
						 */
						if($userRights >= $result['cmd']['cmd_rights']) {
							
							/**
							 * The user id (if exists)
							 */
							$cmdInfo['origin']['userId'] = $igc->userId;
							
							/**
							 * Also pass the command information
							 */
							$cmdInfo['_cmd'] = $result['cmd'];
							
							/**
							 * Send it and execute the command if possible
							 * 
							 * Also checks if cmd != false, cmd==false means it's only the prefix
							 * e.g. !
							 */
							if($cmdInfo['cmd'] != false && !empty($cmdInfo['cmd'])) {
								$igc->executeCommand($cmdInfo);
							}
						
						} else {
							
							/**
							 * Send response => Not enough rights
							 */
							$igc->logCmd($cmdInfo);
							$ct->send('|ccc| ' . $cmdInfo['origin']['name'] . ' |ccc|, you haven\'t got enough rights to use command: |ccc| ' . $pieces[0]);
							
						}
					
					} else {
						
						/**
						 * Send response => Command not found / disabled
						 * 
						 * Uncomment this if you want, it's running fine, but because
						 * you probably run ModManager IGA and this tool at the same time
						 * it's not really handy...
						 * 
						 * e.g. Modmanager uses !k to kick, this tool will display 'Command !k does not exist [...]'
						 * or if the commands are the same, the command will be executed twice
						 */
						//$igc->logCmd($cmdInfo);
						//$ct->send('Command |ccc| ' . $pieces[0]  . ' |ccc| does not exist or the command has been disabled!');
						
					} // END CHECK COMMAND
				
				} // END CHECK EXPIRED CMD
				
			} // END GET ORIGIN PLAYER
						
		} // END PREFIX CHECK AND ADMIN CHECK

	} // END CHATS
	
	/**
	 * Check voting and what not
	 */
	$result = $igv->getActivePoll();
	if($result['code'] == 'OK') {
		
		$poll = $result['poll'];
		$poll['vote_votes'] = json_decode($poll['vote_votes'], true);
		if(count($poll['vote_votes']) >= $settings['tool_igcmds_votes']) {
			// EXECUTE
			$ct->send('|ccc| POLL: Voting success. Command is being executed...');
			$igv->executedPoll($poll['vote_id']);
			$igv->$poll['vote_action']($poll);
		} elseif(time() - strtotime($poll['vote_date']) >= $settings['tool_igcmds_ptime']) {
			// CLOSE VOTING
			$igv->closePoll($poll['vote_id']);
			// Send message
			$ct->send('|ccc| POLL: Not enough votes within ' . $settings['tool_igcmds_ptime'] . ' seconds. Poll closed.');
		}
		
	} // END VOTING
	
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
