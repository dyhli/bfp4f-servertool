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
 
// Don't redirect to installation page, even when the tool is not installed yet
define('INSTALL_PAGE', true);
 
require_once('core/init.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Servertool by SharpBunny</title>
		
		<meta charset="utf8" />
		
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?=HOME_URL?>panel/css/default.css" />
		
		<script src="<?=HOME_URL?>panel/js/jquery-1.9.1.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/bootstrap.min.js"></script>
		<script src="<?=HOME_URL?>panel/js/custom.js"></script>
	</head>
	
	<body>
		
		<div class="container">
			
			<div class="row-fluid">
				<div class="span10 offset1">
					
					<h1 class="center">
						<img src="<?=HOME_URL?>panel/img/Logo_Battlefield-Play4Free.png" alt="Battlefield Play4Free" />
						<br />
						<small>Bunny's ServerTool <?=TOOL_VERSION?></small>
					</h1>
					<hr />
					
					<p>Thank you for using my free servertool. I've put a lot of time and effort in this project, but of course it's not perfect and there are always things that can be improved / added. Please post all the bugs and your own suggestions in <a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank">the forum thread</a>.<br /><br />Help me with this tool by reporting bugs, posting suggestions and by donating!</p>
					
					<p><b>Current version:</b> <?=TOOL_VERSION?></p>
					
					<p class="center"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ES4X5T4623TEU" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="Donate" /></a></p>
					
					<hr />
					
					<div class="row-fluid">
						<div class="span6 offset3">
							<a href="<?=HOME_URL?>panel" class="btn btn-success btn-large btn-block">Continue to the panel <i class="icon-arrow-right"></i></a>
						</div>
					</div>
					
					<hr />
					
					<h2 class="center red" id="credits"><i class="icon-heart"></i> CREDITS <i class="icon-heart"></i></h2>
					
					<br />
					
					<p>Some guys who have helped me and I'd love to thank:</p>
					
					<br />
					
					<div class="row-fluid">
						<div class="span4">
							<h3 class="center">Developers</h3>
							<ul class="icons-ul">
								<li><i class="icon-li icon-user"></i>Danny Li &lt;SharpBunny&gt;<br />bfp4f.sharpbunny@gmail.com</li>
							</ul>
						</div>
						<div class="span4">
							<h3 class="center">Translators</h3>
							<ul class="icons-ul">
								<li><i class="icon-li icon-user"></i>SharpBunny - English & Nederlands</li>
								<li><i class="icon-li icon-user"></i>NommoPL - Polski</li>
								<li><i class="icon-li icon-user"></i>-SM-MED-NB93 - Français</li>
								<li><i class="icon-li icon-user"></i>Johncze - čeština</li>
								<li><i class="icon-li icon-user"></i>BeckerDerBro - Deutsch</li>
							</ul>
						</div>
						<div class="span4">
							<h3 class="center">Suggestions</h3>
							<ul class="icons-ul">
								<li><i class="icon-li icon-user"></i>kosamiitti - Attachment limiter</li>
								<li><i class="icon-li icon-user"></i>roennel - Server config</li>
								<li><i class="icon-li icon-user"></i>-SM-MED-NB93 - Extra weaponslot limiter</li>
							</ul>
						</div>
					</div>
					
					<br />
					
					<h3 class="muted">Thanks to...</h3>
					<ul class="icons-ul">
						<li><i class="icon-li icon-group"></i>BFP4F community, <i>for everything you guys have done</i></li>
						<li><i class="icon-li icon-group"></i>BJW, <i>for the awesome support and fun I had and still have</i></li>
						<li><i class="icon-li icon-user"></i>piqus.pl, <i>for the support and RCON class!</i></li>
						<li><i class="icon-li icon-user"></i>MR_MEANY, <i>for the graphicwork</i></li>
						<li><i class="icon-li icon-user"></i>VincentWhite, <i>for using his server to offer hosted versions</i></li>
						<li><i class="icon-li icon-user"></i>Medic_Alert, <i>for the support and some information he gave me</i></li>
						<br />
						<li><i class="icon-li icon-gift red"></i>All the people who have donated</li>
						<br />
						<li><i class="icon-li icon-coffee brown"></i>A lot of coffee... <small><i>and food... I LOVE FOOD! NOM NOM NOM!</i></small></li>
					</ul>
					
					<br />
					
					<h2 class="center">Thank you very much and enjoy!</h2>
				</div>
			</div>
			
			<footer class="row-fluid">
				<div class="span12">
					<hr />		
					<p class="muted"><a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=131825" target="_blank"><i class="icon-bookmark"></i> Bunnies' Battlefield</a> &middot; <a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank"><i class="icon-file-text"></i> Tool thread</a> &middot; <a href="https://github.com/dyhli/bfp4f-servertool/" target="_blank"><i class="icon-github"></i> View on GitHub</a> <span class="pull-right"><?=replace($lang['cp_footer_createdby'])?></span></p>
				</div>
			</footer>
			
		</div>
		
		
	</body>
</html>