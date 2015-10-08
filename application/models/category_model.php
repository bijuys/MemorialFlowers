<?php

class Category_Model extends CI_Model{
	
	function Category_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('category_name',$vars['category_name']);
		$this->db->set('category_status',$vars['category_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->insert('categories');
		return $this->db->insert_id();			
	}
	
	
	function get_category_byname($name)
	{
		$this->db->from('categories');
		$this->db->join('banners','categories.banner_id=banners.banner_id','left');
		$this->db->where('category_name',$name);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_category_byname2($name)
	{
		$query = $this->db->query("SELECT * FROM categories c
									LEFT JOIN products p ON c.category_id=p.category_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE p.product_status=1 AND p.customer_page=1 AND c.category_name='".$name."'
									GROUP BY p.product_id
									ORDER BY p.product_id DESC");
		
		return $query->result();
	}
	
	
	function rowparser($row)
	{
		$temp_cat = $row;
		$row->category_name=NULL;
		$row->category_id=NULL;
		$row->category_status=NULL;
		
		return $row;
				
	}
	
	function setMainCategories($vars)
	{
		if(count($vars['categories']))
		{
			$this->db->set('main',0);
			$this->db->update('categories');
			foreach($vars['categories'] as $row=>$val)
			{
				$this->db->set('main',1);
				$this->db->where('category_id',$row);
				$this->db->update('categories');
			}
		}
	}
	
	function get_categories()
	{
		$query = $this->db->query("SELECT c.*, COUNT(p.product_id) AS products, (SELECT COUNT(x.subcategory_id) AS subcats FROM sub_categories x WHERE x.category_id=c.category_id) AS subcats   
					  FROM categories c
					  LEFT JOIN sub_categories s ON c.category_id=s.category_id 
					  LEFT JOIN products p ON p.category_id=c.category_id
					  GROUP BY c.category_id 
					  ORDER BY (c.category_name) ASC");
		
		return $query->result();
	}
	
	function get_main_categories()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}
	
	function get_category($id)
	{
		$query = $this->db->get_where('categories',array('category_id'=>$id));
		return $query->row();
		
	}
	
	function get_products($id)
	{
		$query= $this->db->query("SELECT *,p.product_id AS product_id FROM products p LEFT JOIN category_products c ON p.category_id=c.category_id AND p.product_id=c.product_id 
		       WHERE p.category_id={$id} GROUP BY p.product_id ORDER BY c.display_order ASC");
		
		return $query->result();
	}
	
	function getCategoryDetails($name)
	{
		$query = $this->db->query("SELECT *,c.category_name AS title FROM categories c 
					  LEFT JOIN banners b ON c.banner_id=b.banner_id 
					  WHERE c.category_name='{$name}'");
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('category_name',$vars['category_name']);
		$this->db->set('category_status',$vars['category_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->where('category_id',$vars['category_id']);
		$this->db->update('categories');
		
		$this->db->query("DELETE FROM category_products WHERE category_id=".$vars['category_id']);
		
		if(count($vars['display_order']))
		{
			foreach($vars['display_order'] as $key=>$val)
			{
				$this->db->insert('category_products',array('product_id'=>$key,
									    'category_id'=>$vars['category_id'],
									    'display_order'=>$val));
			}
		}
		
		return TRUE;			
	}
	
	function delete($id)
	{
		$check = $this->db->get_where('sub_categories',array('category_id'=>$id));
		if($check->num_rows()>0)
		{
			return FALSE;
		}
		else
		{
			$check = $this->db->get_where('products',array('category_id'=>$id));
			
			if($check->num_rows()==0)
			{
				$this->db->delete('categories',array('category_id'=>$id));				
			}
		}
	}
	
} 