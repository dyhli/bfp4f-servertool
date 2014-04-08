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

$pageTitle = 'Livechat support';
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<h2><i class="fa fa-comments"></i> Livechat support <small>Ultra-fast support</small></h2>
					<hr />
					
					<p>Please not that this page is NOT translated and is English only.</p>
					
					<hr />
					
					<div class="row">
					
						<div class="col-md-6">
							<h3>Request support from our staff</h3>
							<div id="lhc_status_container_page" ></div>
						</div>
						
						<div class="col-md-6">
							<h3>Chat with other servertool users</h3>
							<div id="lhc_chatbox_embed_container" ></div>
						</div>
					
					</div>
					
					<script>
						var LHCChatOptionsPage = {};
						LHCChatOptionsPage.opt = {};
						LHCChatOptionsPage.attr = new Array();
						LHCChatOptionsPage.attr.push({'name':'From','value':'ServerTool <?=TOOL_VERSION?> - <?=HOME_URL?>','type':'hidden','size':150});
						(function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = '//battlefieldtools.com/support/livechat/index.php/chat/getstatusembed/(department)/6';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						})();
						
						var LHCChatboxOptionsEmbed = {hashchatbox:'servertool',identifier:'servertool'};
						(function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = '//battlefieldtools.com/support/livechat/index.php/chatbox/embed/(chat_height)/220';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						})();
					</script>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
