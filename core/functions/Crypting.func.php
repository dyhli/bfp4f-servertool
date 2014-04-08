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
  * encrypt()
  * Encrypt a string
  * 
  * @param $pure_string str - String to be encrypted
  * @return str - Encrypted string
  */
function encrypt($pure_string) {
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, RANDOM_STRING, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
	return base64_encode($encrypted_string);
}

/**
 * decrypt()
 * Decrypt an encrypted string
 * 
 * @param $encrypted_string str - Encrypted string
 * @return str - Decrypted string
 */
function decrypt($encrypted_string) {
	$encrypted_string = base64_decode($encrypted_string);
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, RANDOM_STRING, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return filter_var($decrypted_string, FILTER_SANITIZE_STRING);
}
?>
