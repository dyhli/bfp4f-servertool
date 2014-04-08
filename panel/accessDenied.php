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

$pageTitle = $lang['cp_norights'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<div class="alert alert-warning alert-block">
						<h4><i class="fa fa-exclamation-triangle"></i> <?=$lang['word_error']?></h4>
						<p><?=$lang['cp_norights_msg']?></p><br />
						<p><a href="javascript:;" onclick="history.go(-1)" class="btn btn-warning"><i class="fa fa-arrow-left"></i> <?=$lang['btn_back']?></a></p>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
