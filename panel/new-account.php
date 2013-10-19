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

$pageTitle = $lang['tool_acc_add'];
include(CORE_DIR . '/cp_header.php');

$status = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
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
		));
		
		if($result == 'OK') {
			$status = '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'User ' . strtolower($_POST['username']) . ' added');
		} else {
			$status = '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $result . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<div class="row-fluid">
				<div class="span8 offset2">
					
					<h2><i class="icon-plus green"></i> <?=$lang['tool_acc_add']?> <small><?=$lang['tool_acc']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/accounts" class="btn btn-inverse"><i class="icon-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<form action="" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['word_name']?></label>
							<div class="controls">
								<input type="text" name="name" class="input-block-level" required />
								<span class="help-block"><small><?=$lang['tool_acc_help1']?></small></span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['cp_username']?></label>
							<div class="controls">
								<input type="text" name="username" class="input-block-level" required />
								<span class="help-block"><small><?=$lang['tool_acc_help2']?></small></span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-user"></i> <?=$lang['word_profileid']?></label>
							<div class="controls">
								<input type="text" name="profileid" class="input-block-level" required />
								<span class="help-block"><small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small></span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label"><i class="icon-lock"></i> <?=$lang['cp_password']?></label>
							<div class="controls">
								<input type="password" name="password" class="input-block-level" required />
								<span class="help-block"><small><?=$lang['tool_acc_help3']?></small></span>
							</div>
						</div>
						
						<hr />
						
						<h4><?=$lang['tool_acc_rights']?></h4>
						
						<div class="row-fluid">
							<div class="span6">
								
								<p><label><span><input type="checkbox" name="fr1" /></span> <?=$lang['tool_acc_fr1']?></label></p>
								<p><label><span><input type="checkbox" name="fr2" /></span> <?=$lang['tool_acc_fr2']?></label></p>
								<p><label><span><input type="checkbox" name="fr3" /></span> <?=$lang['tool_acc_fr3']?></label></p>
								<p><label><span><input type="checkbox" name="fr4" /></span> <?=$lang['tool_acc_fr4']?></label></p>
								<p><label><span><input type="checkbox" name="fr5" /></span> <?=$lang['tool_acc_fr5']?></label></p>
								
							</div>
							
							<div class="span6">
								
								<p><label><span><input type="checkbox" name="fr6" /></span> <?=$lang['tool_acc_fr6']?></label></p>
								<p><label><span><input type="checkbox" name="fr7" /></span> <?=$lang['tool_acc_fr7']?></label></p>
								<p><label><span><input type="checkbox" name="fr8" /></span> <?=$lang['tool_acc_fr8']?></label></p>
								<p><label><span><input type="checkbox" name="fr9" /></span> <?=$lang['tool_acc_fr9']?></label></p>
								<p><label><span><input type="checkbox" name="fr10" /></span> <?=$lang['tool_acc_fr10']?></label></p>
								
							</div>
						</div>
						
						<hr />
						
						<button class="btn btn-success pull-right" type="submit"><i class="icon-plus"></i> <?=$lang['btn_add']?></button>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
