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

$pageTitle = $lang['tool_igcmds'];
include(CORE_DIR . '/cp_header.php');

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['votes']) && isset($_POST['ptime'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check status
	if(!in_array($_POST['votes'], range(1,32))) {
		$errors[] = $lang['tool_igcmds_err6'];
	}
	// Check online
	if(!in_array($_POST['ptime'], array(30, 60, 90, 120, 180, 210, 240, 270, 300))) {
		$errors[] = $lang['tool_igcmds_err7'];
	}
	// Active
	$_POST['active'] = 'false';
	if(isset($_POST['active'])) {
		$_POST['active'] = 'true';
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('tool_igcmds', $_POST['active']) && updateSetting('tool_igcmds_votes', $_POST['votes']) && updateSetting('tool_igcmds_ptime', $_POST['ptime'])) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'In-game command settings edited');
			
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
					
					<h2><i class="fa fa-cog"></i> <?=$lang['tool_set']?> <small><?=$lang['tool_igcmds']?></small></h2>
					<hr />
					
					<a href="<?=HOME_URL?>panel/igcmds" class="btn btn-primary"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
					
					<hr />
					
					<form action="" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-bullhorn"></i> <?=$lang['tool_igcmds_votes']?></label>
							<div class="col-sm-9">
								<select name="votes" class="selectpicker show-tick" data-width="100%" required>
<?php
foreach(range(1,32) as $num) {
?>
									<option value="<?=$num?>"<?=(($settings['tool_igcmds_votes'] == $num) ? ' selected' : '')?>><?=$num?></option>
<?php
}
?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-clock-o"></i> <?=$lang['tool_igcmds_polltime']?></label>
							<div class="col-sm-9">
								<select name="ptime" class="selectpicker show-tick" data-width="100%" required>
<?php
foreach(array(30, 60, 90, 120, 180, 210, 240, 270, 300) as $sec) {
?>
									<option value="<?=$sec?>"<?=(($settings['tool_igcmds_ptime'] == $sec) ? ' selected' : '') . (($sec > 0) ? ' data-icon="fa fa-clock-o"' : 'data-icon="fa fa-times"')?>><?=replace($lang['tool_igcmds_pt_opt'], array('%s%' => $sec))?></option>
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
									<label><input type="checkbox" name="active"<?=(($settings['tool_igcmds'] == 'true') ? ' checked' : '')?> /> <span><?=$lang['tool_igcmds_active']?></span></label>
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
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
