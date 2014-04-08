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
if($userInfo['rights_itemlist'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = $lang['tool_iteml'];
include(CORE_DIR . '/cp_header.php');

$list = new Itemlist($db, $config);
?>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-list"></i> <?=$lang['tool_iteml']?> <small><?=$lang['tool_iteml_desc']?></small></h2>
					<hr />
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Item cat</th>
									<th>Item subcat</th>
									<th>Item BFP4F ID</th>
									<th>Item name</th>
									<th>Item min. lvl</th>
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
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
