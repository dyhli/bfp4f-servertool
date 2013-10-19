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