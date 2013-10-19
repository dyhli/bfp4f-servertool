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

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_vips'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

// Connect to server
use T4G\BFP4F\Rcon as rcon;
$rc->connect($cn, $cs);

$sv = new rcon\Server();

$pageTitle = $lang['tool_vipm'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span10 offset1">
					
					<h2><i class="icon-star orange"></i> <?=$lang['tool_vipm']?> <small><?=$lang['tool_vipm_desc']?></small></h2>
					<hr />

					<a href="javascript:;" onclick="$('#addVip').slideToggle()" class="btn btn-success"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
					
					<form id="addVip" style="display:none">
						<hr />
						<div class="row-fluid">
							<div class="span4 offset1">
								<?=$lang['word_playername']?>:<br />
								<input type="text" id="v1" class="input-block-level" required />
							</div>
							<div class="span3">
								<?=$lang['word_profileid']?>:<br />
								<input type="text" id="v2" class="input-block-level" required />
								<small><a href="https://github.com/dyhli/bfp4f-servertool/wiki/Q&A#wiki-qa3" target="_blank"><?=$lang['word_qa']?>: <?=$lang['qa'][1]['question']?></a></small>
							</div>
							<div class="span2">
								<br />
								<a href="javascript:;" onclick="$.executeCmd('addVip',{'vars':{'name':$('#addVip #v1').val(),'profileId':$('#addVip #v2').val()},'onSuccess':function(){resetForm('addVip')}})" class="btn btn-success btn-block"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
							</div>
						</div>
					</form>
					
					<hr />
					
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th><?=$lang['word_playername']?></th>
								<th><?=$lang['word_profileid']?></th>
								<th><?=$lang['word_actions']?></th>
							</tr>
						</thead>
						
						<tbody>
							
<?php
if(!$rc->init()) {
?>
							<tr>
								<td colspan="3"><?=$lang['msg_serverdown'] . ' ' . date($settings['cp_date_format_full'], $settings['server_last_stream'])?></td>
							</tr>
<?php
} else {
	$result = $sv->fetchVips();
	
	if(count($result) > 0) {
		$i = 0;
		foreach($result as $vip) {
?>
							<tr id="vip_<?=$i?>">
								<td><a href="http://battlefield.play4free.com/en/profile/<?=$vip['profileId']?>" target="_blank"><?=$vip['playerName']?></a></td>
								<td><?=$vip['profileId']?></td>
								<td><a href="javascript:;" onclick="if(confirm('<?=$lang['msg_sure']?>')){$.executeCmd('deleteVip', {'vars':{'name':'<?=$vip['playerName']?>','profileId':'<?=$vip['profileId']?>','onSuccess':function(){$('tr#vip_<?=$i?>').fadeOut()}}})}" class="btn btn-small btn-danger"><i class="icon-remove icon-only"></i></a></td>
							</tr>
<?php
			$i++;
		}
	} else {
?>
							<tr>
								<td colspan="3"><?=$lang['tool_vipm_notfound']?></td>
							</tr>
<?php
	}
}
?>
							
						</tbody>
					</table>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
