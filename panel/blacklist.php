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
if($userInfo['rights_blacklist'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Fetch the whitelist users
$list = new Blacklist($db, $config);
$bans = $list->fetchList();

// Initialize the Accounts class
$acc = new Accounts($db, $config);

$pageTitle = $lang['tool_bl'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-ban"></i> <?=$lang['tool_bl']?> <small><?=$lang['tool_bl_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addBan').slideToggle()" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
					
					<form id="addBan" style="display:none">
						<hr />
						<div class="row">
							<div class="col-md-3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v1" class="form-control" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="col-md-4">
								<?=$lang['tool_bl_reason']?>:<br />
								<input type="text" id="v2" class="form-control" required />
							</div>
							<div class="col-md-3">
								<?=$lang['tool_bl_until']?>:<br />
								<input type="text" id="v3" class="form-control" value="0000-00-00 00:00:00" data-format="yyyy-MM-dd hh:mm:ss" required />
								<small><?=$lang['tool_bl_help1']?></small>
								<small>YYYY-MM-DD HH:II:SS</small>
							</div>
							<div class="col-md-2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addBlacklist',{'vars':{'profileId':$('#addBan #v1').val(),'reason':$('#addBan #v2').val(),'until':$('#addBan #v3').val()},'onSuccess':function(){resetForm('addBan')}})" class="btn btn-success btn-block"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
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
									<th><?=$lang['tool_bl_reason']?></th>
									<th><?=$lang['tool_bl_addedby']?></th>
									<th><?=$lang['word_date']?></th>
									<th><?=$lang['word_until']?></th>
									<th><?=$lang['word_actions']?></th>
								</tr>
							</thead>
							
							<tbody>
							
<?php
if($bans['code'] == 'OK') {
	foreach($bans['list'] as $ban) {
?>
								<tr id="ban_<?=$ban['ban_id']?>">
									<td><a href="http://battlefield.play4free.com/en/profile/<?=$ban['profile_id']?>" target="_blank"><?=$ban['soldier_names']?></a></td>
									<td><?=$ban['profile_id']?></td>
									<td><?=htmlentities($ban['ban_reason'])?></td>
									<td><?=$acc->getNameById($ban['ban_by'])?></td>
									<td><?=date($settings['cp_date_format_full'],strtotime($ban['ban_date']))?></td>
									<td><?=(($ban['ban_until'] == '0000-00-00 00:00:00') ? $lang['word_forever'] : date($settings['cp_date_format_full'],strtotime($ban['ban_until'])))?></td>
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteBlacklist', {'vars':{'id':'<?=$ban['ban_id']?>','onSuccess':function(){$('tr#ban_<?=$ban['ban_id']?>').fadeOut()}}})}" class="btn btn-xs btn-danger"><i class="fa fa-times icon-only"></i></a></td>
								</tr>
<?php
	}
} else {
?>
								<tr>
									<td colspan="7"><?=getLang($bans['message'])?></td>
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
