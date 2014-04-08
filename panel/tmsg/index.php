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
 
require_once('../../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_server'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Fetch the timed messages
$tmsg = new TimedMessages($db, $config);
$msgs = $tmsg->fetchMessages();

$pageTitle = $lang['tool_tmsg'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-comments"></i> <?=$lang['tool_tmsg']?> <small><?=$lang['tool_tmsg_desc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/tmsg/add.php" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a>
					
					<hr />
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th><?=$lang['tool_tmsg_msg']?></th>
									<th><?=$lang['tool_tmsg_freq']?></th>
									<th><?=$lang['tool_tmsg_active']?></th>
									<th><?=$lang['word_actions']?></th>
								</tr>
							</thead>
							
							<tbody>
							
<?php
if($msgs['code'] == 'OK') {
	foreach($msgs['msg'] as $msg) {
?>
								<tr id="msg_<?=$msg['msg_id']?>">
									<td><?=$msg['msg_content']?></td>
									<td class="center"><?=$msg['msg_time']?> <?=$lang['tool_tmsg_secs']?></td>
									<td class="center"><?=(($msg['msg_active'] == 'yes') ? $lang['word_yes'] : $lang['word_no'])?></td>
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteTmsg', {'vars':{'id':'<?=$msg['msg_id']?>'},'onSuccess':function(){$('tr#msg_<?=$msg['msg_id']?>').fadeOut()}})}" class="btn btn-xs btn-danger"><i class="fa fa-times icon-only"></i></a> <a href="<?=HOME_URL?>panel/tmsg/edit.php?id=<?=$msg['msg_id']?>" class="btn btn-default btn-xs"><i class="fa fa-pencil icon-only"></i></a></td>
								</tr>
<?php
	}
} else {
?>
								<tr>
									<td colspan="4"><?=getLang($msgs['message'])?></td>
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
