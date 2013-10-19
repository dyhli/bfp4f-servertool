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

// If user is logged in, redirect to dashboard
if($user->checkLogin()) {
	header('Location: ' . HOME_URL . 'panel');
	die();
}

$pageTitle = $lang['cp_login'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
	
	sleep(2);
	
	$result = $user->Login($_POST['username'], $_POST['password']);
	
	if($result['code'] == 'OK') {
		
		if(isset($_POST['remember'])) {
			setcookie('User_UserName', $_POST['username'], time()+31449600, '/');
		}
		
		header('Location: ' . HOME_URL . 'panel');
		die();
	} else {
		$status = '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . getLang($result['message']) . '</p></div>';
	}
	
}
?>
			
			<div class="row-fluid">
				<div class="span6 offset3 well">
					
					<h2><i class="icon-key"></i> <?=$lang['cp_login']?></h2>
					<hr />
					
					<?=$status?>
					
					<form action="<?=HOME_URL?>panel/login" method="post" class="form-horizontal">
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['cp_username']?></label>
							<div class="controls">
								<input type="text" name="username" class="input-block-level"<?=((isset($_COOKIE['User_UserName'])) ? ' value="' . $_COOKIE['User_UserName'] . '"' : '')?> autofocus required />
							</div>
						</div>
												
						<div class="control-group">
							<label class="control-label"><i class="icon-lock"></i> <?=$lang['cp_password']?></label>
							<div class="controls">
								<input type="password" name="password" class="input-block-level" required />
							</div>
						</div>
						
						<br />
						
						<div class="control-group">
							<div class="controls">
								<label><input type="checkbox" name="remember" /> <span><?=$lang['cp_login_remember']?></span></label>
							</div>
						</div>
						
						<br />
						
						<button class="btn btn-inverse pull-right" type="submit"><?=$lang['word_go']?> <i class="icon-arrow-right right"></i></button>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
