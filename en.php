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
 
$lang = array(
	
	// Language information
	'lang_name' => 'English / English',
	'lang_name_short' => 'EN',
	'lang_translator' => 'SharpBunny',
	'lang_notes' => 'None', // Add here some additional notes... If you've got some...
	
	'github' => 'View on GitHub',
	
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Tool',
	'word_cp_full' => 'ControlPanel',
	'word_cp' => 'CP',
	'word_vip' => 'VIP',
	'word_welcome' => 'Welcome',
	'word_language' => 'Language',
	'word_about' => 'About',
	'word_error' => 'Oh oh!', # Error
	'word_yes' => 'Yes',
	'word_no' => 'No',
	'word_ok' => 'OK',
	'word_cancel' => 'Cancel', // Verb
	'word_delete' => 'Delete', // Verb
	'word_go' => 'Go',
	'word_devs' => 'Developers',
	'word_translators' => 'Translators',
	'word_suggestions' => 'Suggestions',
	'word_settings' => 'Settings',
	'word_name' => 'Name',
	'word_loading' => 'Loading',
	'word_actions' => 'Actions',
	'word_qa' => 'Q&A',
	'word_player' => 'Player',
	'word_players' => 'Players',
	'word_playername' => 'Playername',
	'word_profileid' => 'ProfileID',
	'word_rank' => 'Rank',
	'word_updated' => 'Updated',
	'word_enable' => 'Enable', // Verb
	'word_disable' => 'Disable', // Verb
	'word_enabled' => 'Enabled',
	'word_disabled' => 'Disabled',
	'word_ty' => 'Thank you!',
	'word_date' => 'Date',
	'word_until' => 'Until',
	'word_forever' => 'Forever',
	
	// Messages
	'msg_serverdown' => 'The tool could not connect to the server, it\'s probably down or incorrect RCON details are given, go check it!<br />The last heartbeat was:',
	'msg_serverup' => 'The server is up and running.<br />The last heartbeat was:',
	'msg_norights' => 'You haven\'t got enough rights to access this page.',
	'msg_settings_saved' => 'The settings have been saved',
	'msg_error' => 'The following error(s) have been occured:',
	'msg_cmd_noaccess' => 'You haven\'t got access to this command',
	'msg_cmd_missingvars' => 'There are some missing variables for this command',
	'msg_cmd_failed' => 'Executing command failed',
	'msg_nologin' => 'You are not logged in or your session has expired',
	'msg_sure' => 'Are you sure?',
	'msg_notadded' => 'This function is not added yet',
	'msg_db1' => 'Please go to the configuration page to enable/disable this tool',
	
	// Buttons
	'btn_back' => 'Back',
	'btn_previous' => 'Previous',
	'btn_next' => 'Next',
	'btn_save' => 'Save',
	'btn_add' => 'Add',
	'btn_close' => 'Close',
	
	// Tools general
	'tool_gen_ignorevip' => 'Ignore VIPs?',
	'tool_gen_help1' => 'Maximum per team',
	
	// Tools names and descriptions
	'tool_server' => 'Server management',
	'tool_server_desc' => 'Current status and manage the server',
	'tool_server_editrcon' => 'Edit RCON information',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_nextmap' => 'Next map',
	'tool_server_nextmap_msg' => 'Map is being switched',
	'tool_server_restartround' => 'Restart round',
	'tool_server_restartround_msg' => 'Round is being restarted',
	'tool_server_empty' => 'Server is empty',
	'tool_server_editrcon_msg' => 'The new RCON info has been saved', // Not used anymore...
	'tool_server_warnpl_msg' => 'Player has been warned',
	'tool_server_kickpl_msg' => 'Player has been kicked',
	'tool_server_ranked' => 'RANKED', // NOTE: All uppercase!
	'tool_server_unranked' => 'UNRANKED', // NOTE: All uppercase!
	'tool_server_joining' => 'joining', // NOTE: All lowercase
	'tool_server_curmap' => 'Current map',
	'tool_server_t1tickets' => 'Team 1 tickets',
	'tool_server_t2tickets' => 'Team 2 tickets',
	'tool_server_playing' => 'Time playing',
	'tool_server_serverip' => 'Server IP',
	'tool_server_rconport' => 'RCON admin port',
	'tool_server_rconpass' => 'RCON password',
	'tool_server_chat' => 'Chat',
	'tool_server_adminchat' => 'Adminchat',
	'tool_server_team' => 'Team',
	'tool_server_kit' => 'Kit',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Kills',
	'tool_server_deaths' => 'Deaths',
	'tool_server_score' => 'Score',
	'tool_server_idle' => 'Idle',
	'tool_server_plactions' => 'Player actions',
	'tool_server_ltp' => 'Link to profile',
	'tool_server_kick' => 'Kick player',
	'tool_server_warn' => 'Warn player',
	'tool_server_nochat' => 'No chatmessages',
	
	'tool_vipm' => 'VIPs management',
	'tool_vipm_desc' => 'Add or delete VIPs',
	'tool_vipm_vipadded' => 'VIP added',
	'tool_vipm_vipdeleted' => 'VIP deleted',
	'tool_vipm_notfound' => 'No VIPs found',
	
	'tool_iteml' => 'Item list',
	'tool_iteml_desc' => 'List of all the items in BFP4F',
	
	'tool_set' => 'Settings',
	'tool_set_desc' => 'Settings for the CP and tool',
	'tool_set_deflang' => 'Default language',
	'tool_set_df' => 'Date format',
	'tool_set_fdf' => 'Full date format',
	'tool_set_notifier' => 'Notifier',
	'tool_set_notify_email' => 'Notify e-mailaddress',
	'tool_set_iga_ad' => 'Small advertisement',
	'tool_set_iga_ad_opt' => 'Display every %s% seconds',
	'tool_set_iga_ad_help' => "Displays the following message: '%msg%'",
	'tool_set_help1' => 'More information about date formats, see <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'Language %lang% doesn\'t exist!',
	'tool_set_err2' => 'Invalid value for the advertisement',
	'tool_set_err3' => 'Unknown notifier value for the tool',
	'tool_set_err4' => 'Please enter a valid e-mailaddress to notify you when the tool cannot connect to your server',
	
	'tool_acc' => 'Accounts',
	'tool_acc_desc' => 'Manage the accounts',
	'tool_acc_add' => 'Add user',
	'tool_acc_edit' => 'Edit user',
	'tool_acc_expl1' => 'Leave the password fields blank if you don\'t want to change your password',
	'tool_acc_rights' => 'Choose what rights the user has',
	'tool_acc_fr1' => '<abbr title="In-Game Admin">IGA</abbr>',
	'tool_acc_fr2' => 'Super-admin',
	'tool_acc_fr3' => 'RCON access',
	'tool_acc_fr4' => 'Blacklist',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Server management',
	'tool_acc_fr7' => 'Items list',
	'tool_acc_fr8' => 'Limiters (tools)',
	'tool_acc_fr9' => 'Logs',
	'tool_acc_fr10' => 'Whitelist',
	'tool_acc_help1' => 'The name has to be at least 5 characters, this is a public name',
	'tool_acc_help2' => 'The username has to be at least 5 characters and unique',
	'tool_acc_help3' => 'The password has to be at least 6 characters',
	'tool_acc_help4' => 'Confirm the password',
	'tool_acc_err1' => 'Your name has to be at least 5 characters',
	'tool_acc_err2' => 'Your username has to be at least 5 characters',
	'tool_acc_err3' => 'Your password has to be at least 6 characters',
	'tool_acc_err4' => 'Unknown value for rights',
	
	'tool_logs' => 'Logs',
	'tool_logs_desc' => 'Check the logs, are there some unusual things?',
	'tool_logs1' => 'Autokicker log',
	'tool_logs1_desc' => 'All the executed kicks',
	'tool_logs2' => 'CP actions log',
	'tool_logs2_desc' => 'All the executed actions via the CP',
	'tool_word_desc' => 'Description',
	
	'tool_wl' => 'Weapon limiter',
	'tool_wl_desc' => 'Pick the disallowed weapons and automatically kick the players',
	'tool_wl_disallowed' => 'Disallowed items',
	'tool_wl_err1' => 'Unknown status value for the tool',
	'tool_wl_err2' => 'Unknown ignvip value for the tool',
	'tool_wl_err3' => 'Invalid BFID: %id%',
	
	'tool_pl' => 'Prebuy limiter',
	'tool_pl_desc' => 'Disallow prebuy for certain weapons or all weapons',
	'tool_pl_check' => 'Items to check',
	'tool_pl_help1' => 'Leave blank to apply the prebuy limiter for <b>ALL</b> weapons',
	
	'tool_al' => 'Attachment limiter',
	'tool_al_desc' => 'Pick the disallowed attachments and automatically kick the players',
	
	'tool_sl' => 'Shotgun limiter',
	'tool_sl_desc' => 'Set a maximum amount of shotgun users per team',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Maximum shotgun users per team',
	'tool_sl_err1' => 'Unknown status value for the tool',
	'tool_sl_err2' => 'Unknown ignvip value for the tool',
	'tool_sl_err3' => 'Invalid number for maximum shotgun users',
	
	'tool_ll' => 'Level limiter',
	'tool_ll_desc' => 'Set a minimum and maximum required level',
	'tool_ll_min' => 'Minimum rank',
	'tool_ll_max' => 'Maximum rank',
	'tool_ll_err1' => 'Unknown status value for the tool',
	'tool_ll_err2' => 'Unknown ignvip value for the tool',
	'tool_ll_err3' => 'Minimum level has to be between: %lvls%',
	'tool_ll_err4' => 'Maximum level has to be between: %lvls%',
	
	'tool_cl' => 'Class limiter',
	'tool_cl_desc' => 'Allow a certain amount of classes per team',
	'tool_cl_assaults' => 'Assaults',
	'tool_cl_medics' => 'Medics',
	'tool_cl_recons' => 'Recons',
	'tool_cl_engineers' => 'Engineers',
	'tool_cl_err1' => 'Unknown status value for the tool',
	'tool_cl_err2' => 'Unknown ignvip value for the tool',
	'tool_cl_err3' => 'Invalid number for %class%',
	
	'tool_am' => 'Admin message',
	'tool_am_desc' => 'Show a message in-game with the online admins',
	'tool_am_opt' => 'Display every %s% seconds',
	'tool_am_online' => 'Online message',
	'tool_am_offline' => 'Offline message',
	'tool_am_help1' => 'Time to display the message',
	'tool_am_help2' => 'Message to display when at least one admin is in-game<br /><code>%admins%</code> Names of the online admins',
	'tool_am_help3' => 'Message to display when there are no admins in-game',
	'tool_am_err1' => 'Unknown status value for the tool',
	'tool_am_err2' => 'You cannot leave the online message blank',
	'tool_am_err3' => 'You cannot leave the offline message blank',
	
	'tool_sm' => 'Stats message',
	'tool_sm_desc' => 'Show a message in-game with the current stats of the player',
	'tool_sm_opt' => 'Display every %s% seconds',
	'tool_sm_msg' => 'Message',
	'tool_sm_help1' => 'Time to display the message',
	'tool_sm_help2' => 	'Message to display, you can use the following variables:<br />' .
						'<code>%name%</code> Name<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Class<br />' .
						'<code>%rank%</code> Rank<br />' .
						'<code>%kills%</code> Kills<br />' .
						'<code>%deaths%</code> Deaths<br />' .
						'<code>%score%</code> Score<br />' .
						'<code>%vip%</code> VIP status (Yes or No)',
	
	'tool_bl' => 'Blacklist',
	'tool_bl_desc' => 'Ban players for a certain time or permanent',
	'tool_bl_reason' => 'Reason',
	'tool_bl_until' => 'Banned until',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Banned permanently',
	'tool_bl_warn1' => 'It\'s not possible to enable/disable the blacklist',
	'tool_bl_err1' => 'This player already has a permanent ban',
	'tool_bl_err2' => 'Could not fetch soldiers: Invalid ProfileID',
	'tool_bl_err3' => 'No bans yet',
	'tool_bl_addedby' => 'Ban by',
	'tool_bl_added' => 'Ban is added',
	'tool_bl_deleted' => 'Ban is deleted',
	
	'tool_wlist' => 'Whitelist',
	'tool_wlist_desc' => 'Add players you don\'t want to be kicked by the limiters',
	'tool_wlist_added' => 'Player is added to the whitelist',
	'tool_wlist_deleted' => 'Player is deleted from the whitelist',
	'tool_wlist_err1' => 'This player already exists in the whitelist',
	'tool_wlist_err2' => 'Could not fetch soldiers: Invalid ProfileID',
	'tool_wlist_err3' => 'No players whitelisted yet',
	'tool_wlist_addedby' => 'Added by',
	
	// Installation page
	#'install_welcome' => 'Welcome to the installation wizard, make sure all your details are filled in correctly. Then click on install.',
	#'install_error_config' => 'Please fill in your details in the file config.php before trying to install the tool',
	#'install_error' => 'Installation failed, please install the database manually by using the following SQL',
	#'install_success' => 'Installation was succesful, please delete the file install.php. You can login with the following details',
	
	// ControlPanel no rights page
	'cp_norights' => 'Access denied',
	'cp_norights_msg' => 'You haven\'t got enough rights to access this page.',
	
	// ControlPanel menu
	'cp_menu_tools' => 'Tools',
	'cp_menu_credits' => 'Credits',
	'cp_menu_donate' => 'Donate',
	'cp_menu_report_bug' => 'Report a bug',
	'cp_menu_subm_sug' => 'Submit a suggestion',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'Changelog',
	'cp_menu_logout' => 'Logout',
	
	// ControlPanel login page
	'cp_login' => 'Login',
	'cp_username' => 'Username',
	'cp_password' => 'Password',
	'cp_login_remember' => 'Remember me',
	'cp_error_login' => 'Invalid username and or password, please try again',
	'cp_error_login_sessions' => 'Could not set the login sessions, please try again. If this message keeps showing up, please check your PHP settings.',
	
	// ControlPanel logout page
	'cp_logout' => 'Logout',
	'cp_logout_success' => 'You have been succesfully logged out. See you later!',
	
	// ControlPanel dashboard
	'cp_dashboard' => 'Dashboard',
	'cp_dashboard_subtitle' => 'Summary and easy navigation',
	'cp_dashboard_explination' => 'Click on the <i class="icon-remove"></i> to activate a tool or click on the <i class="icon-ok"></i> to deactivate a tool. Click on the title to manage the tool.',
	
	// ControlPanel my account
	'cp_myaccount' => 'My account',
	'cp_myaccount_subtitle' => 'Manage your own account',
	'cp_myaccount_expl1' => 'This is the name that will be displayed in public',
	'cp_myaccount_expl2' => 'Leave the password fields blank if you don\'t want to change your password',
	'cp_myaccount_oldpass' => 'Old password',
	'cp_myaccount_newpass' => 'New password',
	'cp_myaccount_expl3' => 'At least 6 characters',
	'cp_myaccount_expl4' => 'Just a check',
	'cp_myaccount_err1' => 'Your name must be at least 4 characters',
	'cp_myaccount_err2' => 'Your old password doesn\'t match',
	'cp_myaccount_err3' => 'Your new password must be at least 6 characters',
	'cp_myaccount_err4' => 'The two new password fields do not match',
	
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'No items were found',
	
	// ControlPanel footer
	'cp_footer_thread' => 'Tool thread',
	'cp_footer_createdby' => 'Bunny\'s ServerTool %version% is licensed under Apache License V2.0<br />Copyright &copy; %year% by Danny Li &lt;<i>SharpBunny</i>&gt;',
	
	/*
	 * Q&A THINGS
	 */
	'qa_questions' => 'Questions',
	'qa_answers' => 'Answers',
	'qa_note' => 'NOTE: More Q&A will be added in the future, meanwhile you can ask me via PM, RaidCall or e-mail.',
	
	'qa' => array(
		1 => array(
			'question' => 'How to find the player\'s profileID?',
			'anwser' => 'Example: <code>http://battlefield.play4free.com/en/profile/2567963101/540307041</code><br /><code>2567963101</code> = ProfileID<br /><code>540307041</code> = SoldierID'
	 	),
	),

);
?>
