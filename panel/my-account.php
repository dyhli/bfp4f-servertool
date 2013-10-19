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

$pageTitle = $lang['cp_myaccount'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_name']) && isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['new_pass2'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check the length of the name
	if(strlen($_POST['user_name']) < 4) {
		$errors[] = $lang['cp_myaccount_err1'];
	}
	
	// Check if password fields are not blank
	if(!empty($_POST['old_pass']) && !empty($_POST['new_pass'])) {
		if(hash('sha256', $_POST['old_pass']) !== $userInfo['user_password']) {
			$errors[] = $lang['cp_myaccount_err2'];
		}
		if(strlen($_POST['new_pass']) < 6) {
			$errors[] = $lang['cp_myaccount_err3'];
		}
		if($_POST['new_pass'] !== $_POST['new_pass2']) {
			$errors[] = $lang['cp_myaccount_err4'];
		}
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
		
		$result = $user->updateAccount($_POST['user_name'], $_POST['new_pass']);
		
		if($result['code'] == 'OK') {
			$status = '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
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
					
					<h2><i class="icon-user"></i> <?=$lang['cp_myaccount']?> <small><?=$lang['cp_myaccount_subtitle']?></small></h2>
					<hr />
					
					<?=$status?>
					
					<form action="<?=HOME_URL?>panel/my-account" method="post" class="form-horizontal">
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['cp_username']?></label>
							<div class="controls">
								<input type="text" class="input-block-level" value="<?=$userInfo['user_username']?>" disabled />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['word_name']?></label>
							<div class="controls">
								<input type="text" name="user_name" class="input-block-level" value="<?=$userInfo['user_name']?>" required />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl1']?></small>
								</span>
							</div>
						</div>
						
						<hr />
						
						<div class="alert alert-info">
							<i class="icon-lightbulb"></i>
							<?=$lang['cp_myaccount_expl2']?>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-lock"></i> <?=$lang['cp_myaccount_oldpass']?></label>
							<div class="controls">
								<input type="password" name="old_pass" class="input-block-level" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-lock"></i> <?=$lang['cp_myaccount_newpass']?></label>
							<div class="controls">
								<input type="password" name="new_pass" class="input-block-level" />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl3']?></small>
								</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-lock"></i> <?=$lang['cp_myaccount_newpass']?></label>
							<div class="controls">
								<input type="password" name="new_pass2" class="input-block-level" />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl4']?></small>
								</span>
							</div>
						</div>
						
						<br />
						
						<button class="btn btn-inverse pull-right" type="submit"><i class="icon-save"></i> <?=$lang['btn_save']?></button>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
