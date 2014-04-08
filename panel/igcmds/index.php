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
if($userInfo['rights_igcmds'] < 100) {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Fetch the in-game commands
$igc = new IgCommands(null, null, null, null, $db, $config, null, $settings);
$igcmds = $igc->getCommands();

$pageTitle = $lang['tool_igcmds'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-bullhorn"></i> <?=$lang['tool_igcmds']?> <small><?=$lang['tool_igcmds_desc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/igcmds/add.php" class="btn btn-success"><i class="fa fa-plus"></i> <?=$lang['btn_add']?></a> 
					<a href="<?=HOME_URL?>panel/igcmds/settings.php" class="btn btn-primary"><i class="fa fa-cog"></i> <?=$lang['tool_set']?></a>
					
					<hr />
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th><?=$lang['tool_igcmds_cmd']?></th>
									<th><?=$lang['tool_igcmds_func']?></th>
									<th><?=$lang['tool_igcmds_lvl']?></th>
									<th><?=$lang['tool_igcmds_active']?></th>
									<th><?=$lang['word_actions']?></th>
								</tr>
							</thead>
							
							<tbody>
							
<?php
if($igcmds['code'] == 'OK') {
	foreach($igcmds['cmds'] as $cmd) {
?>
								<tr id="cmd_<?=$cmd['cmd_id']?>">
									<td class="center"><?=$cmd['cmd_name']?></td>
									<td class="center"><?=$cmd['cmd_function']?></td>
									<td class="center"><?=$cmd['cmd_rights']?></td>
									<td class="center"><?=(($cmd['cmd_active'] == 'yes') ? $lang['word_yes'] : $lang['word_no'])?></td>
									<td class="center"><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteIgcmd', {'vars':{'id':'<?=$cmd['cmd_id']?>'},'onSuccess':function(){$('tr#cmd_<?=$cmd['cmd_id']?>').fadeOut()}})}" class="btn btn-xs btn-danger"><i class="fa fa-times icon-only"></i></a> <a href="<?=HOME_URL?>panel/igcmds/edit.php?id=<?=$cmd['cmd_id']?>" class="btn btn-default btn-xs"><i class="fa fa-pencil icon-only"></i></a></td>
								</tr>
<?php
	}
} else {
?>
								<tr>
									<td colspan="4"><?=getLang($cmd['message'])?></td>
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
