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
								var content = '<h3>' + data.info.name + ' <small>' + data.info.ranked.replace('1','<span class="green"><?=$lang['tool_server_ranked']?></span>').replace('0','<span class="red"><?=$lang['tool_server_unranked']?></span>') + '</small></h3><div class="row-fluid"><div class="span6">' +
								'<p><b><?=$lang['word_players']?>:</b> ' + data.info.playersCurrent + ' / ' + data.info.playersMax + ' (' + data.info.playersJoining + ' <?=$lang['tool_server_joining']?>)</p>'+
								'<p><b><?=$lang['tool_server_curmap']?>:</b> ' + data.info.map + ' ' + data.info.gameMode + ' (' + data.info.roundsCount + ' / ' + data.info.rounds + ')</p>' +
								'<p><b><?=$lang['word_updated']?>:</b> ' + data.request_date + '</p>'+
								'</div><div class="span6">' +
								'<p><b class="blue"><?=addslashes($lang['tool_server_t1tickets'])?>:</b> ' + data.info.tickets[0] + '</p>' +
								'<p><b class="red"><?=addslashes($lang['tool_server_t2tickets'])?>:</b> ' + data.info.tickets[1] + '</p>' +
								'<p><b><?=$lang['tool_server_playing']?>:</b> ' + data.info.timeElapsed.toHHMMSS() + '</p>'+
								'</div></div>' +
								'<hr /><a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'nextMap\')}" class="btn btn-success"><?=$lang['tool_server_nextmap']?> <i class="icon-arrow-right right"></i></a> <a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'restartRound\')}" class="btn btn-info"><i class="icon-refresh"></i> <?=$lang['tool_server_restartround']?></a><hr />' +
								'<ul class="nav nav-tabs tabs-nav"><li class="active"><a href="#players" data-toggle="tab" onclick="window.location.hash=\'players\'"><i class="icon-group"></i> <?=$lang['word_players']?></a></li><li><a href="#chat" data-toggle="tab" onclick="window.location.hash=\'chat\'"><i class="icon-comments"></i> <?=$lang['tool_server_chat']?></a></li><li><a href="#adminchat" data-toggle="tab" onclick="window.location.hash=\'adminchat\'"><i class="icon-comments"></i> <?=$lang['tool_server_adminchat']?></a></li></ul><div class="tab-content">' +
								'<div id="players" class="tab-pane active"><h3><?=$lang['word_players']?> (' + data.info.playersTotal + ')</h3><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['tool_server_team']?></th><th><?=$lang['word_playername']?></th><th><?=$lang['word_profileid']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['tool_server_idle']?></th><th><?=$lang['word_vip']?></th><th><?=$lang['word_actions']?></th></tr></thead><tbody>';
								
								if(data.info.playersTotal > 0) {
									$.each(data.players, function(key, value) {
										vip = '<a href="javascript:;" onclick="vipUser(\'' + data.players[key].name + '\',\'' + data.players[key].nucleusId + '\', 1)"><i class="icon-star-empty dark"></i></a>';
										if(data.players[key].vip == '1') {
											vip = '<a href="javascript:;" onclick="vipUser(\'' + data.players[key].name + '\',\'' + data.players[key].nucleusId + '\', 0)"><i class="icon-star orange"></i></a>';
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
										'<td><a href="javascript:;" onclick="optionsUser(\'' + data.players[key].index + '\',\'' + data.players[key].nucleusId + '\',\'' + data.players[key].name + '\')" class="btn btn-small"><i class="icon-cog icon-only"></i></a></td>' +
										'</tr>';
									});
								} else {
									content += '<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>';
								}
								
								content += '</tbody></table>' +
								'</div><div class="tab-pane" id="chat">';
								
								if(data.chat.length > 0) {
									$.each(data.chat, function(key, value) {
										if(data.chat[key].origin != 'Admin') {
											content += '<p' + ((data.chat[key].team == '1') ? ' class="blue"' : ' class="red"') + '>(' + data.chat[key].time + ')' + ((data.chat[key].type == 'Team') ? ' &lt;<?=strtoupper($lang['tool_server_team'])?>&gt;' : '') + ' <b>' + data.chat[key].origin + '</b>: ' + data.chat[key].message + '</p>';
										}
									});
								} else {
									content += '<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>';
								}
								
								content += '</div><div class="tab-pane" id="adminchat">';
								
								if(data.chat.length > 0) {
									$.each(data.chat, function(key, value) {
										if(data.chat[key].origin == 'Admin') {
											content += '<p>(' + data.chat[key].time + ') <b>' + data.chat[key].origin + '</b>: ' + data.chat[key].message + '</p>';
										}
									});
								} else {
									content += '<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>';
								}
								
								content += '</div></div>';
								
								$('#serverInfo').html(content);
								
								if(window.location.hash){
									$('.tabs-nav').find('a[href="'+window.location.hash+'"]').tab('show');
								}
							} else {
								$('#serverInfo').html('<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> <?=$lang['word_error']?></h4>' + data.msg + '</div>');
							}
						} else {
							$('#serverInfo').html('<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i>' + data + '</div>');
						}
					}).fail(function(data) {
						$('#serverInfo').html('<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> <?=$lang['word_error']?></h4><?=addslashes($lang['msg_serverdown'])?> <?=date($settings['cp_date_format_full'], $settings['server_last_stream'])?></div>');
					});
				}
				
				// Fetch info every 10 seconds
				var i = new Interval('fetchInfo()', 10000);
				i.start();
				
				// Fetch info immediately when page is loaded
				fetchInfo();
			</script>
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-hdd"></i> <?=$lang['tool_server']?> <small><?=$lang['tool_server_desc']?></small></h2>
					<hr />
					
					<a href="javascript:;" onclick="$('#rconInfo').slideToggle()" class="btn btn-inverse"><i class="icon-pencil"></i> <?=$lang['tool_server_editrcon']?></a> <a href="javascript:;" onclick="i.toggle();$(this).toggleClass('btn-danger')" class="btn" data-toggle="button"><i class="icon-refresh"></i> <?=$lang['tool_server_toggle']?></a>
					
					<form id="rconInfo" style="display:none">
						<hr />

<?php
if($userInfo['rights_rcon'] == 'yes') {
?>
						<?=$lang['tool_server_serverip']?>:<br />
						<input type="text" id="v1" class="span4" /><br />
						<?=$lang['tool_server_rconport']?>:<br />
						<input type="text" id="v2" class="span4" /><br />
						<?=$lang['tool_server_rconpass']?>:<br />
						<input type="password" id="v3" class="span4" /><br />
						
						<a href="javascript:;" onclick="$.executeCmd('editRconInfo',{'vars':{'serverIp':$('#rconInfo #v1').val(),'adminPort':$('#rconInfo #v2').val(),'rconPass':$('#rconInfo #v3').val()}})" class="btn btn-success"><i class="icon-save"></i> <?=$lang['btn_save']?></a>
<?php
} else {
?>
						<div class="alert alert-error alert-block">
							<h4><i class="icon-remove"></i> <?=$lang['word_error']?></h4>
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
							<a href="javascript:;" onclick="$('#optionsUser').slideUp()" class="btn btn-danger"><i class="icon-remove"></i> <?=$lang['btn_close']?></a>
						</div>
					</div>
					
					<hr />
					
					<div id="serverInfo">
						<div class="center">
							<i class="icon-refresh icon-spin icon-4x blue"></i>
							<h2><?=$lang['word_loading']?></h2>
						</div>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
