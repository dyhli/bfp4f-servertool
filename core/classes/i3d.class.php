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

namespace Extern\I3D;

class API {
	public $userId	= 0;
	public $apiKey	= '';
	public $category	= '';
	public $action	= '';
	
	private $categories = array(
		'colocation',
		'dedicatedserver',
		'gameserver',
		'voiceserver'
	);
	
	public function doRequest(array $option = null)
	{
		// Validate some vars
		if ($this->userId < 1 ||
			strlen($this->apiKey) != 20 ||
			$this->action === '')
			return array(
				'status' => 'Error',
				'message' => 'Invalid parameters'
			);
			
		if (!in_array($this->category, $this->categories))
			return array(
				'status' => 'Error',
				'message' => 'Invalid category'
			);
		
		// Create POST data
		$data = array(
		    'userId' => $this->userId,
		    'apiKey' => $this->apiKey,
		    'action' => $this->action
		);
		if ($option)
		{
			$data = array_merge($data, $option);
		}
		$data = http_build_query($data);
		
		// Create http stream context
		$url = 'https://customer.i3d.net/api/rest/'.$this->category;
		$ctx = stream_context_create(array(
		    'http' => array(
		        'method' => 'POST',
		        'header' => "Content-type: application/x-www-form-urlencoded\r\n".
		                    "Content-Length: ".strlen($data)."\r\n",
		        'content' => $data
		    )
		));
		
		// Do the request
		$json = @file_get_contents($url, null, $ctx);
		return json_decode($json, true);
	}
}
?>