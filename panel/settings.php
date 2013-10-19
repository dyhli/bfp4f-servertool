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

$pageTitle = $lang['tool_set'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lang']) && isset($_POST['df']) && isset($_POST['df_full']) && isset($_POST['notifier']) && isset($_POST['notify_email']) && isset($_POST['iga_ad'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check if the language exists
	if(!file_exists(CORE_DIR . '/lang/' . $_POST['lang'] . '.php')) {
		$errors[] = replace($lang['tool_set_err1'], array('%lang%' => strtoupper($_POST['lang'])));
	}
	// Check notifier
	if($_POST['notifier'] != 'true' && $_POST['notifier'] != 'false') {
		$errors[] = $lang['tool_set_err3'];
	}
	// Check notify_email
	if($_POST['notifier'] == 'true') {
		if(!filter_var($_POST['notify_email'], FILTER_VALIDATE_EMAIL)) {
			$errors[] = $lang['tool_set_err4'];
		}
	}
	// Check iga_ad
	if(!in_array($_POST['iga_ad'], array(0, 30, 60, 90, 120, 180, 240, 300))) {
		$errors[] = $lang['tool_set_err2'];
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('cp_default_lang', $_POST['lang']) && updateSetting('cp_date_format', $_POST['df']) && updateSetting('cp_date_format_full', $_POST['df_full']) && updateSetting('notify', $_POST['notifier']) && updateSetting('notify_email', $_POST['notify_email']) && updateSetting('iga_ad', $_POST['iga_ad'])) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Settings edited');
			
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
					
					<h2><i class="icon-wrench"></i> <?=$lang['tool_set']?> <small><?=$lang['tool_set_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/settings" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<h4><?=$lang['word_cp_full']?></h4>
						<br />
												
						<div class="control-group">
							<label class="control-label"><i class="icon-flag"></i> <?=$lang['tool_set_deflang']?></label>
							<div class="controls">
								<select name="lang" class="selectpicker show-tick" data-width="100%" required>
<?php
foreach(glob(CORE_DIR . '/lang/*.php') as $b) {
?>
									<option value="<?=basename($b, '.php')?>"<?=(($settings['cp_default_lang'] == basename($b, '.php')) ? ' selected' : '')?>><?=strtoupper(basename($b, '.php'))?></option>
<?php
}
?>
								</select>

							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-time"></i> <?=$lang['tool_set_df']?></label>
							<div class="controls">
								<input type="text" name="df" class="input-block-level" value="<?=$settings['cp_date_format']?>" required />
								<span class="help-block">
									<small><?=$lang['tool_set_help1']?></small>
								</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-time"></i> <?=$lang['tool_set_fdf']?></label>
							<div class="controls">
								<input type="text" name="df_full" class="input-block-level" value="<?=$settings['cp_date_format_full']?>" required />
								<span class="help-block">
									<small><?=$lang['tool_set_help1']?></small>
								</span>
							</div>
						</div>
						
						<h4><?=$lang['tool_set_notifier']?></h4>
						<br />
						
						<div class="control-group">
							<label class="control-label"><i class="icon-exclamation-sign"></i> <?=$lang['tool_set_notifier']?></label>
							<div class="controls">
								<select name="notifier" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="icon-remove"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="icon-ok"<?=(($settings['notify'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-envelope"></i> <?=$lang['tool_set_notify_email']?></label>
							<div class="controls">
								<input type="email" name="notify_email" class="input-block-level" value="<?=$settings['notify_email']?>" required />
							</div>
						</div>
						<br />
						
						<h4><?=$lang['word_tool']?></h4>
						<br />
						
						<div class="control-group">
							<label class="control-label"><i class="icon-heart"></i> <?=$lang['tool_set_iga_ad']?></label>
							<div class="controls">
								<select name="iga_ad" class="selectpicker show-tick" data-width="100%" data-show-subtext="true" required>
<?php
foreach(array(0, 30, 60, 90, 120, 180, 240, 300) as $sec) {
	$input = $lang['tool_set_iga_ad_opt'];
	if($sec == 0) {
		$input = $lang['word_disabled'];
	}
?>
									<option value="<?=$sec?>"<?=(($settings['iga_ad'] == $sec) ? ' selected' : '') . (($sec > 0) ? ' data-subtext="' . $lang['word_ty'] . '" data-icon="icon-time"' : 'data-icon="icon-remove"')?>><?=replace($input, array('%s%' => $sec))?></option>
<?php
}
?>
								</select>
								<span class="help-block">
									<small><?=replace($lang['tool_set_iga_ad_help'], array('%msg%' => '<i>' . replace($settings['iga_ad_msg']) . '</i>'))?></small>
								</span>
							</div>
						</div>
						
						<br />
						
						<button class="btn btn-inverse pull-right" type="submit"><i class="icon-save"></i> <?=$lang['btn_save']?></button>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
