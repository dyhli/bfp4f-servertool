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
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . getLang($result['message']) . '</p></div>';
	}
	
}
?>
						
			<div class="row" style="margin:40px 0">
				<div class="col-md-6 col-md-offset-3">
					
					<h1 class="center"><i class="fa fa-wrench"></i> Battlefield Play4free Servertool</h1>
					<hr />
					
					<?=$status?>
					
					<form action="<?=HOME_URL?>panel/login.php" method="post" class="form-horizontal">
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-user"></i> <?=$lang['cp_username']?></label>
 							<div class="col-sm-9">
								<input type="text" name="username" class="form-control"<?=((isset($_COOKIE['User_UserName'])) ? ' value="' . $_COOKIE['User_UserName'] . '"' : '')?> autofocus required />
							</div>
						</div>
												
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-lock"></i> <?=$lang['cp_password']?></label>
 							<div class="col-sm-9">
								<input type="password" name="password" class="form-control" required />
							</div>
						</div>
						
						<br />
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" name="remember" /> <span><?=$lang['cp_login_remember']?></span></label>
								</div>
							</div>
 						</div>
						
						<br />
						
						<div class="form-group">
							<div class="col-sm-4">
								<a class="btn btn-block btn-default" href="<?=HOME_URL?>"><i class="fa fa-heart"></i> <?=$lang['cp_menu_credits']?></a>
							</div>
							<div class="col-sm-4 col-sm-offset-4">
								<button type="submit" class="btn btn-block btn-primary"><?=$lang['word_go']?> <i class="fa fa-arrow-right fa-right"></i></button>
							</div>
						</div>
													
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
