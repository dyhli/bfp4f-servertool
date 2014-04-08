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
 
require_once('../../core/init.php');

$user->checkLogin(true);

// Check his rights
if($userInfo['rights_rcon'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied.php');
	die();
}

$pageTitle = 'RCON Console';
include(CORE_DIR . '/cp_header.php');
?>
			
			<!--
				INLINE JAVASCRIPT FOR THIS PAGE
			-->
			<script>
			var context=context||function(){function t(t){e=$.extend({},e,t);$(document).on("click","html",function(){$(".dropdown-context").fadeOut(e.fadeSpeed,function(){$(".dropdown-context").css({display:""}).find(".drop-left").removeClass("drop-left")})});if(e.preventDoubleContext){$(document).on("contextmenu",".dropdown-context",function(e){e.preventDefault()})}$(document).on("mouseenter",".dropdown-submenu",function(){var e=$(this).find(".dropdown-context-sub:first"),t=e.width(),n=e.offset().left,r=t+n>window.innerWidth;if(r){e.addClass("drop-left")}})}function n(t){e=$.extend({},e,t)}function r(t,n,i){var s=i?" dropdown-context-sub":"",o=e.compress?" compressed-context":"",u=$('<ul class="dropdown-menu dropdown-context'+s+o+'" id="dropdown-'+n+'"></ul>');var a=0,f="";for(a;a<t.length;a++){if(typeof t[a].divider!=="undefined"){u.append('<li class="divider"></li>')}else if(typeof t[a].header!=="undefined"){u.append('<li class="nav-header">'+t[a].header+"</li>")}else{if(typeof t[a].href=="undefined"){t[a].href="#"}if(typeof t[a].target!=="undefined"){f=' target="'+t[a].target+'"'}if(typeof t[a].subMenu!=="undefined"){$sub='<li class="dropdown-submenu"><a tabindex="-1" href="'+t[a].href+'">'+t[a].text+"</a></li>"}else{$sub=$('<li><a tabindex="-1" href="'+t[a].href+'"'+f+">"+t[a].text+"</a></li>")}if(typeof t[a].action!=="undefined"){var l=new Date,c="event-"+l.getTime()*Math.floor(Math.random()*1e5),h=t[a].action;$sub.find("a").attr("id",c);$("#"+c).addClass("context-event");$(document).on("click","#"+c,h)}u.append($sub);if(typeof t[a].subMenu!="undefined"){var p=r(t[a].subMenu,n,true);u.find("li:last").append(p)}}if(typeof e.filter=="function"){e.filter(u.find("li:last"))}}return u}function i(t,n){var i=new Date,s=i.getTime(),o=r(n,s);$("body").append(o);$(document).on("contextmenu",t,function(t){t.preventDefault();t.stopPropagation();$(".dropdown-context:not(.dropdown-context-sub)").hide();$dd=$("#dropdown-"+s);if(typeof e.above=="boolean"&&e.above){$dd.addClass("dropdown-context-up").css({top:t.pageY-20-$("#dropdown-"+s).height(),left:t.pageX-13}).fadeIn(e.fadeSpeed)}else if(typeof e.above=="string"&&e.above=="auto"){$dd.removeClass("dropdown-context-up");var n=$dd.height()+12;if(t.pageY+n>$("html").height()){$dd.addClass("dropdown-context-up").css({top:t.pageY-20-n,left:t.pageX-13}).fadeIn(e.fadeSpeed)}else{$dd.css({top:t.pageY+10,left:t.pageX-13}).fadeIn(e.fadeSpeed)}}})}function s(e){$(document).off("contextmenu",e).off("click",".context-event")}var e={fadeSpeed:100,filter:function(e){},above:"auto",preventDoubleContext:true,compress:false};return{init:t,settings:n,attach:i,destroy:s}}();
			$(document).ready(function(){$("#rconCmd").keypress(function(e){if(e.which==13){executeCommand()}});context.init({preventDoubleContext:false});context.attach("#terminal",[{text:'<i class="fa fa-arrow-right"></i> Execute command',href:"javascript:executeCommand()"},{text:'<i class="fa fa-question-circle"></i> Help!',href:"javascript:preSetCmd('help')"},{divider:true},{text:'<i class="fa fa-times"></i> Clear terminal',href:"javascript:clearTerminal()"}]);setTimeout("clearTerminal()",2500)})
			function clearTerminal(){$("#terminal").html('<span class="text-muted">$></span> <span class="green">RCON console is ready to use</span><br /><span class="text-muted">$></span> Type \'help\' or \'?\' for more information about RCON commands<br /><span class="text-muted">$></span> Type \'clear\' to clear the console<br /><span class="text-muted">$></span> Use at your own risk, please do NOT use if you don\'t know what you\'re doing!<br /><span class="text-muted">$></span> Please note that everything in this console is English and is not translated<br />');nextCmd()}
			function nextCmd(){$("#terminal").scrollTop($("#terminal")[0].scrollHeight);$("#rconCmd, button").attr("disabled",false);$("#rconCmd").focus()}
			function preSetCmd(e){$("#rconCmd").val(e);executeCommand()}
			function executeCommand(){var e=$("#rconCmd").val().replace("<","&lt;").replace(">","&gt;");$("#terminal").append('<span class="text-muted">$></span> '+e+"<br />").animate({scrollTop:$("#terminal")[0].scrollHeight},1);$("#rconCmd, button").attr("disabled",true);if(e=="clear"){clearTerminal()}else if(e==""){$("#terminal").append('<span class="text-muted">$></span> <span class="red">Cannot execute an empty command...</span><br />');nextCmd()}else{$.post("<?=HOME_URL?>panel/ajax/rconConsole.php",{cmd:e},function(e){$("#terminal").append('<span class="text-muted">$></span> '+e+"<br />");nextCmd()}).fail(function(){$("#terminal").append('<span class="text-muted">$></span> <span class="red">Could not execute command...</span><br />');nextCmd()})}$("#rconCmd").val("")}
			</script>
			
			<div class="row">
				<div class="col-md-12">
					
					<h2><i class="fa fa-terminal"></i> <?=$lang['tool_rcon']?> <small><?=$lang['tool_rcon_desc']?></small></h2>
					<hr />

					<div id="terminal" class="f1">
						<div class="center">
							<h2>
								<i class="fa fa-cog fa-spin fa-3x"></i><br /><br />
								Preparing RCON console<br />
								<small class="f4">Please wait...</small>
							</h2>
						</div>
					</div>
					<hr />
					<div class="form-horizontal f6">
						
						<div class="form-group">
							<label class="control-label col-sm-2"><i class="fa fa-terminal"></i> <?=$lang['tool_rcon_field1']?></label>
							<div class="col-sm-6">
								<input type="text" id="rconCmd" class="form-control" disabled autofocus required />
							</div>
							<div class="col-sm-3">
								<button onclick="executeCommand()" class="btn btn-primary btn-block" disabled><?=$lang['word_go']?> <i class="fa fa-arrow-right right"></i></button>
							</div>
						</div>
						
					</div>
					
					<div class="dropdown contextMenu clearfix">
 				     <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
				        <li><a tabindex="-1" href="#">Action</a></li>
				        <li><a tabindex="-1" href="#">Another action</a></li>
				        <li><a tabindex="-1" href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a tabindex="-1" href="#">Separated link</a></li>
				      </ul>
				    </div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
