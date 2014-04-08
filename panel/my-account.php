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
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
		} else {
			$status = '<div class="alert alert-error alert-block"><h4><i class="fa fa-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $result['message'] . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-error alert-block"><h4><i class="fa fa-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<h2><i class="fa fa-user"></i> <?=$lang['cp_myaccount']?> <small><?=$lang['cp_myaccount_subtitle']?></small></h2>
					<hr />
					
					<?=$status?>
					
					<form action="<?=HOME_URL?>panel/my-account.php" method="post" class="form-horizontal">
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-user"></i> <?=$lang['cp_username']?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="<?=$userInfo['user_username']?>" disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-user"></i> <?=$lang['word_name']?></label>
							<div class="col-sm-9">
								<input type="text" name="user_name" class="form-control" value="<?=$userInfo['user_name']?>" required />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl1']?></small>
								</span>
							</div>
						</div>
						
						<hr />
						
						<div class="alert alert-info">
							<i class="fa fa-lightbulb-o"></i>
							<?=$lang['cp_myaccount_expl2']?>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-lock"></i> <?=$lang['cp_myaccount_oldpass']?></label>
							<div class="col-sm-9">
								<input type="password" name="old_pass" class="form-control" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-lock"></i> <?=$lang['cp_myaccount_newpass']?></label>
							<div class="col-sm-9">
								<input type="password" name="new_pass" class="form-control" />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl3']?></small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-lock"></i> <?=$lang['cp_myaccount_newpass']?></label>
							<div class="col-sm-9">
								<input type="password" name="new_pass2" class="form-control" />
								<span class="help-block">
									<small><?=$lang['cp_myaccount_expl4']?></small>
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
