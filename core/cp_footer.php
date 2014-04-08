			<script>
				var LHCChatOptions = {};
				LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
				LHCChatOptions.attr = new Array();
				LHCChatOptions.attr.push({'name':'From','value':'ServerTool <?=TOOL_VERSION?> - <?=HOME_URL?>','type':'hidden','size':150});
				(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				var refferer = (document.referrer) ? encodeURIComponent(document.referrer) : '';
				var location  = (document.location) ? encodeURIComponent(document.location) : '';
				po.src = '//battlefieldtools.com/support/livechat/index.php/chat/getstatus/(click)/internal/(position)/middle_right/(top)/350/(department)/6/(units)/pixels?r='+refferer+'&l='+location;
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
				// ---------------------
				var LHCVotingOptions = {status_text:'Help us become better!'};
				(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = '//battlefieldtools.com/support/livechat/index.php/questionary/getstatus/(position)/middle_right/(top)/400/(units)/pixels/(width)/300/(height)/300';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
				// ---------------------
				var LHCChatboxOptions = {hashchatbox:'servertool',identifier:'servertool',status_text:'Chat with other servertool users'};
				(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = '//battlefieldtools.com/support/livechat/index.php/chatbox/getstatus/(position)/middle_right/(top)/300/(units)/pixels/(width)/300/(height)/300/(chat_height)/220';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
			
			<footer class="row">
				<div class="col-md-12">
					<hr />		
					<p class="text-muted"><a href="http://battlefieldtools.com" target="_blank"><i class="fa fa-wrench"></i> BattlefieldTools.com</a> &middot; <a href="http://battlefield.play4free.com/en/forum/showthread.php?tid=137006" target="_blank"><i class="fa fa-file-text"></i> <?=$lang['cp_footer_thread']?></a> &middot; <a href="https://github.com/dyhli/bfp4f-servertool/" target="_blank"><i class="fa fa-github"></i> <?=$lang['github']?></a> <span class="pull-right">BattlefieldTools Servertool is licensed under GPL v3.0.<br />Copyright &copy; <?=date('Y')?> by Danny Li &lt;SharpBunny&gt;</span></p>
				</div>
			</footer>
			
		</div>
				
	</body>
</html>
<!-- Page generated in: <?=number_format(microtime(true)-$pageStart,4)?> seconds -->