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
if($userInfo['rights_limiters'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = $lang['tool_am'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['online']) && isset($_POST['offline'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check status
	if(!in_array($_POST['status'], array(0, 30, 60, 90, 120, 180, 240, 300))) {
		$errors[] = $lang['tool_am_err1'];
	}
	// Check online
	if(empty($_POST['online'])) {
		$errors[] = $lang['tool_am_err2'];
	}
	// Check offline
	if(empty($_POST['offline'])) {
		$errors[] = $lang['tool_am_err3'];
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('tool_am', $_POST['status']) && updateSetting('tool_am_msg', $_POST['online']) && updateSetting('tool_am_msg_alt', $_POST['offline'])) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Admin message settings edited');
			
			// Reload settings
			fetchSettings();
		} else {
			$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $result['message'] . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<h2><i class="fa fa-comment"></i> <?=$lang['tool_am']?> <small><?=$lang['tool_am_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/tool/am.php" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<br />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-cog"></i> <?=$lang['word.tool']?></label>
							<div class="col-sm-9">
								<select name="status" class="selectpicker show-tick" data-width="100%" data-show-subtext="true" required>
<?php
foreach(array(0, 30, 60, 90, 120, 180, 240, 300) as $sec) {
	$input = $lang['tool_am_opt'];
	if($sec == 0) {
		$input = $lang['word_disabled'];
	}
?>
									<option value="<?=$sec?>"<?=(($settings['tool_am'] == $sec) ? ' selected' : '') . (($sec > 0) ? ' " data-icon="fa fa-clock-o"' : ' data-icon="fa fa-times"')?>><?=replace($input, array('%s%' => $sec))?></option>
<?php
}
?>
								</select>
								<span class="help-block">
									<small><?=$lang['tool_am_help1']?></small>
								</span>
							</div>
						</div>

						<hr />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-comment"></i> <?=$lang['tool_am_online']?></label>
							<div class="col-sm-9">
								<input type="text" name="online" class="form-control" value="<?=$settings['tool_am_msg']?>" required />
								
								<span class="help-block">
									<small><?=$lang['tool_am_help2']?></small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-comment"></i> <?=$lang['tool_am_offline']?></label>
							<div class="col-sm-9">
								<input type="text" name="offline" class="form-control" value="<?=$settings['tool_am_msg_alt']?>" required />
								
								<span class="help-block">
									<small><?=$lang['tool_am_help3']?></small>
								</span>
							</div>
						</div>

						
						<br />
						
						<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-save"></i> <?=$lang['btn_save']?></button> 
						<a href="<?=HOME_URL?>panel" class="btn btn-link pull-right"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
