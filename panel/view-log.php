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

// Check his rights
if($userInfo['rights_logs'] == 'no') {
	header('Location: ' . HOME_URL . 'panel/accessDenied');
	die();
}

header('Content-type: text/plain');

if(isset($_GET['log'])) {
	
	$result = $log->fetchLog($_GET['log']);
	
	if($result['code'] == 'OK') {
		
		$i = 0;
		
		foreach($result['items'] as $value) {
			$i++;
			
			echo '[#' . $i . '] ';
			foreach($value as $key => $value) {
				echo $key . ': ' . $value . ' || ';
			}
			echo PHP_EOL;
		}
		
	} else {
		echo $result['message'];
	}
	
}
?>