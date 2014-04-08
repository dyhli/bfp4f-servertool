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
 
require_once('../../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_server'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// Timed messages
$tmsg = new TimedMessages($db, $config);

$pageTitle = $lang['tool_tmsg'];
include(CORE_DIR . '/cp_header.php');

if(isset($_GET['id'])) {
	$msg = $tmsg->fetchMessage($_GET['id']);
} else {
	$msg = $tmsg->fetchMessage(0);
}

if($msg['code'] == 'OK') {
	
	$msg = $msg['msg'];
	
	$status = '';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['msg']) && isset($_POST['time']) && isset($_POST['active'])) {
		
		sleep(2);
		
		$errors = array();
		
		// Clean the post variables
		foreach ($_POST as $key => $value) {
			$_POST[$key] = trim($value);	
		}
		
		// Some checks
		
		// Check time
		if(!in_array($_POST['time'], range(30, 600, 30))) {
			$errors[] = $lang['tool_tmsg_err3'];
		}
		// Check response
		if(strlen($_POST['msg']) > 150) {
			$errors[] = $lang['tool_tmsg_err2'];
		}
		// Set the rights values
		if(isset($_POST['active'])) {
			$_POST['active'] = 'yes';
		} else {
			$_POST['active'] = 'no';
		}
		
		// Check errors and stuff
		if(count($errors) == 0) {
			
			$result = $tmsg->updateMessage($msg['msg_id'], array(
				'msg_content' => $_POST['msg'],
				'msg_time' => $_POST['time'],
				'msg_active' => $_POST['active'],
			));
			
			if($result == 'OK') {
				$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
				$msg = $tmsg->fetchMessage($_GET['id']);
				$msg = $msg['msg'];
				$log->insertActionLog($userInfo['user_id'], 'Timed message ' . strtolower($_GET['id']) . ' updated');
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
					
					<h2><i class="fa fa-pencil"></i> <?=$lang['tool_tmsg_edit']?> <small><?=$lang['tool_tmsg']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/tmsg" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<form action="" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-bullhorn"></i> <?=$lang['tool_tmsg_msg']?></label>
							<div class="col-sm-9">
								<input type="text" name="msg" class="form-control" value="<?=$msg['msg_content']?>" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-clock-o"></i> <?=$lang['tool_tmsg_freq']?></label>
							<div class="col-sm-9">
								<select name="time" class="selectpicker show-tick" data-width="100%" data-show-subtext="true" required>
<?php
foreach(range(30, 600, 30) as $time) {
?>
									<option data-icon="fa fa-clock-o" value="<?=$time?>"<?=(($time == $msg['msg_time']) ? ' selected' : '')?>><?=replace($lang['tool_tmsg_opt'], array('%s%' => $time))?></option>
<?php
}
?>
								</select>
							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" name="active" <?=(($msg['msg_active'] == 'yes') ? 'checked ' : '')?>/> <span><?=$lang['tool_tmsg_help1']?></span></label>
								</div>
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
<?php
} else {
?>
			<div class="row-fluid">
				<div class="span8 offset2">
					
					<h2><i class="fa fa-pencil"></i> <?=$lang['tool_tmsg_edit']?> <small><?=$lang['tool_tmsg']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/igcmds" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<div class="alert alert-danger alert-block">
						<h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>
						<p><?=$msg['message']?></p>
					</div>
					
				</div>
			</div>
<?php	
} include(CORE_DIR . '/cp_footer.php'); ?>
