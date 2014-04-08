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
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$pageTitle?> | BattlefieldTools.com Servertool</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="<?=$lang['lang_charset']?>" />
		<meta name="author" content="BattlefieldTools.com" />
		
		<link rel="icon" type="image/png" href="<?=HOME_URL?>panel/img/favicon.png" />
		
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap-select.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/default.css" />
		
		<script src="<?=HOME_URL?>panel/js/jquery-1.9.1.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap.typeahead.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-select.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-growl.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-tagsinput.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/custom.js"></script>
		
		<script>
		$(function() {
			$('form').each(function() {
				$(this).find('.btn[type=submit]').data('loading-text','<i class="fa fa-block fa-refresh fa fa-block fa-spin"></i> <?=$lang['word_loading']?>...');
				$(this).submit(function() {
					$(this).find('.btn[type=submit]').button('loading');
					$(this).find('input,select,textarea').attr('readonly','');
				})
			});
		});

		(function($) {
			$.executeCmd = function(cmd, options) {
				var settings = $.extend({
					vars: { 'par1':'arg1' },
					onSuccess: function() { },
					onError: function() { }
				}, options);
			 		
				$.post('<?=HOME_URL?>panel/ajax/server.php', {cmd:cmd, vars:settings.vars}, function(data) {
					if(data.status == "OK") {
						$.bootstrapGrowl('<b><?=$lang['word_ok']?></b><br />' + data.msg, {type:'success'});
						settings.onSuccess();
					} else {
						$.bootstrapGrowl('<b><?=$lang['word_error']?></b><br />' + data.msg, {type:'danger'});
						settings.onError();
					}
				}).fail(function(){
					$.bootstrapGrowl('<b><?=$lang['word_error']?></b><br /><?=addslashes($lang['msg_cmd_failed'])?>', {type:'danger'});
				});
			};
		}(jQuery));
		
		function langInfo() {
			alert("This language: <?=$lang['lang_name']?> is written by <?=$lang['lang_translator']?>\n\nNOTES:\n<?=$lang['lang_notes']?>");
		}
		
		<?=((isset($_GET['lang'])) ? 'langInfo();' : '')?>
		</script>
	</head>
	
	<body>

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation"<?=((defined('NO_HEADER_NAV')) ? ' style="display:none"' : '')?>>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-header-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=HOME_URL?>panel"><i class="fa fa-block fa-cog fa-spin blue"></i> BFP4F SERVERTOOL</a>
			</div>
			<div class="collapse navbar-collapse navbar-header-1">
							
