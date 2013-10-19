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
 
class Itemlist {
	
	protected $db,
			  $config;
			  
	function __construct($db, $config) {
		$this->db = $db;
		$this->config = $config;
	}
	
	/**
	 * getNameById()
	 * Get item name by BFID
	 * 
	 * @param $id int - Item BFID
	 * @return str - Item name
	 * 
	 * NOT USED ANYMORE
	 */
	public function getNameById($id) {
		
		if($result = $this->db->query("SELECT item_name FROM " . $this->config['db_prefix'] . "itemlist WHERE
		item_bf_id='" . $this->db->real_escape_string($id) . "' LIMIT 1")) {
			
			if($result->num_rows == 1) {
				$item = $result->fetch_array();
				
				return $item['item_name'];
			}
			
			$result->free();
			
		}
		
		return null;
		
	}
	
	/**
	 * validateBfid()
	 * Validate BFID
	 * 
	 * @param $id int - Item BFID
	 * @return bool
	 * 
	 * NOT USED ANYMORE
	 */
	public function validateBfid($id) {
		
		if($result = $this->db->query("SELECT item_id FROM " . $this->config['db_prefix'] . "itemlist WHERE
		item_bf_id='" . $this->db->real_escape_string($id) . "' LIMIT 1")) {
			
			if($result->num_rows == 1) {
				return true;
			}
			
			$result->free();
			
		}
		
		return false;
		
	}
	
	/**
	 * fetchItems()
	 * Fetch the items
	 * 
	 * @return array - Status + items
	 */
	public function fetchItems() {
		
		if($result = $this->db->query("SELECT * FROM " . $this->config['db_prefix'] . "itemlist ORDER BY item_category,item_subcat DESC")) {
			
			if($result->num_rows > 0) {
				$items = array();
				while($a = $result->fetch_assoc()) {
					$items[$a['item_bf_id']] = $a;
				}
				
				return array('code' => 'OK', 'items' => $items);
				
			} else {
				return array('code' => 'ERROR', 'message' => '{%cp_itemlist_err1%}');
			}
			
			$result->free();
			
		} else {
			return array('code' => 'ERROR', 'message' => $this->db->error);
		}
		
	}
	
	/**
	 * insertItem()
	 * Insert item into the list
	 * 
	 * @param $cat str - Item category
	 * @param $sub_cat str - Item subcategory
	 * @param $bf_id int - Bfp4f item ID
	 * @param $name str - Item name
	 * @param $min_lvl int - Unlock level (min lvl)
	 * @return array - Status
	 */
	public function insertItem($user_id, $desc) {
		
		if($this->db->query("INSERT INTO " . $this->config['db_prefix'] . "log_cp_actions (user_id,description,action_date) VALUES (
			'" . $this->db->real_escape_string($user_id) . "',
			'" . $this->db->real_escape_string($desc) . "',
			NOW()
		)")) {
			
			return array('code' => 'OK');
			
		} else {
			
			return array('code' => 'ERROR', 'message' => $this->db->error);
			
		}
		
	}
	
	/**
	 * deleteItem()
	 * Delete an item from the list
	 * 
	 * @param $item_id int - Item ID
	 * @return array - Status
	 */
	public function deleteItem($item_id) {
		
		
		
	}
	
	/**
	 * editItem()
	 * Edit an item from the list
	 * 
	 * @param $item_id int - Item ID
	 * @param $sub_cat str - Item subcategory
	 * @param $bf_id int - Bfp4f item ID
	 * @param $name str - Item name
	 * @param $min_lvl int - Unlock level (min lvl)
	 * @return array - Status
	 */
	public function editItem($item_id, $sub_cat, $bf_id, $name, $min_lvl) {
		
		
		
	}
	
}
 
?>

