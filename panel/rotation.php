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
if($userInfo['rights_server'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = $lang['tool_mrot'];
include(CORE_DIR . '/cp_header.php');

// Connect to server
use T4G\BFP4F\Rcon as rcon;
$rc->connect($cn, $cs);
$rc->init();

// Class with maps and gamemodes
$cmg = new GameMaps();

$status = '';

// If form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rotation']) && isset($_POST['rpm'])) {
	sleep(2);
	
	$errors = array();
	
	// Some checks
	
	$maps = array( );
	$rotation = array( );
	
	// Check rotation
	if(!is_array($_POST['rotation'])) {
		$errors[] = $lang['tool_mrot_err1'];
	} else {
		if(count($_POST['rotation']) == 0) {
			$errors[] = $lang['tool_mrot_err2'];
		} else {
			foreach($_POST['rotation'] as $map) {
				$rotation[] = explode('|', $map);
			}
		}
	}
	// Check rpm
	if(!is_numeric($_POST['rpm'])) {
		$errors[] = $lang['tool_sl_err3'];
	} else {
		$_POST['rpm'] = round($_POST['rpm']);
	}
	
	// Check errors and stuff
	if(count($errors) == 0) {
				
		if(updateSetting('tool_mrot_rpm', $_POST['rpm'])) {
			
			$sv = new rcon\Server();
			
			$sv->clearRotation();
			foreach($rotation as $map) {
				$sv->appendMap($map[0], $map[1]);
			}
			$sv->setNumOfRounds($_POST['rpm']);
			$rc->query('exec maplist.save');

			$status = '<div class="alert alert-success alert-block"><h4><i class="fa fa-check"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_settings_saved'] . '</p></div>';
			$log->insertActionLog($userInfo['user_id'], 'Map rotation edited');

		} else {
			$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $result['message'] . '</p></div>';
		}
		
	} else {
		$status = '<div class="alert alert-danger alert-block"><h4><i class="fa fa-times"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_error'] . '</p><ul><li>' . implode('</li><li>', $errors) . '</li></ul></div>';
	}
}

// Fetch the current rotation
$mapsArray = explode("\n", $rc->query("maplist"));

$curRot = array( );

foreach($mapsArray as $map) {
	preg_match('/([0-9]+)(: )(")([a-zA-Z_]+)(")( )([a-zA-Z_-]+)( )([0-9]+)/', $map, $matches);
	
	$curRot[] = array(
		'index' => $matches[0],
		'name' => $matches[4],
		'gamemode' => $matches[7],
		'players' => $matches[9],
	);
	
}
?>

			<!--
				INLINE CSS FOR THIS PAGE
			-->
			<style>
			#currentRotation tr:hover {
				cursor: n-resize
			}
			</style>
			
			<!--
				INLINE JAVASCRIPT FOR THIS PAGE
			-->
			<script>
			$(function() {
				$('#currentRotation').sortable();
			});
			
			function appendRotation(map, gamemode, mapAlt, gamemodeAlt) {
				
				$('#currentRotation').append('<tr><input type="hidden" name="rotation[]" value="' + mapAlt + '|' + gamemodeAlt + '" /><td>' + map + '</td><td>' + gamemode + '</td><td class="center"><a href="javascript:;" onclick="$(this).parent().parent().remove()" class="btn btn-danger btn-xs"><i class="fa fa-times icon-only"></i></a></td></tr>')
				
			}
			</script>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-pencil"></i> <?=$lang['tool_mrot']?></h2>
					<hr />
					
					<?=$status?>
					
					<div class="row">
						<div class="col-md-5 center">
							<h3><?=$lang['tool_mrot_available']?></h3>
							
							<div class="alert alert-info"><i class="fa fa-lightbulb-o"></i> <?=$lang['tool_mrot_help1']?></div>
							
							<select class="form-control" size="20">
							
<?php
foreach($cmg->combos as $key => $value) {
?>
								<optgroup label="<?=$lang['tool_mrot_gamemode']?>: <?=$cmg->getGameMode($key)?>">
<?php
	foreach($value as $map) {
?>
									<option onclick="appendRotation('<?=$cmg->getMapName($map)?>','<?=$cmg->getGameMode($key)?>','<?=$map?>','<?=$key?>')"><?=$cmg->getMapName($map)?></a></option>
<?php
	}
?>
								</optgroup>
<?php
}
?>
							</select>
						</div>
						
						<form action="" class="col-md-7 form-horizontal center" method="post">
							<h3><?=$lang['tool_mrot_current']?></h3>
							
							<div class="alert alert-info"><i class="fa fa-lightbulb-o"></i> <?=$lang['tool_mrot_help2']?></div>
							
							<table class="table table-bordered table-hover table-striped">
								
								<thead>
									<tr>
										<th><?=$lang['tool_mrot_map']?></th>
										<th><?=$lang['tool_mrot_gamemode']?></th>
										<th><?=$lang['word_actions']?></th>
									</tr>
								</thead>
								
								<tbody id="currentRotation">
<?php
foreach($curRot as $map) {
?>
									<tr>
										<input type="hidden" name="rotation[]" value="<?=$map['name']?>|<?=$map['gamemode']?>" />
										<td><?=$cmg->getMapName($map['name'])?></td>
										<td><?=$cmg->getGameMode($map['gamemode'])?></td>
										<td class="center"><a href="javascript:;" onclick="$(this).parent().parent().remove()" class="btn btn-danger btn-xs"><i class="fa fa-times icon-only"></i></a></td>
									</tr>
<?php
}
?>

								</tbody>
							</table>
								
							<hr />
							
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=$lang['tool_mrot_rpm']?></label>
	 							<div class="col-sm-9">
									<input type="text" name="rpm" value="<?=$settings['tool_mrot_rpm']?>" class="span2 form-control" maxlength="3" required />
								</div>
							</div>
							
							<hr />
							
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-4">
									<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> <?=$lang['btn_save']?></button>
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>