<?php
if(!$user->checkLogin()) {
?>
				<ul class="nav navbar-nav navbar-left">
					<li><a href="<?=HOME_URL?>panel/login.php"><i class="fa fa-block fa-key"></i> <?=$lang['cp_login']?></a></li>
				</ul>
<?php
} else {
?>
				
				<ul class="nav navbar-nav navbar-left">
					<li><a href="<?=HOME_URL?>panel"><i class="fa fa-home"></i> <?=$lang['cp_dashboard']?></a></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-hdd-o"></i> Server <b class="fa fa-caret-down"></b></a>
						<ul class="dropdown-menu">
							<li<?=(($userInfo['rights_server'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/server.php"><i class="fa fa-block fa-hdd-o"></i> <?=$lang['tool_server']?></a></li>
							<li<?=(($userInfo['rights_vips'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/vips.php"><i class="fa fa-block fa-star"></i> <?=$lang['tool_vipm']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_server'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/rotation.php"><i class="fa fa-block fa-pencil"></i> <?=$lang['tool_mrot']?></a></li>
							<li<?=(($userInfo['rights_rcon'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/rcon.php"><i class="fa fa-block fa-terminal"></i> <?=$lang['tool_rcon']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_server'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/server-settings.php"><i class="fa fa-block fa-cogs"></i> <?=$lang['tool_svset']?></a></li>
							<li><a href="<?=HOME_URL?>panel/ping.php"><i class="fa fa-block fa-signal"></i> <?=$lang['tool_ping']?></a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> <?=$lang['cp_menu_tools']?> <b class="fa fa-caret-down"></b></a>
						<ul class="dropdown-menu">
							<li<?=(($userInfo['rights_igcmds'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/igcmds"><i class="fa fa-block fa-bullhorn"></i> <?=$lang['tool_igcmds']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/wl.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_wl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/pl.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_pl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/dsl.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_dsl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/sl.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_sl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/ll.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_ll']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/cl.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_cl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/am.php"><i class="fa fa-block fa-comment"></i> <?=$lang['tool_am']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/sm.php"><i class="fa fa-block fa-comment"></i> <?=$lang['tool_sm']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_server'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tmsg"><i class="fa fa-block fa-comments"></i> <?=$lang['tool_tmsg']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_blacklist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/blacklist.php"><i class="fa fa-block fa-ban"></i> <?=$lang['tool_bl']?></a></li>
							<li<?=(($userInfo['rights_whitelist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/whitelist.php"><i class="fa fa-block fa-check-square-o"></i> <?=$lang['tool_wlist']?></a></li>
							<li class="divider"></li>
							<li><a href="<?=HOME_URL?>public"><i class="fa fa-block fa-eye"></i> <?=$lang['tool_watcher']?></a></li>
						</ul>
					</li>
					<li<?=(($userInfo['rights_superadmin'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/accounts.php"><i class="fa fa-group"></i> <?=$lang['tool_acc']?></a></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <?=$lang['word_cp']?> <b class="fa fa-caret-down"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=HOME_URL?>panel/my-account.php"><i class="fa fa-block fa-user"></i> <?=$lang['cp_myaccount']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_itemlist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/itemlist.php"><i class="fa fa-block fa-list"></i> <?=$lang['tool_iteml']?></a></li>
							<li<?=(($userInfo['rights_superadmin'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/settings.php"><i class="fa fa-block fa-wrench"></i> <?=$lang['tool_set']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_logs'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/view-log.php?log=autokick"><i class="fa fa-block fa-archive"></i> <?=$lang['tool_logs_autokick']?></a></li>
							<li<?=(($userInfo['rights_logs'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/view-log.php?log=cp_actions"><i class="fa fa-block fa-archive"></i> <?=$lang['tool_logs_cp_actions']?></a></li>
							<li<?=(($userInfo['rights_logs'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/view-log.php?log=igcmds"><i class="fa fa-block fa-archive"></i> <?=$lang['tool_logs_igcmds']?></a></li>
							<li class="divider"></li>
							<li><a href="<?=HOME_URL?>panel/checkVersion.php"><i class="fa fa-block fa-refresh"></i> <?=$lang['vcheck']?></a></li>
						</ul>
					</li>
				</ul>
				
<?php
}
?>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i> <?=$lang['word_about']?> <b class="fa fa-caret-down"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=HOME_URL?>#credits"><i class="fa fa-block fa-heart"></i> <?=$lang['cp_menu_credits']?></a></li>
							<li><a href="http://battlefieldtools.com/donate" target="_blank"><i class="fa fa-block fa-gift"></i> <?=$lang['cp_menu_donate']?></a></li>
							<li class="divider"></li>
							<li><a href="https://battlefieldtools.com/forum/forum/4" target="_blank"><i class="fa fa-block fa-bug"></i> <?=$lang['cp_menu_report_bug']?></a></li>
							<li><a href="https://battlefieldtools.com/forum/forum/4" target="_blank"><i class="fa fa-block fa-lightbulb-o"></i> <?=$lang['cp_menu_subm_sug']?></a></li>
							<li class="divider"></li>
							<li><a href="<?=HOME_URL?>panel/livechat.php"><i class="fa fa-block fa-comments"></i> Livechat support</a></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A" target="_blank"><i class="fa fa-block fa-question-circle"></i> <?=$lang['cp_menu_qa']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Changelog-&-Todo" target="_blank"><i class="fa fa-block fa-archive"></i> <?=$lang['cp_menu_changelog']?></a></li>
							<li class="divider"></li>
							<li><a href="<?=HOME_URL?>panel/checkVersion.php"><i class="fa fa-block fa-refresh"></i> <?=$lang['vcheck']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/" target="_blank"><i class="fa fa-block fa-github"></i> <?=$lang['github']?></a></li>
							<li><a href="http://battlefieldtools.com"><i class="fa fa-block fa-wrench"></i> BattlefieldTools.com</a></li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i> <?=$lang['word_language']?> <b class="fa fa-caret-down"></b></a>
						<ul class="dropdown-menu">
<?php
foreach(glob(CORE_DIR . '/lang/*.php') as $b) {
?>
							<li<?=(($settings['cp_default_lang'] == basename($b, '.php')) ? ' class="active"' : '')?>><a href="<?=HOME_URL?>panel/?lang=<?=basename($b, '.php')?>"><i class="fa fa-block fa-flag"></i> <?=strtoupper(basename($b, '.php'))?></a></li>
<?php
}
?>
						</ul>
					</li>
<?php
if($user->checkLogin()) {
?>
					
					<li class="divider-vertical"></li>
					<li><a href="<?=HOME_URL?>panel/logout.php"><i class="fa fa-power-off"></i> <?=$lang['cp_menu_logout']?></a></li>
<?php
}
?>
				</ul>
			</div>
		</nav>
		
		<div class="container">