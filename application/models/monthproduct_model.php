<?php

class Monthproduct_Model extends CI_Model{
	
	function Monthproduct_Model()
	{
		parent::__construct();
	}
	
	function get_month($id)
	{
		$query = $this->db->get_where('months',array('month_id'=>$id));
		
		return $query->row();
	}
	
	function get_monthinfo($month)
	{
		$this->db->from('months');
		$this->db->join('banners','months.banner_id=banners.banner_id','left');
		$this->db->where('name',$month);
		
		$query = $this->db->get();
		
		return $query->row();		
		
	}
	
	
	function get_months()
	{
		$this->db->select('months.*,COUNT(month_products.product_id) AS products');
		$this->db->from('months');
		$this->db->join('month_products','months.month_id=month_products.month_id','left');
		$this->db->group_by('months.month_id');
		$this->db->order_by('months.month_id');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_monthlyproducts($month)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('month_products','products.product_id=month_products.product_id','left');
		$this->db->join('months','month_products.month_id=months.month_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->group_by('products.product_id');
		$this->db->where('months.name',$month);
		$this->db->order_by('month_products.display_order');
		$this->db->limit(8);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
	
	function updateMonth($id,$vars,$pics)
	{
		$curr = $this->get_month($id);
		
		
		if(!empty($pics['en']))
			@unlink('/productres/'.$curr->picture);

		if(!empty($pics['fr']))
			@unlink('/productres/'.$curr->picture_fr);		
		
		
		$data = array('banner_id'=>$vars['banner_id'],
			      'description'=>$vars['description'],
			      'description_fr'=>$vars['description_fr']);
		
		if(!empty($pics['en']))
			$data['picture'] = $pics['en'];
		
		if(!empty($pics['fr']))
			$data['picture_fr'] = $pics['fr'];
		
		$this->db->where('month_id',$id);
		$this->db->update('months',$data);
		
		$this->db->delete('month_products',array('month_id'=>$id));
		
		if(isset($vars['products']) && count($vars['products']))
		{
			foreach($vars['products'] as $key=>$val)
			{
				$this->db->insert('month_products',array('month_id'=>$id,
									 'product_id'=>$val,
									 'display_order'=>$vars['display_order'][$val]));
			}
		}
		
		return TRUE;
		
		
	}
	
	function get_products($id)
	{
		
		$query = $this->db->query("SELECT p.* FROM products p
					  LEFT JOIN month_products m ON p.product_id=m.product_id 
					  WHERE m.month_id={$id} OR m.month_id IS NULL 
					  GROUP BY p.product_id
					  ORDER BY p.product_name");
				
		return $query->result();		
		
	}
	
	function get_assigned($id)
	{
		
		$query = $this->db->query("SELECT * FROM month_products m 
					  LEFT JOIN products p ON m.product_id=p.product_id 
					  WHERE m.month_id={$id} 
					  GROUP BY m.product_id 
					  ORDER BY m.display_order");
				
		return $query->result();		
		
	}
	
	
	
} 