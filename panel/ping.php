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

$pageTitle = 'Ping';
include(CORE_DIR . '/cp_header.php');
?>
			
			<script>
				function checkPing() {
					$.get('<?=HOME_URL?>panel/ajax/ping.php', function(data) {
						$('#pingHtml').html(data.pingHtml);
						$('#pingHtml2').html(data.pingHtml2);
						if(data.status == 'OK') {
							$('#pingDesc').html(data.pingDesc);
							$('#pingDesc2').html(data.pingDesc2);
						} else {
							$('#pingDesc').html(data.msg);
							$('#pingDesc2').html(data.msg);
						}
					});
				}
				
				// Check ping every 4 seconds
				setInterval('checkPing()', 4000);
				
				// Check ping on page load
				checkPing();
			</script>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					
					<h2><i class="fa fa-signal"></i> <?=$lang['tool_ping']?> <small><?=$lang['tool_ping_desc']?></small></h2>
					<hr />
					
					<div class="center f1">
						<h3><?=$lang['tool_ping_info1']?></h3>
						<h1 id="pingHtml"><i class="fa fa-refresh fa-spin"></i></h1>
						<h3 id="pingDesc"></h3>
					</div>
					
					<hr />
					
					<div class="center f2">
						<h3><?=$lang['tool_ping_info3']?></h3>
						<h1 id="pingHtml2"><i class="fa fa-refresh fa-spin"></i></h1>
						<h3 id="pingDesc2"></h3>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
