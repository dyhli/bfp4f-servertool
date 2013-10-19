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
 
require_once('../../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_limiters'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
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
			$status = '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Admin message settings edited');
			
			// Reload settings
			fetchSettings();
		} else {
			$status = '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $result['message'] . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<div class="row-fluid">
				<div class="span8 offset2">
					
					<h2><i class="icon-comment"></i> <?=$lang['tool_am']?> <small><?=$lang['tool_am_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/tool/am" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<br />
						
						<div class="control-group">
							<label class="control-label"><i class="icon-cog"></i> <?=$lang['word.tool']?></label>
							<div class="controls">
								<select name="status" class="selectpicker show-tick" data-width="100%" data-show-subtext="true" required>
<?php
foreach(array(0, 30, 60, 90, 120, 180, 240, 300) as $sec) {
	$input = $lang['tool_am_opt'];
	if($sec == 0) {
		$input = $lang['word_disabled'];
	}
?>
									<option value="<?=$sec?>"<?=(($settings['tool_am'] == $sec) ? ' selected' : '') . (($sec > 0) ? ' " data-icon="icon-time"' : 'data-icon="icon-remove"')?>><?=replace($input, array('%s%' => $sec))?></option>
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
						
						<div class="control-group">
							<label class="control-label"><i class="icon-comment"></i> <?=$lang['tool_am_online']?></label>
							<div class="controls">
								<input type="text" name="online" class="input-block-level" value="<?=$settings['tool_am_msg']?>" required />
								
								<span class="help-block">
									<small><?=$lang['tool_am_help2']?></small>
								</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-comment"></i> <?=$lang['tool_am_offline']?></label>
							<div class="controls">
								<input type="text" name="offline" class="input-block-level" value="<?=$settings['tool_am_msg_alt']?>" required />
								
								<span class="help-block">
									<small><?=$lang['tool_am_help3']?></small>
								</span>
							</div>
						</div>

						
						<br />
						
						<button class="btn btn-inverse pull-right" type="submit"><i class="icon-save"></i> <?=$lang['btn_save']?></button> 
						<a href="<?=HOME_URL?>panel" class="btn btn-link pull-right"><i class="icon-arrow-left"></i> <?=$lang['btn_back']?></a>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
