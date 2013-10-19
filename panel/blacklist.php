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
if($userInfo['rights_whitelist'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
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
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-check"></i> <?=$lang['tool_bl']?> <small><?=$lang['tool_bl_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addBan').slideToggle()" class="btn btn-success"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
					
					<form id="addBan" style="display:none">
						<hr />
						<div class="row-fluid">
							<div class="span3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v1" class="input-block-level" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="span4">
								<?=$lang['tool_bl_reason']?>:<br />
								<input type="text" id="v2" class="input-block-level" required />
							</div>
							<div class="span3">
								<?=$lang['tool_bl_until']?>:<br />
								<div id="datetimepicker" class="input-append">
									<input type="text" id="v3" class="input-block-level" value="0000-00-00 00:00:00" data-format="yyyy-MM-dd hh:mm:ss" required />
									<span class="add-on">
										<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
									</span>
								</div>
								<br />
								<small><?=$lang['tool_bl_help1']?></small>
							</div>
							<script>
							$(function() {
								$('#datetimepicker').datetimepicker();
							})
							</script>
							<div class="span2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addBlacklist',{'vars':{'profileId':$('#addBan #v1').val(),'reason':$('#addBan #v2').val(),'until':$('#addBan #v3').val()},'onSuccess':function(){resetForm('addBan')}})" class="btn btn-success btn-block"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
							</div>
						</div>
					</form>
					
					<hr />
					
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
								<td><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteBlacklist', {'vars':{'id':'<?=$ban['ban_id']?>','onSuccess':function(){$('tr#ban_<?=$ban['ban_id']?>').fadeOut()}}})}" class="btn btn-small btn-danger"><i class="icon-remove icon-only"></i></a></td>
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
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
