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

$pageTitle = $lang['cp_logout'];
include(CORE_DIR . '/cp_header.php');

if($user->checkLogin()) {
	// Logout, just destroy the session
	$user->Logout();
	
	// Refresh page, so the menu will turn back
	header('Location: ' . HOME_URL . 'panel/logout.php');
	die();
}
?>
						
			<div class="row" style="margin:40px 0">
				<div class="col-md-6 col-md-offset-3">
					
					<h1 class="center"><i class="fa fa-wrench"></i> Battlefield Play4free Servertool</h1>
					<hr />
					
					<div class="alert alert-success alert-block">
						<h4><i class="fa fa-check"></i> <?=$lang['word_ok']?></h4>
						<p><?=$lang['cp_logout_success']?></p>
						<br />
						<p><a href="<?=HOME_URL?>panel/login.php" class="btn btn-success btn-sm btn-block"><i class="fa fa-key"></i> <?=$lang['cp_login']?></a></p>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
