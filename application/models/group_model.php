<?php

class Group_Model extends CI_Model{
	
	function Group_Model()
	{
		parent::__construct();
	}
	
	function get_add_charges($id=0)
	{		
		$shipping = 0;
		$tax = 0;
		
		$loc = $this->db->query("SELECT * FROM order_items o 
				      LEFT JOIN delivery_details d ON o.orderitem_id=d.orderitem_id
				      WHERE o.orderitem_id={$id}");

		
		foreach($loc->result() as $delivery)
		{

			$postalcode = strtoupper(str_replace(' ','',trim($delivery->postalcode)));
			$country_id = $delivery->country_id;
			$province = $delivery->postalcode;
			$product_id = $delivery->product_id;
			
			$post = $this->db->query("SELECT * FROM postalcodes p
						 LEFT JOIN cities c ON p.city_id=c.city_id
						 LEFT JOIN provinces r ON c.province_id=r.province_id
						 LEFT JOIN countries n ON r.country_id=n.country_id
						 WHERE REPLACE(UPPER(p.postalcode),' ','')='{$postalcode}'  
						 GROUP BY p.postalcode");
			
			if($post->num_rows()>0)
			{
				foreach($post->result() as $row)
				{
					$province_id = $row->province_id;
					
					$coquery = $this->db->query("SELECT * FROM products p
							    LEFT JOIN product_locations r ON p.product_id=r.product_id
							    LEFT JOIN groups g ON r.group_id=g.group_id 
							    LEFT JOIN group_locations l ON g.group_id=l.group_id
							    WHERE l.location_type='country' AND
							    l.location_id={$country_id} AND 
							    p.product_id={$product_id}
							    GROUP BY p.product_id ");
					
					foreach($coquery->result() as $cores)
					{
						$shipping += $cores->location_shipping;
						$tax += $cores->location_tax;
					}
					
					$coquery = $this->db->query("SELECT * FROM products p
							    LEFT JOIN product_locations r ON p.product_id=r.product_id
							    LEFT JOIN groups g ON r.group_id=g.group_id 
							    LEFT JOIN group_locations l ON g.group_id=l.group_id
							    WHERE l.location_type='province' AND
							    l.location_id={$province_id} AND 
							    p.product_id={$product_id}
							    GROUP BY p.product_id ");
					
					foreach($coquery->result() as $prores)
					{
						$shipping += $prores->location_shipping;
						$tax += $prores->location_tax;
					}
					
				}				
			}
			else
			{
				$coquery = $this->db->query("SELECT * FROM products p
							    LEFT JOIN product_locations r ON p.product_id=r.product_id
							    LEFT JOIN groups g ON r.group_id=g.group_id 
							    LEFT JOIN group_locations l ON g.group_id=l.group_id
							    WHERE l.location_type='country' AND
							    l.location_id={$country_id} AND 
							    p.product_id={$product_id}
							    GROUP BY p.product_id ");
				
				foreach($coquery->result() as $cores)
				{
					$shipping += $cores->location_shipping;
					$tax += $cores->location_tax;
				}
				
			}
			
		}
		
		$acharges = array('shipping'=>$shipping,
				 'tax'=>$tax);
                
		return $acharges;			
		
	}
	
	function get_plus_charges($product_id,$group_id,$postalcode)
	{
		$shipping = 0;
		$tax = 0;
		
		$this->db->from('postalcodes');
		$this->db->join('cities','postalcodes.city_id=cities.city_id','left');
		$this->db->join('provinces','cities.province_id=provinces.province_id','left');
		$this->db->join('countries','provinces.country_id=countries.country_id','left');
		$this->db->where("UPPER(REPLACE(postalcode,' ',''))=",strtoupper(str_replace(' ','',$postalcode)));
		$query = $this->db->get();
		$loc = $query->row();
		
		$this->db->from('group_locations');
		$this->db->where('location_type','country');
		$this->db->where('location_id',$loc->country_id);
		$this->db->where('group_id',$group_id);
		
		$charges = $this->db->get();
		
		foreach($charges->result() as $row)
		{
			$shipping += $row->location_shipping;
			$tax += $row->location_tax;
		}
		
		
		$this->db->from('group_locations');
		$this->db->where('location_type','province');
		$this->db->where('location_id',$loc->province_id);
		$this->db->where('group_id',$group_id);
		
		$charges = $this->db->get();
		
		foreach($charges->result() as $row)
		{
			$shipping += $row->location_shipping;
			$tax += $row->location_tax;
		}
                
                $this->db->from('products');
                $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
                $this->db->where('product_id',$product_id);
                
                $decharges = $this->db->get();
                
                foreach($decharges->result() as $row)
                {
                    if($row->delivery_charge!=-1)
                    {
                        $shipping += $row->delivery_charge;  
                    }
                    else
                    {
                        $shipping = 0;  
                    }
                }
		
		$acharges = array('shipping'=>$shipping,
				 'tax'=>$tax);
                
		return $acharges;		
		
	}
	
	function create($vars)
	{
		$this->db->set('group_name',$vars['group_name']);
		$this->db->insert('groups');
		$lastid = $this->db->insert_id();
		
		$countries = isset($vars['country_id'])?$vars['country_id']:array();
		$provinces = isset($vars['province_id'])?$vars['province_id']:array();
		
		if(count($countries)) {	
			foreach($countries as $row)
			{
				$this->db->set('group_id',$lastid);
				$this->db->set('location_id',$row);
				$this->db->set('location_type','country');
				$this->db->set('location_shipping',$vars['country_shipping'][$row]);
				$this->db->set('location_tax',$vars['country_tax'][$row]);
				$this->db->insert('group_locations');			
			}			
		}

		if(count($provinces)) {	
			foreach($provinces as $row)
			{
				$this->db->set('group_id',$lastid);
				$this->db->set('location_id',$row);
				$this->db->set('location_type','province');
				$this->db->set('location_shipping',$vars['province_shipping'][$row]);
				$this->db->set('location_tax',$vars['province_tax'][$row]);
				$this->db->insert('group_locations');			
			}			
		}		
		
		return $lastid;				
	}
	
	function get_groups()
	{
		$query = $this->db->get('groups');
		return $query->result();
	}
	
	function get_group($id)
	{
		$query = $this->db->get_where('groups',array('group_id'=>$id));
		$result = $query->row();
		$charges = $this->db->get_where('delivery_charges',array('group_id'=>$id));		
		$result->delivery_charge = $charges->result();	
		
		$countries = $this->db->get_where('group_locations',array('group_id'=>$id,'location_type'=>'country'));
		$result->country_id = $countries->result();
		$provinces = $this->db->get_where('group_locations',array('group_id'=>$id,'location_type'=>'province'));
		$result->province_id = $provinces->result();		
		return $result;
	}
	
	function update($vars)
	{
		$this->db->set('group_name',$vars['group_name']);
		$this->db->where('group_id',$vars['group_id']);
		$this->db->update('groups');
		$affrows = $this->db->affected_rows();
		
		$countries = isset($vars['country_id'])?$vars['country_id']:array();
		$provinces = isset($vars['province_id'])?$vars['province_id']:array();		
		
		$this->db->where('group_id',$vars['group_id']);
		$this->db->where('location_type','country');
		$this->db->delete('group_locations');
		
		if(count($countries)) {
		
			foreach($countries as $row=>$val)
			{
				$this->db->set('group_id',$vars['group_id']);
				$this->db->set('location_id',$row);
				$this->db->set('location_type','country');
				$this->db->set('location_shipping',$vars['country_shipping'][$row]);
				$this->db->set('location_tax',$vars['country_tax'][$row]);
				$this->db->insert('group_locations');			
			}			
		}
		
		$this->db->where('group_id',$vars['group_id']);
		$this->db->where('location_type','province');
		$this->db->delete('group_locations');
		
		if(count($provinces)) {
		
			foreach($provinces as $row=>$val)
			{
				$this->db->set('group_id',$vars['group_id']);
				$this->db->set('location_id',$row);
				$this->db->set('location_type','province');
				$this->db->set('location_shipping',$vars['province_shipping'][$row]);
				$this->db->set('location_tax',$vars['province_tax'][$row]);
				$this->db->insert('group_locations');			
			}			
		}
		
		
		return $affrows;			
	}
	
	function delete($id)
	{
		$this->db->delete('group_locations',array('group_id'=>$id));
		$this->db->delete('groups',array('group_id'=>$id));
	}
	
} 