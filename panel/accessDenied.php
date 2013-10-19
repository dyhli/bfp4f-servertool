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

$pageTitle = $lang['cp_norights'];
include(CORE_DIR . '/cp_header.php');
?>
			
			<div class="row-fluid">
				<div class="span8 offset2">
					
					<div class="alert alert-warning alert-block">
						<h4><i class="icon-warning-sign"></i> <?=$lang['word_error']?></h4>
						<p><?=$lang['cp_norights_msg']?></p><br />
						<p><a href="javascript:;" onclick="history.go(-1)" class="btn btn-warning"><i class="icon-arrow-left"></i> <?=$lang['btn_back']?></a></p>
					</div>
					
				</div>
			</div>
			
<?php include(CORE_DIR . '/cp_footer.php'); ?>
