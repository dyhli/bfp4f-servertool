<?php
/**
 * BattlefieldTools.com API PHP class
 * Version 1.0.3
 *
 * Copyright (C) 2013 <BattlefieldTools.com>
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
 
namespace BT\API;

class Base {
	
	/**
	 * $apiUrl
	 * The API url of BattlefieldTools.com
	 */
	public $apiUrl = 'https://battlefieldtools.com/api/';
	
	/**
	 * $apiUser
	 * API username
	 */
	protected $apiUser;
	
	/**
	 * $apiKey
	 * API key
	 */
	protected $apiKey;
	
	/**
	 * $requestUrl
	 * Request URL
	 */
	public $requestUrl;
	
	/**
	 * $requestStatus
	 * Request status
	 */
	public $requestStatus;
	
	/**
	 * $requestRpiInfo
	 * Request API info
	 */
	public $requestApiInfo;
	
	/**
	 * $requestResponse
	 * Response of the request, everything
	 */
	public $requestResponse;
	
	/**
	 * $requestData
	 * Request response, data only (array)
	 */
	public $requestData = array( );
	
	/**
	 * function setUser()
	 * Set API user
	 */
	public function setUser($apiUser) {
		$this->apiUser = $apiUser;
	}
	
	/**
	 * function setKey()
	 * Set API key
	 */
	public function setKey($apiKey) {
		$this->apiKey = $apiKey;
	}
	
	/**
	 * function init()
	 * Initialize command
	 * 
	 * @param $cat str - API category
	 * @param $vars array - Variables
	 * @param $api str - public or private
	 * @return bool
	 */
	public function init($cat, $vars, $api='public') {
		
		$vars['username'] = $this->apiUser;
		$vars['key'] = $this->apiKey;
		
		foreach($vars as $key => $value) {
			$vars[$key] = urlencode($vars[$key]);
		}
		$vars = http_build_query($vars);
		
		$this->requestUrl = $this->apiUrl . $api . '/' . $cat . '?' . $vars;
		return true;
		
	}
	
	/**
	 * function request()
	 * Send request to server and fetch response
	 * 
	 * @param $url str - URL
	 * @return str
	 */
	public function execute() {
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$response = curl_exec($ch);
		if(!$response) {
			$this->requestStatus = array(
				'failed',
				'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch),
			);
		} else {
			
			$data = json_decode($response, true);
			
			if($data != false) {
				$this->requestStatus = array(
					$data['result']['status'],
					$data['result']['message']
				);
				$this->requestApiInfo = $data['api'];
				$this->requestResponse = $data;
				$this->requestData = $data['result']['data'];
			} else {
				$this->requestStatus = array(
					'failed',
					'Not a JSON response'
				);
			}
			
		}
		curl_close($ch);
		
	}
	
}
?>