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
require_once('../core/init.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Public server watcher | BattlefieldTools.com Servertool</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="UTF-8" />
		<meta name="author" content="BattlefieldTools.com" />
		
		<link rel="icon" type="image/png" href="<?=HOME_URL?>panel/img/favicon.png" />
		
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/default.css" />
		
		<script src="<?=HOME_URL?>panel/js/jquery-1.9.1.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/custom.js"></script>
	</head>
	
	<body>
		
		<div class="container">

			<!--
				INLINE JAVASCRIPT FOR THIS PAGE
			-->
			<script>
			function fetchInfo(){$.get('<?=HOME_URL?>public/ajax/serverInfo.php',function(c){if(c.status.length>0){if(c.status=='OK'){var d='<h2>'+c.info.name+' <small>'+c.info.ranked.replace('1','<span class="green"><?=$lang['tool_server_ranked']?></span>').replace('0','<span class="red"><?=$lang['tool_server_unranked']?></span>')+'</small></h2><div class="row"><div class="col-md-6">'+'<p><b><?=$lang['word_players']?>:</b> '+c.info.playersCurrent+' / '+c.info.playersMax+' ('+c.info.playersJoining+' <?=$lang['tool_server_joining']?>)</p>'+'<p><b><?=$lang['tool_server_curmap']?>:</b> '+c.info.mapName+' ['+c.info.gameModeName+'] ('+c.info.roundsCount+' / '+c.info.rounds+')</p>'+'<p><b><?=$lang['word_updated']?>:</b> '+c.request_date+'</p>'+'</div><div class="col-md-6">'+'<p><b class="blue"><?=addslashes($lang['tool_server_t1tickets'])?>:</b> '+c.info.tickets[0]+'</p>'+'<p><b class="red"><?=addslashes($lang['tool_server_t2tickets'])?>:</b> '+c.info.tickets[1]+'</p>'+'<p><b><?=$lang['tool_server_playing']?>:</b> '+c.info.timeElapsed.toHHMMSS()+'</p>'+'</div></div>'+'<div class="row"><div class="col-md-6"><h3><i class="fa fa-group"></i> <?=$lang['tool_server_team']?> 1</h3><div class="table-responsive"><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['word_playername']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['word_vip']?></th></tr></thead><tbody>';if(c.info.playersTotal>0){$.each(c.players,function(a,b){if(c.players[a].team=='1'){vip='<i class="fa fa-star-o dark"></i>';if(c.players[a].vip=='1'){vip='<i class="fa fa-star orange"></i>'}idling='';if(c.players[a].idle>0){idling=' class="danger"'}d+='<tr'+idling+'><td>('+c.players[a].level+') <a href="http://battlefield.play4free.com/en/profile/'+c.players[a].nucleusId+'/'+c.players[a].cdKeyHash+'" target="_blank">'+c.players[a].name+'</a></td>'+'<td class="center">'+c.players[a].kit.replace('none','Dead').replace('US_','').replace('RU_','').replace('_kit','')+'</td>'+'<td class="center">'+c.players[a].ping+'</td>'+'<td class="center">'+c.players[a].kills+'</td>'+'<td class="center">'+c.players[a].deaths+'</td>'+'<td class="center">'+c.players[a].score+'</td>'+'<td class="center">'+vip+'</td>'+'</tr>'}})}else{d+='<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>'}d+='</tbody></table></div></div>'+'<div class="col-md-6"><h3><i class="fa fa-group"></i> <?=$lang['tool_server_team']?> 2</h3><div class="table-responsive"><table class="table table-bordered table-striped table-hovered table-condensed"><thead><tr><th><?=$lang['word_playername']?></th><th><?=$lang['tool_server_kit']?></th><th><?=$lang['tool_server_ping']?></th><th><?=$lang['tool_server_kills']?></th><th><?=$lang['tool_server_deaths']?></th><th><?=$lang['tool_server_score']?></th><th><?=$lang['word_vip']?></th></tr></thead><tbody>';if(c.info.playersTotal>0){$.each(c.players,function(a,b){if(c.players[a].team=='2'){vip='<i class="fa fa-star-o dark"></i>';if(c.players[a].vip=='1'){vip='<i class="fa fa-star orange"></i>'}idling='';if(c.players[a].idle>0){idling=' class="danger"'}d+='<tr'+idling+'><td>('+c.players[a].level+') <a href="http://battlefield.play4free.com/en/profile/'+c.players[a].nucleusId+'/'+c.players[a].cdKeyHash+'" target="_blank">'+c.players[a].name+'</a></td>'+'<td class="center">'+c.players[a].kit.replace('none','Dead').replace('US_','').replace('RU_','').replace('_kit','')+'</td>'+'<td class="center">'+c.players[a].ping+'</td>'+'<td class="center">'+c.players[a].kills+'</td>'+'<td class="center">'+c.players[a].deaths+'</td>'+'<td class="center">'+c.players[a].score+'</td>'+'<td class="center">'+vip+'</td>'+'</tr>'}})}else{d+='<tr><td colspan="11"><i><?=$lang['tool_server_empty']?></i></td></tr>'}d+='</tbody></table></div></div>';$('#serverInfo').html(d)}else{$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>'+c.msg+'</div>')}}else{$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i>'+c+'</div>')}}).fail(function(a){$('#serverInfo').html('<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><?=addslashes($lang['msg_serverdown'])?> <?=date($settings['cp_date_format_full'], $settings['server_last_stream'])?></div>')})}var i=new Interval('fetchInfo()',10000);i.start();fetchInfo();
			</script>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-eye"></i> Public server watcher</h2>
					<hr />
					
					<div id="serverInfo" class="f1">
						<div class="center">
							<i class="fa fa-refresh fa-spin fa-4x blue"></i>
							<h2>Loading...</h2>
						</div>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
