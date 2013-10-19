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

$pageTitle = $lang['cp_logout'];
include(CORE_DIR . '/cp_header.php');

if($user->checkLogin()) {
	// Logout, just destroy the session
	$user->Logout();
	
	// Refresh page, so the menu will turn back
	header('Location: ' . HOME_URL . 'panel/logout');
	die();
}
?>
			
			<div class="row-fluid">
				<div class="span6 offset3">
					
					<h2><i class="icon-off"></i> <?=$lang['cp_logout']?></h2>
					<hr />
					
					<div class="alert alert-success alert-block">
						<h4><i class="icon-ok"></i> <?=$lang['word_ok']?></h4>
						<p><?=$lang['cp_logout_success']?></p>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
