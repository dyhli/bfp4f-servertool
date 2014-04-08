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
 
$lang = array(
	
	// Language information
	'lang_name' => 'English / English',
	'lang_name_short' => 'EN',
	'lang_charset' => 'utf8',
	'lang_translator' => 'SharpBunny',
	'lang_notes' => 'None', // Add here some additional notes... If you've got some...
	
	'github' => 'View on GitHub',
	
	// Some words
	'word_tool' => 'BattlefieldTools Servertool',
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
	'msg_serverdown' => 'The tool could not connect to the server, it\'s probably down or incorrect RCON details are given, go check it!',
	'msg_serverup' => 'The server is up and running.',
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
	'msg_limdis' => '<b>ATTENTION</b> All the limiters have been disabled, you can enable the limiters in your settings',
	'msg_igcmdsdis' => '<b>ATTENTION</b> All the in-game commands have been disabled, you can enable the in-game commands in your settings',
	'msg_minusone' => 'Did you see the new public watcher yet? You can see it <a href="../public" class="alert-link">here</a>, but first turn this feature on in your settings!',
	
	// Buttons
	'btn_back' => 'Back',
	'btn_previous' => 'Previous',
	'btn_next' => 'Next',
	'btn_save' => 'Save',
	'btn_add' => 'Add',
	'btn_close' => 'Close',
	
	// i3D API
	'i3d' => 'i3D API',
	'i3d_your' => 'Your i3D server',
	'i3d_start' => 'Start server',
	'i3d_stop' => 'Stop server',
	'i3d_restart' => 'Restart server',
	'i3d_cpu' => 'CPU usage',
	'i3d_mem' => 'Memory usage',
	'i3d_disk' => 'Hard disk usage',
	'i3d_warn1' => '<b>ATTENTION</b> This is for i3D gameservers only!',
	'i3d_err1' => 'i3D API: Gameserver not found, invalid ID',
	'i3d_err2' => 'This option is only for i3D servers or your i3D API details are invalid',
	'i3d_msg1' => 'Server is starting...',
	'i3d_msg2' => 'Server is stopping...',
	'i3d_msg3' => 'Server is restarting...',
	
	// Version checker
	'vcheck' => 'Check version',
	'vcheck_latest' => 'Latest version',
	'vcheck_current' => 'Current version',
	'vcheck_past' => 'Past versions',
	'vcheck_download' => 'Download',
	'vcheck_notes' => 'Notes',
	'vcheck_err1' => 'Could not connect to the mainserver, please try again later!',
	'vcheck_ok' => 'Latest version installed!',
	'vcheck_old' => 'Seems like your version is outdated, please update to the latest version!',
	
	// Tools general
	'tool_gen_ignorevip' => 'Ignore VIPs?',
	'tool_gen_help1' => 'Maximum per team',
	'tool_gen_kick_msg' => 'Kick message',
	'tool_gen_help2' => 'The message that the player will see when he gets kicked',
	
	// Tools names and descriptions
	'tool_server' => 'Server management',
	'tool_server_desc' => 'Current status and manage the server',
	'tool_server_editrcon' => 'Edit RCON information',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_switchmap' => 'Switch map',
	'tool_server_switchmap_msg' => 'Switched map to %map%',
	'tool_server_nextmap' => 'Next map',
	'tool_server_nextmap_msg' => 'Map is being switched',
	'tool_server_restartround' => 'Restart round',
	'tool_server_restartround_msg' => 'Round is being restarted',
	'tool_server_closepoll' => 'Close active poll',
	'tool_server_closepoll_msg' => 'Active poll was closed',
	'tool_server_closepoll_err' => 'There is no poll active',
	'tool_server_empty' => 'Server is empty',
	'tool_server_editrcon_msg' => 'The new RCON info has been saved', // Not used anymore...
	'tool_server_warnpl_msg' => 'Player has been warned',
	'tool_server_kickpl_msg' => 'Player has been kicked',
	'tool_server_switchpl_msg' => 'Player has been switched to the other team',
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
	'tool_server_switch' => 'Switch player',
	'tool_server_nochat' => 'No chatmessages',
	'tool_server_send_msg' => 'Send message',
	'tool_server_send_msg_help1' => 'This message will appear in the adminchat!',
	'tool_server_msg_sent' => 'Servermessage is sent',
	'tool_server_loadout' => 'Get loadout',
	'tool_server_loadout_title' => 'Loadout of', // Loadout of {name}
	
	// Server settings
	'tool_svset' => 'Server settings',
	'tool_svset_desc' => 'Configure your server settings',
	
	'tool_rcon' => 'RCON Console',
	'tool_rcon_desc' => 'Execute RCON commands',
	'tool_rcon_info1' => 'Do NOT use if you don\'t know what you\'re doing!',
	'tool_rcon_field1' => 'Command',
	
	'tool_igcmds' => 'In-game commands',
	'tool_igcmds_desc' => 'Use commands in-game',
	'tool_igcmds_rights' => 'In-game commands rights',
	'tool_igcmds_add' => 'Add an in-game command',
	'tool_igcmds_edit' => 'Edit an in-game command',
	'tool_igcmds_cmd' => 'Command',
	'tool_igcmds_func' => 'Function',
	'tool_igcmds_lvl' => 'Level',
	'tool_igcmds_active' => 'Active',
	'tool_igcmds_response' => 'Response',
	'tool_igcmds_votes' => 'Votes needed',
	'tool_igcmds_active' => 'In-game commands active',
	'tool_igcmds_polltime' => 'Poll time',
	'tool_igcmds_pt_opt' => 'Close poll after %s% seconds',
	'tool_igcmds_deleted' => 'In-game command deleted',
	'tool_igcmds_err1' => 'In-game commands rights has to be 0 - 100',
	'tool_igcmds_err2' => 'The command cannot be blank',
	'tool_igcmds_err3' => 'This command already exists',
	'tool_igcmds_err4' => 'This function does not exist',
	'tool_igcmds_err5' => 'Max. characters for the response is 75',
	'tool_igcmds_err6' => 'Votes: invalid',
	'tool_igcmds_err7' => 'Polltime: invalid',
	'tool_igcmds_help1' => 'Level 0 - 100',
	'tool_igcmds_help2' => 'cmdMessage, cmdKickPlayer, cmdWarnPlayer, cmdBanPlayer and cmdFunnyWord',
	'tool_igcmds_help3' => 'Only send the response to the player?',
	'tool_igcmds_help4' => 'Command active?',
	
	'tool_tmsg' => 'Timed messages',
	'tool_tmsg_desc' => 'Display timed messages on the server',
	'tool_tmsg_msg' => 'Message',
	'tool_tmsg_freq' => 'Frequency',
	'tool_tmsg_active' => 'Active',
	'tool_tmsg_secs' => 'seconds',
	'tool_tmsg_deleted' => 'Timed message deleted',
	'tool_tmsg_err1' => 'No timed messages found',
	
	'tool_mrot' => 'Edit map rotation',
	'tool_mrot_map' => 'Mapname',
	'tool_mrot_gamemode' => 'Gamemode',
	'tool_mrot_current' => 'Current rotation',
	'tool_mrot_available' => 'Available maps',
	'tool_mrot_rpm' => 'Rounds per map',
	'tool_mrot_help1' => 'Click on the map to add this to your rotation!',
	'tool_mrot_help2' => 'You can drag and drop to edit your rotation order!',
	'tool_mrot_err1' => 'Invalid rotation value',
	'tool_mrot_err2' => 'Min. one map is required in the rotation',
	'tool_mrot_err3' => 'The rounds per map is not a number',
	
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
	'tool_set_bml' => 'Bookmarklink',
	'tool_set_lim' => 'Limiters',
	'tool_set_iga_ad_opt' => 'Display every %s% seconds',
	'tool_set_iga_ad_help' => "Displays the following message: '%msg%'",
	'tool_set_help1' => 'More information about date formats, see <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_help2' => 'I use this for tracking which servers are using the tool. To disable servertracking, leave the field blank',
	'tool_set_err1' => 'Language %lang% doesn\'t exist!',
	'tool_set_err2' => 'Invalid value for the advertisement',
	'tool_set_err3' => 'Unknown notifier value for the tool',
	'tool_set_err4' => 'Please enter a valid e-mailaddress to notify you when the tool cannot connect to your server',
	'tooL_set_err5' => 'Invalid bookmarklink',
	
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
	'tool_acc_err5' => 'Invalid ProfileID',
	'tool_acc_err6' => 'No user found',
	'tool_acc_err7' => 'You cannot delete your own superadmin rights',
	
	'tool_logs' => 'Logs',
	'tool_logs_desc' => 'Check the logs, are there some unusual things?',
	'tool_logs_autokick' => 'Autokicker log',
	'tool_logs_autokick_desc' => 'All the executed kicks',
	'tool_logs_cp_actions' => 'CP actions log',
	'tool_logs_cp_actions_desc' => 'All the executed actions via the CP',
	'tool_logs_igcmds' => 'In-game commands log',
	'tool_logs_igcmds_desc' => 'All the executed and failed in-game commands',
	'tool_word_desc' => 'Description',
	'tool_logs_info1' => 'No log entries found',
	'tool_logs_err1' => 'Log not found',
	
	'tool_wl' => 'Weapon limiter',
	'tool_wl_desc' => 'Pick the disallowed weapons and automatically kick the players',
	'tool_wl_disallowed' => 'Disallowed items',
	'tool_wl_inverse' => '<b>Inverse:</b> Only <u>allow</u> the selected weapons above',
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
	
	'tool_dsl' => 'Dual-slot limiter',
	'tool_dsl_desc' => 'Disallow the dual-slot booster',
	
	'tool_ping' => 'Ping',
	'tool_ping_desc' => 'Check the connection status',
	'tool_ping_info1' => 'The ping between the servertool and your gameserver is:',
	'tool_ping_info2' => 'Between the servertool and gameserver',
	'tool_ping_info3' => 'The ping between the servertool and the BFP4F website is:',
	'tool_ping_status1' => 'The connection is exellent!',
	'tool_ping_status2' => 'The connection is average',
	'tool_ping_status3' => 'The connection is slow!',
	
	'tool_watcher' => 'Public watcher',
	
	'tool_minusone' => 'Rank -1 kicker',
	
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
	'cp_dashboard_info_1' => 'Players in server',
	'cp_dashboard_info_2' => 'Server status',
	
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