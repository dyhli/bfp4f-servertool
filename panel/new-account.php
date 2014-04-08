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

// Check his rights
if($userInfo['rights_superadmin'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = $lang['tool_acc_add'];
include(CORE_DIR . '/cp_header.php');

$status = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['profileid']) && isset($_POST['username']) && isset($_POST['igcmds_rights'])) {
	
	sleep(2);
	
	// Accounts class
	$acc = new Accounts($db, $config);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check name
	if(strlen($_POST['name']) < 5) {
		$errors[] = $lang['tool_acc_err1'];
	}
	// Check username
	if(strlen($_POST['username']) < 5 || !$acc->checkUsername($_POST['username'])) {
		$errors[] = $lang['tool_acc_help2'];
	}
	// Check profileid
	$data = json_decode(file_get_contents("http://battlefield.play4free.com/en/profile/soldiers/" . $_POST['profileid']), true);
	if(count($data['data']) == 0) {
		$errors[] = $lang['tool_acc_err5'];
	}
	// Check password
	if(strlen($_POST['password']) < 6) {
		$errors[] = $lang['tool_acc_err3'];
	}
	
	// Set the rights values
	foreach(range(1, 10) as $right) {
		if(isset($_POST['fr'.$right])) {
			$_POST['fr'.$right] = 'yes';
		} else {
			$_POST['fr'.$right] = 'no';
		}
	}
	
	// Check igcmds_rights
	if(!in_array($_POST['igcmds_rights'], range(0,100))) {
		$errors[] = $lang['tool_igcmds_err1'];
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
		
		$result = $acc->createUser(array(
			'user_profile_id' => $_POST['profileid'],
			'user_name' => $_POST['name'],
			'user_username' => strtolower($_POST['username']),
			'user_password' => hash('sha256', $_POST['password']),
			'rights_ingameadmin' => $_POST['fr1'],
			'rights_superadmin' => $_POST['fr2'],
			'rights_rcon' => $_POST['fr3'],
			'rights_blacklist' => $_POST['fr4'],
			'rights_vips' => $_POST['fr5'],
			'rights_server' => $_POST['fr6'],
			'rights_itemlist' => $_POST['fr7'],
			'rights_limiters' => $_POST['fr8'],
			'rights_logs' => $_POST['fr9'],
			'rights_whitelist' => $_POST['fr10'],
			'rights_igcmds' => $_POST['igcmds_rights'],
		));
		
		if($result == 'OK') {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'User ' . strtolower($_POST['username']) . ' added');
		} else {
			$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $result . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<h2><i class="fa fa-plus green"></i> <?=$lang['tool_acc_add']?> <small><?=$lang['tool_acc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/accounts.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<form action="" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-user"></i> <?=$lang['word_name']?></label>
							<div class="col-sm-9">
								<input type="text" name="name" class="form-control" required />
								<span class="help-block"><small><?=$lang['tool_acc_help1']?></small></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-user"></i> <?=$lang['cp_username']?></label>
							<div class="col-sm-9">
								<input type="text" name="username" class="form-control" required />
								<span class="help-block"><small><?=$lang['tool_acc_help2']?></small></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-user"></i> <?=$lang['word_profileid']?></label>
							<div class="col-sm-9">
								<input type="text" name="profileid" class="form-control" required />
								<span class="help-block"><small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-lock"></i> <?=$lang['cp_password']?></label>
							<div class="col-sm-9">
								<input type="password" name="password" class="form-control" required />
								<span class="help-block"><small><?=$lang['tool_acc_help3']?></small></span>
							</div>
						</div>
						
						<hr />
						
						<h4><?=$lang['tool_acc_rights']?></h4>
						
						<div class="row">
							<div class="col-md-6">
								
								<p><label><span><input type="checkbox" name="fr1" /></span> <?=$lang['tool_acc_fr1']?></label></p>
								<p><label><span><input type="checkbox" name="fr2" /></span> <?=$lang['tool_acc_fr2']?></label></p>
								<p><label><span><input type="checkbox" name="fr3" /></span> <?=$lang['tool_acc_fr3']?></label></p>
								<p><label><span><input type="checkbox" name="fr4" /></span> <?=$lang['tool_acc_fr4']?></label></p>
								<p><label><span><input type="checkbox" name="fr5" /></span> <?=$lang['tool_acc_fr5']?></label></p>
								
							</div>
							
							<div class="col-md-6">
								
								<p><label><span><input type="checkbox" name="fr6" /></span> <?=$lang['tool_acc_fr6']?></label></p>
								<p><label><span><input type="checkbox" name="fr7" /></span> <?=$lang['tool_acc_fr7']?></label></p>
								<p><label><span><input type="checkbox" name="fr8" /></span> <?=$lang['tool_acc_fr8']?></label></p>
								<p><label><span><input type="checkbox" name="fr9" /></span> <?=$lang['tool_acc_fr9']?></label></p>
								<p><label><span><input type="checkbox" name="fr10" /></span> <?=$lang['tool_acc_fr10']?></label></p>
								
							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-star"></i> <?=$lang['tool_igcmds_rights']?></label>
							<div class="col-sm-9">
								<select name="igcmds_rights" class="form-control" required>
<?php
foreach(range(0, 100) as $lvl) {
?>
									<option value="<?=$lvl?>"><?=$lvl?></option>
<?php
}
?>
								</select>
								<span class="help-block"><?=$lang['tool_igcmds_help1']?></span>
							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-8">
								<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> <?=$lang['btn_save']?></button>
							</div>
						</div>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
