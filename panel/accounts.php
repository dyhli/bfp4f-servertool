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
if($userInfo['rights_superadmin'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Fetch the whitelist users
$acc = new Accounts($db, $config);
$users = $acc->fetchUsers();

$pageTitle = $lang['tool_acc'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-group"></i> <?=$lang['tool_acc']?> <small><?=$lang['tool_acc_desc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/new-account.php" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
					
					<hr />
					
					<div class="table-responsive">
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
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteUser', {'vars':{'id':'<?=$user['user_id']?>'},'onSuccess':function(){$('tr#us_<?=$user['user_id']?>').fadeOut()}})}" class="btn btn-xs btn-danger"><i class="fa fa-times icon-only"></i></a> <a href="<?=HOME_URL?>panel/edit-account.php?id=<?=$user['user_id']?>" class="btn btn-default btn-xs"><i class="fa fa-pencil icon-only"></i></a></td>
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
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
