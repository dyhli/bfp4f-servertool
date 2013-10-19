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

$pageTitle = $lang['tool_sl'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['ignvip']) && isset($_POST['max'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check status
	if($_POST['status'] != 'true' && $_POST['status'] != 'false') {
		$errors[] = $lang['tool_sl_err1'];
	}
	// Check ignvip
	if($_POST['ignvip'] != 'true' && $_POST['ignvip'] != 'false') {
		$errors[] = $lang['tool_sl_err2'];
	}
	// Check max
	if(!in_array($_POST['max'], range(0, 16))) {
		$errors[] = $lang['tool_sl_err3'];
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('tool_sl', $_POST['status']) && updateSetting('tool_sl_ignorevip', $_POST['ignvip']) && updateSetting('tool_sl_max', $_POST['max'])) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Shotgun limiter settings edited');
			
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
					
					<h2><i class="icon-ban-circle"></i> <?=$lang['tool_sl']?> <small><?=$lang['tool_sl_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/tool/sl" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<br />
						
						<div class="control-group">
							<label class="control-label"><i class="icon-cog"></i> <?=$lang['word.tool']?></label>
							<div class="controls">
								<select name="status" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="icon-remove"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="icon-ok"<?=(($settings['tool_sl'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-star"></i> <?=$lang['tool_gen_ignorevip']?></label>
							<div class="controls">
								<select name="ignvip" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="icon-remove"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="icon-ok"<?=(($settings['tool_sl_ignorevip'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<hr />
						
						<div class="control-group">
							<label class="control-label"><i class="icon-minus"></i> <?=$lang['tool_sl_max']?></label>
							<div class="controls">
								<select name="max" class="selectpicker show-tick" data-width="100%" required>
<?php
foreach(range(0, 16) as $amount) {
?>
									<option value="<?=$amount?>"<?=(($settings['tool_sl_max'] == $amount) ? ' selected' : '')?>><?=$amount?></option>
<?php
}
?>
								</select>
								<span class="help-block"><small><?=$lang['tool_sl_help1']?></small></span>
							</div>
						</div>
						
						<br />
						
						<button class="btn btn-inverse pull-right" type="submit"><i class="icon-save"></i> <?=$lang['btn_save']?></button> 
						<a href="<?=HOME_URL?>panel" class="btn btn-link pull-right"><i class="icon-arrow-left"></i> <?=$lang['btn_back']?></a>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
