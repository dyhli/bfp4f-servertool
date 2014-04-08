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

$pageTitle = $lang['vcheck'];
include(CORE_DIR . '/cp_header.php');

// Set the namespace
use BT\API as Api;

// Define the class
$api = new Api\Base;

// Init
$api->init(
	'servertool',
	array(
		'cmd' => 'getVersions',
	)
);
// Execute command
$api->execute();
$data = $api->requestData;
?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<h2><i class="fa fa-refresh"></i> <?=$lang['vcheck']?></h2>
					<hr />
					
<?php
if($api->requestStatus[0] == 'success') {
	if(TOOL_VERSION == $data['latestVersion']['version']) {
?>
					<div class="alert alert-success"><i class="fa fa-check"></i> <?=$lang['vcheck_ok']?></div>
<?php
	} else {
?>
					<div class="alert alert-danger"><i class="fa fa-times"></i> <?=$lang['vcheck_old']?></div>
<?php	
	}
?>

					
					<div class="row">
						<div class="col-md-6 center">
							<h3><?=$lang['vcheck_current']?></h3>
							<h4><?=TOOL_VERSION?></h4>
						</div>
						<div class="col-md- center">
							<h3><?=$lang['vcheck_latest']?></h3>
							<h4><?=$data['latestVersion']['version']?></h4>
						</div>
					</div>
					
					<hr />
					
					<div class="center">
						
						<h4><a href="<?=$data['latestVersion']['download']?>" target="_blank"><?=$lang['vcheck_download']?> <?=$data['latestVersion']['version']?></a></h4>
						<h4><a href="<?=$data['latestVersion']['changelog']?>" target="_blank"><?=$lang['cp_menu_changelog']?> <?=$data['latestVersion']['version']?></a></h4>
						
						<hr />
						
						<h3><?=$lang['vcheck_notes']?></h3>
						<?=$data['latestVersion']['notes']?>
						
					</div>
<?php
} else {
?>
					<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><p><?=$lang['vcheck_err1']?>.<br /><?=$api->requestStatus[1]?></p></div>
<?php
}
?>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
