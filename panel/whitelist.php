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
$list = new Whitelist($db, $config);
$players = $list->fetchList();

// Initialize the Accounts class
$acc = new Accounts($db, $config);

$pageTitle = $lang['tool_wlist'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-check"></i> <?=$lang['tool_wlist']?> <small><?=$lang['tool_wlist_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addPlayer').slideToggle()" class="btn btn-success"><i class="icon-plus"></i> <?=$lang['btn_add']?></a> <a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'whl'}});" class="btn"><i class="icon-off"></i> <?=$lang['word_enable']?> / <?=$lang['word_disable']?></a>
					
					<form id="addPlayer" style="display:none">
						<hr />
						<div class="row-fluid">
							<div class="span4 offset3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v1" class="input-block-level" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="span2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addWhitelist',{'vars':{'profileId':$('#addPlayer #v1').val()},'onSuccess':function(){resetForm('addPlayer')}})" class="btn btn-success btn-block"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
							</div>
						</div>
					</form>
					
					<hr />
					
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
								<td><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteWhitelist', {'vars':{'id':'<?=$player['list_id']?>'},'onSuccess':function(){$('tr#pl_<?=$player['list_id']?>').fadeOut()}})}" class="btn btn-small btn-danger"><i class="icon-remove icon-only"></i></a></td>
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
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
