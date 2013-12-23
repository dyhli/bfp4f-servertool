<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.6.0
 *
 * Copyright (C) 2013 <Danny Li> a.k.a. SharpBunny
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
	// Check bml
	//if(!preg_match('{(http://|https://)(www.)?(battlefield.play4free.com/bookmark/server:)([a-z0-9-]+)}', $_POST['bml'], $matches)) {
	//	$errors[] = $lang['tool_set_err5'];
	//}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('cp_default_lang', $_POST['lang']) && updateSetting('cp_date_format', $_POST['df']) && updateSetting('cp_date_format_full', $_POST['df_full']) && updateSetting('notify', $_POST['notifier']) && updateSetting('notify_email', $_POST['notify_email']) && updateSetting('iga_ad', $_POST['iga_ad'])) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Settings edited');
			
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
					
					<h2><i class="fa fa-wrench"></i> <?=$lang['tool_set']?> <small><?=$lang['tool_set_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/settings.php" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<h4><?=$lang['word_cp_full']?></h4>
						<br />
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-flag"></i> <?=$lang['tool_set_deflang']?></label>
 							<div class="col-sm-9">
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
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-clock-o"></i> <?=$lang['tool_set_df']?></label>
 							<div class="col-sm-9">
								<input type="text" name="df" class="form-control" value="<?=$settings['cp_date_format']?>" required />
								<span class="help-block">
									<small><?=$lang['tool_set_help1']?></small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-clock-o"></i> <?=$lang['tool_set_fdf']?></label>
 							<div class="col-sm-9">
								<input type="text" name="df_full" class="form-control" value="<?=$settings['cp_date_format_full']?>" required />
								<span class="help-block">
									<small><?=$lang['tool_set_help1']?></small>
								</span>
							</div>
						</div>
						
						<h4><?=$lang['tool_set_notifier']?></h4>
						<br />
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-exclamation-circle"></i> <?=$lang['tool_set_notifier']?></label>
							<div class="col-sm-9">
								<select name="notifier" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="fa fa-times"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="fa fa-check"<?=(($settings['notify'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-envelope"></i> <?=$lang['tool_set_notify_email']?></label>
							<div class="col-sm-9">
								<input type="email" name="notify_email" class="form-control" value="<?=$settings['notify_email']?>" required />
							</div>
						</div>
						<br />
						
						<h4>BattlefieldTools Servertool</h4>
						<br />
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-heart"></i> <?=$lang['tool_set_iga_ad']?></label>
							<div class="col-sm-9">
								<select name="iga_ad" class="selectpicker show-tick" data-width="100%" data-show-subtext="true" required>
<?php
foreach(array(0, 30, 60, 90, 120, 180, 240, 300) as $sec) {
	$input = $lang['tool_set_iga_ad_opt'];
	if($sec == 0) {
		$input = $lang['word_disabled'];
	}
?>
									<option value="<?=$sec?>"<?=(($settings['iga_ad'] == $sec) ? ' selected' : '') . (($sec > 0) ? ' data-subtext="' . $lang['word_ty'] . '" data-icon="fa fa-clock-o"' : 'data-icon="fa fa-times"')?>><?=replace($input, array('%s%' => $sec))?></option>
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
						
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-8">
								<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> <?=$lang['btn_save']?></button>
							</div>
						</div>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
