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

$pageTitle = $lang['word_qa'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span10 offset1">
					
					<h2><i class="icon-question-sign"></i> <?=$lang['word_qa']?></h2>
					<hr />
					
					<div class="alert alert-info">
						<i class="icon-lightbulb"></i>
						<?=$lang['qa_note']?>
					</div>
					
					<h3><?=$lang['qa_questions']?></h3>
					<ol>
<?php
foreach($lang['qa'] as $key => $value) {
?>
						<li><a href="#qa<?=$key?>"><?=$value['question']?></a></li>
<?php
}
?>
					</ol>
					
					<hr />
					<h3><?=$lang['qa_answers']?></h3>
					
<?php
foreach($lang['qa'] as $key => $value) {
?>
						<h4 id="qa<?=$key?>"><?=$value['question']?></h4>
						<p><?=$value['anwser']?></p>
						
						<br />
						<a href="javascript:;" onclick="$('html, body').animate({scrollTop:0})">^ Back to top</a>
						<hr />
<?php
}
?>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
