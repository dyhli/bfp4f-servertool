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
	'lang_name' => 'Čeština / Czech',
	'lang_name_short' => 'CS',
	'lang_charset' => 'utf8',
	'lang_translator' => 'Johncze',
	'lang_notes' => 'czechbattlefield.info', // Add here some additional notes... If you've got some...
	
	'github' => 'Zobrazit v GitHub',
	
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Nástroj',
	'word_cp_full' => 'Kontrolní panel',
	'word_cp' => 'CP',
	'word_vip' => 'VIP',
	'word_welcome' => 'Vítejte',
	'word_language' => 'Jazyk',
	'word_about' => 'Informace',
	'word_error' => 'Hups!', # Error
	'word_yes' => 'Ano',
	'word_no' => 'Ne',
	'word_ok' => 'OK',
	'word_cancel' => 'Zrušit', // Verb
	'word_delete' => 'Smazat', // Verb
	'word_go' => 'Jdi',
	'word_devs' => 'Vývojáři',
	'word_translators' => 'Překladatelé',
	'word_suggestions' => 'Návrhy',
	'word_settings' => 'Nastavení',
	'word_name' => 'Jméno',
	'word_loading' => 'Nahrávání',
	'word_actions' => 'Akce',
	'word_qa' => 'Q&A',
	'word_player' => 'Hráč',
	'word_players' => 'Hráči',
	'word_playername' => 'Jméno hráče',
	'word_profileid' => 'ProfileID',
	'word_rank' => 'úroveň',
	'word_updated' => 'Aktualizováno',
	'word_enable' => 'Zapnout', // Verb
	'word_disable' => 'Vypnout', // Verb
	'word_enabled' => 'Zapnuto',
	'word_disabled' => 'Vypnuto',
	'word_ty' => 'Díky!',
	'word_date' => 'Datum',
	'word_until' => 'Do',
	'word_forever' => 'Navždy',
	
	// Messages
	'msg_serverdown' => 'Nástroj se nemohl připojit k serveru, nejspíše je offline nebo jsou zadané špatné přihlašovací (RCON) údaje, překontrolujte si je.<br />Poslední záznam:',
	'msg_serverup' => 'Server je online a běží.<br />Poslední záznam:',
	'msg_norights' => 'Pro přístup do této sekce nemáte oprávnění.',
	'msg_settings_saved' => 'Nastavení bylo uloženo',
	'msg_error' => 'Vyskytly se následující problémy:',
	'msg_cmd_noaccess' => 'K tomuto příkazu nemáte přístup',
	'msg_cmd_missingvars' => 'U příkazu chybí některé parametry',
	'msg_cmd_failed' => 'Vykonávání příkazu selhalo',
	'msg_nologin' => 'Nejste přihlášen nebo vaše session expirovala',
	'msg_sure' => 'Jste si jistí?',
	'msg_notadded' => 'Tato funkce není prozatím spuštěna',
	'msg_db1' => 'Jděte prosím do konfigurace pro zapnutí/vypnutí tohoto nástroje',
	
	// Buttons
	'btn_back' => 'Zpátky',
	'btn_previous' => 'Předchozí',
	'btn_next' => 'Další',
	'btn_save' => 'Uložit',
	'btn_add' => 'Přidat',
	'btn_close' => 'Zavřít',
	
	// Tools general
	'tool_gen_ignorevip' => 'Ignorovat VIP?',
	'tool_gen_help1' => 'Maximum v týmu',
	
	// Tools names and descriptions
	'tool_server' => 'Správa serverů',
	'tool_server_desc' => 'Aktuální stav a nastavení serveru',
	'tool_server_editrcon' => 'Upravit RCON informace',
	'tool_server_toggle' => 'Přepnout streaming',
	'tool_server_nextmap' => 'Další mapa',
	'tool_server_nextmap_msg' => 'Mapa byla přepnuta',
	'tool_server_restartround' => 'Restrartovat kolo',
	'tool_server_restartround_msg' => 'Kolo bylo restartováno',
	'tool_server_empty' => 'Server je prázdný',
	'tool_server_editrcon_msg' => 'Nové RCON údaje byly uloženy', // Not used anymore...
	'tool_server_warnpl_msg' => 'Hráč byl varován',
	'tool_server_kickpl_msg' => 'Hráč byl vykopnut',
	'tool_server_ranked' => 'RANKED', // NOTE: All uppercase!
	'tool_server_unranked' => 'UNRANKED', // NOTE: All uppercase!
	'tool_server_joining' => 'připojuje se', // NOTE: All lowercase
	'tool_server_curmap' => 'Aktuální mapa',
	'tool_server_t1tickets' => 'Tým 1 tikety',
	'tool_server_t2tickets' => 'Tým 2 tikety',
	'tool_server_playing' => 'Délka kola',
	'tool_server_serverip' => 'Server IP',
	'tool_server_rconport' => 'RCON admin port',
	'tool_server_rconpass' => 'RCON heslo',
	'tool_server_chat' => 'Chat',
	'tool_server_adminchat' => 'Adminchat',
	'tool_server_team' => 'Tým',
	'tool_server_kit' => 'Třída',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Zabití',
	'tool_server_deaths' => 'Smrtí',
	'tool_server_score' => 'Skóre',
	'tool_server_idle' => 'Neaktivní',
	'tool_server_plactions' => 'Akce hráče',
	'tool_server_ltp' => 'Odkaz na profil',
	'tool_server_kick' => 'Vykopnout hráče',
	'tool_server_warn' => 'Varovat hráče',
	'tool_server_nochat' => 'Žádné zprávy v chatu',
	
	'tool_vipm' => 'Správa VIP',
	'tool_vipm_desc' => 'Přidat nebo odebrat VIP',
	'tool_vipm_vipadded' => 'VIP přidáno',
	'tool_vipm_vipdeleted' => 'VIP odebráno',
	'tool_vipm_notfound' => 'Žádné VIP nenalezeno',
	
	'tool_iteml' => 'Seznam předmětů',
	'tool_iteml_desc' => 'Všechny předměty v BFP4F',
	
	'tool_set' => 'Nastavení',
	'tool_set_desc' => 'Nastavení pro kontrolní panel a nástroj',
	'tool_set_deflang' => 'Původní jazyk',
	'tool_set_df' => 'Formát data',
	'tool_set_fdf' => 'Formát celého data',
	'tool_set_notifier' => 'Upozornění',
	'tool_set_notify_email' => 'emailová adresa pro upozornění',
	'tool_set_iga_ad' => 'Malá propagace',
	'tool_set_iga_ad_opt' => 'Zobrazit každých %s% sekund',
	'tool_set_iga_ad_help' => "Zobrazit následující zprávu: '%msg%'",
	'tool_set_help1' => 'Více informací ohledně formátu data a času naleznete na <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'Jazyk %lang% neexistuje!',
	'tool_set_err2' => 'Neplatná hodnota pro propagaci',
	'tool_set_err3' => 'Neznámá hodnota v upozornění',
	'tool_set_err4' => 'Vložte prosím platnou emailovou adresu pro upozornění při potížích nástroje s připojením k serveru',
	
	'tool_acc' => 'Účty',
	'tool_acc_desc' => 'Správa účtů',
	'tool_acc_add' => 'Přidat uživatele',
	'tool_acc_edit' => 'Upravit uživatele',
	'tool_acc_expl1' => 'Nechte pole pro heslo prázdné, pokud ho nechcete měnit',
	'tool_acc_rights' => 'Přidělte práva uživateli',
	'tool_acc_fr1' => '<abbr title="In-Game Admin (Admin ve hře)">IGA</abbr>',
	'tool_acc_fr2' => 'Superadmin',
	'tool_acc_fr3' => 'přístup k RCON',
	'tool_acc_fr4' => 'Blacklist',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Správa serveru',
	'tool_acc_fr7' => 'Seznam předmětů',
	'tool_acc_fr8' => 'Limitery (nástroje)',
	'tool_acc_fr9' => 'Záznamy',
	'tool_acc_fr10' => 'Whitelist',
	'tool_acc_help1' => 'Jméno musí mít alespoň 5 znaků, jedná se o veřejné jméno',
	'tool_acc_help2' => 'Jméno uživatele musí mít alespoň 5 znaků a být unikátní',
	'tool_acc_help3' => 'Heslo musí být alespoň 6 znaků dlouhé',
	'tool_acc_help4' => 'Potvrďte heslo',
	'tool_acc_err1' => 'Jméno musí mít alespoň 5 znaků',
	'tool_acc_err2' => 'Jméno uživatele musí mít alespoň 5 znaků',
	'tool_acc_err3' => 'Heslo musí být alespoň 6 znaků dlouhé',
	'tool_acc_err4' => 'Neznámé nastavení hodnoty práva',
	'tool_acc_err5' => 'Invalid ProfileID',
	'tool_acc_err6' => 'No user found',
	'tool_acc_err7' => 'You cannot delete your own superadmin rights',
	
	'tool_logs' => 'Záznamy',
	'tool_logs_desc' => 'Zkontrolujt záznamy, není v nich něco neobvyklého?',
	'tool_logs1' => 'Záznamy z autokickeru',
	'tool_logs1_desc' => 'Všechny vykonané kopnutí',
	'tool_logs2' => 'Záznamy všech aktivit v kontrolním panelu',
	'tool_logs2_desc' => 'Všechny vykonané příkazy skrze panel',
	'tool_word_desc' => 'Popis',
	
	'tool_wl' => 'Limiter na zbraně',
	'tool_wl_desc' => 'Vyberte všechny předměty, za které bude hráč vykopnut',
	'tool_wl_disallowed' => 'Zakázané předměty',
	'tool_wl_err1' => 'Neznámá hodnota pro nástroj',
	'tool_wl_err2' => 'Neznámá hodnota ignvip',
	'tool_wl_err3' => 'Neplatné BFID: %id%',
	
	'tool_pl' => 'Prebuy limiter',
	'tool_pl_desc' => 'Zakázat pre-buy všech zbraní nebo vybraných',
	'tool_pl_check' => 'Kontrolované předměty',
	'tool_pl_help1' => 'Nechte prázdné pro aplikování na <b>všechny</b> zbraně',
	
	'tool_al' => 'Limiter na vylepšení',
	'tool_al_desc' => 'Vyberte zakázané vylepšení, za které budou hráči kopáni',
	
	'tool_sl' => 'Limiter na brokovnice',
	'tool_sl_desc' => 'Nastavte maximální počet brokovnic v týmu',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Maximum brokovnic v týmu',
	'tool_sl_err1' => 'Neznámá hodnota pro nástroj',
	'tool_sl_err2' => 'Neznámá hodnota ignvip',
	'tool_sl_err3' => 'Neplatné číslo pro maximum hráčů s brokovnicemi',
	
	'tool_ll' => 'Level limiter',
	'tool_ll_desc' => 'Nastavte minimální a maximální povolený level',
	'tool_ll_min' => 'Minimální level',
	'tool_ll_max' => 'Maximální level',
	'tool_ll_err1' => 'Neznámá hodnota pro nástroj',
	'tool_ll_err2' => 'Neznámá hodnota ignvip',
	'tool_ll_err3' => 'Minimální level musí být v rozmezí: %lvls%',
	'tool_ll_err4' => 'Maximální level musí být v rozmezí: %lvls%',
	
	'tool_cl' => 'Limiter na třídy',
	'tool_cl_desc' => 'Povolte určitý počet tříd v týmu',
	'tool_cl_assaults' => 'Assault',
	'tool_cl_medics' => 'Medic',
	'tool_cl_recons' => 'Recon',
	'tool_cl_engineers' => 'Engineer',
	'tool_cl_err1' => 'Neznámá hodnota pro nástroj',
	'tool_cl_err2' => 'Neznámá hodnota ignvip',
	'tool_cl_err3' => 'Neznámá hodnota pro %class%',
	
	'tool_am' => 'Adminské zprávy',
	'tool_am_desc' => 'Zobrazit zprávy ve hře, pokud jsou ve hře admini',
	'tool_am_opt' => 'Zobrazit každých %s% sekund',
	'tool_am_online' => 'Online zpráva',
	'tool_am_offline' => 'Offline zpráva',
	'tool_am_help1' => 'Doba zobrazení zprávy',
	'tool_am_help2' => 'Zobrazit zprávu, pokud je alespoň jeden admin ve hře<br /><code>%admins%</code> Vypíše jména adminů',
	'tool_am_help3' => 'Zobrazit zprávu, pokud není žádný admin online',
	'tool_am_err1' => 'Neznámá hodnota pro nástroj',
	'tool_am_err2' => 'Nemůžete nechat pole pro online zprávu prázdnou',
	'tool_am_err3' => 'Nemůžete nechat pole pro offline zprávu prázdnou',
	
	'tool_sm' => 'Zobrazování statistik',
	'tool_sm_desc' => 'Zobrazení zpráv se statistikami hráče',
	'tool_sm_opt' => 'Zobrazit každých %s% sekund',
	'tool_sm_msg' => 'Zpráva',
	'tool_sm_help1' => 'Doba zobrazení zprávy',
	'tool_sm_help2' =>	'Zobrazované zprávy, můžete využít těchto proměnných:<br />' .
						'<code>%name%</code> Jméno<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Třída<br />' .
						'<code>%rank%</code> Level<br />' .
						'<code>%kills%</code> Zabití<br />' .
						'<code>%deaths%</code> Smrtí<br />' .
						'<code>%score%</code> Skóre<br />' .
						'<code>%vip%</code> VIP status (Ano nebo ne)',
	
	'tool_bl' => 'Blacklist',
	'tool_bl_desc' => 'Zabanovat hráče na nějakou dobu či permanentně',
	'tool_bl_reason' => 'Důvod',
	'tool_bl_until' => 'Zabanován do',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Zabanován natrvalo',
	'tool_bl_warn1' => 'Blacklist není možné vypnout či zapnout',
	'tool_bl_err1' => 'Tento hráč je permanetně zabanován',
	'tool_bl_err2' => 'Nemohu najít hráče: Neplatné ProfileID',
	'tool_bl_err3' => 'Zatím žádné bany',
	'tool_bl_addedby' => 'Zabanoval',
	'tool_bl_added' => 'Ban byl přidán',
	'tool_bl_deleted' => 'Ban byl smazán',
	
	'tool_wlist' => 'Whitelist',
	'tool_wlist_desc' => 'Vložte hráče, které budou limitery ignorovat',
	'tool_wlist_added' => 'Hráč byl přidán do whitelistu',
	'tool_wlist_deleted' => 'Hráč byl odebrán z whitelistu',
	'tool_wlist_err1' => 'Tento hráč již je ve whitelistu',
	'tool_wlist_err2' => 'Nemohu  najít hráče: Neplatné ProfileID',
	'tool_wlist_err3' => 'Žádný hráč ve whitelistu',
	'tool_wlist_addedby' => 'Přidal',
	
	// Installation page
	#'install_welcome' => 'Vítejte v průvodci instalací, ujistěte se, že máte všechny údaje správně vyplněné. Následně pokračujte kliknutím na instalovat.',
	#'install_error_config' => 'Dříve než začnete s instalací vyplňte prosím údaje v config.php',
	#'install_error' => 'Instalace selhalaa, nainstalujte prosím databázi manuálně s následujícím SQL',
	#'install_success' => 'Instalace byla úspěšná, nyní prosím smažte soubor install.php. Přihlásit se můžete s následujícími údaji',
	
	// ControlPanel no rights page
	'cp_norights' => 'Přístup odepřen',
	'cp_norights_msg' => 'Pro vstup do této sekce nemáte dostatečná práva.',
	
	// ControlPanel menu
	'cp_menu_tools' => 'Nástroje',
	'cp_menu_credits' => 'Tvůrci',
	'cp_menu_donate' => 'Přispět',
	'cp_menu_report_bug' => 'Nahlásit chybu',
	'cp_menu_subm_sug' => 'Návrh na vylepšení',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'Changelog',
	'cp_menu_logout' => 'Odhlásit',
	
	// ControlPanel login page
	'cp_login' => 'Přihlásit se',
	'cp_username' => 'Přihlašovací jméno',
	'cp_password' => 'Heslo',
	'cp_login_remember' => 'Pamatovat si mě',
	'cp_error_login' => 'Neplatné jméno nebo heslo, zkuste to prosím znovu',
	'cp_error_login_sessions' => 'Nelze nastavit přihlašovací session, zkuste to prosím znovu. Pokud tento problém přetrvává, zkotrolujte nastavení PHP.',
	
	// ControlPanel logout page
	'cp_logout' => 'Odhlásit se',
	'cp_logout_success' => 'Byli jste úspěšně odhlášeni. Na viděnou!',
	
	// ControlPanel dashboard
	'cp_dashboard' => 'Nástěnka',
	'cp_dashboard_subtitle' => 'Souhrn a rychlá navigace',
	'cp_dashboard_explination' => 'Klikněte na <i class="icon-remove"></i> pro aktivování nástroje nebo na <i class="icon-ok"></i> pro jeho deaktivaci. Kliknutím na název spustíte správu nástroje.',
	
	// ControlPanel my account
	'cp_myaccount' => 'Můj účet',
	'cp_myaccount_subtitle' => 'Správa vašeho účtu',
	'cp_myaccount_expl1' => 'Veřejně zobrazované jméno',
	'cp_myaccount_expl2' => 'Nechte pole pro heslo prázdné, pokud ho nechcete měnit',
	'cp_myaccount_oldpass' => 'Staré heslo',
	'cp_myaccount_newpass' => 'Nové heslo',
	'cp_myaccount_expl3' => 'Alespoň 6 znaků',
	'cp_myaccount_expl4' => 'Pouze pro kontrolu',
	'cp_myaccount_err1' => 'Jméno musí mít alespoň 4 znaky',
	'cp_myaccount_err2' => 'Staré heslo nesouhlasí',
	'cp_myaccount_err3' => 'Nové heslo musí mít alespoň 6 znaků',
	'cp_myaccount_err4' => 'Nové heslo a ověření hesla musí být shodné',
	
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'Nebyly nalezený žádné předměty',
	
	// ControlPanel footer
	'cp_footer_thread' => 'Vlákno k nástroji',
	'cp_footer_createdby' => 'Bunny\'s ServerTool %version% je licencována pod Apache License V2.0<br />Copyright &copy; %year% by Danny Li &lt;<i>SharpBunny</i>&gt;',
	
	/*
	 * Q&A THINGS
	 */
	'qa_questions' => 'Otázky',
	'qa_answers' => 'Odpovědi',
	'qa_note' => 'POZNÁMKA: Více otázek a odpovědí bude přidáno v budoucnu, prozatím se můžete ptát skrze soukromé zprávy, RaidCall nebo e-mail.',
	
	'qa' => array(
		1 => array(
			'question' => 'Jak získám profileID hráče?',
			'anwser' => 'Příklad: <code>http://battlefield.play4free.com/en/profile/2567963101/540307041</code><br /><code>2567963101</code> = ProfileID<br /><code>540307041</code> = SoldierID'
	 	),
	),

);
?>