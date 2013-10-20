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
