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
if($userInfo['rights_itemlist'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

$pageTitle = $lang['tool_iteml'];
include(CORE_DIR . '/cp_header.php');

$list = new Itemlist($db, $config);
?>
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-list"></i> <?=$lang['tool_iteml']?> <small><?=$lang['tool_iteml_desc']?></small></h2>
					<hr />
					
					<!--
						
					NOT SURE IF I'LL DELETE THIS PART ENTIRELY OR IMPLEMENT IT LATER...
					
					<a href="javascript:;" onclick="$('#addItem').slideToggle()" class="btn btn-success"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
					
					<form id="addItem" style="display:none">
						<hr />
						<div class="row-fluid">
							<div class="span2">
								Category:<br />
								<select class="input-block-level">
									<option value="weapon">Weapon</option>
									<option value="gadget">Gadget</option>
									<option value="attachment">Attachment</option>
								</select>
							</div>
							<div class="span2">
								Subcategory:<br />
								<select class="input-block-level">
									<option value="none">None</option>
									<option value="smg">SMG</option>
									<option value="ar">AR</option>
									<option value="sr">SR</option>
									<option value="lmg">LMG</option>
									<option value="shotgun">Shotgun</option>
									<option value="sidearm">Sidearm</option>
								</select>
							</div>
							<div class="span2">
								BFP4F item ID:<br />
								<input type="text" class="input-block-level" />
							</div>
							<div class="span4">
								Item name:<br />
								<input type="text" class="input-block-level" />
							</div>
							<div class="span2">
								Min. lvl:<br />
								<input type="text" class="input-block-level" />
							</div>
						</div>
						<div class="row-fluid">
							<div class="span2 offset10">
								<a href="javascript:;" onclick="$.bootstrapGrowl('Item was added!')" class="btn btn-success btn-block"><i class="icon-plus"></i> <?=$lang['btn_add']?></a>
							</div>
						</div>
					</form>
					
					<hr />
					
					-->
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Item cat</th>
								<th>Item subcat</th>
								<th>Item BFP4F ID</th>
								<th>Item name</th>
								<th>Item min. lvl</th>
								<!--<th><?=$lang['word_actions']?></th>-->
							</tr>
						</thead>
						
						<tbody>
							
<?php
$result = $list->fetchItems();

if($result['code'] == 'OK') {
	foreach($result['items'] as $item) {
?>
							<tr>
								<td><?=ucfirst($item['item_category'])?></td>
								<td><?=strtoupper($item['item_subcat'])?></td>
								<td><?=$item['item_bf_id']?></td>
								<td><?=$item['item_name']?></td>
								<td><?=$item['item_min_lvl']?></td>
								<!--<td><a href="" class="btn btn-small btn-danger"><i class="icon-remove icon-only"></i></a></td>-->
							</tr>
<?php
	}
} else {
?>
							<tr>
								<td colspan="5"><?=getLang($result['message'])?></td>
							</tr>
<?php
}
?>
							
						</tbody>
					</table>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
