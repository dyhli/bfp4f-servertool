<?php
/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.6.0
 *
 * Copyright (C) 2013 <Danny Li> a.k.a. SharpBunny
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
	
	<body style="margin-top:0">
		
		<div class="container">
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<h1 class="center">
						<img src="<?=HOME_URL?>panel/img/battlefieldtools-logo.png" alt="BattlefieldTools.com" />
						<br />
						<small>BattlefieldTools.com ServerTool <?=TOOL_VERSION?></small>
					</h1>
					<hr />
					
					<p>Thank you for using my free servertool. I've put a lot of time and effort in this project, but of course it's not perfect and there are always things that can be improved / added. Please post all the bugs and your own suggestions in <a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank">the forum thread</a>.<br /><br />Help me with this tool by reporting bugs, posting suggestions and by donating!</p>
					
					<p><b>Current version:</b> <?=TOOL_VERSION?></p>
					
					<p class="center"><a href="http://battlefieldtools.com/donate" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="Donate" /></a></p>
					
					<hr />
					
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<a href="<?=HOME_URL?>panel" class="btn btn-success btn-lg btn-block">Continue to the panel <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
					
					<hr />
					
					<h2 class="center red" id="credits"><i class="fa fa-heart"></i> CREDITS <i class="fa fa-heart"></i></h2>
					
					<br />
					
					<p>Some guys who have helped me and I'd love to thank:</p>
					
					<br />
					
					<div class="row">
						<div class="col-md-4">
							<h3 class="center">Developers</h3>
							<ul class="fa-ul">
								<li><i class="fa-li fa fa-user"></i>Danny Li &lt;SharpBunny&gt;<br />bunny@battlefieldtools.com</li>
								
								<li><i class="fa-li fa fa-group"></i>BattlefieldTools.com Staff</li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="center">Translators</h3>
							<ul class="fa-ul">
								<li><i class="fa-li fa fa-user"></i>SharpBunny - English & Nederlands</li>
								<li><i class="fa-li fa fa-user"></i>NommoPL - Polski</li>
								<li><i class="fa-li fa fa-user"></i>-SM-MED-NB93 - Français</li>
								<li><i class="fa-li fa fa-user"></i>Johncze - čeština</li>
								<li><i class="fa-li fa fa-user"></i>BeckerDerBro - Deutsch</li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="center">Suggestions</h3>
							<ul class="fa-ul">
								<li><i class="fa-li fa fa-user"></i>kosamiitti - Attachment limiter</li>
								<li><i class="fa-li fa fa-user"></i>roennel - Server config</li>
								<li><i class="fa-li fa fa-user"></i>-SM-MED-NB93 - Dual-slot limiter</li>
							</ul>
						</div>
					</div>
					
					<br />
					
					<h3 class="text-muted">Thanks to...</h3>
					<ul class="fa-ul">
						<li><i class="fa-li fa fa-group"></i>BFP4F community, <i>for everything you guys have done</i></li>
						<li><i class="fa-li fa fa-group"></i>BTC, <i>for the awesome support and fun I had and still have</i></li>
						<li><i class="fa-li fa fa-user"></i>piqus.pl, <i>for the support and RCON class!</i></li>
						<br />
						<li><i class="fa-li fa fa-gift red"></i>All the people who have donated</li>
						<br />
						<li><i class="fa-li fa fa-coffee brown"></i>A lot of coffee... <small><i>and food... I LOVE FOOD! NOM NOM NOM!</i></small></li>
					</ul>
					
					<br />
					
					<h2 class="center">Thank you very much and enjoy!</h2>
				</div>
			</div>
			
			<footer class="row">
				<div class="col-md-12">
					<hr />		
					<p class="text-muted"><a href="http://battlefieldtools.com" target="_blank"><i class="fa fa-wrench"></i> BattlefieldTools.com</a> &middot; <a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank"><i class="fa fa-file-text"></i> Tool thread</a> &middot; <a href="https://github.com/dyhli/bfp4f-servertool/" target="_blank"><i class="fa fa-github"></i> View on GitHub</a> <span class="pull-right">BattlefieldTools Servertool is licensed under GPL v3.0.<br />Copyright &copy; <?=date('Y')?> by Danny Li <SharpBunny></span></p>
				</div>
			</footer>
			
		</div>
		
		
	</body>
</html>