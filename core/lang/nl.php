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
	'lang_name' => 'Nederlands / Dutch',
	'lang_name_short' => 'NL',
	'lang_charset' => 'utf8',
	'lang_translator' => 'SharpBunny',
	'lang_notes' => 'Geen', // Add here some additional notes... If you've got some...
	
	'github' => 'Bekijk op GitHub',
	
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Tool',
	'word_cp_full' => 'ControlPanel',
	'word_cp' => 'CP',
	'word_vip' => 'VIP',
	'word_welcome' => 'Welkom',
	'word_language' => 'Taal',
	'word_about' => 'Over',
	'word_error' => 'Oh oh!', # Error
	'word_yes' => 'Ja',
	'word_no' => 'Nee',
	'word_ok' => 'OK',
	'word_cancel' => 'Annuleren', // Verb
	'word_delete' => 'Verwijderen', // Verb
	'word_go' => 'Ga',
	'word_devs' => 'Ontwikkelaars',
	'word_translators' => 'Vertalers',
	'word_suggestions' => 'Suggesties',
	'word_settings' => 'Instellingen',
	'word_name' => 'Naam',
	'word_loading' => 'Laden',
	'word_actions' => 'Acties',
	'word_qa' => 'Q&A',
	'word_player' => 'Speler',
	'word_players' => 'Spelers',
	'word_playername' => 'Spelernaam',
	'word_profileid' => 'ProfileID',
	'word_rank' => 'Rank',
	'word_updated' => 'Updated',
	'word_enable' => 'Inschakelen', // Verb
	'word_disable' => 'Uitschakelen', // Verb
	'word_enabled' => 'Ingeschakeld',
	'word_disabled' => 'Uitgeschakeld',
	'word_ty' => 'Dank je!',
	'word_date' => 'Datum',
	'word_until' => 'Tot',
	'word_forever' => 'Voor altijd',
	
	// Messages
	'msg_serverdown' => 'De tool kon niet verbinden met de server, het is waarschijnlijk down of je hebt onjuiste RCON informatie opgegeven, controleer het!<br />Laatste hartslag was:',
	'msg_serverup' => 'De server is up en draait<br />Laatste hartslag was:',
	'msg_norights' => 'Je hebt niet genoeg rechten om deze pagina te bekijken',
	'msg_settings_saved' => 'De instellingen zijn opgeslagen',
	'msg_error' => 'De volgende fout(en) zijn opgetreden:',
	'msg_cmd_noaccess' => 'Je hebt niet genoeg rechten voor deze commando',
	'msg_cmd_missingvars' => 'Er zijn ontbrekende variabelen voor deze commando',
	'msg_cmd_failed' => 'Uitvoeren van commando mislukt',
	'msg_nologin' => 'Je bent niet ingelogd of je sessie is verlopen',
	'msg_sure' => 'Weet je het zeker?',
	'msg_notadded' => 'Deze functie is nog niet toegevoegd',
	'msg_db1' => 'Ga a.u.b. naar de configuratiepagina om deze tool in of uit te schakelen.',
	
	// Buttons
	'btn_back' => 'Terug',
	'btn_previous' => 'Vorige',
	'btn_next' => 'Volgende',
	'btn_save' => 'Opslaan',
	'btn_add' => 'Toevoegen',
	'btn_close' => 'Sluiten',
	
	// Tools general
	'tool_gen_ignorevip' => 'VIPs negeren?',
	'tool_gen_help1' => 'Maximum per team',
	
	// Tools names and descriptions
	'tool_server' => 'Server beheer',
	'tool_server_desc' => 'Actuele status and beheer de server',
	'tool_server_editrcon' => 'RCON informatie bewerken',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_nextmap' => 'Volgende map',
	'tool_server_nextmap_msg' => 'Map wordt gewisseld',
	'tool_server_restartround' => 'Ronde herstarten',
	'tool_server_restartround_msg' => 'Ronde wordt herstard',
	'tool_server_empty' => 'Server is leeg',
	'tool_server_editrcon_msg' => 'The new RCON info has been saved', // Not used anymore...
	'tool_server_warnpl_msg' => 'Speler is gewaarschuwed',
	'tool_server_kickpl_msg' => 'Speler is gekicked',
	'tool_server_ranked' => 'RANKED', // NOTE: All uppercase!
	'tool_server_unranked' => 'UNRANKED', // NOTE: All uppercase!
	'tool_server_joining' => 'aan het verbinden', // NOTE: All lowercase
	'tool_server_curmap' => 'Actuele map',
	'tool_server_t1tickets' => 'Team 1 tickets',
	'tool_server_t2tickets' => 'Team 2 tickets',
	'tool_server_playing' => 'Speeltijd',
	'tool_server_serverip' => 'Server IP',
	'tool_server_rconport' => 'RCON admin port',
	'tool_server_rconpass' => 'RCON wachtwoord',
	'tool_server_chat' => 'Chat',
	'tool_server_adminchat' => 'Adminchat',
	'tool_server_team' => 'Team',
	'tool_server_kit' => 'Kit',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Kills',
	'tool_server_deaths' => 'Deaths',
	'tool_server_score' => 'Score',
	'tool_server_idle' => 'Idle',
	'tool_server_plactions' => 'Speler acties',
	'tool_server_ltp' => 'Link maar profiel',
	'tool_server_kick' => 'Speler kicken',
	'tool_server_warn' => 'Speler waarschuwen',
	'tool_server_nochat' => 'Geen chatberichten',
	
	'tool_vipm' => 'VIPs beheer',
	'tool_vipm_desc' => 'Voeg VIPs toe of verwijder ze',
	'tool_vipm_vipadded' => 'VIP toegevoegd',
	'tool_vipm_vipdeleted' => 'VIP verwijderd',
	'tool_vipm_notfound' => 'Geen VIPs gevonden',
	
	'tool_iteml' => 'Item lijst',
	'tool_iteml_desc' => 'Lijst van alle items in BFP4F',
	
	'tool_set' => 'Instellingen',
	'tool_set_desc' => 'Instellingen voor de CP en tool',
	'tool_set_deflang' => 'Standaard taal',
	'tool_set_df' => 'Datum formaat',
	'tool_set_fdf' => 'Volledige datum formaat',
	'tool_set_notifier' => 'Melder',
	'tool_set_notify_email' => 'Melder e-mailadres',
	'tool_set_iga_ad' => 'Kleine advertentie',
	'tool_set_iga_ad_opt' => 'Weergeef elke %s% seconden',
	'tool_set_iga_ad_help' => "Weergeeft het volgende bericht: '%msg%'",
	'tool_set_help1' => 'Meer informatie over datum formaten, zie <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'Taal %lang% bestaat niet!',
	'tool_set_err2' => 'Ongeldige waarde voor advertisement',
	'tool_set_err3' => 'Ongeldige waarde voor notifier',
	'tool_set_err4' => 'Geef a.u.b. een geldig e-mailadres op om meldingen te ontvangen wanneer de tool niet met de server kan verbinden',
	
	'tool_acc' => 'Accounts',
	'tool_acc_desc' => 'Beheer de accounts',
	'tool_acc_add' => 'Gebruiker toevoegen',
	'tool_acc_edit' => 'Gebruiker bewerken',
	'tool_acc_expl1' => 'Laat de wachtwoord velden leeg als je deze niet wilt veranderen',
	'tool_acc_rights' => 'Kies welke rechten de gebruiker heeft',
	'tool_acc_fr1' => '<abbr title="In-Game Admin">IGA</abbr>',
	'tool_acc_fr2' => 'Super-admin',
	'tool_acc_fr3' => 'RCON toegang',
	'tool_acc_fr4' => 'Blacklist',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Server beheer',
	'tool_acc_fr7' => 'Items list',
	'tool_acc_fr8' => 'Limiters (tools)',
	'tool_acc_fr9' => 'Logs',
	'tool_acc_fr10' => 'Whitelist',
	'tool_acc_help1' => 'De naam moet uit minimaal 5 tekens bestaan, dit is een publieke naam',
	'tool_acc_help2' => 'De gebruikersnaam moet uit minimaal 5 tekens bestaan en uniek zijn',
	'tool_acc_help3' => 'Het wachtwoord moet uit minimaal 6 tekens bestaan',
	'tool_acc_help4' => 'Bevestig het wachtwoord',
	'tool_acc_err1' => 'De naam moet uit minimaal 5 tekens bestaan',
	'tool_acc_err2' => 'De gebruikersnaam moet uit minimaal 5 tekens bestaan en uniek zijn',
	'tool_acc_err3' => 'Het wachtwoord moet uit minimaal 6 tekens bestaan',
	'tool_acc_err4' => 'Onbekende waarde voor rights',
	'tool_acc_err5' => 'Ongeldige ProfileID',
	'tool_acc_err6' => 'Geen gebruiker gevonden',
	'tool_acc_err7' => 'Je kan niet je eigen superadmin rechten verwijderen',
	
	'tool_logs' => 'Logs',
	'tool_logs_desc' => 'Check the logs, are there some unusual things?',
	'tool_logs1' => 'Autokicker log',
	'tool_logs1_desc' => 'Alle uitgevoerde kicks',
	'tool_logs2' => 'CP actions log',
	'tool_logs2_desc' => 'Alle uitgevoerde acties via de CP',
	'tool_word_desc' => 'Omschrijving',
	
	'tool_wl' => 'Weapon limiter',
	'tool_wl_desc' => 'Kies de verboden wapens en kick spelers automatisch',
	'tool_wl_disallowed' => 'Verboden items',
	'tool_wl_err1' => 'Onbekende waarde voor status',
	'tool_wl_err2' => 'Onbekende waarde voor ignvip',
	'tool_wl_err3' => 'Ongeldige BFID: %id%',
	
	'tool_pl' => 'Prebuy limiter',
	'tool_pl_desc' => 'Verbied prebuy voor bepaalde wapens of alle wapens',
	'tool_pl_check' => 'Te controleren items',
	'tool_pl_help1' => 'Laat het veld leeg om te controleren op <b>ALLE</b> wapens',
	
	'tool_al' => 'Attachment limiter',
	'tool_al_desc' => 'Kies de verboden attachments en kick de speler automatisch',
	
	'tool_sl' => 'Shotgun limiter',
	'tool_sl_desc' => 'Zet een maximum aantal shotgun gebruikers pet team',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Maximum shotgun gebruikers per team',
	'tool_sl_err1' => 'Onbekende waarde voor status',
	'tool_sl_err2' => 'Onbekende waarde voor ignvip',
	'tool_sl_err3' => 'Ongeldig aantal voor het maximum aantal shotgun gebruikers',
	
	'tool_ll' => 'Level limiter',
	'tool_ll_desc' => 'Zet het minimum en maximum benodigde level',
	'tool_ll_min' => 'Minimum rank',
	'tool_ll_max' => 'Maximum rank',
	'tool_ll_err1' => 'Onbekende waarde voor status',
	'tool_ll_err2' => 'Onbekende waarde voor ignvip',
	'tool_ll_err3' => 'Minimum level moet tussen: %lvls% zijn',
	'tool_ll_err4' => 'Maximum level moet tussen: %lvls% zijn',
	
	'tool_cl' => 'Class limiter',
	'tool_cl_desc' => 'Sta alleen een bepaald aantal van classes toe per team',
	'tool_cl_assaults' => 'Assaults',
	'tool_cl_medics' => 'Medics',
	'tool_cl_recons' => 'Recons',
	'tool_cl_engineers' => 'Engineers',
	'tool_cl_err1' => 'Onbekende waarde voor status',
	'tool_cl_err2' => 'Onbekende waarde voor ignvip',
	'tool_cl_err3' => 'Ongeldig aantal voor %class%',
	
	'tool_am' => 'Admin bericht',
	'tool_am_desc' => 'Weergeef een bericht in-game met de online admins',
	'tool_am_opt' => 'Weergeef elke %s% seconden',
	'tool_am_online' => 'Online bericht',
	'tool_am_offline' => 'Offline bericht',
	'tool_am_help1' => 'De tijd om het bericht te weergeven',
	'tool_am_help2' => 'Het bericht om te weergeven wanneer er minimaal 1 admin in-game is<br /><code>%admins%</code> Namen van de online admins',
	'tool_am_help3' => 'Het bericht om te weergeven wanneer er geen admins in-game zijn',
	'tool_am_err1' => 'Onbekende waarde voor status',
	'tool_am_err2' => 'Je kan het online bericht niet leeg laten',
	'tool_am_err3' => 'Je kan het offline bericht niet leeg laten',
	
	'tool_sm' => 'Stats bericht',
	'tool_sm_desc' => 'Weergeeft een bericht in-game met de statistieken van de speler',
	'tool_sm_opt' => 'Weergeef elke %s% seconden',
	'tool_sm_msg' => 'Bericht',
	'tool_sm_help1' => 'De tijd om het bericht te weergeven',
	'tool_sm_help2' => 	'Bericht om te weergeven, je kan de volgende variabelen gebruiken:<br />' .
						'<code>%name%</code> Naam<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Class<br />' .
						'<code>%rank%</code> Rank<br />' .
						'<code>%kills%</code> Kills<br />' .
						'<code>%deaths%</code> Deaths<br />' .
						'<code>%score%</code> Score<br />' .
						'<code>%vip%</code> VIP status (Yes of No)',
	
	'tool_bl' => 'Blacklist',
	'tool_bl_desc' => 'Ban spelers voor een bepaalde tijd of permanent',
	'tool_bl_reason' => 'Reden',
	'tool_bl_until' => 'Geband tot',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Permanent',
	'tool_bl_warn1' => 'Het is niet mogelijk om de blacklist in of uit te schakelen',
	'tool_bl_err1' => 'Deze speler heeft al een permanente ban',
	'tool_bl_err2' => 'Kon soldaten niet opvragen: Ongeldige ProfileID',
	'tool_bl_err3' => 'Nog geen bans',
	'tool_bl_addedby' => 'Geband door',
	'tool_bl_added' => 'Ban is toegevoegd',
	'tool_bl_deleted' => 'Ban is verwijderd',
	
	'tool_wlist' => 'Whitelist',
	'tool_wlist_desc' => 'Voeg spelers toe die niet gekicked worden door de limiters',
	'tool_wlist_added' => 'Speler is toegevoegd aan de whitelist',
	'tool_wlist_deleted' => 'Speler is verwijderd uit de whitelist',
	'tool_wlist_err1' => 'De speler staat al in de whitelist',
	'tool_wlist_err2' => 'Could not fetch soldiers: Invalid ProfileID',
	'tool_wlist_err3' => 'Kon soldaten niet opvragen: Ongeldige ProfileID',
	'tool_wlist_addedby' => 'Toegevoegd door',
	
	// Installation page
	#'install_welcome' => 'Welcome to the installation wizard, make sure all your details are filled in correctly. Then click on install.',
	#'install_error_config' => 'Please fill in your details in the file config.php before trying to install the tool',
	#'install_error' => 'Installation failed, please install the database manually by using the following SQL',
	#'install_success' => 'Installation was succesful, please delete the file install.php. You can login with the following details',
	
	// ControlPanel no rights page
	'cp_norights' => 'Toegang geweigerd',
	'cp_norights_msg' => 'Je hebt niet genoeg rechten om deze pagina te bekijken.',
	
	// ControlPanel menu
	'cp_menu_tools' => 'Tools',
	'cp_menu_credits' => 'Credits',
	'cp_menu_donate' => 'Doneren',
	'cp_menu_report_bug' => 'Bug melden',
	'cp_menu_subm_sug' => 'Suggestie doen',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'Changelog',
	'cp_menu_logout' => 'Uitloggen',
	
	// ControlPanel login page
	'cp_login' => 'Inloggen',
	'cp_username' => 'Gebruikersnaam',
	'cp_password' => 'Wachtwoord',
	'cp_login_remember' => 'Onthoud mij',
	'cp_error_login' => 'Ongeldige gebruikersnaam en/of wachtwoord, probeer het nog eens',
	'cp_error_login_sessions' => 'Kon de login sessies niet aanmaken, probeer het nog eens. Als dit bericht blijft aanhouden, controleer dan je PHP instellingen.',
	
	// ControlPanel logout page
	'cp_logout' => 'Uitloggen',
	'cp_logout_success' => 'Je bent succesvol uitgelogd, tot ziens!',
	
	// ControlPanel dashboard
	'cp_dashboard' => 'Dashboard',
	'cp_dashboard_subtitle' => 'Overzicht en eenvoudige navigatie',
	'cp_dashboard_explination' => 'Klik op <i class="icon-remove"></i> om de tool te activeren of op <i class="icon-ok"></i> om te deactiveren. Klik op de titel om de tool te beheren.',
	
	// ControlPanel my account
	'cp_myaccount' => 'Mijn account',
	'cp_myaccount_subtitle' => 'Beheer mijn account',
	'cp_myaccount_expl1' => 'Dit is de naam die voor iedereen zichtbaar is',
	'cp_myaccount_expl2' => 'Laat de wachtwoordvelden leeg als je je wachtwoord niet wilt veranderen',
	'cp_myaccount_oldpass' => 'Oud wachtwoord',
	'cp_myaccount_newpass' => 'Nieuw wachtwoord',
	'cp_myaccount_expl3' => 'Tenminste 6 tekens',
	'cp_myaccount_expl4' => 'Om te controleren',
	'cp_myaccount_err1' => 'Je naam moet uit minimaal 6 tekens bestaan',
	'cp_myaccount_err2' => 'Je oude wachtwoord klopt niet',
	'cp_myaccount_err3' => 'Je nieuwe wachtwoord moet uit minimaal 6 tekens bestaan',
	'cp_myaccount_err4' => 'De twee nieuwe wachtwoordvelden komen niet overeen',
	
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'Geen items gevonden',
	
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