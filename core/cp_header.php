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
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$pageTitle?> | <?=$lang['word_tool']?></title>
		
		<meta charset="<?=$lang['lang_charset']?>" />
		<meta name="author" content="Danny Li <SharpBunny>" />
		
		<link rel="shortcut icon" href="<?=HOME_URL?>panel/img/favicon.ico" type="image/x-icon" />
		
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap-select.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/default.css" />
		
		<script src="<?=HOME_URL?>panel/js/jquery-1.9.1.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-select.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-growl.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-tagsinput.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap-datepicker.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/custom.js"></script>
		
		<script>
		$(function() {
			$('form').each(function() {
				$(this).find('.btn[type=submit]').data('loading-text','<i class="icon-refresh icon-spin"></i> <?=$lang['word_loading']?>...');
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
			 		
				$.post('<?=HOME_URL?>panel/ajax/server', {cmd:cmd, vars:settings.vars}, function(data) {
					if(data.status == "OK") {
						$.bootstrapGrowl('<b><?=$lang['word_ok']?></b><br />' + data.msg, {type:'success'});
						settings.onSuccess();
					} else {
						$.bootstrapGrowl('<b><?=$lang['word_error']?></b><br />' + data.msg, {type:'error'});
						settings.onError();
					}
				}).fail(function(){
					$.bootstrapGrowl('<b><?=$lang['word_error']?></b><br /><?=addslashes($lang['msg_cmd_failed'])?>', {type:'error'});
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
		
		<header class="navbar navbar-inverse navbar-static-top">
			<div class="navbar-inner">
				<a class="brand" href="<?=HOME_URL?>panel"><i class="icon-cog icon-spin"></i> BFP4F Server CP</a>
				
<?php
if(!$user->checkLogin()) {
?>
				<ul class="nav">
					<li class="divider-vertical"></li>
					<li><a href="<?=HOME_URL?>panel/login"><i class="icon-key"></i> <?=$lang['cp_login']?></a></li>
				</ul>
<?php
} else {
?>
				
				<ul class="nav">
					<li class="divider-vertical"></li>
					<li><a href="<?=HOME_URL?>panel"><i class="icon-home"></i> <?=$lang['cp_dashboard']?></a></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-hdd"></i> Server <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li<?=(($userInfo['rights_server'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/server"><i class="icon-hdd"></i> <?=$lang['tool_server']?></a></li>
							<li<?=(($userInfo['rights_vips'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/vips"><i class="icon-star"></i> <?=$lang['tool_vipm']?></a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench"></i> <?=$lang['cp_menu_tools']?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/wl"><i class="icon-ban-circle"></i> <?=$lang['tool_wl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/pl"><i class="icon-ban-circle"></i> <?=$lang['tool_pl']?></a></li>
							<li class="disabled"><a href="javascript:;"><i class="icon-ban-circle"></i> <?=$lang['tool_al']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/sl"><i class="icon-ban-circle"></i> <?=$lang['tool_sl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/ll"><i class="icon-ban-circle"></i> <?=$lang['tool_ll']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/cl"><i class="icon-ban-circle"></i> <?=$lang['tool_cl']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/am"><i class="icon-comment"></i> <?=$lang['tool_am']?></a></li>
							<li<?=(($userInfo['rights_limiters'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/tool/sm"><i class="icon-comment"></i> <?=$lang['tool_sm']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_blacklist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/blacklist"><i class="icon-ban-circle"></i> <?=$lang['tool_bl']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_whitelist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/whitelist"><i class="icon-check"></i> <?=$lang['tool_wlist']?></a></li>
						</ul>
					</li>
					<li<?=(($userInfo['rights_superadmin'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/accounts"><i class="icon-group"></i> <?=$lang['tool_acc']?></a></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> <?=$lang['word_cp']?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=HOME_URL?>panel/my-account"><i class="icon-user"></i> <?=$lang['cp_myaccount']?></a></li>
							<li class="divider"></li>
							<li<?=(($userInfo['rights_itemlist'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/itemlist"><i class="icon-list"></i> <?=$lang['tool_iteml']?></a></li>
							<li<?=(($userInfo['rights_superadmin'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/settings"><i class="icon-wrench"></i> <?=$lang['tool_set']?></a></li>
							<li class="divider"></li>
							<li class="dropdown-submenu<?=(($userInfo['rights_logs'] == 'no') ? ' disabled' : '')?>">
								<a tabindex="-1" href="#"><i class="icon-archive"></i> <?=$lang['tool_logs']?></a>
								<ul class="dropdown-menu">
									<li<?=(($userInfo['rights_logs'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/view-log?log=autokick" target="_blank"><i class="icon-archive"></i> Autokicker log</a></li>
									<li<?=(($userInfo['rights_logs'] == 'no') ? ' class="disabled"' : '')?>><a href="<?=HOME_URL?>panel/view-log?log=cp_actions" target="_blank"><i class="icon-archive"></i> CP actions log</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
				
<?php
}
?>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-info-sign"></i> <?=$lang['word_about']?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=HOME_URL?>#credits"><i class="icon-heart"></i> <?=$lang['cp_menu_credits']?></a></li>
							<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ES4X5T4623TEU" target="_blank"><i class="icon-gift"></i> <?=$lang['cp_menu_donate']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/issues/new" target="_blank"><i class="icon-bug"></i> <?=$lang['cp_menu_report_bug']?></a></li>
							<li><a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank"><i class="icon-lightbulb"></i> <?=$lang['cp_menu_subm_sug']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A" target="_blank"><i class="icon-question-sign"></i> <?=$lang['cp_menu_qa']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Changelog-&-Todo" target="_blank"><i class="icon-archive"></i> <?=$lang['cp_menu_changelog']?></a></li>
							<li class="divider"></li>
							<li><a href="https://github.com/dyhli/bfp4f-servertool/" target="_blank"><i class="icon-github"></i> <?=$lang['github']?></a></li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-flag"></i> <?=$lang['word_language']?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=HOME_URL?>panel/?lang=en"><i class="icon-flag"></i> English</a></li>
							<li><a href="<?=HOME_URL?>panel/?lang=nl"><i class="icon-flag"></i> Nederlands</a></li>
							<li><a href="<?=HOME_URL?>panel/?lang=de"><i class="icon-flag"></i> Deutsch</a></li>
							<li><a href="<?=HOME_URL?>panel/?lang=fr"><i class="icon-flag"></i> Francais</a></li>
							<li><a href="<?=HOME_URL?>panel/?lang=pl"><i class="icon-flag"></i> Polski</a></li>
							<li><a href="<?=HOME_URL?>panel/?lang=cs"><i class="icon-flag"></i> Čeština</a></li>
						</ul>
					</li>
<?php
if($user->checkLogin()) {
?>
					
					<li class="divider-vertical"></li>
					<li><a href="<?=HOME_URL?>panel/logout"><i class="icon-off"></i> <?=$lang['cp_menu_logout']?></a></li>
<?php
}
?>
				</ul>
			</div>
		</header>
		
		<div class="container">