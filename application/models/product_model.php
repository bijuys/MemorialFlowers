<?php

class Product_Model extends CI_Model{
	
	public $web_disc = 0;
	
	
	
	
	function Product_Model()
	{
		parent::__construct();
		
		if($this->session->userdata('disco') != 0){
				$this->web_disc = $this->session->userdata('disco');
		}
		
	}
	
	function updateUrls($vars)
	{
		
		if(count($vars))
		{
			
			//die(print_r($vars));
			
			foreach($vars['url'] as $key=>$val)
			{
				
				if(empty($val))
				{
					$url=url_title(strtolower($vars['name'][$key]));
				}
				else
				{
					$url = $val;
				}
				
				$this->db->where('product_id',$key);
				$this->db->update('products',array('url'=>$url));				
			}
			
		return TRUE;
			
		}
			
	}
	
	function save_search($search)
	{
		$this->db->set('search_string',$search);
		$this->db->set('search_time',date('Y-m-d H:s:i',time()));
		if($this->session->userdata('customer_id')>0)
			$this->db->set('customer_id',$this->session->userdata('customer_id'));
			
		$this->db->insert('searches');
		
		return $this->db->insert_id();
		
	}	
	
	function create($vars,$pic)
	{
		$this->db->set('product_id',str_replace(' ','',trim($vars['product_code'])));
		$this->db->set('product_name',trim($vars['product_name']));
		$this->db->set('url',url_title(strtolower($vars['product_name'])));
		$this->db->set('product_name_fr',trim($vars['product_name_fr']));
		$this->db->set('product_code',str_replace(' ','',trim($vars['product_code'])));
		$this->db->set('alternate_text',$vars['alternate_text']);
		$this->db->set('category_id',$vars['category_id']);
		$this->db->set('preserved_item',isset($vars['preserved_item']) ? '1':'0');
		//$this->db->set('allow_addons',isset($vars['allow_addons']) ? '1':'0');
		$this->db->set('seasonal_item',isset($vars['seasonal_item']) ? '1':'0');
		$this->db->set('delivery_method_id',$vars['delivery_method_id']);
		//$this->db->set('group_id',$vars['group_id']);
		$this->db->set('delivery_policy_id',$vars['delivery_policy_id']);
		$this->db->set('substitution_policy_id',$vars['substitution_policy_id']);
		$this->db->set('contents',$vars['contents']);
		$this->db->set('contents_fr',$vars['contents_fr']);
		$this->db->set('seo_title',$vars['seo_title']);
		$this->db->set('seo_description',$vars['seo_description']);
		$this->db->set('seo_keywords',$vars['seo_keywords']);
		$this->db->set('product_picture',$pic);
		$this->db->set('addon_linking',$vars['addon_linking']);
		$this->db->set('product_description',$vars['product_description']);
		$this->db->set('product_description_fr',$vars['product_description_fr']);
		$this->db->set('product_status',isset($vars['product_status']) ? '1':'0');
		$this->db->set('product_created',date('Y-m-d H:i:s',time()));
		$this->db->set('custom_vase',isset($vars['custom_vase']) ? 1:0);
		$this->db->set('landing_name',$vars['landing_name']);
		$this->db->set('landing_name_fr',$vars['landing_name_fr']);
		$this->db->set('landing_status',isset($vars['landing_status']) ? '1':'0');
		$this->db->insert('products');
		
		$id = $this->db->insert_id();	
		
		if($id>0)
		{
			
			if($vars['addon_linking']!='default')
			{
				if(isset($vars['addons']) && count($vars['addons']))
				{
					foreach($vars['addons'] as $key=>$val)
					{
						$this->db->set('product_id',$id);
						$this->db->set('addon_id',$val);
						$this->db->insert('product_addons');
					}
				}
			}
			
			if(isset($vars['subcategory_id']) && count($vars['subcategory_id']))
			{
				foreach($vars['subcategory_id'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('subcategory_id',$val);
					$this->db->insert('product_subcategories');
				}
			}
			if(isset($vars['option']) && count($vars['option']))
			{
				foreach($vars['option'] as $key=>$val)
				{
						$this->db->set('product_id',$id);
						$this->db->set('price_name',$val);
						$this->db->set('price_value',$vars['price'][$key]);
						$this->db->set('option_picture',$this->_doUpload($key));
						$this->db->insert('product_prices');						
				}				
			}
		
			if(isset($vars['occasions']) && count($vars['occasions']))
			{
				foreach($vars['occasions'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('optionrecord_id',$key);
					$this->db->set('option_type','occasion');
					$this->db->insert('product_options');
				}
			}
			

			
			if(isset($vars['colors']) && count($vars['colors']))
			{
				foreach($vars['colors'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('optionrecord_id',$key);
					$this->db->set('option_type','color');
					$this->db->insert('product_options');
				}
			}
			
			if(isset($vars['related']) && count($vars['related']))
			{
				foreach($vars['related'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('related_id',$key);
					$this->db->insert('related_products');
				}
			}
			
			if(isset($vars['group_id']) && count($vars['group_id']))
			{
				foreach($vars['group_id'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('group_id',$val);	
					$this->db->insert('product_locations');
				}
			}
			
		}
				
	}

	function _doUpload($key) {

		$ufile = array('name' => $_FILES['option_picture']['name'][$key],
				'type' => $_FILES['option_picture']['type'][$key],
				'tmp_name' =>  $_FILES['option_picture']['tmp_name'][$key],
				'error' => $_FILES['option_picture']['error'][$key],
				'size' => $_FILES['option_picture']['size'][$key]);

		$this->load->library('Imaging');

		$this->imaging->upload($ufile);
		if(!$this->imaging->uploaded)
		{
			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = md5(rand(0, 99999999).rand(0,9999999));
			$this->imaging->image_resize = true;
			$this->imaging->ratio = false;
			$this->imaging->image_x = 330;
			$this->imaging->image_y = 370;
			$this->imaging->jpeg_quality     = 100;
			$this->imaging->process('productres/');
			
			if($this->imaging->processed)
			{
				return $this->imaging->file_dst_name;
			}
			else
			{	
				return false;
			}
		}

	}  
	
	function get_filteredProducts($vars)
	{
		
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->join('product_subcategories','products.product_id=product_subcategories.product_id','left');
		$this->db->join('product_options','products.product_id=product_options.product_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
		$this->db->order_by('products.product_name','ASC');
		
		if(!empty($vars['productcode']))
		{
			$this->db->where('products.product_code',$vars['productcode']);
		}
		
		if(!empty($vars['productid']))
		{
			$this->db->where('products.product_id',$vars['productid']);
		}
		
		if(!empty($vars['productid']))
		{
			$this->db->where('products.category_id',$vars['category']);
		}
		
		if(!empty($vars['occasion']))
		{
			$this->db->where('product_options.optionrecord_id',$vars['occasion']);
			$this->db->where('product_options.option_type','occasion');
		}
		
		if(!empty($vars['color']))
		{
			$this->db->where('product_options.optionrecord_id',$vars['color']);
			$this->db->where('product_options.option_type','color');
		}
		
		if(!empty($vars['category']))
		{
			$this->db->where('categories.category_id',$vars['category']);
		}
		
		if(!empty($vars['subcategory']))
		{
			$this->db->where('product_subcategories.subcategory_id',$vars['subcategory']);
		}
		
		
		$this->db->where('product_status !=','-1');
		$this->db->group_by('products.product_id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_products()
	{
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
		$this->db->order_by('product_prices.price_value','ASC');
		$this->db->where('product_status !=','-1');
		$this->db->group_by('products.product_id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_product_prices($id)
	{
		$this->db->from('product_prices');
		$this->db->order_by('product_prices.price_value','ASC');
		$this->db->where('product_id',$id);
		$query = $this->db->get();
		
		return $query->result();
	}

	function get_same($cid,$limit)
	{
		/*
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
		$this->db->where('products.category_id =', $cid);
		$this->db->group_by('products.product_id');
		$this->db->order_by('RAND()');
		$this->db->limit($limit);

		$query = $this->db->get();
		
		return $query->result();	
		*/

		$query = $this->db->query("SELECT *,MIN(pp.price_value) as price_value FROM products p
								  LEFT JOIN product_prices pp ON p.product_id=pp.product_id
								  WHERE p.product_status=1 AND p.customer_page=1 AND p.category_id=".$cid."
								  GROUP BY p.product_id 
								  ORDER BY rand() LIMIT ".$limit);
		
		return $query->result();
		
	}
	
	function get_products_enhanced()
	{
		/*
		$this->db->select('*,GROUP_CONCAT(DISTINCT group_name ORDER BY group_name SEPARATOR \', \') AS group_name');
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
		$this->db->join('product_locations','products.product_id=product_locations.product_id','left');
		$this->db->join('groups','product_locations.group_id=groups.group_id','left');
		$this->db->order_by('products.product_name','ASC');
		$this->db->where('product_status !=','-1');
		$this->db->group_by('products.product_id');
		*/
		$query = $this->db->query("SELECT *,products.product_id AS product_id, 
					  GROUP_CONCAT(DISTINCT group_name ORDER BY group_name SEPARATOR ', ') AS group_name 
					  FROM (products) 
					  LEFT JOIN categories ON products.category_id=categories.category_id  
					  LEFT JOIN product_prices ON products.product_id=product_prices.product_id 
					  LEFT JOIN delivery_methods ON products.delivery_method_id=delivery_methods.delivery_method_id 
					  LEFT JOIN product_locations ON products.product_id=product_locations.product_id 
					  LEFT JOIN groups ON product_locations.group_id=groups.group_id 
					  WHERE product_status != '-1' GROUP BY products.product_id 
					  ORDER BY products.product_name ASC");
		
		return $query->result();
	}
	
	function products_merchandise()
	{
		$query = $this->db->query("SELECT * FROM products p
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									LEFT JOIN categories c ON p.category_id=c.category_id
									WHERE p.customer_page=1
									ORDER BY p.category_id ASC, p.product_id ASC,pp.price_value ASC");
		
		return $query->result();
	}
	
	function get_search_products($limit=100,$options=array())
	{
		
		$wh = '';
		
		$string = str_replace("'","\'",$options['search']);
		
		$query = 'SELECT *,MIN(r.price_value) AS price_value FROM products p ';
		$query .= 'LEFT JOIN categories c ON p.category_id=c.category_id ';
		$query .= 'LEFT JOIN product_subcategories e ON p.product_id=e.product_id ';
		$query .= 'LEFT JOIN sub_categories b ON e.subcategory_id=b.subcategory_id ';
		$query .= 'LEFT JOIN product_prices r ON p.product_id=r.product_id ';
		$query .= 'LEFT JOIN product_options n ON p.product_id=n.product_id ';
		$query .= 'LEFT JOIN colors x ON n.optionrecord_id=x.color_id ';
		$query .= 'LEFT JOIN occasions o ON n.optionrecord_id=o.occasion_id ';
		$query .= 'LEFT JOIN delivery_methods d ON p.delivery_method_id=d.delivery_method_id ';
		//$query .= 'LEFT JOIN groups g ON p.group_id=g.group_id ';

		//$wh .= " OR p.product_description LIKE '%".$val."%' ";
		//$wh .= " OR p.product_code LIKE '%".$val."%') ";
		//$this->db->like("products.product_name",$val);
		//$this->db->or_like("products.product_description",$val);
		//$this->db->where("MATCH (products.product_name,products.product_description) AGAINST ('{$val}' IN BOOLEAN MODE )",NULL,FALSE);
		
		$result = array();
		
		$query .= 'WHERE p.product_status=1 AND p.customer_page=1 ';
		//$query .= '';
		$grp = 'GROUP BY p.product_code ';
		
		$pids = array();
		
		
		$wh = " AND (p.product_name LIKE '%".$this->db->escape_like_str($string)."%' OR p.product_code LIKE '%".$this->db->escape_like_str($string)."%' ) ";
		$res = $this->db->query($query.$wh.$grp);
		
		foreach($res->result() as $row)
		{
			$result[] = $row;
			if(!empty($row->product_id) && $row->product_id>0)
				$pids[] = $row->product_id;
		}
		
		/*
		$wh = " AND (c.category_name LIKE '%".$this->db->escape_like_str($string)."%') ";
		if(count($pids)) { $wh .= "AND p.product_id NOT IN('".implode(',',$pids)."') "; }
		$res = $this->db->query($query.$wh.$grp);
		
		foreach($res->result() as $row)
		{
			$result[] = $row;
			if(!in_array($row->product_id,$pids) && !empty($row->product_id) && $row->product_id>0)
				$pids[] = $row->product_id;
		}
		*/
		
		$wh = "AND (b.subcategory_name LIKE '%".$this->db->escape_like_str($string)."%') ";
		if(count($pids)) { $wh .= "AND p.product_id NOT IN('".implode(',',$pids)."') "; }
		$res = $this->db->query($query.$wh.$grp);
	
		foreach($res->result() as $row)
		{
			$result[] = $row;
			if(!in_array($row->product_id,$pids) && !empty($row->product_id) && $row->product_id>0)
				$pids[] = $row->product_id;
		}
		
		$wh = " AND (p.product_description LIKE '%".$this->db->escape_like_str($string)."%') ";
		if(count($pids)) { $wh .= "AND p.product_id NOT IN('".implode(',',$pids)."') "; }
		$res = $this->db->query($query.$wh.$grp);
		foreach($res->result() as $row)
		{
			$result[] = $row;
			if(!in_array($row->product_id,$pids) && !empty($row->product_id) && $row->product_id>0)
				$pids[] = $row->product_id;
		}
		
		
		return $result;

		//die($this->db->last_query());

	}
	
	function get_category_products($id,$val,$orderby)
	{
		$query = $this->db->query("SELECT *,MIN(pp.price_value) AS price_value FROM categories c
									LEFT JOIN products p ON c.category_id=p.category_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE p.product_status=1 AND p.customer_page=1 AND p.category_id=".$id."".$val."
									GROUP BY p.product_id
									ORDER BY ".$orderby);
		
		return $query->result();
	}
	
	function get_new_search_products($id)
	{
		$query = $this->db->query("SELECT *,MIN(pp.price_value) AS price_value FROM categories c
									LEFT JOIN products p ON c.category_id=p.category_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE p.product_status=1 AND p.customer_page=1 AND (p.product_name LIKE '%".$id."%' OR p.product_code LIKE '%".$id."%')
									GROUP BY p.product_id
									ORDER BY p.product_id DESC");
		
		return $query->result();
	}
	
	function is_product_flowerforservice($id)
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product_options
								   WHERE optionrecord_id=1 AND product_id='".$id."'");
		
		return $query->row();
	
	}
	
	function get_catalog_products($limit=100,$options=array(),$pricesort='')
	{
		$wh = '';
		$order = '';
		
		if(count($options))
		{
			foreach($options as $opt=>$val)
			{				
				switch ($opt)
				{
					case 'category':
						{
							$wh .= " AND (LOWER(REPLACE(c.category_name,'\'',''))='".str_replace('-',' ',$val)."') ";
							$order = " ORDER BY price_value ASC ";
							//$this->db->where('categories.category_name',str_replace('-',' ',$val));
							break;
						}
					case 'subcategory':
						{
							$wh .= " AND (LOWER(REPLACE(b.subcategory_name,'\'',''))='".str_replace('-',' ',$val)."') ";
							//$order = " ORDER BY price_value ASC  ";
							$order = " ORDER BY q.display_order ASC, n.display_order ASC  ";
							//$this->db->where('categories.category_name',str_replace('-',' ',$val));
							break;
						}
					case 'occasion':
						{
							$wh .= " AND (LOWER(REPLACE(o.occasion_name,'\'',''))='".str_replace('-',' ',$val)."') AND (o.occasion_status=1) ";
							$order = " ORDER BY price_value ASC  ";
							//$this->db->where('occasions.occasion_name',str_replace('-',' ',$val));
							break;							
						}
					case 'country':
						{						
							$qr = $this->db->get_where('countries',array('short_code'=>$val));
							
							$res = $qr->row();
							
							$id = isset($res->country_id) ? $res->country_id:0;
							
							$wh .= " AND (z.location_id=".$id." AND location_type='country') ";
							
							//$this->db->where('occasions.occasion_name',str_replace('-',' ',$val));
							break;							
						}
					case 'delivery':
						{
							$wh .= " AND (LOWER(REPLACE(d.delivery_method,'\'',''))='".str_replace('-',' ',$val)."') ";
							//$this->db->where('delivery_methods.delivery_method',str_replace('-',' ',$val));
							break;							
						}
					case 'color':
						{
							$wh .= " AND (LOWER(REPLACE(x.color_name,'\'',''))='".str_replace('-',' ',$val)."') ";
							//$this->db->where('delivery_methods.delivery_method',str_replace('-',' ',$val));
							break;							
						}
                                        case 'search':
                                                {
							$wh .= " AND (p.product_name LIKE '%".$val."%' ";
							$wh .= " OR p.product_description LIKE '%".$val."%' ";
							$wh .= " OR p.product_code LIKE '%".$val."%') ";
							//$this->db->like("products.product_name",$val);
							//$this->db->or_like("products.product_description",$val);
                                                        //$this->db->where("MATCH (products.product_name,products.product_description) AGAINST ('{$val}' IN BOOLEAN MODE )",NULL,FALSE);
                                                }
				}
				
			}
		}
		
		$query = 'SELECT *,TRUNCATE((r.price_value-(r.price_value*'.$this->web_disc.')), 2) AS price_value FROM products p ';
		$query .= 'LEFT JOIN categories c ON p.category_id=c.category_id ';
		$query .= 'LEFT JOIN category_products xg ON p.product_id=xg.product_id AND p.category_id=xg.category_id ';
		$query .= 'LEFT JOIN product_subcategories e ON p.product_id=e.product_id ';
		$query .= 'LEFT JOIN sub_categories b ON e.subcategory_id=b.subcategory_id ';
		$query .= 'LEFT JOIN product_prices r ON p.product_id=r.product_id ';
		$query .= 'LEFT JOIN product_options q ON p.product_id=q.product_id ';
		$query .= 'LEFT JOIN product_options n ON p.product_id=n.product_id ';
		$query .= "LEFT JOIN colors x ON q.optionrecord_id=x.color_id AND q.option_type='color' ";
		$query .= "LEFT JOIN occasions o ON n.optionrecord_id=o.occasion_id AND n.option_type='occasion' ";
		$query .= 'LEFT JOIN delivery_methods d ON p.delivery_method_id=d.delivery_method_id ';
		$query .= 'LEFT JOIN product_locations u ON p.product_id=u.product_id ';
		$query .= 'LEFT JOIN groups g ON u.group_id=g.group_id ';
		$query .= 'LEFT JOIN group_locations z ON g.group_id=z.group_id ';
		$query .= 'WHERE (p.product_status=1) AND (p.customer_page=1) '.$wh;
		$query .= 'GROUP BY p.product_id ';

		if($pricesort=='L')
		{
			$query .= 'ORDER BY r.price_value ASC';
		}
		elseif($pricesort='H')
		{
			$query .= 'ORDER BY r.price_value DESC';
		}

		//$query .= 'ORDER BY q.display_order ASC,p.product_id ASC';
		
		$query .= $order;
		
		$res = $this->db->query($query);
		
		return $res->result();
		
		
		/*
		
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('product_options','products.product_id=product_options.product_id','left');
		$this->db->join('occasions','product_options.optionrecord_id=occasions.occasion_id','left');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
		$this->db->join('groups','products.group_id=groups.group_id','left');
		$this->db->where('products.product_status','1');
		$this->db->group_by('products.product_id');
		$query = $this->db->get();
		
		die($this->db->last_query());
		
		return $query->result();
		
		*/		

	}
	
	function get_home_groups($num=100)
	{
		//$ci=& get_instance();
		
		
		$this->db->order_by('display_order','ASC');
		$groups = $this->db->get_where('product_groups',array('publish_home'=>1));
		$container = array();
		
		foreach($groups->result() as $row)
		{
			
			/*$this->db->from('products');
			$this->db->join('group_products','group_products.product_id=products.product_id');
			$this->db->join('product_prices','products.product_id=product_prices.product_id');
			$this->db->join('product_options','products.product_id=product_options.product_id AND option_type="occasion"','left');
			$this->db->join('occasions','product_options.optionrecord_id=occasions.occasion_id','left');
			$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id');
			$this->db->where('products.product_status','1');
			$this->db->where('occasions.occasion_status','1');
			$this->db->where('group_products.productgroup_id',7);
			$this->db->group_by('products.product_id');
			$this->db->limit($num);
			
			$query = $this->db->get();*/
			
			//echo $this->session->userdata('disco');
			/*echo '<br />';
			
			
			echo $this->web_disc;*/
			
			$query = $this->db->query("SELECT *, TRUNCATE((pp.price_value-(pp.price_value*$this->web_disc)), 2) AS price_value FROM products p
LEFT JOIN group_products gp ON p.product_id=gp.product_id
LEFT JOIN product_prices pp ON p.product_id=pp.product_id
LEFT JOIN product_options po ON p.product_id=po.product_id
LEFT JOIN occasions o ON po.optionrecord_id=o.occasion_id
LEFT JOIN delivery_methods dm ON p.delivery_method_id=dm.delivery_method_id
WHERE p.product_status=1
AND o.occasion_status=1
AND gp.productgroup_id=7 
GROUP BY p.product_id");
			
			$groupitems = $query->result();
			
			$grp = $row;
			$grp->products = $groupitems;
			
			
			
			
			
		
		 
			
			
			
			
			
			//san code
			/*$price_container = array();
			foreach($groupitems as $ploop) {
			$price_value=round($ploop->price_value-10.00,2);
			print_r($price_value);
			$price_container=$price_value;
			}
			$grp->price_value = $price_container;*/
			//end here
			
		
		
		
			
			
			$container[] = $grp;		
			
			//print_r($container);
			
			
			
		}
		
		
		return $container;		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	function get_subcat_pros($id,$val,$orderby)
	{ 

		$query = $this->db->query("SELECT *,MIN(pp.price_value) AS price_value FROM product_subcategories ps
									LEFT JOIN products p ON ps.product_id=p.product_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE ps.subcategory_id=".$id." AND p.product_status=1 AND p.customer_page=1".$val."
									GROUP BY p.product_id
									ORDER BY ".$orderby);
		
		return $query->result();		
	}
	
	function get_full_catalog_products($val,$orderby)
	{ 

		$query = $this->db->query("SELECT *,MIN(pp.price_value) AS price_value FROM products p
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE p.product_status=1 AND p.customer_page=1".$val."
									GROUP BY p.product_id
									ORDER BY ".$orderby." LIMIT 150");
		
		return $query->result();		
	}
	
	function get_occas_pros($id,$val,$orderby)
	{ 

		$query = $this->db->query("SELECT *,MIN(pp.price_value) AS price_value FROM product_options po
									LEFT JOIN products p ON po.product_id=p.product_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE p.product_status=1 AND p.customer_page=1 AND po.optionrecord_id=".$id."".$val."
									GROUP BY p.product_id
									ORDER BY ".$orderby);
		
		return $query->result();		
	}
	
	function get_grouped_products($num=100)
	{
		$this->db->from('products');
		$this->db->join('group_products','group_products.product_id=products.product_id');
		$this->db->join('product_prices','products.product_id=product_prices.product_id');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id');
		$this->db->where('products.product_status','1');
		$this->db->where('group_products.productgroup_id','7');
		$this->db->group_by('products.product_id');
		$this->db->limit($num);
		$query = $this->db->get();
		
		return $query->result();		
	}
	
	function get_by_price($from = 0, $to = 1000)
	{ 

		$query = $this->db->query(" SELECT p.product_name, r.price_value_original, p.url, p.product_picture FROM products p
						   LEFT JOIN product_prices r ON p.product_id=r.product_id
						   WHERE p.customer_page=1 AND r.price_value_original BETWEEN {$from} AND {$to}
						   order by r.price_value_original");
		
		return $query->result();		
	}
		
	function get_home_products($num=100)
	{
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id');
		$this->db->join('product_prices','products.product_id=product_prices.product_id');
		$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id');
		$this->db->join('groups','products.group_id=groups.group_id');
		$this->db->where('product_status','1');
		$this->db->group_by('products.product_id');
		$this->db->limit($num);
		$query = $this->db->get();
		
		return $query->result();		
	}
	
	function get_urlitem($url)
	{
		$query = $this->db->get_where('products',array('url'=>$url));
		
		foreach($query->result() as $row)
		{
			
			
			
			
			
			

			$id = $row->product_id;
			$cat =  $this->db->get_where('categories',array('category_id'=>$row->category_id));			
			$row->category = $cat->row();			
			$subcat = $this->db->get_where('product_subcategories',array('product_id'=>$id));
			$row->subcategories = $subcat->result();
			$this->db->order_by('price_value','ASC');			
			$pric = $this->db->get_where('product_prices',array('product_id'=>$id));
			//$pric = $pric*$this->web_disc;
			$row->prices = $pric->result();
			$occ = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'occasion'));
			$row->occasions = $occ->result();
			$col = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'color'));
			$row->colors = $col->result();
			$dpol = $this->db->get_where('message_templates',array('message_id'=>$row->delivery_policy_id));
			$spol = $this->db->get_where('message_templates',array('message_id'=>$row->substitution_policy_id));
			$row->delivery_policy = $dpol->result();
			$row->substitution_policy = $spol->result();
			$rels = $this->db->query("SELECT *,p.product_id AS product_id FROM related_products r LEFT JOIN
						 products p ON r.related_id=p.product_id
						 LEFT JOIN product_prices d ON p.product_id=d.product_id
						 WHERE r.product_id='{$row->product_id}'");
			$row->related = $rels->result();
			
			if($row->addon_linking=='include')
			{
				$row->addons = $this->get_includeAddons($row->product_id);	
			}
			elseif($row->addon_linking=='exclude')
			{
				$row->addons = $this->get_excludeAddons($row->product_id);	
			}
			else
			{
				$row->addons = $this->get_defaultAddons($row->product_id);	
			}			
			
			return $row;
		}
		
	}
	

	function get_includeAddons($id)
	{
		$query = $this->db->get_where('product_addons',array('product_id'=>$id));
		
		$include_list = array();
		
		foreach($query->result() as $row)
		{
			$include_list[] = $row->addon_id;
		}


		$this->db->from('addon_products');
		$this->db->where_in('addon_id',$include_list);
		$query = $this->db->get();
			
		$result = array();
		
		foreach($query->result() as $row)
		{
			$res = $row;
			$prices = $this->db->get_where('addon_prices',array('addon_id'=>$row->addon_id));
			$res->prices = $prices->result();

			$result[] = $res;

		}
		
		return $result;			

	}
	

	function get_excludeAddons($id)
	{
		$query = $this->db->get_where('product_addons',array('product_id'=>$id));
		
		$exclude_list = array();
		
		foreach($query->result() as $row)
		{
			$exclude_list[] = $row->addon_id;
		}


		$this->db->from('addon_products');
		$this->db->where_not_in('addon_id',$exclude_list);
		$query = $this->db->get();
			
		$result = array();
		
		foreach($query->result() as $row)
		{
			$res = $row;
			$prices = $this->db->get_where('addon_prices',array('addon_id'=>$row->addon_id));
			$res->prices = $prices->result();

			$result[] = $res;

		}
		
		return $result;			

	}
	
	
	function get_defaultAddons($id)
	{
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->where('products.product_id',$id);

		$query = $this->db->get();
		$product = $query->row();

		if($product->show_addons==1)
		{

			$this->db->from('addons_deliverymethods');
			$this->db->join('addon_products','addons_deliverymethods.addon_id=addon_products.addon_id','left');
			$this->db->group_by('addons_deliverymethods.addon_id');
			$this->db->where('addons_deliverymethods.delivery_method_id',$product->delivery_method_id);
			$query = $this->db->get();
			
			$result = array();
			
			foreach($query->result() as $row)
			{
				$res = $row;
				$prices = $this->db->get_where('addon_prices',array('addon_id'=>$row->addon_id));
				$res->prices = $prices->result();

				$result[] = $res;

			}
			
			return $result;			
		}

		return array();	
	}
	
	function get_item($id)
	{
		$query = $this->db->get_where('products',array('product_code'=>$id));
		
		foreach($query->result() as $row)
		{
			
			$id = $row->product_id;
			$cat =  $this->db->get_where('categories',array('category_id'=>$row->category_id));			
			$row->category = $cat->row();			
			$subcat = $this->db->get_where('product_subcategories',array('product_id'=>$id));
			$row->subcategories = $subcat->result();
			$this->db->order_by('price_value','ASC');			
			$pric = $this->db->get_where('product_prices',array('product_id'=>$id));
			$row->prices = $pric->result();
			$occ = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'occasion'));
			$row->occasions = $occ->result();
			$col = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'color'));
			$row->colors = $col->result();
			$cpol = $this->db->get_where('message_templates',array('message_id'=>$row->contents_id));
			$dpol = $this->db->get_where('message_templates',array('message_id'=>$row->delivery_policy_id));
			$spol = $this->db->get_where('message_templates',array('message_id'=>$row->substitution_policy_id));
			$row->contents = $cpol->result();
			$row->delivery_policy = $dpol->result();
			$row->substitution_policy = $spol->result();
			$rels = $this->db->query("SELECT *,p.product_id AS product_id FROM related_products r LEFT JOIN
						 products p ON r.related_id=p.product_id
						 LEFT JOIN product_prices d ON p.product_id=d.product_id
						 WHERE r.product_id={$row->product_id}");
			$row->related = $rels->result();
			return $row;
		}
		
	}
	
	
	function get_product_info($id)
	{
		$this->db->from('products');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->where('products.product_id',$id);
		$this->db->order_by('product_prices.price_value','asc');
		$this->db->limit('1');
		$query = $this->db->get();

		return $query->row();
		
	}
	
	function get_product($id)
	{
		$query = $this->db->get_where('products',array('product_id'=>$id));
		foreach($query->result() as $row)
		{
			$subcat = $this->db->get_where('product_subcategories',array('product_id'=>$id));
			$row->subcategories = $subcat->result();
			$pric = $this->db->get_where('product_prices',array('product_id'=>$id));
			$row->prices = $pric->result();
			$loc = $this->db->get_where('product_locations',array('product_id'=>$id));
			$row->locations = $loc->result();
			$occ = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'occasion'));
			$row->occasions = $occ->result();
			$col = $this->db->get_where('product_options',array('product_id'=>$id,'option_type'=>'color'));
			$row->colors = $col->result();
			$rel = $this->db->get_where('related_products',array('product_id'=>$id));
			$row->related = $rel->result();
			$rel = $this->db->get_where('product_addons',array('product_id'=>$id));
			$row->addons = $rel->result();
			
			return $row;
		}
		
	}
	
	function update_color($product_id,$color)
	{
	
		$this->db->set('color',$color);
		$this->db->where('product_id',$product_id);
		$this->db->update('products');
	
	}
	
	function update_pro_info_news($product_id,$price_id,$price_name,$price_value)
	{
		$this->db->set('price_name',$price_name);
		$this->db->set('price_value',$price_value);
		$this->db->where('product_id',$product_id);
		$this->db->where('price_id',$price_id);
		$this->db->update('product_prices');
	
	}
	
	function update_pro_customer_news($product_id,$statu)
	{
		$this->db->set('customer_page',$statu);
		$this->db->where('product_id',$product_id);
		$this->db->update('products');
	
	}
	
	/*
	function update_pro_customer_news($product_id,$statu)
	{
		$this->db->set('customer_page',1);
		$this->db->where('product_id','101046');
		$this->db->update('products');
	
	}
	*/
	
	function insert_similar_product($id,$id2)
	{
	
		$this->db->set('session_id',$id);
		$this->db->set('product_id',$id2);
		$this->db->insert('similar_pro');
	
	}
	
	function insert_pri_pro_new($name,$price,$d,$imagepic2,$product_id)
	{
	
		$this->db->set('price_name',$name);
		$this->db->set('price_value',$price);
		$this->db->set('price_value_mymemorial',$price);
		$this->db->set('price_value_original',$price);
		$this->db->set('valentine',$price);
		$this->db->set('mother',$price);
		$this->db->set('christmas',$price);
		$this->db->set('product_id',$product_id);
		$this->db->set('price_val',$d);
		$this->db->set('option_picture',$imagepic2);
		$this->db->insert('product_prices');
	
	}
	
	function get_sim_pro($id,$id2,$id3)
	{
	
		$query = $this->db->query("SELECT *,MIN(pp.price_value) as price_value FROM similar_pro sp
									LEFT JOIN products p ON sp.product_id=p.product_id
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE sp.session_id='".$id."' AND sp.product_id<>'".$id2."'
									GROUP BY sp.product_id
									ORDER BY id DESC LIMIT ".$id3);
		
		return $query->result();	
	
	}
	
	function get_website_products()
	{
		$query = $this->db->query("SELECT * FROM products
									WHERE product_status=1 AND customer_page=1
									ORDER BY product_id ASC");
		
		return $query->result();	
	}
	
	function get_website_product_prices($id)
	{
		$query = $this->db->query("SELECT * FROM product_prices
									WHERE product_id='".$id."'
									ORDER BY price_value ASC");
		
		return $query->result();
	}
	
	function update_price_new($price_id,$product_id,$price_name,$price_val,$product_picture)
	{
	
		$this->db->set('price_name',$price_name);
		$this->db->set('price_val',$price_val);
		$this->db->set('option_picture',$product_picture);
		$this->db->where('product_id',$product_id);
		$this->db->where('price_id',$price_id);
		$this->db->update('product_prices');
	
	}
	
	function delete_price_new($price_id,$product_id)
	{
		$this->db->where('product_id',$product_id);
		$this->db->where('price_id',$price_id);
		$this->db->delete('product_prices');
	}
	
	function delete_pro_pri_all($product_id)
	{
		$this->db->where('product_id',$product_id);
		$this->db->delete('product_prices');
	}
	
	function update($vars,$pic)
	{


		$this->db->set('product_id',str_replace(' ','',trim($vars['product_code'])));
		$this->db->set('product_name',trim($vars['product_name']));
		$this->db->set('product_name_fr',trim($vars['product_name_fr']));
		$this->db->set('product_code',str_replace(' ','',trim($vars['product_code'])));
		$this->db->set('alternate_text',$vars['alternate_text']);
		$this->db->set('category_id',$vars['category_id']);
		$this->db->set('preserved_item',isset($vars['preserved_item']) ? '1':'0');
		//$this->db->set('allow_addons',isset($vars['allow_addons']) ? '1':'0');
		$this->db->set('seasonal_item',isset($vars['seasonal_item']) ? '1':'0');
		$this->db->set('delivery_method_id',$vars['delivery_method_id']);
		//$this->db->set('group_id',$vars['group_id']);
		$this->db->set('delivery_policy_id',$vars['delivery_policy_id']);
		$this->db->set('substitution_policy_id',$vars['substitution_policy_id']);
		$this->db->set('seo_title',$vars['seo_title']);
		$this->db->set('seo_description',$vars['seo_description']);
		$this->db->set('addon_linking',$vars['addon_linking']);
		$this->db->set('seo_keywords',$vars['seo_keywords']);
		$this->db->set('contents',$vars['contents']);
		$this->db->set('contents_fr',$vars['contents_fr']);
		$this->db->set('landing_name',$vars['landing_name']);
		$this->db->set('landing_name_fr',$vars['landing_name_fr']);
		$this->db->set('landing_status',isset($vars['landing_status']) ? '1':'0');
		if($pic!='')
		{
			$this->db->set('product_picture',$pic);
		}
		$this->db->set('product_description',$vars['product_description']);
		$this->db->set('product_description_fr',$vars['product_description_fr']);
		$this->db->set('product_status',isset($vars['product_status']) ? '1':'0');
		$this->db->set('custom_vase',isset($vars['custom_vase']) ? 1:0);
		$this->db->where('product_id',$vars['product_id']);
		$this->db->update('products');
		
		$id = $vars['product_id'];	
		
		if(!empty($id))
		{
			$this->db->where('product_id',$id);
			$this->db->delete('product_addons');
			
			if($vars['addon_linking']!='default')
			{
				if(isset($vars['addons']) && count($vars['addons']))
				{
					foreach($vars['addons'] as $key=>$val)
					{
						$this->db->set('product_id',$id);
						$this->db->set('addon_id',$val);
						$this->db->insert('product_addons');
					}
				}
			}
			
			$subcats = array('0');
			
			//$this->db->delete('product_subcategories',array('product_id'=>$id));			
			
			/*
			if(isset($vars['subcategory_id']) && count($vars['subcategory_id']))
			{
				foreach($vars['subcategory_id'] as $key=>$val)
				{
					$subcats[] = $val;
					
					$query = $this->db->get_where('product_subcategories',array('subcategory_id'=>$val,
												    'product_id'=>$id));
					
					if($query->num_rows()==0)
					{
						$this->db->set('product_id',$id);
						$this->db->set('subcategory_id',$val);
						$this->db->set('display_order','0');
						$this->db->insert('product_subcategories');						
					}
				}
			}
			
			
			$subc = implode(',',$subcats);
			
			$this->db->query("DELETE FROM product_subcategories WHERE product_id='{$id}' AND subcategory_id NOT IN ({$subc})");
			*/
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			/*
			$this->db->delete('product_prices',array('product_id'=>$id));
		
			if(isset($vars['option']) && count($vars['option']))
			{
				foreach($vars['option'] as $key=>$val)
				{
					
					
					$img =  $this->_doUpload($key);
					
					$this->db->set('product_id',$id);
					$this->db->set('price_name',$val);
					$this->db->set('price_value',$vars['price'][$key]);
					$this->db->set('option_picture', empty($img) ? $vars['existing_picture'][$key]:$imagepic2);
					$this->db->insert('product_prices');					
				}				
			}
			*/
			
			
			
			
			
			
			
			
			
			
			
			
			/*
			$this->db->delete('product_options',array('product_id'=>$id));
		
			if(isset($vars['occasions']) && count($vars['occasions']))
			{
				foreach($vars['occasions'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('optionrecord_id',$key);
					$this->db->set('option_type','occasion');
					$this->db->set('display_order',$vars['occasion_order'][$key]);
					$this->db->insert('product_options');
				}
			}
			*/
			$this->db->delete('related_products',array('product_id'=>$id));
			
			if(isset($vars['related']) && count($vars['related']))
			{
				foreach($vars['related'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('related_id',$key);
					$this->db->insert('related_products');
				}
			}
			
			if(isset($vars['colors']) && count($vars['colors']))
			{
				foreach($vars['colors'] as $key=>$val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('optionrecord_id',$key);
					$this->db->set('option_type','color');
					$this->db->insert('product_options');
				}
			}
			
			$this->db->delete('product_locations',array('product_id'=>$id));
			
			if(isset($vars['group_id']) && count($vars['group_id']))
			{
				foreach($vars['group_id'] as $val)
				{
					$this->db->set('product_id',$id);
					$this->db->set('group_id',$val);	
					$this->db->insert('product_locations');
				}
			}
			
		}
		
		return true;	
	}
	
	function update_price($product_id,$price_id,$price_val,$price_name,$price_customer,$price_affiliate)
	{
	
		$this->db->set('price_val',$price_val);
		$this->db->set('price_name',$price_name);
		$this->db->set('price_value',$price_customer);
		$this->db->set('price_value_mymemorial',$price_affiliate);
		$this->db->where('product_id',$product_id);
		$this->db->where('price_id',$price_id);
		$this->db->update('product_prices');
	
	}
	
	function update_main_product_picture($product_id,$price_picture)
	{
		
		$this->db->set('product_picture',$price_picture);
		$this->db->where('product_id',$product_id);
		$this->db->update('products');
	
	}
	
	function update_pro_info($product_id,$customer_page,$affiliate_page)
	{
	
		$this->db->set('customer_page',$customer_page);
		$this->db->set('affiliate_page',$affiliate_page);
		$this->db->where('product_id',$product_id);
		$this->db->update('products');
	
	}
	
	function is_dup_exists($value,$field,$id)
	{
		$this->db->from('products');
		$this->db->where($field,$value);
		$this->db->where('product_code <>',$id);
		$query = $this->db->get();
		if($query->num_rows>0)
			return TRUE;
		else
			return FALSE;
	}
	
	function is_exists($value,$field,$id)
	{
		$this->db->from('products');
		$this->db->where($field,$value);
		$this->db->where('product_id <>',$id);
		$query = $this->db->get();
		if($query->num_rows>0)
			return TRUE;
		else
			return FALSE;
	}
	
	function delete($id)
	{
		$this->db->delete('products',array('product_id'=>$id));
		return $this->db->affected_rows();
	}
	
	function get_sliders()
	{
		$this->db->from('product_slides');
		$this->db->join('products','product_slides.product_id=products.product_id','left');
		$this->db->group_by('product_slides.slide_id');
		$this->db->order_by('product_slides.sort_order','asc');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_slide($id)
	{
		$this->db->from('product_slides');
		$this->db->join('products','product_slides.product_id=products.product_id','left');
		$this->db->where('slide_id',$id);
		$this->db->order_by('sort_order','asc');
		$query = $this->db->get();
		
		return $query->row();		
	}
	
	function create_Slide($vars)
	{
		$data = array('product_id'=>$vars['product_id'],
			      'sort_order'=>$vars['req_order']);
		
		$this->db->query("UPDATE product_slides SET sort_order=sort_order+1 WHERE
					  sort_order >= ".$vars['req_order']);	
		
		$this->db->insert('product_slides',$data);
		
		return $this->db->insert_id();
				
	}
	
	function update_Slide($vars)
	{
		$data = array('product_id'=>$vars['product_id'],
			      'sort_order'=>$vars['req_order']);
		
		$curr = $vars['sort_order']>0 ? $vars['sort_order']:0;
		$requ = $vars['req_order'];
		
		$this->db->query("UPDATE product_slides SET sort_order=sort_order-1 WHERE
				  sort_order >= {$curr} AND slide_id<>".$vars['slide_id']);
		
		$this->db->where('slide_id',$vars['slide_id']);		
		$this->db->update('product_slides',$data);
		
		$this->db->query("UPDATE product_slides SET sort_order=sort_order+1 WHERE
					  sort_order >= {$requ} AND slide_id<>".$vars['slide_id']);		
		

		
		return $this->db->affected_rows();
				
	}
	
	function delete_Slide($id)
	{
		$this->db->delete('product_slides',array('slide_id'=>$id));
		return $this->db->affected_rows();
	}
	
	
	
	
	
	
	/* ******************** MyMemorial Flowers *******************************/
	
	
	
	
	
	function getActiveProducts()
	{
		$this->db->from('products');
		$this->db->join('price','products.product_id=price.product_id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function getItemDetail($id,$price_id)
	{
		$this->db->from('products');
		$this->db->join('price','products.product_id=price.product_id','left');
		$this->db->where('products.product_id',$id);
		$this->db->where('price.price_id',$price_id);
		$this->db->where('products.active','1');
		
		return $this->db->get()->row();
	}
	
	function getItemDetailByPrice($price_id)
	{
		$this->db->from('products');
		$this->db->join('price','products.product_id=price.product_id','left');
		$this->db->where('price.price_id',$price_id);
		$this->db->where('products.active','1');
		
		return $this->db->get()->row();
	}
	
	function getAddons()
	{
		$query = $this->db->get('addon_products');
		
		return $query->result();	
	}
	
	function getRecent($num)
	{
		$this->db->from('products');
		$this->db->where('active',1);
		$this->db->order_by('created','DESC');
		$this->db->limit($num,0);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function getItems($vars)
	{
		foreach($vars as $var)
		{
			$item[] = "'".$var."'";
		}
		$items = implode(',',$item);
		
		$query = $this->db->query("SELECT * FROM products p LEFT JOIN price r ON p.product_id=r.product_id
					  WHERE p.product_id IN({$items}) GROUP BY p.product_id");
		return $query->result();
	}
	
	function getProductItems()
	{
		$query = $this->db->query("SELECT * FROM products p
					  LEFT JOIN price r ON p.product_id=r.product_id
					  GROUP BY p.product_id");
		
		return $query->result();
	}
	
	public function getProduct($id)
	{
		$query = $this->db->get_where('products',array('product_id'=>$id));
		
		foreach($query->result() as $row)
		{
			$prod = $row;
			
			$prices = $this->db->get_where('price',array('product_id'=>$id));
			
			foreach($prices->result() as $pricerow)
			{
				$prod->prices[] = $pricerow;
			}
			
			$colors = $this->db->get_where('product_color',array('product_id'=>$id));
			
			$prod->color_id = array();
			
			foreach($colors->result() as $colrow)
			{
				$prod->color_id[] = $colrow->color_id;
			}
			
			$prod->occassion_id = array();
			
			$occassions = $this->db->get_where('product_occassion',array('product_id'=>$id));
			foreach($occassions->result() as $occrow)
			{
				$prod->occassion_id[] = $occrow->occassion_id;
			}
			
			return $prod;
			
		}
	}
	
	public function myMemorial_Create($vars,$image='')
	{
		$data['product_id'] = $vars['product_id'];
		$data['product'] = $vars['product'];
		$data['description'] = $vars['description'];
		$data['detail'] = $vars['detail'];
		$data['type_id'] = $vars['type_id'];
		$data['category_id'] = $vars['category_id'];
		$data['delivery_id'] = $vars['delivery_id'];
		$data['picture'] = $image;
		$data['active'] = isset($vars['active']) ? '1':'0';
		
		$data['preserved'] = isset($vars['preserved']) ? '1':'0';
		$data['premier'] = isset($vars['premier']) ? '1':'0';
		$data['additem'] = isset($vars['additem']) ? '1':'0';
		$data['seasonal'] = isset($vars['seasonal']) ? '1':'0';
		$data['sameday'] = $vars['delivery_id']==1 ? '1':'0';
		$data['pdisplay'] = 1;
		$data['created'] = date('Y-m-d',time());
		$data['sameday'] = $vars['delivery_id']==1 ? '1':'0';
		$data['discount'] = 0;
		
		if($this->db->insert('products',$data))
		{
			
			foreach($vars['price'] as $key=>$val)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['price'] = $val;
				$data['title'] = $vars['title'][$key];
				$data['details'] = $vars['details'][$key];
				
				$this->db->insert('price',$data);
			}

			foreach($vars['color_id'] as $color)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['color_id'] = $color;
				
				$this->db->insert('product_color',$data);
			}
			
			foreach($vars['occassion_id'] as $occassion)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['occassion_id'] = $occassion;
				
				$this->db->insert('product_occassion',$data);
			}
			
			return TRUE; 
		}
				
	}
	
	
	public function myMemorial_Update($vars,$image='',$id)
	{
		$data['product_id'] = $vars['product_id'];
		$data['product'] = $vars['product'];
		$data['description'] = $vars['description'];
		$data['detail'] = $vars['detail'];
		$data['type_id'] = $vars['type_id'];
		$data['category_id'] = $vars['category_id'];
		$data['delivery_id'] = $vars['delivery_id'];
		if(!empty($image))
		{
			$data['picture'] = $image;
		}
		$data['active'] = isset($vars['active']) ? '1':'0';
		
		$data['preserved'] = isset($vars['preserved']) ? '1':'0';
		$data['premier'] = isset($vars['premier']) ? '1':'0';
		$data['additem'] = isset($vars['additem']) ? '1':'0';
		$data['seasonal'] = isset($vars['seasonal']) ? '1':'0';
		$data['sameday'] = $vars['delivery_id']==1 ? '1':'0';
		
		$this->db->where('product_id',$id);
		
		if($this->db->update('products',$data))
		{
			$this->db->delete('price',array('product_id'=>$id));
			
			foreach($vars['price'] as $key=>$val)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['price'] = $val;
				$data['title'] = $vars['title'][$key];
				$data['details'] = $vars['details'][$key];
				
				$this->db->insert('price',$data);
			}
			
			$this->db->delete('product_color',array('product_id'=>$id));

			foreach($vars['color_id'] as $color)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['color_id'] = $color;
				
				$this->db->insert('product_color',$data);
			}
			
			$this->db->delete('product_occassion',array('product_id'=>$id));
			
			foreach($vars['occassion_id'] as $occassion)
			{
				$data = array();
				$data['product_id'] = $vars['product_id'];
				$data['occassion_id'] = $occassion;
				
				$this->db->insert('product_occassion',$data);
			}
			
			return TRUE; 
		}
				
	}
	
	
	public function getCatalog($vars,$start=0,$limit=1000)
	{
		$this->db->where('product_status',1);
		
		if(!empty($vars['customer_id']))
		{
		    //$this->db->where('c.customer_id',$vars[customer_id]);
		}
		
		if(!empty($vars['sales_min']))
		{
		    //$this->db->where('amount >=',$vars[sales_min]);
		}
		
		if(!empty($vars['sales_max']))
		{
		   // $this->db->where('amount <=',$vars[sales_max]);
		}
		
		if(!empty($vars['joined_after']))
		{
		     //$this->db->where('product_created >=',$vars[joined_after]);
		}
		
		if(!empty($vars['joined_before']))
		{
		    //$this->db->where('product_created <=',$vars[joined_before]);
		}
		
		if(!empty($vars['keyword']))
		{
		    //$this->db->like('product_name',$vars['keyword']);
		    //$this->db->or_like('product_code',$vars['keyword']);
		}
		
		$this->db->from('products');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->order_by('product_created','DESC');
		$this->db->order_by('price_value','ASC');
		
		$query = $this->db->get();
		
		
		
		/*
		
		$query = $this->db->query("SELECT * FROM products p
					  LEFT JOIN price r ON p.product_id=r.product_id 
					  {$where}   
					  ORDER BY p.created DESC, r.price ASC  
					  LIMIT {$start},{$limit}");
					  
		*/
		
		$products = array();
		$prevprod = '';
		
		foreach($query->result() as $row)
		{
			$prices = array('price_id'=>$row->price_id,
					'price'=>$row->price_value,
					'title'=>$row->price_name	);
			
			if($row->product_id)
			{
			
				if($prevprod!=$row->product_id)
				{
					$prod = $row;
					$prod->prices[] = (object) $prices;
					$products[$row->product_id] = $prod;
				}
				else
				{
					$products[$row->product_id]->prices[] = (object) $prices;
				}
	
				$prevprod = $row->product_id;
				
			}
			
		}
		
		return $products;	

	 

		 
	}

	
	
	public function getProducts($vars,$start=0,$limit=1000)
	{
		$where = 'WHERE o.cstatus="CM"';
		
		if(!empty($vars['customer_id']))
		{
		    $where .= ' AND c.customer_id='.$vars[customer_id];
		}
		
		if(!empty($vars['sales_min']))
		{
		    $where .= ' AND amount>='.$vars[sales_min];
		}
		
		if(!empty($vars['sales_max']))
		{
		    $where .= ' AND amount<='.$vars[sales_max];
		}
		
		if(!empty($vars['joined_after']))
		{
		    $where .= ' AND created>='.$vars[joined_after];
		}
		
		if(!empty($vars['joined_before']))
		{
		    $where .= ' AND created<='.$vars[joined_before];
		}
		
		if(!empty($vars['keyword']))
		{
		    $where .= " AND (product LIKE '%".$vars['keyword']."%' OR decription LIKE '%".$vars['keyword']."%' OR product_id LIKE '%".$vars['keyword']."%')";
		}
		
		$query = $this->db->query("SELECT p.product_id,p.product,p.created,p.picture,p.active,  
					  (SELECT COUNT(order_product_id) AS sales FROM order_product r
					   LEFT JOIN orders o ON r.order_id=o.order_id
					   WHERE o.cstatus='CM' AND r.product_id=p.product_id GROUP BY r.product_id) AS sales,
					   (SELECT SUM(i.amount) AS amount FROM order_product r
					   LEFT JOIN orders o ON r.order_id=o.order_id
					   LEFT JOIN invoice i ON o.order_id=i.order_id 
					   WHERE o.cstatus='CM' AND r.product_id=p.product_id GROUP BY r.product_id) AS amount, price  
					   FROM products p
					   LEFT JOIN price r ON p.product_id=r.product_id 
					   ORDER BY created DESC
					   LIMIT {$start},{$limit}");
	 
	 /*
		$query = $this->db->query("SELECT p.*,COUNT(i.invoice_id) AS sales, SUM(i.amount) AS amount
				     FROM products p
				     LEFT JOIN order_product r ON p.product_id=r.product_id 
				     LEFT JOIN orders o ON r.order_id=o.order_id
				     LEFT JOIN invoice i ON o.order_id=i.order_id
				     {$where} 
				     GROUP BY p.product_id"); */
		
		//die($this->db->last_query());
		
		return $query->result();  
	}
	
	
	/**********         Special Functions for Mymemorial    *********************************/
	
	function mymemorial_products($limit=100,$options=array())
	{
		$wh = '';
		$order = '';
		
		if(count($options))
		{
			foreach($options as $opt=>$val)
			{
				switch ($opt)
				{
					
                                        case 'search':
					{
						$wh .= " AND (p.product_name LIKE '%".$val."%' ";
						$wh .= " OR p.product_description LIKE '%".$val."%' ";
						$wh .= " OR p.product_code LIKE '%".$val."%') ";
						break;
						//$this->db->like("products.product_name",$val);
						//$this->db->or_like("products.product_description",$val);
						//$this->db->where("MATCH (products.product_name,products.product_description) AGAINST ('{$val}' IN BOOLEAN MODE )",NULL,FALSE);
					}
					case 'catid':
					{
						
						if(isset($val) && !empty($val) && $val>=1)
						{
							$wh .= ' AND (p.category_id='.$val.') ';
						}
						break;
						
					}
				}
				
			}
		}
		
		$query = 'SELECT * FROM products p ';
		$query .= 'WHERE (p.product_status=1) '.$wh;
		$query .= 'GROUP BY p.product_id ';
		//$query .= $order;
		
		$res = $this->db->query($query);
		
		//die($this->db->last_query());
		
		$result = array();
		
		foreach($res->result() as $row)
		{
			$prices = $this->db->query("SELECT * FROM product_prices WHERE product_id='".$row->product_id."' ORDER BY price_value ASC");
			
			$row->prices = $prices->result();
			
			$result[] = $row;
			
		}
		
		
		return $result;
		
			

	}
	
	//DYNAMIC CHANGES
	function get_home_pros($id)
	{
	
		$query = $this->db->query('SELECT * FROM home_page_products hpp
									LEFT JOIN products p ON hpp.product_code=p.product_code
									LEFT JOIN product_prices pp ON p.product_id=pp.product_id
									WHERE hpp.page_id='.$id.'
									GROUP BY hpp.product_code
									ORDER BY hpp.sort_order ASC');							
								   
		return $query->result();
	
	}
	
	function get_fun_home($id)
	{
		$query = $this->db->query('SELECT * FROM sci_list
									WHERE sci_id='.$id);
		
		return $query->row();
	}
	
	function get_category_by_product($id)
	{
		$query = $this->db->query('SELECT * FROM categories
									WHERE category_id='.$id);
		
		return $query->row();
	}
	
	function get_customer_products($vars = array())
	{
		/*
		$query = $this->db->query("SELECT * FROM products
								   WHERE customer_page=1 AND product_status=1
								   ORDER BY product_name ASC LIMIT 20");
		
		return $query->result();
		*/
		
		$pieces = explode("_",$vars['category_id']);
		$type_id = $pieces[0];
		$proper_id = $pieces[1];
		
		$this->db->from('products');
		//TO KNOW WHICH TYPE
		if($vars['category_id']!=''){
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==2){
				$this->db->join('product_subcategories','product_subcategories.product_id=products.product_id','left');
			}
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==3){
				$this->db->join('product_options','product_options.product_id=products.product_id','left');
			}
		}
		//TO KNOW WHERE
		if($vars['category_id']!=''){
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==1){
				$this->db->where('products.category_id',$proper_id);
			}
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==2){
				$this->db->where('product_subcategories.subcategory_id',$proper_id);
			}
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==3){
				$this->db->where('product_options.optionrecord_id',$proper_id);
			}
		}
		//TO KNOW WHERE PRODUCT NAME
		if($vars['product_name']!=''){
			$this->db->like('products.product_name',$vars['product_name']); 
			$this->db->like('products.product_description',$vars['product_name']); 
		}
		$this->db->where('products.customer_page',1);
		$this->db->where('products.product_status',1);
		$this->db->group_by('products.product_id');
		//TO KNOW ORDER BY
		if($vars['category_id']!=''){
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==1){
				$this->db->order_by('products.product_name','ASC');
			}
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==2){
				$this->db->order_by('product_subcategories.display_order','ASC');
			}
			if(isset($vars['category_id']) && !empty($vars['category_id']) && $type_id==3){
				$this->db->order_by('product_options.display_order','ASC');
			}
		}
		/*
		if(isset($vars['invoice_id']) && !empty($vars['invoice_id']))
		{
			$this->db->where('orders.invoice_id',$vars['invoice_id']);
		}
		if(isset($vars['funeral_home']) && !empty($vars['funeral_home']) && $vars['funeral_home']!=0)
		{
			$this->db->where('delivery_details.location_id',$vars['funeral_home']);
		}	
		*/
		$orders = $this->db->get();
		
		return $orders->result();
		
	}
	
	function get_customer_products_prices($id)
	{
		
		$query = $this->db->query("SELECT * FROM product_prices
								   WHERE product_id='".$id."'
								   ORDER BY price_value ASC");
		
		return $query->result();
	
	}
	
	function update_product_description_info($vars)
	{
	
		$data = array('product_description' => $vars['product_description']);
						
		$this->db->where('product_id', $vars['product_id']);
		$this->db->update('products', $data);
	
	}
	
	
} 