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
 
/**
 * Email()
 * Sends an e-mail, using PHP mail()
 * 
 * @param $name str - Name
 * @param $to str - E-mailaddress
 * @param $subject str - Subject
 * @param $message str - Message
 * @return bool
 */
function Email($name, $to, $subject, $message) {
	
	$headers = 'To: ' . $name . ' <' . $to . '>' . PHP_EOL;
	$headers .= 'From: ' . $name . ' <' . $to . '>' . PHP_EOL;
	$headers .= 'MIME-Version: 1.0' . PHP_EOL;
	$headers .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;
	$headers .= 'X-Priority: Normal' . PHP_EOL;
		
	if(mail($to, $subject, $message, $headers)) {
		return true;
	} else {
		return false;
	}
}
?>