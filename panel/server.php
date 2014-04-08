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

$i3dStart = true;
require_once('../core/init.php');

$user->checkLogin(true);

// Class with maps and gamemodes
$cmg = new GameMaps();

$pageTitle = $lang['tool_server'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<!--
				INLINE JAVASCRIPT FOR THIS PAGE
			-->
			<script>
			function optionsUser(index,nucleusId,cdKeyHash,name){content='<b><?=$lang['word_player']?>:</b> '+name+'<br />'+'<b><?=$lang['word_profileid']?>:</b> '+nucleusId+'<br />'+'<a class="btn btn-default" href="http://battlefield.play4free.com/en/profile/'+nucleusId+'" target="_blank"><i class="fa fa-user"></i> <?=$lang['tool_server_ltp']?></a><hr /><b><?=$lang['word_actions']?>:</b><br />'+'<a class="btn btn-default btn-block" href="javascript:;" onclick="kickUser(\''+name+'\',\''+index+'\')"><i class="fa fa-times"></i> <?=$lang['tool_server_kick']?></a>'+'<a class="btn btn-default btn-block" href="javascript:;" onclick="warnUser(\''+name+'\',\''+index+'\')"><i class="fa fa-exclamation-circle"></i> <?=$lang['tool_server_warn']?></a>'+'<a class="btn btn-default btn-block" href="javascript:;" onclick="switchUser(\''+name+'\',\''+index+'\')"><i class="fa fa-exchange"></i> <?=$lang['tool_server_switch']?></a>'+'<a class="btn btn-default btn-block" href="javascript:;" onclick="getLoadout(\''+name+'\',\''+nucleusId+'\',\''+cdKeyHash+'\')"><i class="fa fa-search"></i> <?=$lang['tool_server_loadout']?></a>';$('#optionsUser #content').html(content);$('#optionsUser').modal()}function getLoadout(name,nucleusId,cdKeyHash){$('#loadoutModal').find('.modal-title').html('<i class="fa fa-search"></i> <?=$lang['tool_server_loadout_title']?> '+name).end().find('.modal-body').html('<div class="center"><h2><i class="fa fa-refresh fa-spin"></i></h2><h3><?=$lang['word_loading']?></h3></div>').end().modal();$.get('<?=HOME_URL?>panel/ajax/getLoadout.php',{nucleusId:nucleusId,cdKeyHash:cdKeyHash},function(data){$('#loadoutModal').find('.modal-body').html(data)})}function kickUser(name,index){reason=prompt('Reason? (Default: Unknown)','Unknown');if(reason){$.executeCmd('kickPlayer',{'vars':{'player':name,'index':index,'reason':reason}})}}function warnUser(name,index){reason=prompt('Reason? (Default: Unknown)','Unknown');if(reason){$.executeCmd('warnPlayer',{'vars':{'player':name,'index':index,'reason':reason}})}}function switchUser(name,index){$.executeCmd('switchPlayer',{'vars':{'player':name,'index':index}})}function vipUser(name,nucleusId,onoff){if(onoff==1){$.executeCmd('addVip',{'vars':{'name':name,'nucleusId':nucleusId}})}else{$.executeCmd('deleteVip',{'vars':{'name':name,'nucleusId':nucleusId}})}}function switchMap(){$.executeCmd('switchMap',{'vars':{'map':$('#switchMapVal').val()}});$('#switchMapModal').modal('hide')}function fetchInfo(){$.get('<?=HOME_URL?>panel/ajax/serverInfo.php',{players:true,chat:true,ping:true},function(data){if(data.status.length>0){if(data.status=='OK'){var valCtMsg=$('#ctmsg').val();var content='<h2>'+data.info.name+' <small>'+data.info.ranked.replace('1','<span class="green"><?=$lang['tool_server_ranked']?></span>').replace('0','<span class="red"><?=$lang['tool_server_unranked']?></span>')+' <span class="text-muted">'+data.ping+'</span></small></h2><div class="row"><div class="col-md-6">'+'<p><b><?=$lang['word_players']?>:</b> '+data.info.playersCurrent+' / '+data.info.playersMax+' ('+data.info.playersJoining+' <?=$lang['tool_server_joining']?>)</p>'+'<p><b><?=$lang['tool_server_curmap']?>:</b> '+data.info.mapName+' ['+data.info.gameModeName+'] ('+data.info.roundsCount+' / '+data.info.rounds+')</p>'+'<p><b><?=$lang['word_updated']?>:</b> '+data.request_date+'</p>'+'</div><div class="col-md-6">'+'<p><b class="blue"><?=addslashes($lang['tool_server_t1tickets'])?>:</b> '+data.info.tickets[0]+'</p>'+'<p><b class="red"><?=addslashes($lang['tool_server_t2tickets'])?>:</b> '+data.info.tickets[1]+'</p>'+'<p><b><?=$lang['tool_server_playing']?>:</b> '+data.info.timeElapsed.toHHMMSS()+'</p>'+'</div></div>'+'<hr /><div class="center"><a href="javascript:;" onclick="$(\'#switchMapModal\').modal()" class="btn btn-default"><i class="fa fa-list"></i> <?=$lang['tool_server_switchmap']?></a> <a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'nextMap\')}" class="btn btn-default"><?=$lang['tool_server_nextmap']?> <i class="fa fa-arrow-right right"></i></a> <a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'restartRound\')}" class="btn btn-default"><i class="fa fa-refresh"></i> <?=$lang['tool_server_restartround']?></a> <a href="javascript:;" onclick="if(confirm(\'<?=$lang['msg_sure']?>\')){$.executeCmd(\'closePoll\')}" class="btn btn-default"><i class="fa fa-times"></i> <?=$lang['tool_server_closepoll']?></a></div><hr />'+'<ul class="nav nav-tabs tabs-nav"><li class="active"><a href="#players" data-toggle="tab" onclick="window.location.hash=\'players\'"><i class="fa fa-group"></i> <?=$lang['word_players']?></a></li><li><a href="#chat" data-toggle="tab" onclick="window.location.hash=\'chat\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_chat']?></a></li><li><a href="#adminchat" data-toggle="tab" onclick="window.location.hash=\'adminchat\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_adminchat']?></a></li><li><a href="#sendmsg" data-toggle="tab" onclick="window.location.hash=\'sendmsg\'"><i class="fa fa-comments"></i> <?=$lang['tool_server_send_msg']?></a></li></ul><div class="tab-content">'+'<div id="players" class="tab-pane active">'+'<div class="row"><div class="col-md-6"><h3><i class="fa fa-group"></i> <?=$lang['tool_server_team']?> 1</h3><div class="table-responsive"><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['word_playername']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['word_vip']?></th><th><?=$lang['word_actions']?></th></tr></thead><tbody>';if(data.info.playersTotal>0){$.each(data.players,function(key,value){if(data.players[key].team=='1'){vip='<a href="javascript:;" onclick="vipUser(\''+data.players[key].name+'\',\''+data.players[key].nucleusId+'\', 1)"><i class="fa fa-star-o dark"></i></a>';if(data.players[key].vip=='1'){vip='<a href="javascript:;" onclick="vipUser(\''+data.players[key].name+'\',\''+data.players[key].nucleusId+'\', 0)"><i class="fa fa-star orange"></i></a>'}idling='';if(data.players[key].idle>0){idling=' class="danger"'}content+='<tr'+idling+'><td>('+data.players[key].level+') <a href="http://battlefield.play4free.com/en/profile/'+data.players[key].nucleusId+'/'+data.players[key].cdKeyHash+'" target="_blank">'+data.players[key].name+'</a></td>'+'<td class="center">'+data.players[key].kit.replace('none','Dead').replace('US_','').replace('RU_','').replace('_kit','')+'</td>'+'<td class="center">'+data.players[key].ping+'</td>'+'<td class="center">'+data.players[key].kills+'</td>'+'<td class="center">'+data.players[key].deaths+'</td>'+'<td class="center">'+data.players[key].score+'</td>'+'<td class="center">'+vip+'</td>'+'<td class="center"><a href="javascript:;" onclick="optionsUser(\''+data.players[key].index+'\',\''+data.players[key].nucleusId+'\',\''+data.players[key].cdKeyHash+'\',\''+data.players[key].name+'\')" class="btn btn-default btn-xs"><i class="fa fa-cog icon-only"></i></a></td>'+'</tr>'}})}else{content+='<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>'}content+='</tbody></table></div></div>'+'<div class="col-md-6"><h3><i class="fa fa-group"></i> <?=$lang['tool_server_team']?> 2</h3><div class="table-responsive"><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['word_playername']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['word_vip']?></th><th><?=$lang['word_actions']?></th></tr></thead><tbody>';if(data.info.playersTotal>0){$.each(data.players,function(key,value){if(data.players[key].team=='2'){vip='<a href="javascript:;" onclick="vipUser(\''+data.players[key].name+'\',\''+data.players[key].nucleusId+'\', 1)"><i class="fa fa-star-o dark"></i></a>';if(data.players[key].vip=='1'){vip='<a href="javascript:;" onclick="vipUser(\''+data.players[key].name+'\',\''+data.players[key].nucleusId+'\', 0)"><i class="fa fa-star orange"></i></a>'}idling='';if(data.players[key].idle>0){idling=' class="danger"'}content+='<tr'+idling+'><td>('+data.players[key].level+') <a href="http://battlefield.play4free.com/en/profile/'+data.players[key].nucleusId+'/'+data.players[key].cdKeyHash+'" target="_blank">'+data.players[key].name+'</a></td>'+'<td class="center">'+data.players[key].kit.replace('none','Dead').replace('US_','').replace('RU_','').replace('_kit','')+'</td>'+'<td class="center">'+data.players[key].ping+'</td>'+'<td class="center">'+data.players[key].kills+'</td>'+'<td class="center">'+data.players[key].deaths+'</td>'+'<td class="center">'+data.players[key].score+'</td>'+'<td class="center">'+vip+'</td>'+'<td class="center"><a href="javascript:;" onclick="optionsUser(\''+data.players[key].index+'\',\''+data.players[key].nucleusId+'\',\''+data.players[key].cdKeyHash+'\',\''+data.players[key].name+'\')" class="btn btn-default btn-xs"><i class="fa fa-cog icon-only"></i></a></td>'+'</tr>'}})}else{content+='<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>'}content+='</tbody></table></div></div></div>'+'</div><div class="tab-pane" id="chat"><br />';if(data.chat.length>0){content+='<div class="table-responsive"><table class="table table-bordered table-striped table-hovered"><thead><tr><th><i class="fa fa-clock-o"></i></th><th><i class="fa fa-user"></i></th><th><i class="fa fa-comment"></i></th></tr></thead><tbody>';$.each(data.chat,function(key,value){if(data.chat[key].origin!='Admin'){content+='<tr'+((data.chat[key].team=='1')?' class="blue"':' class="red"')+'><td style="width:65px">'+data.chat[key].time+'</td><td style="width:250px">'+((data.chat[key].type=='Team')?' &lt;<?=strtoupper($lang['tool_server_team'])?>&gt;':'')+' <b>'+data.chat[key].origin+'</b></td><td>'+data.chat[key].message+'</td></tr>'}});content+='</tbody></table></div>'}else{content+='<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>'}content+='</div><div class="tab-pane" id="adminchat"><br />';if(data.chat.length>0){content+='<div class="table-responsive"><table class="table table-bordered table-striped table-hovered"><thead><tr><th><i class="fa fa-clock-o"></i></th><th><i class="fa fa-user"></i></th><th><i class="fa fa-comment"></i></th></tr></thead><tbody>';$.each(data.chat,function(key,value){if(data.chat[key].origin=='Admin'){content+='<tr class="text-success"><td style="width:65px">'+data.chat[key].time+'</td><td style="width:150px"><b>'+data.chat[key].origin+'</b></td><td>'+data.chat[key].message.replace(/\|ccc\| (.+?) \|ccc\|/g,'<span class="text-warning">$1</span>').replace(/\|ccc\| (.*)/,'<span class="text-warning">$1</span>')+'</td></tr>'}});content+='</tbody></table></div>'}else{content+='<div class="alert alert-info"><?=$lang['tool_server_nochat']?></div>'}content+='</div><div class="tab-pane center" id="sendmsg">'+'<div class="alert alert-info"><i class="fa fa-lightbulb-o"></i> <?=$lang['tool_server_send_msg_help1']?></div>'+'<form id="sendMsgForm"><input type="text" class="form-control" id="ctmsg" /><br /><a href="javascript:;" class="btn btn-default" onclick="$.executeCmd(\'sendSrvMsg\', {\'vars\':{\'msg\':$(\'input#ctmsg\').val()},\'onSuccess\':function(){resetForm(\'sendMsgForm\')}})"><?=$lang['word_go']?> <i class="icon-right fa fa-arrow-right"></i></a></form>'+'</div></div>';$('#serverInfo').html(content);if(valCtMsg!='undefined'){$('#ctmsg').val(valCtMsg)}if(window.location.hash){$('.tabs-nav').find('a[href="'+window.location.hash+'"]').tab('show')}}else{$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>'+data.msg+'</div>')}}else{$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i>'+data+'</div>')}}).fail(function(data){$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><?=addslashes($lang['msg_serverdown'])?> <?=date($settings['cp_date_format_full'], $settings['server_last_stream'])?></div>')})}var i=new Interval('fetchInfo()',10000);i.start();fetchInfo();
			</script>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-hdd-o"></i> <?=$lang['tool_server']?> <small><?=$lang['tool_server_desc']?></small></h2>
					<hr />
					
<?php
if($settings['i3d_active'] == 'true' && $userInfo['rights_superadmin'] == 'yes' && $i3dStatus == 'success') {
	$cpuPercentage = $i3dResult['data'][0]['usageCpu']/110*100;
	$ramPercentage = $i3dResult['data'][0]['usageMemory']/800*100;
	$diskPercentage = $i3dResult['data'][0]['usageDisk']/10*100;
?>
					<div class="alert alert-info fix-bottom">
						<h4 class="pull-left"><i class="fa fa-hdd-o"></i> <?=$lang['i3d_your']?> #<?=$i3dResult['data'][0]['gameserverId']?> <small><?=$i3dResult['data'][0]['ip']?>:<?=$i3dResult['data'][0]['port']?></small></h4>
						<div class="pull-right">
							<a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('startServer')}" class="btn btn-default btn-xs"><i class="fa fa-play"></i> <?=$lang['i3d_start']?></a>
							<a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('stopServer')}" class="btn btn-default btn-xs"><i class="fa fa-stop"></i> <?=$lang['i3d_stop']?></a>
							<a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('restartServer')}" class="btn btn-default btn-xs"><i class="fa fa-refresh"></i> <?=$lang['i3d_restart']?></a>
						</div>
						<div class="clearfix"></div>
						
						<div class="row" id="i3dInfo">
							<div class="col-md-4">
								<p class="center text-dark"><?=$lang['i3d_cpu']?></p>
								<div class="progress">
									<div class="progress-bar progress-bar-<?=progressColor($cpuPercentage)?>" role="progressbar" aria-valuenow="<?=$cpuPercentage?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$cpuPercentage?>%"><span><?=$i3dResult['data'][0]['usageCpu']?> % / 110 %</span></div>
								</div>
							</div>
							<div class="col-md-4">
								<p class="center text-dark"><?=$lang['i3d_mem']?></p>
								<div class="progress">
									<div class="progress-bar progress-bar-<?=progressColor($ramPercentage)?>" role="progressbar" aria-valuenow="<?=$ramPercentage?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$ramPercentage?>%"><span><?=$i3dResult['data'][0]['usageMemory']?> MB / 800 MB</span></div>
								</div>
							</div>
							<div class="col-md-4">
								<p class="center text-dark"><?=$lang['i3d_disk']?></p>
								<div class="progress">
									<div class="progress-bar progress-bar-<?=progressColor($diskPercentage)?>" role="progressbar" aria-valuenow="<?=$diskPercentage?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$diskPercentage?>%"><span><?=$i3dResult['data'][0]['usageDisk']?> GB / 10 GB</span></div>
								</div>
							</div>
						</div>
					</div>
<?php
}
?>
					
					<div class="center f3">
						<a href="javascript:;" onclick="$('#rconInfo').modal()" class="btn btn-default"><i class="fa fa-pencil"></i> <?=$lang['tool_server_editrcon']?></a>
						<a href="javascript:;" onclick="i.toggle();$(this).toggleClass('btn-danger btn-default')" class="btn btn-default" data-toggle="button"><i class="fa fa-refresh"></i> <?=$lang['tool_server_toggle']?></a>
						<a href="<?=HOME_URL?>panel/rotation.php" class="btn btn-default"><i class="fa fa-pencil"></i> <?=$lang['tool_mrot']?></a>
						<a href="<?=HOME_URL?>panel/server-settings.php" class="btn btn-default"><i class="fa fa-cogs"></i> <?=$lang['tool_svset']?></a>
					</div>
					
					<hr />
					
					<div id="serverInfo" class="f1">
						<div class="center">
							<i class="fa fa-refresh fa-spin fa-4x blue"></i>
							<h2><?=$lang['word_loading']?></h2>
						</div>
					</div>
					
				</div>
			</div>
			
			<!-- MODALS -->
			<div class="modal fade" id="rconInfo">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-pencil"></i> <?=$lang['tool_server_editrcon']?></h4>
						</div>
						<div class="modal-body">
<?php
if($userInfo['rights_rcon'] == 'yes') {
?>
							<?=$lang['tool_server_serverip']?>:<br />
							<input type="text" id="v1" class="form-control" value="<?=decrypt($settings['server_ip'])?>" /><br />
							<?=$lang['tool_server_rconport']?>:<br />
							<input type="text" id="v2" class="form-control" value="<?=decrypt($settings['server_admin_port'])?>" /><br />
							<?=$lang['tool_server_rconpass']?>:<br />
							<input type="password" id="v3" class="form-control" /><br />
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
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?=$lang['btn_close']?></button>
							<a href="javascript:;" data-dismiss="modal" onclick="$.executeCmd('editRconInfo',{'vars':{'serverIp':$('#rconInfo #v1').val(),'adminPort':$('#rconInfo #v2').val(),'rconPass':$('#rconInfo #v3').val()}})" class="btn btn-primary"><i class="fa fa-save"></i> <?=$lang['btn_save']?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="optionsUser">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-user"></i> <?=$lang['tool_server_plactions']?></h4>
						</div>
						<div class="modal-body" id="content"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?=$lang['btn_close']?></button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="loadoutModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?=$lang['btn_close']?></button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="switchMapModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-list"></i> <?=$lang['tool_server_switchmap']?></h4>
						</div>
						<div class="modal-body">
							
							<select class="form-control" size="14" id="switchMapVal">
							
<?php
foreach($cmg->combos as $key => $value) {
?>
								<optgroup label="<?=$lang['tool_mrot_gamemode']?>: <?=$cmg->getGameMode($key)?>">
<?php
	foreach($value as $map) {
?>
									<option value="<?=$map?>|<?=$key?>"><?=$cmg->getMapName($map)?></a></option>
<?php
	}
?>
								</optgroup>
<?php
}
?>
							</select>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?=$lang['btn_close']?></button>
							<a class="btn btn-primary" href="javascript:;" onclick="switchMap()"><i class="fa fa-edit"></i> <?=$lang['tool_server_switchmap']?></a>
						</div>
					</div>
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
