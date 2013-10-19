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
	'lang_name' => 'Deutsch / German',
	'lang_name_short' => 'DE',
	'lang_charset' => 'utf8',
	'lang_translator' => 'BeckerDerBro',
	'lang_notes' => 'Keine', // Add here some additional notes... If you've got some...
       
	'github' => 'View on GitHub',
       
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Tool',
	'word_cp_full' => 'ControlPanel',
	'word_cp' => 'CP',
	'word_vip' => 'VIP',
	'word_welcome' => 'Willkommen',
	'word_language' => 'Sprache',
	'word_about' => 'Über',
	'word_error' => 'Oh oh!', # Error
	'word_yes' => 'Ja',
	'word_no' => 'Nein',
	'word_ok' => 'OK',
	'word_cancel' => 'Abbrechen', // Verb
	'word_delete' => 'Löschen', // Verb
	'word_go' => 'Los',
	'word_devs' => 'Entwickler',
	'word_translators' => 'Übersetzer',
	'word_suggestions' => 'Vorschläge',
	'word_settings' => 'Settings',
	'word_name' => 'Name',
	'word_loading' => 'Laden',
	'word_actions' => 'Aktionen',
	'word_qa' => 'Q&A',
	'word_player' => 'Spieler',
	'word_players' => 'Spieler',
	'word_playername' => 'Spielername',
	'word_profileid' => 'ProfilID',
	'word_rank' => 'Rang',
	'word_updated' => 'Updated',
	'word_enable' => 'Aktivieren', // Verb
	'word_disable' => 'Deaktiviere', // Verb
	'word_enabled' => 'Aktiviert',
	'word_disabled' => 'Deaktiviert',
	'word_ty' => 'Danke!',
	'word_date' => 'Datum',
	'word_until' => 'Bis',
	'word_forever' => 'Für immer',
       
	// Messages
	'msg_serverdown' => 'Das Tool konnte sich nicht mit dem Server verbinden, Es ist möglicherweise aus oder falsche RCON Details sind gegeben, Schau nach!<br />Der letzte Herzschlag war:',
	'msg_serverup' => 'Der Server ist online und läuft.<br />Der letzte Herzschlag war:',
	'msg_norights' => 'Du hast nicht die nötigen Rechte um diese Seite zu öffnen.',
	'msg_settings_saved' => 'Die Einstellungen wurden gespeichert',
	'msg_error' => 'Die/Der Folgende/n Fehler sind aufgetreten:',
	'msg_cmd_noaccess' => 'Du hast keinen Zugriff auf diesen Befehl',
	'msg_cmd_missingvars' => 'Es gibt fehlende Variablen',
	'msg_cmd_failed' => 'Ausführender Befehl fehlgeschlagen',
	'msg_nologin' => 'Du bist nicht eingeloggt, oder die Sitzung ist abgelaufen',
	'msg_sure' => 'Bist du sicher?',
	'msg_notadded' => 'Diese Funktion wurde noch nicht hinzugefügt',
	'msg_db1' => 'Bitte gehe zu Bearbeitungsseite um diesen Befehl zu aktivieren/deaktivieren',
       
	// Buttons
	'btn_back' => 'Zurück',
	'btn_previous' => 'Verheriges',
	'btn_next' => 'Nächstes',
	'btn_save' => 'Save',
	'btn_add' => 'Hinzufügen',
	'btn_close' => 'Schließen',
       
	// Tools general
	'tool_gen_ignorevip' => 'VIPs ignorieren?',
	'tool_gen_help1' => 'Maximum per team',
       
	// Tools names and descriptions
	'tool_server' => 'Server Verwaltung',
	'tool_server_desc' => 'Momentaner Status und Verwalte den Server',
	'tool_server_editrcon' => 'Edit RCON information',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_nextmap' => 'Nächste Karte',
	'tool_server_nextmap_msg' => 'Karte wird geändert',
	'tool_server_restartround' => 'Runde neustarten',
	'tool_server_restartround_msg' => 'Runde wurde neu gestartet',
	'tool_server_empty' => 'Server ist leer',
	'tool_server_editrcon_msg' => 'Die neue RCON Info wurde gespeichert', // Nicht mehr benutzt...
	'tool_server_warnpl_msg' => 'Spieler wurde gewarnt',
	'tool_server_kickpl_msg' => 'Spieler wurde gekickt',
	'tool_server_ranked' => 'RANKED', // NOTE: ALL uppercase!
	'tool_server_unranked' => 'UNRANKED', // NOTE: ALL uppercase!
	'tool_server_joining' => 'joining', // NOTE: ALL lowercase!
	'tool_server_curmap' => 'Momentane Karte',
	'tool_server_t1tickets' => 'Team 1 tickets',
	'tool_server_t2tickets' => 'Team 2 tickets',
	'tool_server_playing' => 'Zeit gespielt',
	'tool_server_serverip' => 'Server IP',
	'tool_server_rconport' => 'RCON Admin Port',
	'tool_server_rconpass' => 'RCON Passwort',
	'tool_server_chat' => 'Chat',
	'tool_server_adminchat' => 'Adminchat',
	'tool_server_team' => 'Team',
	'tool_server_kit' => 'Kit',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Kills',
	'tool_server_deaths' => 'Tode',
	'tool_server_score' => 'Score',
	'tool_server_idle' => 'Inaktiv',
	'tool_server_plactions' => 'Spieler Aktionen',
	'tool_server_ltp' => 'Link zum Profil',
	'tool_server_kick' => 'Spieler kicken',
	'tool_server_warn' => 'Spieler warnen',
	'tool_server_nochat' => 'Keine Chatnachrichten',
       
	'tool_vipm' => 'VIP Verwaltung',
	'tool_vipm_desc' => 'VIPs hinzufügen oder entfernen',
	'tool_vipm_vipadded' => 'VIP hinzugefügt',
	'tool_vipm_vipdeleted' => 'VIP entfernt',
	'tool_vipm_notfound' => 'Keine VIPs gefunden',
       
	'tool_iteml' => 'Item Liste',
	'tool_iteml_desc' => 'Liste von allen Items in BF P4F',
       
	'tool_set' => 'Einstellungen',
	'tool_set_desc' => 'Einstellungen für CP und tool',
	'tool_set_deflang' => 'Standart Sprache',
	'tool_set_df' => 'Datumsformat',
	'tool_set_fdf' => 'Kompletttes Datumsformat',
	'tool_set_notifier' => 'Benachrichtiger',
	'tool_set_notify_email' => 'E-mailadresse benachrichtigen',
	'tool_set_iga_ad' => 'Kleine Werbung',
	'tool_set_iga_ad_opt' => 'Alle %s% Sekunden anzeigen',
	'tool_set_iga_ad_help' => "Folgende Nachricht anzeigen: '%msg%'",
	'tool_set_help1' => 'Für mehr Infos über das Datumsformat, Schau hier <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'Sprache %lang% existiert nicht!!',
	'tool_set_err2' => 'Ungültige Geltung',
	'tool_set_err3' => 'Unbekannter Antragssteller für das Tool',
	'tool_set_err4' => 'Bitte gib eine gültige E-mailadresse an, um dich zu benachrichtigen, wenn das Tool nicht zum Server verbinden kann',
       
	'tool_acc' => 'Accounts',
	'tool_acc_desc' => 'Accounts verwalten',
	'tool_acc_add' => 'Benutzer hinzufügen',
	'tool_acc_edit' => 'Benutzer bearbeiten',
	'tool_acc_expl1' => 'Lass das Passwort-Feld leer, wenn du das Passwort nicht ändern möchtest',
	'tool_acc_rights' => 'Wähle welche Rechte der Benutzer hat',
	'tool_acc_fr1' => '<abbr title="In-Game Admin">IGA</abbr>',
	'tool_acc_fr2' => 'Super-admin',
	'tool_acc_fr3' => 'RCON Zugriff',
	'tool_acc_fr4' => 'Blacklist',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Server Verwaltung',
	'tool_acc_fr7' => 'Items Liste',
	'tool_acc_fr8' => 'Limiters (tools)',
	'tool_acc_fr9' => 'Logs',
	'tool_acc_fr10' => 'Whitelist',
	'tool_acc_help1' => 'Der Name muss mindestens 5 Zeichen haben, Dies ist ein öffentlicher Name',
	'tool_acc_help2' => 'Der Name muss mindestens 5 Zeichen haben und einmalig sein',
	'tool_acc_help3' => 'Das Passwort muss mindestens 6 Zeichen haben',
	'tool_acc_help4' => 'Passwort bestätigen',
	'tool_acc_err1' => 'Dein Name muss mindestens 5 Zeichen haben',
	'tool_acc_err2' => 'Dein Username muss mindestens 5 Zeichen haben!',
	'tool_acc_err3' => 'Dein Passwort muss mindestens 6 Zeichen haben!',
	'tool_acc_err4' => 'Unbekannte Gültigkeit der Rechte',
	'tool_acc_err5' => 'Invalid ProfileID',
	'tool_acc_err6' => 'No user found',
	'tool_acc_err7' => 'You cannot delete your own superadmin rights',
       
	'tool_logs' => 'Logs',
	'tool_logs_desc' => 'Checke die Logs, gibt es ungewöhnliche Dinge?',
	'tool_logs1' => 'Autokick log',
	'tool_logs1_desc' => 'Alle ausgeführte Kicks',
	'tool_logs2' => 'CP actions log',
	'tool_logs2_desc' => 'Alle ausgeführte Aktionen via den CP',
	'tool_word_desc' => 'Beschreibung',
       
	'tool_wl' => 'Waffen limiter',
	'tool_wl_desc' => 'Wähle die nicht erlaubten Waffen und kicke die Spieler automatisch',
	'tool_wl_disallowed' => 'Nicht erlaubte Items',
	'tool_wl_err1' => 'Unbekannter Status für das Tool',
	'tool_wl_err2' => 'Unbekannte ignvip Gültigkeit für das Tool',
	'tool_wl_err3' => 'Ungültige BFID: %id%',
       
	'tool_pl' => 'Prebuy limiter',
	'tool_pl_desc' => 'Verbiete prebuy für eine oder alle Waffen',
	'tool_pl_check' => 'Zu prüfende Items',
	'tool_pl_help1' => 'Freilassen, um den prebuylimiter für <b>ALLE</b> Waffen anzuwenden',
       
	'tool_al' => 'Attachment limiter',
	'tool_al_desc' => 'Wähle die nicht erlaubten Attachments und kicke die Spieler automatisch',
       
	'tool_sl' => 'Shotgun limiter',
	'tool_sl_desc' => 'Setze eine maximale Anzahl an Shotguns pro Team',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Maximale Shotgun-Benutzer pro Team',
	'tool_sl_err1' => 'Unbekannter Status für das Tool',
	'tool_sl_err2' => 'Unbekannte ignvip Gültigkeit für das Tool',
	'tool_sl_err3' => 'Ungültige Nummer an maximalen Shotgun-Benutzern',
       
	'tool_ll' => 'Rang limiter',
	'tool_ll_desc' => 'Setze ein maximum und minimum Rang',
	'tool_ll_min' => 'Minimum Rang',
	'tool_ll_max' => 'Maximum Rang',
	'tool_ll_err1' => 'Unbekannter Status für das Tool',
	'tool_ll_err2' => 'Unbekannte ignvip Gültigkeit für das Tool',
	'tool_ll_err3' => 'Minimum Rang muss zwischen %lvls% liegen',
	'tool_ll_err4' => 'Maximum Rang muss zwischen %lvls% liegen',
       
	'tool_cl' => 'Class limiter',
	'tool_cl_desc' => 'Erlaube eine bestimmte Anzahl an Klassen pro Team',
	'tool_cl_assaults' => 'Sturmsoldat',
	'tool_cl_medics' => 'Sanitäter',
	'tool_cl_recons' => 'Aufklärer',
	'tool_cl_engineers' => 'Pionier',
	'tool_cl_err1' => 'Unbekannter Status für das Tool',
	'tool_cl_err2' => 'Unbekannte ignvip Gültigkeit für das Tool',
	'tool_cl_err3' => 'Ungültige Anzahl von %class%',
       
	'tool_am' => 'Admin Nachricht',
	'tool_am_desc' => 'Zeige eine Nachricht im Spiel mit den Admins, die momentan online sind',
	'tool_am_opt' => 'Alle %s% Sekunden anzeigen',
	'tool_am_online' => 'Online Nachricht',
	'tool_am_offline' => 'Offline Nachricht',
	'tool_am_help1' => 'Zeit um die Nachricht anzuzeigen',
	'tool_am_help2' => 'Nachricht die angezeigt werden soll, wenn mindestens ein Admin im Spiel ist <br /><code>%admins%</code> Name der Admins, die online sind',
	'tool_am_help3' => 'Nachricht die angezeigt werden soll, wenn kein Admin im Spiel ist',
	'tool_am_err1' => 'Unbekannter Status für das Tool',
	'tool_am_err2' => 'Du kannst die Online-Nachricht nicht frei lassen',
	'tool_am_err3' => 'Du kannst die Offline-Nachricht nicht frei lassen',
       
	'tool_sm' => 'Nachricht der Stats',
	'tool_sm_desc' => 'Zeige eine Nachricht im Spiel, mit dem momentanen Status des Spielers',
	'tool_sm_opt' => 'Alle %s% Sekunden anzeigen',
	'tool_sm_msg' => 'Nachricht',
	'tool_sm_help1' => 'Zeit um die Nachricht anzuzeigen',
	'tool_sm_help2' =>      'Nachricht anzuzeigen, Du kannst die folgendes Variablen benutzen:<br />' .
						'<code>%name%</code> Name<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Klasse<br />' .
						'<code>%rank%</code> Rang<br />' .
						'<code>%kills%</code> Kills<br />' .
						'<code>%deaths%</code> Tode<br />' .
						'<code>%score%</code> Score<br />' .
						'<code>%vip%</code> VIP Status (Ja oder Nein)',
       
	'tool_bl' => 'Blacklist',
	'tool_bl_desc' => 'Bann Spieler für eine bestimmte Zeit oder permanent',
	'tool_bl_reason' => 'Grund',
	'tool_bl_until' => 'Gebannt bis',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Permanent gebannt',
	'tool_bl_warn1' => 'Es ist nicht möglich, die Blacklist an-/auszuschalten',
	'tool_bl_err1' => 'Dieser Spieler ist schon permanent gebannt',
	'tool_bl_err2' => 'Konnte den Soldat nicht erzielen: Invalid ProfileID',
	'tool_bl_err3' => 'Noch keine Banns',
	'tool_bl_addedby' => 'Gebannt von',
	'tool_bl_added' => 'Bann wurde hinzugefügt',
	'tool_bl_deleted' => 'Bann wurde aufgehoben',
       
	'tool_wlist' => 'Whitelist',
	'tool_wlist_desc' => 'Füge Spieler hinzu die nicht von einem limiter gekickt werden sollen',
	'tool_wlist_added' => 'Spieler wurde der Whitelist hinzugefügt',
	'tool_wlist_deleted' => 'Spieler wurde von der Whitelist entfernt',
	'tool_wlist_err1' => 'Dieser Spieler ist schon auf der Whitelist',
	'tool_wlist_err2' => 'Konnte Soldaten nicht erzielen: Invalid ProfileID',
	'tool_wlist_err3' => 'Noch keine Spieler auf der Whitelist',
	'tool_wlist_addedby' => 'Hinzugefügt von',
       
	// Installation page
	#'install_welcome' => 'Herzlichen Willkommen zum Installations-Zauberer, Prüfe nach, ob du alle Details korrekt eingefüllt hast. Dann klicke auf Installieren.',
	#'install_error_config' => 'Bitte fülle deine Details in die Datei config.php ein, bevor du du versuchst, das Tool zu installieren',
	#'install_error' => 'Installation fehlgeschlagen, bitte installiere die Datenbank manuell indem du die folgende SQL benutzt',
	#'install_success' => 'Installation war erfolgreich, bitte lösche die Datei install.php. Du kannst dich mit den folgenden Details einloggen',
       
	// ControlPanel no rights page
	'cp_norights' => 'Zugriff verweigert',
	'cp_norights_msg' => 'Du hast nicht genug Rechte um auf diese Seite zuzugreifen.',
       
	// ControlPanel menu
	'cp_menu_tools' => 'Tools',
	'cp_menu_credits' => 'Credits',
	'cp_menu_donate' => 'Spenden',
	'cp_menu_report_bug' => 'Einen Bug melden',
	'cp_menu_subm_sug' => 'Mach einen Vorschlag',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'Changelog',
	'cp_menu_logout' => 'Ausloggen',
       
	// ControlPanel login page
	'cp_login' => 'Login',
	'cp_username' => 'Username',
	'cp_password' => 'Passwort',
	'cp_login_remember' => 'Passwort speichern',
	'cp_error_login' => 'Ungültiger Username oder Passwort, Bitte versuche es erneut',
	'cp_error_login_sessions' => 'Could not set the login sessions, Bitte versuche es erneut. Wenn diese Nachricht immer wieder erscheint, Überprüfe bitte deine PHP Einstellungen.',
       
	// ControlPanel logout page
	'cp_logout' => 'Ausloggen',
	'cp_logout_success' => 'Du wurdest erfolgerich ausgeloggt. Bis dann!',
       
	// ControlPanel dashboard
	'cp_dashboard' => 'Dashboard',
	'cp_dashboard_subtitle' => 'Zusammenfassung Und einfache Navigation',
	'cp_dashboard_explination' => 'Kicke <i class="icon-remove"></i> um das Tool zu aktivieren, oder klicke <i class="icon-ok"></i> um das Tool zu deaktivieren. Klicke auf den Titel um das Tool zu verwalten.',
       
	// ControlPanel my account
	'cp_myaccount' => 'Mein Account',
	'cp_myaccount_subtitle' => 'Verwalte deinen Account',
	'cp_myaccount_expl1' => 'Das ist der Name der öffentlich angezeigt wird',
	'cp_myaccount_expl2' => 'Lass das Passwort-Feld leer, wenn du dein Passwort nicht ändern möchtest',
	'cp_myaccount_oldpass' => 'Altes Passwort',
	'cp_myaccount_newpass' => 'Neues Passwort',
	'cp_myaccount_expl3' => 'Mindestens 6 Zeichen',
	'cp_myaccount_expl4' => 'Nur ein check',
	'cp_myaccount_err1' => 'Dein Name muss mindestens 4 Zeichen haben',
	'cp_myaccount_err2' => 'Dein altes Passwort stimmt nicht',
	'cp_myaccount_err3' => 'Dein neues Passwort muss mindestens 6 Zeichen haben',
	'cp_myaccount_err4' => 'Die 2 neuen Passwort-Felder stimmen nicht',
       
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'Keine Items gefunden',
       
	// ControlPanel footer
	'cp_footer_thread' => 'Tool thread',
	'cp_footer_createdby' => 'Bunny\'s ServerTool %version% is licensed under Apache License V2.0<br />Copyright &copy; %year% by Danny Li &lt;<i>SharpBunny</i>&gt;',
       
	/*
	 * Q&A THINGS
	 */
	'qa_questions' => 'Fragen',
	'qa_answers' => 'Antworten',
	'qa_note' => 'NOTE: More Q&A will be added in the future, meanwhile you can ask me via PM, RaidCall or e-mail.',
       
	'qa' => array(
		1 => array(
			'question' => 'Wie finde ich die ProfileID des Spielers?',
			'anwser' => 'Example: <code>http://battlefield.play4free.com/en/profile/2567963101/540307041</code><br /><code>2567963101</code> = ProfileID<br /><code>540307041</code> = SoldierID'
		),
	),
 
);
?>