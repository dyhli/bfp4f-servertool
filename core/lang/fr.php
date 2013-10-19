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
	'lang_name' => 'Français / French',
	'lang_name_short' => 'FR',
	'lang_charset' => 'utf8',
	'lang_translator' => 'Rakib Hernandez NoobZik',
	'lang_notes' => 'None', // Add here some additional notes... If you've got some...
	
	'github' => 'View on GitHub',
	
	// Some words
	'word_tool' => 'Bunny\'s ServerTool',
	'word.tool' => 'Tool',
	'word_cp_full' => 'Panneau de contrôle',
	'word_cp' => 'CP',
	'word_vip' => 'VIP',
	'word_welcome' => 'Bienvenue',
	'word_language' => 'Langue',
	'word_about' => 'A propos',
	'word_error' => 'Oh oh!', # Error
	'word_yes' => 'Oui',
	'word_no' => 'Non',
	'word_ok' => 'OK',
	'word_cancel' => 'Annuler', // Verb
	'word_delete' => 'Supprimer', // Verb
	'word_go' => 'Go',
	'word_devs' => 'Développeurs',
	'word_translators' => 'Tranducteurs',
	'word_suggestions' => 'Suggestions',
	'word_settings' => 'Options',
	'word_name' => 'Nom',
	'word_loading' => 'Chargement en cours',
	'word_actions' => 'Actions',
	'word_qa' => 'Q&A',
	'word_player' => 'Joueur',
	'word_players' => 'Joueurs',
	'word_playername' => 'Nom du joueur',
	'word_profileid' => 'ID du profile',
	'word_rank' => 'Niveau',
	'word_updated' => 'Mis à jour',
	'word_enable' => 'Activer', // Verb
	'word_disable' => 'Désactiver', // Verb
	'word_enabled' => 'Activé',
	'word_disabled' => 'Désactivé',
	'word_ty' => 'Merci !',
	'word_date' => 'Date',
	'word_until' => 'jusqu\'à',
	'word_forever' => 'Permanent',
	
	// Messages
	'msg_serverdown' => 'Le panel ne peut pas se connecter au serveur, il se peut que vous ayez mal tapé vos information RCON, veuillez vérifier!<br />The last heartbeat was:',
	'msg_serverup' => 'Le serveur est en ligne<br />The last heartbeat was:',
	'msg_norights' => 'Vous avez n\'avez pas assez de privilège pour accéder à cette page.',
	'msg_settings_saved' => 'Les paramètres ont été sauvegardés',
	'msg_error' => 'Il y a une(plusieurs) erreur(s) :',
	'msg_cmd_noaccess' => 'Vous n\'avez pas accès à cette commande',
	'msg_cmd_missingvars' => 'Les variables sont manquant pour cette commande',
	'msg_cmd_failed' => 'Erreur d\'exécution de cette commande',
	'msg_nologin' => 'Vous n\'êtes pas connecté ou votre session à expiré',
	'msg_sure' => 'Etes vous sûr ?',
	'msg_notadded' => 'Cette fonctionnalité n\'as été encore ajoutée',
	'msg_db1' => 'Veuillez aller à la page de la configuration pour activer/désactiver le panel',
	
	// Buttons
	'btn_back' => 'Retour',
	'btn_previous' => 'Précédent',
	'btn_next' => 'Suivant',
	'btn_save' => 'Sauvegarder',
	'btn_add' => 'Ajouter',
	'btn_close' => 'Fermer',
	
	// Tools general
	'tool_gen_ignorevip' => 'Ignorer les VIPs ?',
	'tool_gen_help1' => 'Maximum par équipe',
	
	// Tools names and descriptions
	'tool_server' => 'Management du serveur',
	'tool_server_desc' => 'Status actuel et contrôler le serveur',
	'tool_server_editrcon' => 'Editer les information RCON',
	'tool_server_toggle' => 'Toggle streaming',
	'tool_server_nextmap' => 'Carte suivante',
	'tool_server_nextmap_msg' => 'Carte est en train de changer',
	'tool_server_restartround' => 'Redémarrer la manche',
	'tool_server_restartround_msg' => 'La manche est en train de se redémarrer',
	'tool_server_empty' => 'Le serveur est vide',
	'tool_server_editrcon_msg' => 'The new RCON info has been saved', // Not used anymore...
	'tool_server_warnpl_msg' => 'Joueur à été avertie',
	'tool_server_kickpl_msg' => 'Joueur à été exclue',
	'tool_server_ranked' => 'RANKED', // NOTE: All uppercase!
	'tool_server_unranked' => 'UNRANKED', // NOTE: All uppercase!
	'tool_server_joining' => 'connection en cours...', // NOTE: All lowercase
	'tool_server_curmap' => 'Carte actuel',
	'tool_server_t1tickets' => 'Ticket de l\'équipe 1',
	'tool_server_t2tickets' => 'Ticket de l\'équipe 2',
	'tool_server_playing' => 'Temps de jeu',
	'tool_server_serverip' => 'Adresse IP du serveur',
	'tool_server_rconport' => 'Port admin RCON',
	'tool_server_rconpass' => 'Mot de pass RCON ',
	'tool_server_chat' => 'Chat',
	'tool_server_adminchat' => 'Chat Administrateur',
	'tool_server_team' => 'Equipe',
	'tool_server_kit' => 'Kit',
	'tool_server_ping' => 'Ping',
	'tool_server_kills' => 'Tué',
	'tool_server_deaths' => 'Mort',
	'tool_server_score' => 'Score',
	'tool_server_idle' => 'Incatif',
	'tool_server_plactions' => 'Actions du joueur',
	'tool_server_ltp' => 'Lien vers le profil',
	'tool_server_kick' => 'Expulser le joueur',
	'tool_server_warn' => 'Avertir le joueur',
	'tool_server_nochat' => 'Pas de message échangé dans le chat',
	
	'tool_vipm' => 'management des VIPs',
	'tool_vipm_desc' => 'Ajouter ou supprimer des VIPs',
	'tool_vipm_vipadded' => 'VIP ajouté',
	'tool_vipm_vipdeleted' => 'VIP supprimé',
	'tool_vipm_notfound' => 'Pas de VIP trouvé',
	
	'tool_iteml' => 'Liste des objets',
	'tool_iteml_desc' => 'Liste de tout les objet de BFP4F',
	
	'tool_set' => 'Paramètres',
	'tool_set_desc' => 'Paramètre pour le Controle Panel et le panel',
	'tool_set_deflang' => 'Langage par défaut',
	'tool_set_df' => 'Format de la date',
	'tool_set_fdf' => 'Format complet de la date',
	'tool_set_notifier' => 'Notification',
	'tool_set_notify_email' => 'Notification par e-mail',
	'tool_set_iga_ad' => 'Petit avertissement',
	'tool_set_iga_ad_opt' => 'Afficher chaque %s% secondes',
	'tool_set_iga_ad_help' => "Afficher le message suivant: '%msg%'",
	'tool_set_help1' => 'Plus d\'information à propos des format de date, see <a href="http://nl3.php.net/manual/en/function.date.php" target="_blank">PHP date()</a>',
	'tool_set_err1' => 'La langue %lang% n\'existe pas!',
	'tool_set_err2' => 'Valeur invalid pour l\'anonce',
	'tool_set_err3' => 'Valeur de notification inconnue pour le panel',
	'tool_set_err4' => 'Merci de renter une une adresse e-mail valide pour la notification des erreur de connection au serveur',
	
	'tool_acc' => 'Comptes',
	'tool_acc_desc' => 'Gérer les comptes',
	'tool_acc_add' => 'Ajouter un utilisateur',
	'tool_acc_edit' => 'Editer user',
	'tool_acc_expl1' => 'Veuillez laisser la case de mot de passe vide si vous ne voulez pas le modifier',
	'tool_acc_rights' => 'Choisissez les privilège que l\'utilisateur aura',
	'tool_acc_fr1' => '<abbr title="In-Game Admin">IGA</abbr>',
	'tool_acc_fr2' => 'Admin Supême',
	'tool_acc_fr3' => 'RCON access',
	'tool_acc_fr4' => 'Blacklist',
	'tool_acc_fr5' => 'VIP',
	'tool_acc_fr6' => 'Manager le Serveur',
	'tool_acc_fr7' => 'Listes des objet',
	'tool_acc_fr8' => 'Limiteur (panel)',
	'tool_acc_fr9' => 'Historique',
	'tool_acc_fr10' => 'Liste Blanche',
	'tool_acc_help1' => 'Le nom devra avoir au minimum 5 caractères, c\'est un nom publique',
	'tool_acc_help2' => 'Le Pseudo doit avoir au minimum 5 caractères uniques',
	'tool_acc_help3' => 'Le mot de passe doit contenir 6 caractères au minimum',
	'tool_acc_help4' => 'Confirmez le mot de passe',
	'tool_acc_err1' => 'Votre nom doit être au minimum 5 caractères',
	'tool_acc_err2' => 'Votre pseudo doit être au minimum 5 caractères',
	'tool_acc_err3' => 'Votre mot de passe doit être au minimum 6 caractères',
	'tool_acc_err4' => 'Valeur inconnue pour les privilèges',
	'tool_acc_err5' => 'Invalid ProfileID',
	'tool_acc_err6' => 'No user found',
	'tool_acc_err7' => 'You cannot delete your own superadmin rights',
	
	'tool_logs' => 'Logs',
	'tool_logs_desc' => 'Regardez les log, il y a peut-être des actions irrégulières...',
	'tool_logs1' => 'Historiques des expulsions automatiques',
	'tool_logs1_desc' => 'Tout les expulsions éxecuté',
	'tool_logs2' => 'Historiques des actions du Contôle Panel',
	'tool_logs2_desc' => 'Toutes les actions éxecutés du CP',
	'tool_word_desc' => 'Description',
	
	'tool_wl' => 'Limitation des armes',
	'tool_wl_desc' => 'Prendre une arme non autorisée ayant pour conséquence d\'une expulsion automatique du serveur',
	'tool_wl_disallowed' => 'Objet non autorisée',
	'tool_wl_err1' => 'Valeur inconnue pour l\'état du panel',
	'tool_wl_err2' => 'Valeur inconnue pour ignvip pour le panel',
	'tool_wl_err3' => 'BFID invalide: %id%',
	
	'tool_pl' => 'Limitation des achat pré-maturé',
	'tool_pl_desc' => 'Interdit l\'utilisation des armes acheté pré-maturément pour certaines armes ou toutes les armes',
	'tool_pl_check' => 'Objet à vérifier',
	'tool_pl_help1' => 'Veuillez laisser la case blanche pour interdire <b>TOUTES</b> les armes',
	
	'tool_al' => 'Limitation des attachement',
	'tool_al_desc' => 'Equiper un attachement non autorisée ayant pour conséquence d\'une expulsion automatique du serveur',
	
	'tool_sl' => 'Limitation des Fusil à pompes',
	'tool_sl_desc' => 'Appliquer le nombre maximum des fusil à pompe par équipe',
	'tool_sl_max' => 'Maximum',
	'tool_sl_help1' => 'Nombre Fusil à pompe maximum par équipe',
	'tool_sl_err1' => 'Valeur inconnue pour l\'état du panel',
	'tool_sl_err2' => 'Valeur inconnue pour ignvip pour le panel',
	'tool_sl_err3' => 'Valeur invalide pour le nombre maximum des fusil à pompe',
	
	'tool_ll' => 'Limitation de niveau',
	'tool_ll_desc' => 'Appliquer un niveau minimum et maximum du niveau',
	'tool_ll_min' => 'Niveau minimum',
	'tool_ll_max' => 'Niveau maximum',
	'tool_ll_err1' => 'Valeur inconnue pour l\'état du panel',
	'tool_ll_err2' => 'Valeur inconnue pour ignvip pour le panel',
	'tool_ll_err3' => 'Le niveau minimum devra être entre : %lvls%',
	'tool_ll_err4' => 'Le niveau maximum devra être entre : %lvls%',
	
	'tool_cl' => 'Limitation de classe',
	'tool_cl_desc' => 'Limitation de classe joué par équipe',
	'tool_cl_assaults' => 'Assauts',
	'tool_cl_medics' => 'Medcins',
	'tool_cl_recons' => 'Snipers',
	'tool_cl_engineers' => 'Ingenieur',
	'tool_cl_err1' => 'Valeur inconnue pour l\'état du panel',
	'tool_cl_err2' => 'Valeur inconnue pour ignvip pour le panel',
	'tool_cl_err3' => 'Valeur invalide pour %class%',
	
	'tool_am' => 'Message Administrateur',
	'tool_am_desc' => 'Affiche un message en jeu le nom des administrateur connecté',
	'tool_am_opt' => 'Afficher tous les %s% secondes',
	'tool_am_online' => 'Message en-ligne',
	'tool_am_offline' => 'Message Hors-ligne',
	'tool_am_help1' => 'Temps à afficher le message',
	'tool_am_help2' => 'Message a afficher lorsque au moins un administrateur est en jeu<br /><code>%admins%</code> Nom des administrateurs en-ligne',
	'tool_am_help3' => 'Message a afficher lorsqu\'il y a aucun administrateur de connecté',
	'tool_am_err1' => 'Valeur inconnue pour le panel',
	'tool_am_err2' => 'Vous ne pouvez laisser le message en-ligne vide',
	'tool_am_err3' => 'Vous ne pouvez pas laisser le massage hors-ligne vide',
	
	'tool_sm' => 'Message de statistiques',
	'tool_sm_desc' => 'Affiche un message en jeu avec les statitsques actuelle des joueurs',
	'tool_sm_opt' => 'Afficher tous les %s% secondes',
	'tool_sm_msg' => 'Message',
	'tool_sm_help1' => 'Temps pour afficher les messages',
	'tool_sm_help2' =>	'Message à afficher, vous pouvez utiliser les variables suivantes :<br />' .
						'<code>%name%</code> Nom<br />' .
						'<code>%ping%</code> Ping<br />' .
						'<code>%class%</code> Classe<br />' .
						'<code>%rank%</code> Niveau<br />' .
						'<code>%kills%</code> Tué<br />' .
						'<code>%deaths%</code> Mort<br />' .
						'<code>%score%</code> Score<br />' .
						'<code>%vip%</code> Statut VIP (Oui or Non)',
	
	'tool_bl' => 'Blacklist',
	'tool_bl_desc' => 'Banni les joueur sur un temps détérminé ou permanent',
	'tool_bl_reason' => 'Raison',
	'tool_bl_until' => 'Banni jusqu\'à',
	'tool_bl_help1' => '0000-00-00 00:00:00 = Ban permanent',
	'tool_bl_warn1' => 'Il n\'est pas possible d\'activer/désactiver la Blacklist',
	'tool_bl_err1' => 'Ce joueur à déjà un ban permanent',
	'tool_bl_err2' => 'Imposible de retrouver les données du soldat: Profile ID invalide',
	'tool_bl_err3' => 'Pas de ban',
	'tool_bl_addedby' => 'Banni par',
	'tool_bl_added' => 'Le ban à été ajouté',
	'tool_bl_deleted' => 'Le ban à été retiré',
	
	'tool_wlist' => 'Liste Blance',
	'tool_wlist_desc' => 'Liste des joueurs qui ne vont pas être expulsée par le panel',
	'tool_wlist_added' => 'Ce joueur à été ajouté à la liste blanche',
	'tool_wlist_deleted' => 'Ce joueur à été retiré de la liste blanche',
	'tool_wlist_err1' => 'Ce joueur existe déjà dans la liste blanche',
	'tool_wlist_err2' => 'Imposible de retrouver les données du soldat: Profile ID invalide',
	'tool_wlist_err3' => 'Pas de joueur dans la liste blanche',
	'tool_wlist_addedby' => 'Ajouté par',
	
	// Installation page
	#'install_welcome' => 'Welcome to the installation wizard, make sure all your details are filled in correctly. Then click on install.',
	#'install_error_config' => 'Please fill in your details in the file config.php before trying to install the tool',
	#'install_error' => 'Installation failed, please install the database manually by using the following SQL',
	#'install_success' => 'Installation was succesful, please delete the file install.php. You can login with the following details',
	
	// ControlPanel no rights page
	'cp_norights' => 'Accès refusé',
	'cp_norights_msg' => 'Vous n\'avez pas les privilèges d\'accéder à cette page.',
	
	// ControlPanel menu
	'cp_menu_tools' => 'Panel',
	'cp_menu_credits' => 'Credits',
	'cp_menu_donate' => 'Faire un Don',
	'cp_menu_report_bug' => 'Reporter un boggue',
	'cp_menu_subm_sug' => 'Soummetre une suggestion',
	'cp_menu_qa' => 'Q&A',
	'cp_menu_changelog' => 'ChangeLog',
	'cp_menu_logout' => 'Déconnection',
	
	// ControlPanel login page
	'cp_login' => 'Connection',
	'cp_username' => 'Nom d\'utilisateur',
	'cp_password' => 'Mot de passe',
	'cp_login_remember' => 'Rester connecté',
	'cp_error_login' => 'Nom d\'utilisateur / Mot de passe invalide',
	'cp_error_login_sessions' => 'Impossible d\'initier la connection, veuillez réessayez. Si ce message réapparaît, veuillez vérifier vos paramètre PHP.',
	
	// ControlPanel logout page
	'cp_logout' => 'Déconnection',
	'cp_logout_success' => 'Vous avez bien été déconnecté',
	
	// ControlPanel dashboard
	'cp_dashboard' => 'Dashboard',
	'cp_dashboard_subtitle' => 'Résumé et navigation rapide',
	'cp_dashboard_explination' => 'Cliquez sur le <i class="icon-remove"></i> pour activer un panel, cliquez sur <i class="icon-ok"></i> pour déactiver un panel. Cliquez sur le titre pour gérer le serveur.',
	
	// ControlPanel my account
	'cp_myaccount' => 'Mon compte',
	'cp_myaccount_subtitle' => 'Gérer votre propre compte',
	'cp_myaccount_expl1' => 'Ceci est le nom qui sera affiché en publique',
	'cp_myaccount_expl2' => 'Veuillez laisser la case vide si vous ne souhaitez pas changer de mot de passe',
	'cp_myaccount_oldpass' => 'Ancien mot de passe',
	'cp_myaccount_newpass' => 'Nouveau mot de passe',
	'cp_myaccount_expl3' => 'Minimum 6 caractères',
	'cp_myaccount_expl4' => 'Just a check',
	'cp_myaccount_err1' => 'Votre nom devra être au minimum 4 caractère',
	'cp_myaccount_err2' => 'Votre ancien mot de passe de correspondent pas',
	'cp_myaccount_err3' => 'Votre nouveau mot de passe doit avoir au minimum 6 caractères',
	'cp_myaccount_err4' => 'Le nouveau mot de passe ne correspondent pas',
	
	// ControlPanel itemlist page
	'cp_itemlist_err1' => 'Pas d\'objet trouvé',
	
	// ControlPanel footer
	'cp_footer_thread' => 'Tool thread',
	'cp_footer_createdby' => 'Bunny\'s ServerTool %version% is licensed under Apache License V2.0<br />Copyright &copy; %year% by Danny Li &lt;<i>SharpBunny</i>&gt;',
	
	/*
	 * Q&A THINGS
	 */
	'qa_questions' => 'Questions',
	'qa_answers' => 'Réponses',
	'qa_note' => 'NOTE: More Q&A will be added in the future, meanwhile you can ask me via PM, RaidCall or e-mail.',
	
	'qa' => array(
		1 => array(
			'question' => 'Comment trouver le profile ID du joueur ?',
			'anwser' => 'Exemple: <code>http://battlefield.play4free.com/en/profile/2567963101/540307041</code><br /><code>2567963101</code> = ProfileID<br /><code>540307041</code> = SoldierID'
	 	),
	),

);
?>