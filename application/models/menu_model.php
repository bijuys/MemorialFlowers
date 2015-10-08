<?php

class Menu_Model extends CI_Model{
	
	function Menu_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('menu',$vars['menu']);
		$this->db->set('holder',$vars['holder']);
		$this->db->insert('menus');
		return $this->db->insert_id();					
	}
	
	function createItem($var) {
		
		$id = $var['menu_id'];
		$data = array(
			'menu_id'=>$id,
			'parent_id'=>$var['parent_id'],
			'menuitem'=>$var['menuitem'],
			'menulink'=> $var['menu_type']=='#' ? $var['menulink']:$var['menu_type'],
			'sort_order'=>$var['sort_order'],
			'width'=>$var['width']
		);
		
		$this->db->insert('menuitems',$data);
		
		return $this->db->insert_id();
		
	}
	
	function get_menus()
	{
		$query = $this->db->query("SELECT m.*,COUNT(i.menuitem_id) AS items FROM menus m LEFT JOIN menuitems i ON m.menu_id=i.menu_id
					  GROUP BY m.menu_id");				
		return $query->result();
	}
	
	function get_menu($id)
	{
		$query = $this->db->get_where('menus',array('menu_id'=>$id));
		return $query->row();
		
	}
	
	function get_menuitem($id)
	{
		$query = $this->db->get_where('menuitems',array('menuitem_id'=>$id));
		return $query->row();
	}
	
	function get_menuitems($id)
	{
		$this->db->order_by("sort_order","asc");
		$query = $this->db->get_where('menuitems',array('menu_id'=>$id));
		return $query->result();
	}
	
	function get_menu_entries($menu)
	{
		$this->db->from('menuitems');
		$this->db->join('menus','menuitems.menu_id=menus.menu_id');
		$this->db->where('menus.holder',$menu);
		$this->db->order_by("menuitems.sort_order","asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function updateItem($vars)
	{

		$data = array(
			'parent_id'=>$vars['parent_id'],
			'menuitem'=>$vars['menuitem'],
			'menulink'=> $vars['menu_type']=='#' ? $vars['menulink']:$vars['menu_type'],
			'sort_order'=>$vars['sort_order'],
			'width'=>$vars['width']
		);
		
		$this->db->where('menuitem_id',$vars['menuitem_id']);
		$this->db->update('menuitems',$data);
			
		return $this->db->affected_rows();		
	}
	
	function update($vars)
	{
		$this->db->set('menu',$vars['menu']);
		$this->db->set('holder',$vars['holder']);
		$this->db->where('menu_id',$vars['menu_id']);
		$this->db->update('menus');
		return $this->db->affected_rows();			
	}
	
	function deleteItem($id)
	{
		$this->db->delete('menuitems',array('menuitem_id'=>$id));
		return $this->db->affected_rows();
	}
	
	
	function get_menu_types()
	{
		$menu = array();
		$this->db->order_by('occasion_name','asc');
		$res = $this->db->get_where('occasions',array('occasion_type'=>'occasion'));
		
		$menu[] = 'Occasions';
	
		foreach($res->result() as $row)
		{
			$menu[$row->occasion_name]='/occasion/'.url_title(strtolower(trim($row->occasion_name)));
		}
		
		$this->db->order_by('category_name','asc');
		$res = $this->db->get('categories');
		
		$menu[] = 'Categories';
	
		foreach($res->result() as $row)
		{
			$menu[$row->category_name]='/category/'.url_title(strtolower(trim($row->category_name)));
		}
		
		$res = $this->db->get('sub_categories');
		
		$menu[] = 'Sub Categories';
		
		foreach($res->result() as $row)
		{
			$menu[$row->subcategory_name]='/subcategory/'.url_title(strtolower(trim($row->subcategory_name)));
		}
			

		$res = $this->db->get('delivery_methods');
		
		$menu[] = 'Delivery Methods';
	
		foreach($res->result() as $row)
		{
			$menu[$row->delivery_method]='/delivery/'.url_title(strtolower(trim($row->delivery_method)));
		}
		
		$this->db->order_by('page_name','asc');
		$res = $this->db->get('pages');
		
		$menu[] = 'Pages';
	
		foreach($res->result() as $row)
		{
			if($row->core==1)
			{
				$menu[$row->page_name]=$row->link;				
			}
			else
			{
				$menu[$row->page_name]='/'.url_title(trim($row->page_handle)).'.html';
			}
		}
		
		return $menu;		
		
	}	
	
	
} 