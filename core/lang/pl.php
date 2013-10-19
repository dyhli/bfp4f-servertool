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
	'lang_name' => 'Polski / Polish',
	'lang_name_short' => 'PL',
	'lang_charset' => 'utf8',
	'lang_translator' => 'Nommo from <a href=www.partisans.com.pl>Partisans</a>',
	'lang_notes' => 'Brak', // Add here some additional notes... If you've got some...
	
	'github' => 'Sprawdź na GitHub',
	
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Tool',
	'word_cp_full' => 'Panel kontrolny',
	'word_cp' => 'PK',
	'word_vip' => 'VIP',
	'word_welcome' => 'Witaj',
	'word_language' => 'Język',
	'word_about' => '',
	'word_error' => 'O NIE!', # Error
	'word_yes' => 'Tak',
	'word_no' => 'Nie',
	'word_ok' => 'OK',
	'word_cancel' => 'Anuluj', // Verb
	'word_delete' => 'Usuń', // Verb
	'word_go' => 'Idź',
	'word_devs' => 'Developerzy',
	'word_translators' => 'Tłumacze',
	'word_suggestions' => 'Sugestie',
	'word_settings' => 'Ustawienia',
	'word_name' => 'Nazwa',
	'word_loading' => 'Ładowanie',
	'word_actions' => 'Akcje',
	'word_qa' => 'Q&A',
	'word_player' => 'Gracz',
	'word_players' => 'Graczy',
	'word_playername' => 'Nick Gracza',
	'word_profileid' => 'ID Profilu',
	'word_rank' => 'Poziom',
	'word_updated' => 'Updated',
	'word_enable' => 'Włącz', // Verb
	'word_disable' => 'Wyłącz', // Verb
	'word_enabled' => 'Włączony',
	'word_disabled' => 'Wyłączony',
	'word_ty' => 'Dziękuję!',
	'word_date' => 'Data',
	'word_until' => 'Na',
	'word_forever' => 'Zawsze',
	
	// Messages
	'msg_serverdown' => 'Nie można połączyć się z serwerem, możliwe, że serwer jest offline lub podano złe dane RCON!<br />Ostatnie połączenie z serwerem:',
	'msg_serverup' => 'Serwer działa poprawnie.<br />Ostatnie połączenie z serwerem:',
	'msg_norights' => 'Nie masz wystarczających praw, aby tu zaglądać.',
	'msg_settings_saved' => 'Ustawienia zostały zapisane',
	'msg_error' => 'Wyśtąpiły następujące błędy:',
	'msg_cmd_noaccess' => 'Nie masz dostępu do tej komendy',
	'msg_cmd_missingvars' => 'Wystąpiły brakujące zmienne dla tej komendy',
	'msg_cmd_failed' => 'Nieudane wykonanie komendy',
	'msg_nologin' => 'Nie jesteś zalogowany, lub Twoja sesja wygasła',
	'msg_sure' => 'Ale jesteś pewien?',
	'msg_notadded' => 'Ta funkcja nie została jeszcze dodana',
	'msg_db1' => 'Należy wejść na stronę konfiguracji, aby włączyć/wyłączyć tą opcje.',
	
	// Buttons
	'btn_back' => 'Wróć',
	'btn_previous' => 'Poprzedni',
	'btn_next' => 'Następny',
	'btn_save' => 'Zapisz',
	'btn_add' => 'Dodaj',
	'btn_close' => 'Zamknij',
	
	// Tools general
	'tool_gen_ignorevip' => 'Ignorój VIPów?',
	'tool_gen_help1' => 'Maxymalnie na team',
	
	// Tools names and descriptions
	'tool_server' => 'Zarządzanie serwerem',
	'tool_server_desc' => 'Obecny status i zarządzanie serwerem',
	'tool_server_editrcon' => 'Edytuj dane RCON',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_nextmap' => 'Następna mapa',
	'tool_server_nextmap_msg' => 'Mapa zostaje zmieniona',
	'tool_server_restartround' => 'Restartuj rundę',
	'tool_server_restartround_msg' => 'Runda została zrestartowana',
	'tool_server_empty' => 'Server jest pusty',
	'tool_server_editrcon_msg' => 'Nowe dane RCON zostały zapisane', // Not used anymore...
	'tool_server_warnpl_msg' => 'Gracz został ostrzeżony',
	'tool_server_kickpl_msg' => 'Gracz został wykickowany',
	'tool_server_ranked' => 'RANKINGOWY', // NOTE: All uppercase!
	'tool_server_unranked' => 'NIE RANKINGOWY', // NOTE: All uppercase!
	'tool_server_joining' => 'wchodzi', // NOTE: All lowercase
	'tool_server_curmap' => 'Obecna mapa',
	'tool_server_t1tickets' => 'Tickety teamu 1',
	'tool_server_t2tickets' => 'Tickety teamu 2',
	'tool_server_playing' => 'Czas rundy',
	'tool_server_serverip' => 'IP server',
	'tool_server_rconport' => 'Administracyjny port RCON',
	'tool_server_rconpass' => 'Hasło RCON',
	'tool_server_chat' => 'Czat',
	'tool_server_adminchat' => 'Czat administracyjny',
	'tool_server_team' => 'Drużyna',
	'tool_server_kit' => 'Klasa',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Kille',
	'tool_server_deaths' => 'Zgony',
	'tool_server_score' => 'Punkty',
	'tool_server_idle' => 'Śpi',
	'tool_server_plactions' => 'Akcje gracze',
	'tool_server_ltp' => 'Link do profilu',
	'tool_server_kick' => 'Wykickuj',
	'tool_server_warn' => 'Ostrzeż',
	'tool_server_nochat' => 'Brak wiadomości na czacie',
	
	'tool_vipm' => 'Zarządzanie VIPami',
	'tool_vipm_desc' => 'Dodaj lub usuń VIPa',
	'tool_vipm_vipadded' => 'VIP dodny',
	'tool_vipm_vipdeleted' => 'VIP usunięty',
	'tool_vipm_notfound' => 'Brak VIPów',
	
	'tool_iteml' => 'Lista przedmiotów',
	'tool_iteml_desc' => 'Lista wszystkich przedmiotów w Battlefield Play4Free',
	
	'tool_set' => 'Ustawienia',
	'tool_set_desc' => 'Ustawienia panelu kontrolnego i autokicka',
	'tool_set_deflang' => 'Domyślny język',
	'tool_set_df' => 'Format daty',
	'tool_set_fdf' => 'Pełny format daty',
	'tool_set_notifier' => 'Powiadamiacz',
	'tool_set_notify_email' => 'Wysyłaj powiadomienia na e-mail',
	'tool_set_iga_ad' => 'Mała reklama',
	'tool_set_iga_ad_opt' => 'Pokazuj co %s% sekund',
	'tool_set_iga_ad_help' => "Pokazuje wiadomość: '%msg%'",
	'tool_set_help1' => 'Więcej informacji o formatach daty znajdziej tutaj <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'Język %lang% nie istnieje!',
	'tool_set_err2' => 'Zła wartość dla reklamy',
	'tool_set_err3' => 'Nieznana wartość powiadamiacza.',
	'tool_set_err4' => 'Wpisz poprawny adres e-mail, aby Cię powiadomić, gdy nastąpią problemy z połączeniem',
	
	'tool_acc' => 'Konta',
	'tool_acc_desc' => 'Zarządzaj kontami',
	'tool_acc_add' => 'Dodaj konto',
	'tool_acc_edit' => 'Edytuj konto',
	'tool_acc_expl1' => 'Zostaw pustę polę na hasło, gdy nie chcesz go zmieniać',
	'tool_acc_rights' => 'Wybierz, jakie prawa ma mieć użytkownik',
	'tool_acc_fr1' => '<abbr title="In-Game Admin">IGA</abbr>',
	'tool_acc_fr2' => 'Super-admin',
	'tool_acc_fr3' => 'Dostęp RCON',
	'tool_acc_fr4' => 'Czarna lista',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Zarządzanie serwerem',
	'tool_acc_fr7' => 'Lista przedmiotów',
	'tool_acc_fr8' => 'Auto-kicker',
	'tool_acc_fr9' => 'Logi',
	'tool_acc_fr10' => 'Biała Lista',
	'tool_acc_help1' => 'Nick musi miec conajmniej 5 znaków, jest to nazwa publiczna',
	'tool_acc_help2' => 'Login musi mieć minimum 5 znaków i być unikalny',
	'tool_acc_help3' => 'Hasło musi mieć minimum 6 znaków',
	'tool_acc_help4' => 'Potwierdź hasło',
	'tool_acc_err1' => 'Twój nick musi mieć minimum 5 znaków',
	'tool_acc_err2' => 'Twój login musi mieć minimum 5 znaków',
	'tool_acc_err3' => 'Hasło musi miec minimum 6 znaków',
	'tool_acc_err4' => 'Nieznane wartość praw użytkownika',
	'tool_acc_err5' => 'Invalid ProfileID',
	'tool_acc_err6' => 'No user found',
	'tool_acc_err7' => 'You cannot delete your own superadmin rights',
		
	'tool_logs' => 'Logi',
	'tool_logs_desc' => 'Zobacz logi, może są tam dziwne wpisy?',
	'tool_logs1' => 'Autokicker log',
	'tool_logs1_desc' => 'Wszystkie wykickowany osoby',
	'tool_logs2' => 'Log panelu kontrolnego',
	'tool_logs2_desc' => 'Wszystkie akcje wykonane przez panel kontrolny',
	'tool_word_desc' => 'Opis',
	
	'tool_wl' => 'Weapon limiter',
	'tool_wl_desc' => 'Wybierz zabronione bronie i kickuj ich posiadaczy',
	'tool_wl_disallowed' => 'Niedozwolone przedmioty',
	'tool_wl_err1' => 'Nieznany status auto-kicka',
	'tool_wl_err2' => 'Nieznana wartość ignorowania VIPów',
	'tool_wl_err3' => 'Zły BFID: %id%',
	
	'tool_pl' => 'Prebuy limiter',
	'tool_pl_desc' => 'Zabroń prebuy\'a dla wybranych broni',
	'tool_pl_check' => 'Przedmioty do sprawdzenia',
	'tool_pl_help1' => 'Zostaw puste dla kickowania za prebuy <b>WSZYSTKICH</b> broni',
	
	'tool_al' => 'Limiter dodatków',
	'tool_al_desc' => 'Wybierz zabronione dodatki',
	
	'tool_sl' => 'Shotgun limiter',
	'tool_sl_desc' => 'Ustal maxymalna ilość graczy z shotgunami na drużynę',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Maxiumum graczy z shotgunami na drużynę',
	'tool_sl_err1' => 'Nieznany status auto-kicka',
	'tool_sl_err2' => 'Nieznana wartość ignorowania VIPów',
	'tool_sl_err3' => 'Zła wartość maxymalnej ilości graczy z shotgunami na drużynę',
	
	'tool_ll' => 'Level limiter',
	'tool_ll_desc' => 'Ustal minimalny i maxymalny level',
	'tool_ll_min' => 'Minimalny level',
	'tool_ll_max' => 'Maxymalny level',
	'tool_ll_err1' => 'Nieznany status auto-kicka',
	'tool_ll_err2' => 'Nieznana wartość ignorowania VIPów',
	'tool_ll_err3' => 'Minimalny level musi być między: %lvls%',
	'tool_ll_err4' => 'Maxymalny level musi być między: %lvls%',
	
	'tool_cl' => 'Class limiter',
	'tool_cl_desc' => 'Ustal maxymalną ilość graczy z daną klasą na drużynę',
	'tool_cl_assaults' => 'Szturmowcy',
	'tool_cl_medics' => 'Medycy',
	'tool_cl_recons' => 'Snajperzy',
	'tool_cl_engineers' => 'Inżynierowie',
	'tool_cl_err1' => 'Nieznany status auto-kicka',
	'tool_cl_err2' => 'Nieznana wartość ignorowania VIPów',
	'tool_cl_err3' => 'Zła wartość dla klasy: %class%',
	
	'tool_am' => 'Wiadomości ADMINów',
	'tool_am_desc' => 'Wysyłaj wiadomość o stanie administratorów online',
	'tool_am_opt' => 'Wysyłaj co %s% sekund',
	'tool_am_online' => 'Wiadomość, gdy na serwerze jest administrator',
	'tool_am_offline' => 'Wiadomość, gdy na serwerze nie ma administratora',
	'tool_am_help1' => 'Czas do pokazania wiadomości',
	'tool_am_help2' => 'Treść wiadomości, gdy conajmniej jeden z administratorów<br /><code>%admins%</code> jest online',
	'tool_am_help3' => 'Treść wiadomości, gdy na serwerze nie ma administratorów',
	'tool_am_err1' => 'Nieznany status wiadomości',
	'tool_am_err2' => 'Nie możesz zostawić tej wiadomości pustej!',
	'tool_am_err3' => 'Nie możesz zostawić tej wiadomości pustej!',
	
	'tool_sm' => 'Wiadomości statystyk',
	'tool_sm_desc' => 'Pokazuje wiadomość w grze o aktualnych statystykach wybrane gracza',
	'tool_sm_opt' => 'Wysyłaj co %s% sekund',
	'tool_sm_msg' => 'Wiadomość',
	'tool_sm_help1' => 'Czas do wysłania wiadomości',
	'tool_sm_help2' =>	'Wiadomość do wysłania, możesz użyć następujących zmiennych:<br />' .
						'<code>%name%</code> Nick<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Klasa<br />' .
						'<code>%rank%</code> Poziom<br />' .
						'<code>%kills%</code> Kille<br />' .
						'<code>%deaths%</code> Zgony<br />' .
						'<code>%score%</code> Punkty<br />' .
						'<code>%vip%</code> Status VIP)',
	
	'tool_bl' => 'Czarna lista',
	'tool_bl_desc' => 'Zbanuj gracza, na określony czas bądź permanentnie',
	'tool_bl_reason' => 'Powód',
	'tool_bl_until' => 'Zbanowany do',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Ban permanentny',
	'tool_bl_warn1' => 'Nie można włączyć/wyłączyc czarnej listy',
	'tool_bl_err1' => 'Ten gracz ma już bana permanentnego',
	'tool_bl_err2' => 'Zły ProfileID',
	'tool_bl_err3' => 'Nikogo jeszcze nie zbanowanego',
	'tool_bl_addedby' => 'Zbanowany przez',
	'tool_bl_added' => 'Ban został dodany',
	'tool_bl_deleted' => 'Ban is usunięty',
	
	'tool_wlist' => 'Biała lista',
	'tool_wlist_desc' => 'Dodaj graczy, którzy będą bezpieczni',
	'tool_wlist_added' => 'Gracz został dodany do Białej Listy',
	'tool_wlist_deleted' => 'Gracz został usunięty z Białej Listy',
	'tool_wlist_err1' => 'Ten graczy już został dodany do białej listy',
	'tool_wlist_err2' => 'Zły ProfileID',
	'tool_wlist_err3' => 'Nikogo jeszcze nie dodano do Białej Listy',
	'tool_wlist_addedby' => 'Dodany przez',
	
	// Installation page
	#'install_welcome' => 'Bądź pewnien, że wszystkie dane zostały wpisane poprawnie. Następnie kliknij zainstaluj.',
	#'install_error_config' => 'Wpisz swoje dane w pliku config.php zanim zaczniesz instalację',
	#'install_error' => 'Błąd instalacji, zainstaluj bazę danych manualnie przez następujący kod SQL',
	#'install_success' => 'Instalacja zakończona sukcesem, usuń plik install.php. Możesz zalogować się następującymi danymi',
	
	// ControlPanel no rights page
	'cp_norights' => 'Dostęp zabronione',
	'cp_norights_msg' => 'Nie masz praw, aby wejśc na tą stronę.',
	
	// ControlPanel menu
	'cp_menu_tools' => 'Opcje',
	'cp_menu_credits' => 'Podzękowania',
	'cp_menu_donate' => 'Dotacje',
	'cp_menu_report_bug' => 'Zgłoś błąd',
	'cp_menu_subm_sug' => 'Wyślij sugestie',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'Changelog',
	'cp_menu_logout' => 'Wyloguj',
	
	// ControlPanel login page
	'cp_login' => 'Login',
	'cp_username' => 'Nick',
	'cp_password' => 'Hasło',
	'cp_login_remember' => 'Zapamiętaj mnie',
	'cp_error_login' => 'Zły nick i/lub hasło. Spróbuj ponownie',
	'cp_error_login_sessions' => 'Błąd podczas logowania. Jeśli ta wiadomość będzie występowała dalej sprawdź swoje ustawienia PHP.',
	
	// ControlPanel logout page
	'cp_logout' => 'Wyloguj',
	'cp_logout_success' => 'Zostałeś pomyślnie wylogowany. See ya later, bro!',
	
	// ControlPanel dashboard
	'cp_dashboard' => 'Panel zarządania',
	'cp_dashboard_subtitle' => 'Wszystkie opcje w jednym miejscu',
	'cp_dashboard_explination' => 'Kliknij na <i class="icon-remove"></i> aby aktywować auto-kicka, bądź na <i class="icon-ok"></i> aby go deaktywować. Kliknij na tytuł w celu zarządzania.',
	
	// ControlPanel my account
	'cp_myaccount' => 'Moje konto',
	'cp_myaccount_subtitle' => 'Zarządzaj swoim własnym kontem',
	'cp_myaccount_expl1' => 'Nick musi miec conajmniej 5 znaków, jest to nazwa publiczna',
	'cp_myaccount_expl2' => 'Zostaw pustę polę na hasło, gdy nie chcesz go zmieniać',
	'cp_myaccount_oldpass' => 'Stare hasło',
	'cp_myaccount_newpass' => 'Nowe hasło',
	'cp_myaccount_expl3' => 'Minimum 6 znaków',
	'cp_myaccount_expl4' => 'Tylko sprawdź',
	'cp_myaccount_err1' => 'Twój nick musi mieć minimum 4 znaki',
	'cp_myaccount_err2' => 'Podałeś złe stare hasło',
	'cp_myaccount_err3' => 'Nowe hasło musi mieć minimum 6 znaków',
	'cp_myaccount_err4' => 'Nowe hasła nie zgadzają ze sobą',
	
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'Nie znaleziono żadnych przedmiotów',
	
	// ControlPanel footer
	'cp_footer_thread' => 'Temat',
	'cp_footer_createdby' => 'Bunny\'s ServerTool %version% jest licencjonowany na Apache License V2.0<br />Copyright &copy; %year% by Danny Li &lt;<i>SharpBunny</i>&gt;',
	
	/*
	 * Q&A THINGS
	 */
	'qa_questions' => 'Pytania',
	'qa_answers' => 'Odpowiedzi',
	'qa_note' => 'NOTE: Więcej Q&A zostanie dodanych w przyszłości, w tym czasie możesz zadawać pytania za pomoćą PM, RaidCall lub e-mail.',
	
	'qa' => array(
		1 => array(
			'question' => 'Jak znaleźć ProfileID gracza?',
			'anwser' => 'Przykład: <code>http://battlefield.play4free.com/en/profile/2567963101/540307041</code><br /><code>2567963101</code> = ProfileID<br /><code>540307041</code> = SoldierID'
		 ),
	),

);
?>