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

$pageTitle = $lang['cp_dashboard'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span12">
					
					<h2><i class="icon-home"></i> <?=$lang['cp_dashboard']?> <small><?=$lang['cp_dashboard_subtitle']?></small></h2>
					<hr />
					
					<?=$lang['word_welcome']?> <b><?=$userInfo['user_name']?></b>!
					
					<hr />
					
					<?=(($settings['server_status'] != 'up') ? '<div class="alert alert-error alert-block"><h4><i class="icon-remove"></i> ' . $lang['word_error'] . '</h4><p>' . $lang['msg_serverdown'] . ' <b>' . date($settings['cp_date_format_full'], $settings['server_last_stream']) . '</b></p></div>' : '<div class="alert alert-success alert-block"><h4><i class="icon-ok"></i> ' . $lang['word_ok'] . '</h4><p>' . $lang['msg_serverup'] . ' <b>' . date($settings['cp_date_format_full'], $settings['server_last_stream']) . '</b></p></div>')?>

					<hr />
					
					<div class="row-fluid">
						<div class="span3 center db-item<?=(($userInfo['rights_server'] == 'no') ? ' disabled' : '')?>">
							<h1 class="dark"><i class="icon-hdd icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/server"><?=$lang['tool_server']?></a></h3>
							<p><?=$lang['tool_server_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_vips'] == 'no') ? ' disabled' : '')?>">
							<h1 class="orange"><i class="icon-star icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/vips"><?=$lang['tool_vipm']?></a></h3>
							<p><?=$lang['tool_vipm_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_itemlist'] == 'no') ? ' disabled' : '')?>">
							<h1 class="dark"><i class="icon-list icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/itemlist"><?=$lang['tool_iteml']?></a></h3>
							<p><?=$lang['tool_iteml_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_superadmin'] == 'no') ? ' disabled' : '')?>">
							<h1 class="dark"><i class="icon-wrench icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/settings"><?=$lang['tool_set']?></a></h3>
							<p><?=$lang['tool_set_desc']?></p>
						</div>
					</div>
					<br />
					<div class="row-fluid">
						<div class="span3 center db-item<?=(($userInfo['rights_whitelist'] == 'no') ? ' disabled' : '')?>">
							<h1 class="dark"><i class="icon-check icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/whitelist"><?=$lang['tool_wlist']?></a></h3>
							<p><?=$lang['tool_wlist_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_superadmin'] == 'no') ? ' disabled' : '')?>">
							<h1 class="dark"><i class="icon-group icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/accounts"><?=$lang['tool_acc']?></a></h3>
							<p><?=$lang['tool_acc_desc']?></p>
						</div>
						<div class="span3 center db-item">
							<h1 class="dark"><i class="icon-user icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/my-account"><?=$lang['cp_myaccount']?></a></h3>
							<p><?=$lang['cp_myaccount_subtitle']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_logs'] == 'no') ? ' disabled' : '')?>">
							<h1><i class="icon-archive brown icon-2x"></i></h1>
							<div class="dropdown">
								<a href="javascript:;" class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown"><h3><?=$lang['tool_logs']?></h3></a>
								<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel">
									<li><a href="<?=HOME_URL?>panel/view-log?log=autokick" target="_blank"><i class="icon-archive"></i> Autokicker log</a></li>
									<li><a href="<?=HOME_URL?>panel/view-log?log=cp_actions" target="_blank"><i class="icon-archive"></i> CP actions log</a></li>
								</ul>
							</div>
							<p><?=$lang['tool_logs_desc']?></p>
						</div>
					</div>
					
					<br />
										
					<div class="alert alert-info"><i class="icon-lightbulb"></i> <?=$lang['cp_dashboard_explination']?></div>
					
					<div class="row-fluid">
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'wl'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_wl'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/wl"><?=$lang['tool_wl']?></a></h3>
							<p><?=$lang['tool_wl_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'pl'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_pl'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/pl"><?=$lang['tool_pl']?></a></h3>
							<p><?=$lang['tool_pl_desc']?></p>
						</div>
						<div class="span3 center db-item disabled">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'al'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_al'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="javascript:;"><?=$lang['tool_al']?></a></h3>
							<p><?=$lang['tool_al_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'sl'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_sl'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/sl"><?=$lang['tool_sl']?></a></h3>
							<p><?=$lang['tool_sl_desc']?></p>
						</div>
					</div>
					<br />
					<div class="row-fluid">
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'ll'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_ll'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/ll"><?=$lang['tool_ll']?></a></h3>
							<p><?=$lang['tool_ll_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="$.executeCmd('toggleTool',{'vars':{'tool':'cl'}});$(this).find('i').toggleClass('icon-remove red icon-ok green')"><i class="<?=(($settings['tool_cl'] == 'true') ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/cl"><?=$lang['tool_cl']?></a></h3>
							<p><?=$lang['tool_cl_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="alert('<?=$lang['msg_db1']?>')"><i class="<?=(($settings['tool_am'] > 0) ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/am"><?=$lang['tool_am']?></a></h3>
							<p><?=$lang['tool_am_desc']?></p>
						</div>
						<div class="span3 center db-item<?=(($userInfo['rights_limiters'] == 'no') ? ' disabled' : '')?>">
							<h1><a href="javascript:;" onclick="alert('<?=$lang['msg_db1']?>')"><i class="<?=(($settings['tool_sm'] > 0) ? 'icon-ok green' : 'icon-remove red')?> icon-2x"></i></a></h1>
							<h3><a href="<?=HOME_URL?>panel/tool/sm"><?=$lang['tool_sm']?></a></h3>
							<p><?=$lang['tool_sm_desc']?></p>
						</div>
					</div>
					<br />
					<div class="row-fluid">
						<div class="span4 offset4 center db-item<?=(($userInfo['rights_blacklist'] == 'no') ? ' disabled' : '')?>">
							<h1><i class="icon-ban-circle red icon-2x"></i></h1>
							<h3><a href="<?=HOME_URL?>panel/blacklist"><?=$lang['tool_bl']?></a></h3>
							<p><?=$lang['tool_bl_desc']?></p>
							<p><i><?=$lang['tool_bl_warn1']?></i></p>
						</div>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
