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
if($userInfo['rights_igcmds'] < 100) {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

// In-game command class
$igc = new IgCommands(null, null, null, null, $db, $config, null, $settings);

$pageTitle = $lang['tool_igcmds'];
include(CORE_DIR . '/cp_header.php');

if(isset($_GET['id'])) {
	$cmd = $igc->getCommand($_GET['id']);
} else {
	$cmd = $igc->getCommand(0);
}

if($cmd['code'] == 'OK') {
	
	$cmd = $cmd['cmd'];
	
	$status = '';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmd']) && isset($_POST['func']) && isset($_POST['response']) && isset($_POST['rights'])) {
		
		sleep(2);
		
		$errors = array();
		
		// Clean the post variables
		foreach ($_POST as $key => $value) {
			$_POST[$key] = trim($value);	
		}
		
		// Some checks
		
		// Check command
		if(empty($_POST['cmd'])) {
			$errors[] = $lang['tool_acc_err2'];
		}
		// Check if command exits
		$result = $igc->getCommand(strtolower($_POST['cmd']));
		if($result['code'] == 'OK' && strtolower($_POST['cmd']) != $cmd['cmd_name']) {
			$errors[] = $lang['tool_igcmds_err3'];
		}
		// Check function
		$cmds = $igc->getAvailableCmdFunctions();
		if(!isset($cmds[$_POST['func']])) {
			$errors[] = $lang['tool_igcmds_err4'];
		}
		// Check response
		if(strlen($_POST['response']) > 150) {
			$errors[] = $lang['tool_igcmds_err5'];
		}
		// Set the private response setting
		if(isset($_POST['response_priv'])) {
			$_POST['response_priv'] = 'yes';
		} else {
			$_POST['response_priv'] = 'no';
		}
		// Set the rights values
		if(isset($_POST['active'])) {
			$_POST['active'] = 'yes';
		} else {
			$_POST['active'] = 'no';
		}
		
		// Check igcmds_rights
		if(!in_array($_POST['rights'], range(0,100))) {
			$errors[] = $lang['tool_igcmds_err1'];
		}
		
		// Check errors and stuff
		if(count($errors) == 0) {
			
			$result = $igc->updateCommand($cmd['cmd_id'], array(
				'cmd_name' => strtolower($_POST['cmd']),
				'cmd_function' => $_POST['func'],
				'cmd_response' => $_POST['response'],
				'cmd_response_private' => $_POST['response_priv'],
				'cmd_rights' => $_POST['rights'],
				'cmd_active' => $_POST['active'],
			));
			
			if($result == 'OK') {
				$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
				$cmd = $igc->getCommand($_GET['id']);
				$cmd = $cmd['cmd'];
				$log->insertActionLog($userInfo['user_id'], 'Command ' . strtolower($_POST['cmd']) . ' updated');
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
					
					<h2><i class="fa fa-pencil"></i> <?=$lang['tool_igcmds_edit']?> <small><?=$lang['tool_igcmds']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/igcmds" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<form action="" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-bullhorn"></i> <?=$lang['tool_igcmds_cmd']?></label>
							<div class="col-sm-9">
								<input type="text" name="cmd" class="form-control" value="<?=$cmd['cmd_name']?>" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-bullhorn"></i> <?=$lang['tool_igcmds_func']?></label>
							<div class="col-sm-9">
								<select name="func" class="form-control" required>
<?php
foreach($igc->getAvailableCmdFunctions() as $key => $value) {
?>
									<option value="<?=$key?>"<?=(($key == $cmd['cmd_function']) ? ' selected' : '')?>><?=$key?>: <?=$value?></option>
<?php
}
?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" name="response_priv" <?=(($cmd['cmd_response_private'] == 'yes') ? 'checked ' : '')?>/> <span><?=$lang['tool_igcmds_help3']?></span></label>
								</div>
							</div>
 						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-comment"></i> <?=$lang['tool_igcmds_response']?></label>
							<div class="col-sm-9">
								<input type="text" name="response" value="<?=$cmd['cmd_response']?>" class="form-control" />
								<span class="help-block"><small><?=$lang['tool_igcmds_help2']?></small></span>
							</div>
						</div>
												
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-star"></i> <?=$lang['tool_igcmds_rights']?></label>
							<div class="col-sm-9">
								<select name="rights" class="form-control" required>
<?php
foreach(range(0, 100) as $lvl) {
?>
									<option value="<?=$lvl?>"<?=(($lvl == $cmd['cmd_rights']) ? ' selected' : '')?>><?=$lvl?></option>
<?php
}
?>
								</select>
								<span class="help-block"><?=$lang['tool_igcmds_help1']?></span>
							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" name="active" <?=(($cmd['cmd_active'] == 'yes') ? 'checked ' : '')?>/> <span><?=$lang['tool_igcmds_help4']?></span></label>
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
					
					<h2><i class="fa fa-pencil"></i> <?=$lang['tool_igcmds_edit']?> <small><?=$lang['tool_igcmds']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/igcmds" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<div class="alert alert-danger alert-block">
						<h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4>
						<p><?=$cmd['message']?></p>
					</div>
					
				</div>
			</div>
<?php	
} include(CORE_DIR . '/cp_footer.php'); ?>
