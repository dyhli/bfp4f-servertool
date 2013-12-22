<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.6.0
 *
 * Copyright (C) 2013 <Danny Li> a.k.a. SharpBunny
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

require_once('../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_server'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

$pageTitle = $lang['tool_server'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<!--
				INLINE JAVASCRIPT FOR THIS PAGE
			-->
			<script>
			/**
			 * A bit messy, but yeah... :P 
			 */
				function optionsUser(index, profileId, name) {
					$('#optionsUser').slideUp();
					content = '<b><?=$lang['word_player']?>:</b> ' + name + '<br />' +
					'<b><?=$lang['word_profileid']?>:</b> ' + profileId + '<br />' +
					'<a href="http://battlefield.play4free.com/en/profile/' + profileId + '" target="_blank"><?=$lang['tool_server_ltp']?></a><hr /><b><?=$lang['word_actions']?>:</b><br />' +
					'<a href="javascript:;" onclick="kickUser(\''+ name + '\',\''+ index + '\')"><?=$lang['tool_server_kick']?></a> &middot; ' +
					'<a href="javascript:;" onclick="warnUser(\''+ name + '\',\''+ index + '\')"><?=$lang['tool_server_warn']?></a>';
					
					$('#optionsUser #content').html(content);
					$('#optionsUser').slideDown();
					$('html, body').animate({scrollTop:0});
				}
				
				function kickUser(name, index) {
					reason = prompt('Reason? (Default: Unknown)', 'Unknown');
					if(reason) {
						$.executeCmd('kickPlayer', {'vars':{'player':name,'index':index,'reason':reason}});
					}
				}
				
				function warnUser(name, index) {
					reason = prompt('Reason? (Default: Unknown)', 'Unknown');
					if(reason) {
						$.executeCmd('warnPlayer', {'vars':{'player':name,'index':index,'reason':reason}});
					}
				}
				
				function vipUser(name, profileId, onoff) {
					if(onoff == 1) {
						$.executeCmd('addVip', {'vars':{'name':name,'profileId':profileId}});
					} else {
						$.executeCmd('deleteVip', {'vars':{'name':name,'profileId':profileId}});
					}
				}
				
				function fetchInfo() {
					$.get('<?=HOME_URL?>panel/ajax/serverInfo', {players:true,chat:true}, function(data) {
						if(data.status.length > 0) {
							if(data.status == 'OK') {
								
								var valCtMsg = $('#ctmsg').val();								
								var content = '<h3>' + data.info.name + ' <small>' + data.info.ranked.replace('1','<span class="green"><?=$lang['tool_server_ranked']?></span>').replace('0','<span class="red"><?=$lang['tool_server_unranked']?></span>') + '</small></h3><div class="row"><div class="col-md-6">' +
								'<p><b><?=$lang['word_players']?>:</b> ' + data.info.playersCurrent + ' / ' + data.info.playersMax + ' (' + data.info.playersJoining + ' <?=$lang['tool_server_joining']?>)</p>'+
								'<p><b><?=$lang['tool_server_curmap']?>:</b> ' + data.info.mapName + ' [' + data.info.gameModeName + '] (' + data.info.roundsCount + ' / ' + data.info.rounds + ')</p>' +
								'<p><b><?=$lang['word_updated']?>:</b> ' + data.request_date + '</p>'+
								'</div><div class="col-md-6">' +
								'<p><b class="blue"><?=addslashes($lang['tool_server_t1tickets'])?>:</b> ' + data.info.tickets[0] + '</p>' +
								'<p><b class="red"><?=addslashes($lang['tool_server_t2tickets'])?>:</b> ' + data.info.tickets[1] + '</p>' +
								'<p><b><?=$lang['tool_server_playing']?>:</b> ' + data.info.timeElapsed.toHHMMSS() + '</p>'+
								'</div></div>' +
								'<hr /><a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'nextMap\')}" class="btn btn-success"><?=$lang['tool_server_nextmap']?> <i class="fa fa-arrow-right right"></i></a> <a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'restartRound\')}" class="btn btn-info"><i class="fa fa-refresh"></i> <?=$lang['tool_server_restartround']?></a><hr />' +
								'<ul class="nav nav-tabs tabs-nav"><li class="active"><a href="#players" data-toggle="tab" onclick="window.location.hash=\'players\'"><i class="fa fa-group"></i> <?=$lang['word_players']?></a></li><li><a href="#chat" data-toggle="tab" onclick="window.location.hash=\'chat\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_chat']?></a></li><li><a href="#adminchat" data-toggle="tab" onclick="window.location.hash=\'adminchat\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_adminchat']?></a></li><li><a href="#sendmsg" data-toggle="tab" onclick="window.location.hash=\'sendmsg\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_send_msg']?></a></li></ul><div class="tab-content">' +
								'<div id="players" class="tab-pane active"><h3><?=$lang['word_players']?> (' + data.info.playersTotal + ')</h3><div class="table-responsive"><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['tool_server_team']?></th><th><?=$lang['word_playername']?></th><th><?=$lang['word_profileid']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['tool_server_idle']?></th><th><?=$lang['word_vip']?></th><th><?=$lang['word_actions']?></th></tr></thead><tbody>';
								
								if(data.info.playersTotal > 0) {
									$.each(data.players, function(key, value) {
										vip = '<a href="javascript:;" onclick="vipUser(\'' + data.players[key].name + '\',\'' + data.players[key].nucleusId + '\', 1)"><i class="fa fa-star-o dark"></i></a>';
										if(data.players[key].vip == '1') {
											vip = '<a href="javascript:;" onclick="vipUser(\'' + data.players[key].name + '\',\'' + data.players[key].nucleusId + '\', 0)"><i class="fa fa-star orange"></i></a>';
										}
										
										content += '<tr><td>' + data.players[key].team + '</td>' + 
										'<td>(' + data.players[key].level + ') <a href="http://battlefield.play4free.com/en/profile/' + data.players[key].nucleusId + '/' + data.players[key].cdKeyHash + '" target="_blank">' + data.players[key].name + '</a></td>'+
										'<td>' + data.players[key].nucleusId + '</td>' +
										'<td>' + data.players[key].kit.replace('none', 'Dead') + '</td>' +
										'<td>' + data.players[key].ping + '</td>' +
										'<td>' + data.players[key].kills + '</td>' +
										'<td>' + data.players[key].deaths + '</td>' +
										'<td>' + data.players[key].score + '</td>' +
										'<td>' + data.players[key].idle + '</td>' +
										'<td>' + vip + '</td>' +
										'<td class="center"><a href="javascript:;" onclick="optionsUser(\'' + data.players[key].index + '\',\'' + data.players[key].nucleusId + '\',\'' + data.players[key].name + '\')" class="btn btn-default btn-xs"><i class="fa fa-cog icon-only"></i></a></td>' +
										'</tr>';
									});
								} else {
									content += '<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>';
								}
								
								content += '</tbody></table></div>' +
								'</div><div class="tab-pane" id="chat"><br />';
								
								if(data.chat.length > 0) {
									$.each(data.chat, function(key, value) {
										if(data.chat[key].origin != 'Admin') {
											content += '<p' + ((data.chat[key].team == '1') ? ' class="blue"' : ' class="red"') + '>(' + data.chat[key].time + ')' + ((data.chat[key].type == 'Team') ? ' &lt;<?=strtoupper($lang['tool_server_team'])?>&gt;' : '') + ' <b>' + data.chat[key].origin + '</b>: ' + data.chat[key].message + '</p>';
										}
									});
								} else {
									content += '<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>';
								}
								
								content += '</div><div class="tab-pane" id="adminchat"><br />';
								
								if(data.chat.length > 0) {
									$.each(data.chat, function(key, value) {
										if(data.chat[key].origin == 'Admin') {
											content += '<p>(' + data.chat[key].time + ') <b>' + data.chat[key].origin + '</b>: ' + data.chat[key].message + '</p>';
										}
									});
								} else {
									content += '<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>';
								}
								
								content += '</div><div class="tab-pane center" id="sendmsg">' +
								
								'<div class="alert alert-info"><i class="fa fa-lightbulb-o"></i> <?=$lang['tool_server_send_msg_help1']?></div>' +
								'<form id="sendMsgForm"><input type="text" class="form-control" id="ctmsg" /><br /><a href="javascript:;" class="btn btn-default" onclick="$.executeCmd(\'sendSrvMsg\', {\'vars\':{\'msg\':$(\'input#ctmsg\').val()},\'onSuccess\':function(){resetForm(\'sendMsgForm\')}})"><?=$lang['word_go']?> <i class="icon-right fa fa-arrow-right"></i></a></form>' +
								
								'</div></div>';
								
								$('#serverInfo').html(content);
								if(valCtMsg != 'undefined') {
									$('#ctmsg').val(valCtMsg);
								}
								
								if(window.location.hash){
									$('.tabs-nav').find('a[href="'+window.location.hash+'"]').tab('show');
								}
							} else {
								$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>' + data.msg + '</div>');
							}
						} else {
							$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i>' + data + '</div>');
						}
					}).fail(function(data) {
						$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><?=addslashes($lang['msg_serverdown'])?> <?=date($settings['cp_date_format_full'], $settings['server_last_stream'])?></div>');
					});
				}
				
				// Fetch info every 10 seconds
				var i = new Interval('fetchInfo()', 10000);
				i.start();
				
				// Fetch info immediately when page is loaded
				fetchInfo();
			</script>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-hdd-o"></i> <?=$lang['tool_server']?> <small><?=$lang['tool_server_desc']?></small></h2>
					<hr />
					
					<a href="javascript:;" onclick="$('#rconInfo').slideToggle()" class="btn btn-default"><i class="fa fa-pencil"></i> <?=$lang['tool_server_editrcon']?></a>
					<a href="javascript:;" onclick="i.toggle();$(this).toggleClass('btn-danger btn-success')" class="btn btn-success" data-toggle="button"><i class="fa fa-refresh"></i> <?=$lang['tool_server_toggle']?></a>
					<a href="<?=HOME_URL?>panel/rotation" class="btn btn-info"><i class="fa fa-pencil"></i> <?=$lang['tool_mrot']?></a>
					
					<form id="rconInfo" style="display:none">
						<hr />

<?php
if($userInfo['rights_rcon'] == 'yes') {
?>
						<?=$lang['tool_server_serverip']?>:<br />
						<input type="text" id="v1" class="form-control" value="<?=decrypt($settings['server_ip'])?>" /><br />
						<?=$lang['tool_server_rconport']?>:<br />
						<input type="text" id="v2" class="form-control" value="<?=decrypt($settings['server_admin_port'])?>" /><br />
						<?=$lang['tool_server_rconpass']?>:<br />
						<input type="password" id="v3" class="form-control" /><br />
						
						<a href="javascript:;" onclick="$.executeCmd('editRconInfo',{'vars':{'serverIp':$('#rconInfo #v1').val(),'adminPort':$('#rconInfo #v2').val(),'rconPass':$('#rconInfo #v3').val()}})" class="btn btn-success"><i class="fa fa-save"></i> <?=$lang['btn_save']?></a>
<?php
} else {
?>
						<div class="alert alert-danger alert-block">
							<h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>
							<p><?=$lang['msg_cmd_noaccess']?></p>
						</div>
<?php
}
?>
					</form>
					
					<div id="optionsUser" style="display:none">
						<hr />
						<div class="well">
							<h3><?=$lang['tool_server_plactions']?></h3>
							<div id="content"></div>
							<hr />
							<a href="javascript:;" onclick="$('#optionsUser').slideUp()" class="btn btn-danger"><i class="fa fa-times"></i> <?=$lang['btn_close']?></a>
						</div>
					</div>
					
					<hr />
					
					<div id="serverInfo">
						<div class="center">
							<i class="fa fa-refresh fa-spin fa-4x blue"></i>
							<h2><?=$lang['word_loading']?></h2>
						</div>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
