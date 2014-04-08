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
 
define('INSTALL_PAGE', true);
require_once('core/init.php');

$status = '';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['server_ip']) && isset($_POST['server_port']) && isset($_POST['rcon_pass']) && isset($_POST['name']) && isset($_POST['profile_id']) && isset($_POST['username']) && isset($_POST['pass'])) {
	
	sleep(2);
	
	$errors = array( );
	
	// Clean the post variables
	foreach($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	if(!@fsockopen($_POST['server_ip'], $_POST['server_port'], $cn, $cs, 3)) {
		$errors[] = 'Could not connect to the server, please try again and check your serverinformation';
	}
	$data = @json_decode(@file_get_contents("http://battlefield.play4free.com/en/profile/soldiers/" . $_POST['profile_id']), true);
	if(count($data['data']) == 0) {
		$errors[] = 'Invalid ProfileID';
	}
	if(strlen($_POST['name']) < 5) {
		$errors[] = 'Name has to be at least 5 characters';
	}
	if(strlen($_POST['username']) < 5) {
		$errors[] = 'Username has to be at least 5 characters';
	}
	if(strlen($_POST['pass']) < 6) {
		$errors[] = 'Password has to be at least 6 characters';
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
		
		$sql = replace(file_get_contents('SQL.TXT'), array(
			'{%prefix%}' => $config['db_prefix'],
			'{%sv_ip%}' => encrypt($_POST['server_ip']),
			'{%sv_port%}' => encrypt($_POST['server_port']),
			'{%sv_pass%}' => encrypt($_POST['rcon_pass']),
			'{%profile_id%}' => $_POST['profile_id'],
			'{%name%}' => $_POST['name'],
			'{%username%}' => $_POST['username'],
			'{%password%}' => hash('sha256', $_POST['pass']),
		));
		
		if($db->multi_query($sql)) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> Success!</h4><p>Installation succesful, please delete install.php and SQL.TXT<br /><br /><a href="' . HOME_URL . '">Continue &raquo;</a></p></div>';
		} else {
			$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> Oh oh!</h4><p>Installation failed (' . $db->error . '), please install the database manually using the following SQL:<br /><br /><textarea cols="150" rows="20" class="form-control">' . $sql . '</textarea></p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> Oh oh!</h4><p>The following error(s) occurred:</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
	
	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Installation | BattlefieldTools.com Servertool</title>
		
		<meta charset="<?=$lang['lang_charset']?>" />
		<meta name="author" content="BattlefieldTools.com" />
		
		<link rel="icon" type="image/png" href="<?=HOME_URL?>panel/img/favicon.png" />
		
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/default.css" />
		
		<script src="<?=HOME_URL?>panel/js/bootstrap.min.js"></script>
	</head>
	
	<body>

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-header-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=HOME_URL?>panel"><i class="fa fa-block fa-cog fa-spin blue"></i> BFP4F SERVERTOOL</a>
			</div>
			</div>
		</nav>
		
		<div class="container">
						
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<h1 class="center"><i class="fa fa-wrench"></i> Battlefield Play4free Servertool</h1>
					<h3 class="text-muted center">Installation</h3>
					<hr />
					
<?php
if($status != '') {
?>
					<?=$status?>
<?
} else {
?>
					
					<form action="<?=HOME_URL?>install.php" method="post" class="form-horizontal">
						
						<h3><i class="fa fa-hdd-o"></i> Server</h3>
						<hr />
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-hdd-o"></i> Server IP</label>
 							<div class="col-sm-9">
								<input type="text" name="server_ip" class="form-control" autofocus required />
							</div>
						</div>
												
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-hdd-o"></i> Server RCON port</label>
 							<div class="col-sm-9">
								<input type="text" name="server_port" class="form-control" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-lock"></i> Server RCON password</label>
 							<div class="col-sm-9">
								<input type="password" name="rcon_pass" class="form-control" required />
							</div>
						</div>
						
						<br />
						<h3><i class="fa fa-user"></i> Account</h3>
						<hr />
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-user"></i> Public name</label>
 							<div class="col-sm-9">
								<input type="text" name="name" class="form-control" required />
								<span class="help-block">
									<small>E.g. SharpBunny</small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-user"></i> BFP4F Profile ID a.k.a. nucleusID</label>
 							<div class="col-sm-9">
								<input type="text" name="profile_id" class="form-control" required />
								<span class="help-block">
									<small>E.g. (http://battlefield.play4free.com/en/profile/2567963101) => 2567963101</small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-user"></i> Username</label>
 							<div class="col-sm-9">
								<input type="text" name="username" class="form-control" required />
								<span class="help-block">
									<small>E.g. sharpbunny</small>
								</span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><i class="fa fa-lock"></i> Password</label>
 							<div class="col-sm-9">
								<input type="password" name="pass" class="form-control" required />
								<span class="help-block">
									<small>At least 6 characters</small>
								</span>
							</div>
						</div>
						
						<br />
						
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-7">
								<button type="submit" class="btn btn-block btn-success">Install! <i class="fa fa-arrow-right fa-right"></i></button>
							</div>
						</div>
													
					</form>
					
<?php
}
?>					
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
