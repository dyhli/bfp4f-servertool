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

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_vips'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Connect to server
use T4G\BFP4F\Rcon as rcon;

$sv = new rcon\Server();

$pageTitle = $lang['tool_vipm'];
include(CORE_DIR . '/cp_header.php');

$rc->connect($cn, $cs);
?>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<h2><i class="fa fa-star orange"></i> <?=$lang['tool_vipm']?> <small><?=$lang['tool_vipm_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addVip').slideToggle()" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
					
					<form id="addVip" style="display:none">
						<hr />
						<div class="row">
							<div class="col-md-4 col-md-offset-1">
								<?=$lang['word_playername']?>:<br />
								<input type="text" id="v1" class="form-control" required />
							</div>
							<div class="col-md-3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v2" class="form-control" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="col-md-2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addVip',{'vars':{'name':$('#addVip #v1').val(),'profileId':$('#addVip #v2').val()},'onSuccess':function(){resetForm('addVip')}})" class="btn btn-success btn-block"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
							</div>
						</div>
					</form>
					
					<hr />
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th><?=$lang['word_playername']?></th>
									<th><?=$lang['word_profileid']?></th>
									<th><?=$lang['word_actions']?></th>
								</tr>
							</thead>
							
							<tbody>
							
<?php
if(!$rc->init()) {
?>
								<tr>
									<td colspan="3"><?=$lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream'])?></td>
								</tr>
<?php
} else {
	$result = $sv->fetchVips();
	
	if(count($result) > 0) {
		$i = 0;
		foreach($result as $vip) {
?>
								<tr id="vip_<?=$i?>">
									<td><a href="http://battlefield.play4free.com/en/profile/<?=$vip['profileId']?>" target="_blank"><?=$vip['playerName']?></a></td>
									<td><?=$vip['profileId']?></td>
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteVip', {'vars':{'name':'<?=$vip['playerName']?>','profileId':'<?=$vip['profileId']?>','onSuccess':function(){$('tr#vip_<?=$i?>').fadeOut()}}})}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> <?=$lang['word_delete']?></a></td>
								</tr>
<?php
			$i++;
		}
	} else {
?>
								<tr>
									<td colspan="3"><?=$lang['tool_vipm_notfound']?></td>
								</tr>
<?php
	}
}
?>
							
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
