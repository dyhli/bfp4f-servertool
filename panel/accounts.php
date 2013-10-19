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
if($userInfo['rights_superadmin'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

// Fetch the whitelist users
$acc = new Accounts($db, $config);
$users = $acc->fetchUsers();

$pageTitle = $lang['tool_acc'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-group"></i> <?=$lang['tool_acc']?> <small><?=$lang['tool_acc_desc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/new-account" class="btn btn-success"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
					
					<hr />
					
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th><?=$lang['cp_username']?></th>
								<th><?=$lang['word_name']?></th>
								<th><?=$lang['word_profileid']?></th>
								<th><?=$lang['word_actions']?></th>
							</tr>
						</thead>
						
						<tbody>
							
<?php
if($users['code'] == 'OK') {
	foreach($users['users'] as $user) {
?>
							<tr id="us_<?=$user['user_id']?>">
								<td><?=$user['user_username']?></td>
								<td><?=$user['user_name']?></td>
								<td><a href="http://battlefield.play4free.com/en/profile/<?=$user['user_profile_id']?>" target="_blank"><?=$user['user_profile_id']?></a></td>
								<td><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteUser', {'vars':{'id':'<?=$user['user_id']?>'},'onSuccess':function(){$('tr#us_<?=$user['user_id']?>').fadeOut()}})}" class="btn btn-small btn-danger"><i class="icon-remove icon-only"></i></a> <a href="<?=HOME_URL?>panel/edit-account?id=<?=$user['user_id']?>" class="btn btn-small"><i class="icon-pencil icon-only"></i></a></td>
							</tr>
<?php
	}
} else {
?>
							<tr>
								<td colspan="4"><?=getLang($user['message'])?></td>
							</tr>
<?php
}
?>
							
						</tbody>
					</table>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
