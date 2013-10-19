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
 
define('INSTALL_PAGE', true);
require_once('core/init.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['server_ip']) && isset($_POST['server_port']) && isset($_POST['rcon_pass']) && isset($_POST['name']) && isset($_POST['profile_id']) && isset($_POST['username']) && isset($_POST['pass'])) {
	
	sleep(2);
	
	if(!fsockopen($_POST['server_ip'], $_POST['server_port'], $cn, $cs, 3)) {
		die('Could not connect to the server, please try again and check your serverinformation');
	}
	$data = json_decode(file_get_contents("http://battlefield.play4free.com/en/profile/soldiers/" . $_POST['profile_id']), true);
	if(count($data['data']) == 0) {
		die('Invalid ProfileID');
	}
	if(strlen($_POST['name']) < 5) {
		die('Name has to be at least 5 characters');
	}
	if(strlen($_POST['username']) < 5) {
		die('Username has to be at least 5 characters');
	}
	if(strlen($_POST['pass']) < 6) {
		die('Password has to be at least 6 characters');
	}
	
	$sql = replace(file_get_contents('SQL.TXT'), array(
		'{%prefix%}' => $config['db_prefix'],
		'{%sv_ip%}' => encrypt($_POST['server_ip']),
		'{%sv_port%}' => encrypt($_POST['server_port']),
		'{%sv_pass%}' => encrypt($_POST['rcon_pass']),
		'{%profile_id%}' => $_POST['profile_id'],
		'{%name%}' => $_POST['name'],
		'{%username%}' => $_POST['username'],
		'{%password%}' => hash('sha256', $_POST['pass']),
	));
	
	if($db->multi_query($sql)) {
		die('Installation succesful, please delete install.php and SQL.TXT<br /><br /><a href="' . HOME_URL . '">Continue &raquo;</a>');
	} else {
		die('Installation failed (' . $db->error . '), please install the database manually using the following SQL:<br /><br /><textarea cols="150" rows="20">' . $sql . '</textarea>');
	}
	
} else {
?>
Fill in the fields and simply click on 'Install'.<br /><br />
<form action="" method="post">
	
	<fieldset>
		<legend>Server</legend>
		Server IP:<br />
		<input type="text" name="server_ip" style="width:250px" required /><br />
		
		Server ADMIN port:<br />
		<input type="text" name="server_port" style="width:250px" required /><br />
		
		Server RCON password:<br />
		<input type="password" name="rcon_pass" style="width:250px" required /><br />
	</fieldset>
	
	<fieldset>
		<legend>Account</legend>
		Name (Public):<br />
		<input type="text" name="name" style="width:250px" required /> <small>E.g. SharpBunny</small><br />
		
		BFP4F ProfileId:<br />
		<input type="text" name="profile_id" style="width:250px" required /> <small>E.g. (http://battlefield.play4free.com/en/profile/2567963101) 2567963101</small><br />
		
		Username:<br />
		<input type="text" name="username" style="width:250px" required /> <small>E.g. sharpbunny</small><br />
		
		Password:<br />
		<input type="password" name="pass" style="width:250px" required /> <small>At least 6 characters</small><br />
	</fieldset>
	
	<br />
	<input type="submit" value="Install" />

</form>
<?php
}
?>

<hr />
I'm really sorry for this aweful look of the installation page lol, just lazy and didn't want to put too much time in the installation page... >.<