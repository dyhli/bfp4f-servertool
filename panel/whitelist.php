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
if($userInfo['rights_whitelist'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Fetch the whitelist users
$list = new Whitelist($db, $config);
$players = $list->fetchList();

// Initialize the Accounts class
$acc = new Accounts($db, $config);

$pageTitle = $lang['tool_wlist'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-check-square-o"></i> <?=$lang['tool_wlist']?> <small><?=$lang['tool_wlist_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addPlayer').slideToggle()" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a> <a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'whl'}});" class="btn btn-default"><i class="fa fa-power-off"></i> <?=$lang['word_enable']?> / <?=$lang['word_disable']?></a>
					
					<form id="addPlayer" style="display:none">
						<hr />
						<div class="row">
							<div class="col-md-4 col-md-offset-3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v1" class="form-control" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="col-md-2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addWhitelist',{'vars':{'profileId':$('#addPlayer #v1').val()},'onSuccess':function(){resetForm('addPlayer')}})" class="btn btn-success btn-block"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
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
									<th><?=$lang['tool_wlist_addedby']?></th>
									<th><?=$lang['word_date']?></th>
									<th><?=$lang['word_actions']?></th>
								</tr>
							</thead>
							
							<tbody>
							
<?php
if($players['code'] == 'OK') {
	foreach($players['list'] as $player) {
?>
								<tr id="pl_<?=$player['list_id']?>">
									<td><a href="http://battlefield.play4free.com/en/profile/<?=$player['profile_id']?>" target="_blank"><?=$player['soldier_names']?></a></td>
									<td><?=$player['profile_id']?></td>
									<td><?=$acc->getNameById($player['added_by'])?></td>
									<td><?=date($settings['cp_date_format_full'],strtotime($player['add_date']))?></td>
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteWhitelist', {'vars':{'id':'<?=$player['list_id']?>'},'onSuccess':function(){$('tr#pl_<?=$player['list_id']?>').fadeOut()}})}" class="btn btn-xs btn-danger"><i class="fa fa-times icon-only"></i></a></td>
								</tr>
<?php
	}
} else {
?>
								<tr>
									<td colspan="5"><?=getLang($players['message'])?></td>
								</tr>
<?php
}
?>
							
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
