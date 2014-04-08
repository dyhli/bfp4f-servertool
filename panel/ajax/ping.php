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

header('Content-type: application/json');

// Default response template
$response = array(
	'status' => 'ERROR',
	'msg' => '',
	'ping' => '',
	'pingHtml' => '<span class="text-danger">999+ ms</span>',
	'pingDesc' => '',
	'ping2' => '',
	'pingHtml2' => '<span class="text-danger">999+ ms</span>',
	'pingDesc2' => '',
);


$response['status'] = 'OK';
$ping = ping(decrypt($settings['server_ip']) . ':' . decrypt($settings['server_admin_port']));
if(is_float($ping)) {
	$response['ping'] = $ping;
	if($ping < 100) {
		$response['pingHtml'] = '<span class="text-success">' . $ping . ' ms</span>';
		$response['pingDesc'] = '<span class="text-success">' . $lang['tool_ping_status1'] . '</span>';
	} elseif($ping > 100 && $ping < 200) {
		$response['pingHtml'] = '<span class="text-warning">' . $ping . ' ms</span>';
		$response['pingDesc'] = '<span class="text-warning">' . $lang['tool_ping_status2'] . '</span>';
	} else {
		$response['pingHtml'] = '<span class="text-danger">' . $ping . ' ms</span>';
		$response['pingDesc'] = '<span class="text-danger">' . $lang['tool_ping_status3'] . '</span>';
	}
} else {
	$response['ping'] = 0;
	$response['pingHtml'] = '<span class="text-danger">999+ ms</span>';
}

$ping2 = ping('http://battlefield.play4free.com/en/');
if(is_float($ping2)) {
	$response['ping2'] = $ping2;
	if($ping2 < 100) {
		$response['pingHtml2'] = '<span class="text-success">' . $ping2 . ' ms</span>';
		$response['pingDesc2'] = '<span class="text-success">' . $lang['tool_ping_status1'] . '</span>';
	} elseif($ping2 > 100 && $ping2 < 200) {
		$response['pingHtml2'] = '<span class="text-warning">' . $ping2 . ' ms</span>';
		$response['pingDesc2'] = '<span class="text-warning">' . $lang['tool_ping_status2'] . '</span>';
	} else {
		$response['pingHtml2'] = '<span class="text-danger">' . $ping2 . ' ms</span>';
		$response['pingDesc2'] = '<span class="text-danger">' . $lang['tool_ping_status3'] . '</span>';
	}
} else {
	$response['ping2'] = 0;
	$response['pingHtml2'] = '<span class="text-danger">999+ ms</span>';
}

// Output response
echo json_encode($response);
?>