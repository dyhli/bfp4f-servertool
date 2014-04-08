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
if($userInfo['rights_limiters'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = $lang['tool_pl'];
include(CORE_DIR . '/cp_header.php');

// Itemlist
$it = new Itemlist($db, $config);
$it2 = $it->fetchItems();
$items = $it2['items'];

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['ignvip']) && isset($_POST['kickmsg']) && isset($_POST['check'])) {
	
	sleep(2);
	
	$errors = array();
	
	// Clean the post variables
	foreach ($_POST as $key => $value) {
		$_POST[$key] = trim($value);	
	}
	
	// Some checks
	
	// Check status
	if($_POST['status'] != 'true' && $_POST['status'] != 'false') {
		$errors[] = $lang['tool_pl_err1'];
	}
	// Check ignvip
	if($_POST['ignvip'] != 'true' && $_POST['ignvip'] != 'false') {
		$errors[] = $lang['tool_pl_err2'];
	}
	
	// Check check
	if(!empty($_POST['check'])) {
		$checks = explode(',', $_POST['check']);
		foreach($checks as $item) {
			if(!isset($items[$item])) {
				$errors[] = replace($lang['tool_pl_err3'], array('%id%' => $item));
			}
		}
		
		$checks = json_encode($checks);
	} else {
		$checks = 'all';
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
		
		if(updateSetting('tool_pl', $_POST['status']) && updateSetting('tool_pl_ignorevip', $_POST['ignvip']) && updateSetting('tool_pl_msg', $_POST['kickmsg']) && updateSetting('tool_pl_items', $checks)) {
			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Prebuy limiter settings edited');
			
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
					
					<h2><i class="fa fa-ban"></i> <?=$lang['tool_pl']?> <small><?=$lang['tool_pl_desc']?></small></h2>
					<hr />

					<form action="<?=HOME_URL?>panel/tool/pl.php" method="post" class="form-horizontal">
						
						<?=$status?>
						
						<br />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-cog"></i> <?=$lang['word.tool']?></label>
							<div class="col-sm-9">
								<select name="status" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="fa fa-times"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="fa fa-check"<?=(($settings['tool_pl'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-star"></i> <?=$lang['tool_gen_ignorevip']?></label>
							<div class="col-sm-9">
								<select name="ignvip" class="selectpicker show-tick" data-width="100%" required>
									<option value="false" data-icon="fa fa-times"><?=$lang['word_disabled']?></option>
									<option value="true" data-icon="fa fa-check"<?=(($settings['tool_pl_ignorevip'] == 'true') ? ' selected' : '')?>><?=$lang['word_enabled']?></option>
								</select>

							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-comment"></i> <?=$lang['tool_gen_kick_msg']?></label>
							<div class="col-sm-9">
								<input type="text" name="kickmsg" class="form-control" value="<?=$settings['tool_pl_msg']?>" required />
								
								<span class="help-block">
									<small><?=$lang['tool_gen_help2']?></small>
								</span>
							</div>
						</div>
						
						<hr />
						
						<div class="form-group">
							<label class="control-label col-sm-3"><i class="fa fa-eye"></i> <?=$lang['tool_pl_check']?></label>
							<div class="col-sm-9">
								<input id="pl" name="check" />
								
								<script>
								$(function() {
									$('input#pl').tagsinput({
										itemValue: 'value',
										itemText: 'text',
										typeahead: {
									 		source: function(query) {
												return $.getJSON('<?=HOME_URL?>panel/ajax/fetchItems.php',{weapons:true});
											}
										}
									});
									
									// Insert the selected items
<?php
if($settings['tool_pl_items'] != 'all') {
	$fItems = json_decode($settings['tool_pl_items'], true);
	foreach($fItems as $item) {
?>
									$('input#pl').tagsinput('add',{"value":<?=$item?> ,"text":"<?=$items[$item]['item_name']?>"});
<?php
	}
}
?>
								});
								</script>
								<span class="help-block"><small><?=$lang['tool_pl_help1']?></small></span>
							</div>
						</div>
						
						<br />
						
						<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-save"></i> <?=$lang['btn_save']?></button> 
						<a href="<?=HOME_URL?>panel" class="btn btn-link pull-right"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a>
						
					</form>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
