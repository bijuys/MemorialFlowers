<?php

class Subcategory_Model extends CI_Model{
	
	function Category_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('subcategory_name',$vars['subcategory_name']);
		$this->db->set('category_id',$vars['category_id']);
		$this->db->set('subcategory_status',$vars['subcategory_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->insert('sub_categories');
		
		return $this->db->insert_id();			
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
	
	function get_subcategories()
	{
		$query = $this->db->query("SELECT s.*, COUNT(p.product_id) AS products,c.category_name  
					  FROM sub_categories s
					  LEFT JOIN categories c ON s.category_id=c.category_id 
					  LEFT JOIN product_subcategories p ON s.subcategory_id=p.subcategory_id 
					  GROUP BY s.subcategory_id 
					  ORDER BY (s.subcategory_name) ASC");
		
		return $query->result();
	}
	
	function get_subcategory($id)
	{
		$query = $this->db->get_where('sub_categories',array('subcategory_id'=>$id));
		return $query->row();
		
	}
	
	function get_subcategory_byname($name)
	{
		$this->db->from('sub_categories');
		$this->db->join('banners','sub_categories.banner_id=banners.banner_id','left');
		$this->db->where('subcategory_name',$name);
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
	
	function getSubcategoryDetails($name)
	{
		
		$query = $this->db->query("SELECT *,s.subcategory_name AS title FROM sub_categories s 
					  LEFT JOIN banners b ON s.banner_id=b.banner_id 
					  WHERE s.subcategory_name='{$name}'");
		
		return $query->row();		
		
	}
	
	function update($vars)
	{
		$this->db->set('subcategory_name',$vars['subcategory_name']);
		$this->db->set('category_id',$vars['category_id']);
		$this->db->set('subcategory_status',$vars['subcategory_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->where('subcategory_id',$vars['subcategory_id']);
		$this->db->update('sub_categories');
		
		$this->db->delete('product_subcategories',array('subcategory_id'=>$vars['subcategory_id']));
		
		if(isset($vars['products']) && count($vars['products']))
		{
			foreach($vars['products'] as $key=>$val)
			{
				
				$data = array('subcategory_id'=>$vars['subcategory_id'],
					      'product_id'=>$val,
					      'display_order'=>$vars['display_order'][$val]);
				
				$this->db->insert('product_subcategories',$data);

			}
		}		
		
		return true;			
	}
	
	function delete($id)
	{
		$query = $this->db->get_where('product_subcategories',array('subcategory_id'=>$id));
		
		if($query->num_rows()>0)
		{
			return FALSE;
		}
		else
		{
			$this->db->delete('sub_categories',array('subcategory_id'=>$id));
			return TRUE;
		}
	
	}
	
	function get_products($id=0)
	{
		$catid=0;
		
		$query = $this->db->get_where('sub_categories',array('subcategory_id'=>$id));
		
		foreach($query->result() as $row)
		{
			$catid = $row->category_id;
		}
		
		
		
		$query = $this->db->query("SELECT p.* FROM products p
					  LEFT JOIN product_subcategories o ON p.product_id=o.product_id 
					  WHERE p.product_id NOT IN (SELECT t.product_id FROM product_subcategories t
					  WHERE t.subcategory_id={$id}) 
					  AND p.category_id={$catid} 
					  GROUP BY p.product_id
					  ORDER BY p.product_name");
				
		return $query->result();		
		
	}
	
	
	function get_assigned($id)
	{
		
		$query = $this->db->query("SELECT * FROM product_subcategories o 
					  LEFT JOIN products p ON o.product_id=p.product_id 
					  WHERE o.subcategory_id={$id} 
					  AND p.product_id>0 
					  GROUP BY p.product_id 
					  ORDER BY o.display_order");
		
		return $query->result();		
		
	}
	
	
} 