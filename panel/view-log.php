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
if($userInfo['rights_logs'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}
$pageTitle = $lang['tool_logs'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-clock-o"></i> <?=$lang['tool_logs']?> <small><?=$lang['tool_logs_desc']?></small></h2>
					<hr />
					
<?php
if(isset($_GET['log'])) {
	
	$result = $log->fetchLog($_GET['log']);
	
	if($result['code'] == 'OK') {
		
		$keysSet = false;
		$keys = array( );
		$values = array( );
		
		foreach($result['items'] as $value) {
			$values[] = $value;
			foreach($value as $key => $value) {
				if(!$keysSet) $keys[] = $key;
			}
			$keysSet = true;
		}
?>

					<h3><?=@$lang['tool_logs_' . $_GET['log']]?> <small><?=@$lang['tool_logs_' . $_GET['log']. '_desc']?></small></h3>
					<br />

					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
<?php
foreach($keys as $key) {
?>
									<th><?=$key?></th>
<?php
}
?>
								</tr>
							</thead>
							
							<tbody>
							
<?php
foreach($values as $value) {
?>
								<tr>
<?php
	foreach($keys as $key) {
?>
									<td><?=$value[$key]?></td>
<?php
	}
?>
								</tr>
<?php
}
?>
							
							</tbody>
						</table>
					</div>
<?php
	} else {
?>
					<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><p><?=getLang($result['message'])?></p></div>
<?php
	}
} else {
?>
					<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> <?=$lang['word_error']?></h4><p><?=$lang['tool_logs_err1']?></p></div>
<?php
}
?>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
