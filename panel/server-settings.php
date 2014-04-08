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

$pageTitle = $lang['tool_svset'];
include(CORE_DIR . '/cp_header.php');

// Connect to server
use T4G\BFP4F\Rcon as rcon;
$rc->connect($cn, $cs);
$rc->init();

$status = '';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sv_ranked']) &&  isset($_POST['sv_name']) && isset($_POST['sv_welcome']) && isset($_POST['sv_banner'])) {
	
	sleep(2);
	
	$errors = array( );
	
	// Check server ranked
	if($_POST['sv_ranked'] != '1') {
		$_POST['sv_ranked'] = '0';
	}
	// Check server name
	if(strlen($_POST['sv_name']) < 3 || strlen($_POST['sv_name']) > 50) {
		$errors[] = 'Server name: min. 3 and max. 50 characters';
	}
	// Unranked options
	if($_POST['sv_ranked'] == '0') {
		// Check autobalance
		if($_POST['sv_autobalance'] != '1') {
			$_POST['sv_autobalance'] = '0';
		}
		// Check ticketrat
		if(!is_numeric($_POST['sv_ticketrat'])) {
			$errors[] = 'Ticketratio is not a number';
		}
	} else {
		// Back to defaults
		$_POST['sv_ticketrat'] = '100';
		$_POST['sv_autobalance'] = '1';
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
		
		$rc->query("exec sv.ranked " . $_POST['sv_ranked']);
		$rc->query("exec sv.serverName " . $_POST['sv_name']);
		$rc->query("exec sv.welcomeMessage " . $_POST['sv_welcome']);
		$rc->query("exec sv.bannerUrl " . $_POST['sv_banner']);
		$rc->query("exec sv.autoBalanceTeam " . $_POST['sv_autobalance']);
		$rc->query("exec sv.ticketRatio " . $_POST['sv_ticketrat']);
		$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>Your server configuration is saved. Please restart the server to apply these settings. The settings below are still the <b>old</b> settings.</p></div>';
		$log->insertActionLog($userInfo['user_id'], 'Server settings edited');
		
	} else {
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
}
?>
			
			<script>
			function checkUnranked() {
				if($('#ranking').val() == '0') {
					$('#unrankedOptions').slideDown();
				} else {
					$('#unrankedOptions').slideUp();
				}
			}
			checkUnranked();
			</script>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<h2><i class="fa fa-cogs"></i> <?=$lang['tool_svset']?> <small><?=$lang['tool_svset_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/server-settings.php" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-hdd-o"></i> Server status</label>
 							<div class="col-sm-9">
								<select name="sv_ranked" id="ranking" class="selectpicker show-tick" data-width="100%" onchange="checkUnranked()" required>
									<option value="1" data-icon="fa fa-star">Ranked</option>
									<option value="0" data-icon="fa fa-star-o"<?=(($rc->query("exec sv.ranked") == '0') ? ' selected' : '')?>>Unranked</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-hdd-o"></i> Server name</label>
 							<div class="col-sm-9">
								<input type="text" name="sv_name" class="form-control" value="<?=$rc->query("exec sv.serverName")?>" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-comment"></i> Welcome message</label>
 							<div class="col-sm-9">
								<input type="text" name="sv_welcome" class="form-control" value="<?=$rc->query("exec sv.welcomeMessage")?>" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-picture-o"></i> Banner URL</label>
 							<div class="col-sm-9">
								<input type="text" name="sv_banner" class="form-control" value="<?=$rc->query("exec sv.bannerUrl")?>" onkeyup="$('#svBanner').attr('src',$(this).val())" required />
								<span class="help-block">
									<small><a href="javascript:;" onclick="$('input[name=sv_banner]').val('https://battlefieldtools.com/assets/img/servers/servertool.png');$('#svBanner').attr('src','https://battlefieldtools.com/assets/img/servers/servertool.png')">Use our servertoolbanner</a></small>
								</span>
							</div>
						</div>
						
						<div class="form-group center">
							<img src="<?=$rc->query("exec sv.bannerUrl")?>" id="svBanner" alt="Banner" class="img-thumbnail" />
						</div>
						
						<div id="unrankedOptions" style="display:none">
							
							<br />
							<h3><i class="fa fa-star-o"></i> Unranked options</h3>
							<hr />
							
							<div class="form-group">
								<label class="col-sm-3 control-label"><i class="fa fa-group"></i> Autobalance</label>
	 							<div class="col-sm-9">
									<select name="sv_autobalance" class="selectpicker show-tick" data-width="100%" required>
										<option value="1" data-icon="fa fa-check">Enabled</option>
										<option value="0" data-icon="fa fa-times"<?=(($rc->query("exec sv.autoBalanceTeam") == '0') ? ' selected' : '')?>>Disabled</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label"><i class="fa fa-ticket"></i> Ticket ratio</label>
	 							<div class="col-sm-9">
									<input type="text" name="sv_ticketrat" class="form-control" value="<?=$rc->query("exec sv.ticketRatio")?>" required />
								</div>
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
