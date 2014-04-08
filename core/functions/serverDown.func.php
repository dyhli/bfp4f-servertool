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
 * serverDown()
 * Report that the server is down, eventually activate the notifier
 * 
 * @return str 'Reported'
 */

function serverDown() {
	global $settings;
	
	updateSetting('server_status', 'down');
		
	/*
	 * NOTIFIER
	 * 
	 * - Sends an e-mail when the server is down
	 */
	
	if($settings['notify'] == 'true' && $settings['notify_sent'] == 'false') {
		
		// Message
		$message = 'Hello!' . PHP_EOL .
		'The servertool could not connect to your BFP4F server, please check your server and your RCON information.' . PHP_EOL .
		'Click on this link to access the ControlPanel: ' . HOME_URL . PHP_EOL . PHP_EOL .
		'~ Bunny\'s ServerTool Notifier';
		
		// Send e-mail
		Email($settings['notify_email'], $settings['notify_email'], 'Server is down!', $message);
		
		// Update the notifier, so it won't send another e-mail the next time
		updateSetting('notify_sent', 'true');
		
	}
	
	return 'Reported';
}
?>