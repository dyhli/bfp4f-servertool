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