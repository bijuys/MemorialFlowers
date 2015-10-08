<?php

    function template_url($path='')
    {
    	return base_url('templates/dignity/'.$path);
    }

    function path($string='')
    {
	$ci=& get_instance();
	$base = $ci->config->item('base_url');
	
	return $base.$string;
	
    }
    
    function get_message($handle)
    {
	$ci=& get_instance();
	
	$ci->db->from('message_templates');
	$ci->db->where('attach_page',$handle);
	
	$query = $ci->db->get();
	
	return $query->row();
    }
    
    function country_options($country)
    {
	
	$ci=& get_instance();
	
	$ci->db->from('countries');
	$ci->db->where('country_id <=',2);
	$ci->db->order_by('country_id','ASC');
	
	$query = $ci->db->get();
	
	$options = '';
	
	foreach($query->result() as $row)
	{
	    $options .= '<option value="'.$row->country_id.'" ';
	    
	    if($country==$row->country_id)
		$options .= ' selected="selected" ';
	    
	    $options .= '>'.$row->country_name.'</option>';
	    
	}	
	
	$options .= '<option disabled="disabled">--------------------</option>';
	
	$ci->db->from('countries');
	$ci->db->where('country_id >=',3);
	$ci->db->order_by('country_name','ASC');
	
	$query = $ci->db->get();
	
	foreach($query->result() as $row)
	{
	    $options .= '<option value="'.$row->country_id.'" ';
	    
	    if($country==$row->country_id)
		$options .= ' selected="selected" ';
	    
	    $options .= '>'.$row->country_name.'</option>';
	    
	}
	
	return $options;
    
    }
    
    function province_options($province)
    {
	
	$ci=& get_instance();
	$ci->db->from('provinces');
	$ci->db->join('countries','provinces.country_id=countries.country_id','left');
	$ci->db->order_by('countries.country_id, province_name','ASC');
	
	$query = $ci->db->get();
	
	$options = '';
	
	$country = 0;
	
	foreach($query->result() as $row)
	{
	    if($country!=$row->country_id)
	    {
		if(strlen($options)>10)
		    $options .= '</optgroup>';
		
		$options .= '<optgroup label="'.$row->country_name.'">';
		$country = $row->country_id;
	    }
	    
	    $options .= '<option value="'.$row->province_name.'" ';
	    
	    if($province==$row->province_name)
		$options .= ' selected="selected" ';
	    
	    $options .= '>'.$row->province_name.'</option>';
	    
	}
	
	$options .= '</optgroup>';
	
	return $options;
    
	
    }

    function country_provinces($country=1)
    {
	
		$ci=& get_instance();
		$ci->db->from('provinces');
		$ci->db->where('country_id',$country);
		$ci->db->order_by('province_name','ASC');
		
		$query = $ci->db->get();
		
		$options = '';
		
		$country = 0;
		
		foreach($query->result() as $row)
		{	    
		    $options .= '<option value="'.$row->province_id.'" ';	    
		    $options .= '>'.$row->province_name.'</option>';
		}
		
		return $options;
    
    }



    function theme_url() {
        
      $ci=& get_instance();
        
      if($ci->session->userdata('referer_theme'))
        return '/templates/'.$ci->session->userdata('referer_theme').'';
      else
       return '/templates/default';
    
    }
    
    function getCurrencyMenu($formname)
    {
	$ci=& get_instance();
	
	$ci->db->order_by('base_currency','DESC');
	$query = $ci->db->get('currencies');
	
	$res = '<select name="currency_select" onChange="document.forms['."'{$formname}'".'].submit();" class="input-small">';
	
	foreach($query->result() as $row)
	{
	    $res .= '<option value="'.$row->currency_id.'" ';
	    if($ci->session->userdata('currency'))
	    {
		if($ci->session->userdata('currency')==$row->currency_id)
		{
		    $res .= 'selected="selected"';
		}
	    }
	    
	    elseif($row->base_currency)
	    {
		$res .= 'selected="selected"';
	    }
	    
	    $res .= ' >'.$row->currency_symbol.' '.$row->currency_id.'</option>'."\n";
	}
	
	$res .= '</select>';
	
	return $res;
    }
    
    function setCurrency($curr='BASE')
    {
		
	$ci=& get_instance();
	
	$query = $ci->db->get_where('currencies',array('base_currency'=>1));
	$row = $query->row();
	$base = $row->currency_id;
	
	if($curr=='BASE') { $curr = $base; }
	
	$query = $ci->db->get_where('currencies',array('currency_id'=>$curr));
	
	if($query->num_rows()>0)
	{
	    
	    $res = $query->row();
	    
	    if($res->timestamp < (time()-(60*60*12)) && $res->base_currency!=1 )
	    {
		
		$rate = currency($base,$curr,1);
		$ci->db->where('currency_id',$curr);
		$ci->db->update('currencies',array('exchange_rate'=>$rate,'timestamp'=>time()));
	    }
	    else
	    {
		$rate = $res->exchange_rate;
	    }
	    
	    $ci->session->set_userdata('currency',$res->currency_id);
	    $ci->session->set_userdata('rate',$rate);
	    $ci->session->set_userdata('timestamp',time());
	    $ci->session->set_userdata('symbol',$res->currency_symbol);
	    $ci->session->set_userdata('prefix',$res->prefix);
	    $ci->session->set_userdata('suffix',$res->suffix);
	
	    return TRUE;
	}
	
	return FALSE;
    }
    
    function getRate($amount)
    {
    
	$ci=& get_instance();
	if($ci->session->userdata('currency') && $ci->session->userdata('rate'))
	{
	    
	    $amt = $ci->session->userdata('prefix').$ci->session->userdata('symbol');
	    $amt .= number_format($amount * $ci->session->userdata('rate'),2);
	    $amt .= $ci->session->userdata('suffix');
	    
	    return $amt;
	}
	else
	{
	    
	    setCurrency('CAD');
	    
	    /*
	    $country = ip2Country();
	    
	    $eu = array('AT','BE','BG','CY','CZ','DK','EE',
			'FI','FR','DE','EL','HU','IE','IT',
			'LV','LT','LU','MT','NL','PL','PT',
			'RO','SK','SI','ES','SE');
	    
	    if($country=='US') { setCurrency('USD'); }
	    elseif($country=='UK') { setCurrency('GBP'); }
	    elseif($country=='AU') { setCurrency('AUD'); }
	    elseif($country=='NZ') { setCurrency('NZD'); }
	    elseif(in_array($country,$eu)) { setCurrency('EUR'); }
	    else { setCurrency('CAD'); }
	    
	    */

	    return $ci->session->userdata('prefix').$ci->session->userdata('symbol').number_format($amount,2).$ci->session->userdata('suffix');
	}
    }
    
    function currency($from_Currency,$to_Currency,$amount) {
	$amount = urlencode($amount);
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);
	$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);
	$data = explode('"', $rawdata);
	$data = explode(' ', $data['3']);
	$var = $data['0'];
	return round($var,3);
    }
   
    function get_menu_entries($menuh,$submenu=0,$type='',$page='')
    {
        
        $ci=& get_instance();
        $ci->load->database();
        
        $query = $ci->db->query("SELECT m.*,COUNT(i.menuitem_id) AS subitems FROM menuitems m
                                LEFT JOIN menus n ON m.menu_id=n.menu_id 
                                LEFT JOIN menuitems i ON m.menuitem_id=i.parent_id 
                                WHERE n.holder='{$menuh}' AND m.parent_id=0 
                                GROUP BY m.menuitem_id 
                                ORDER BY m.sort_order ASC");
        
        $menu = '';
		
		$end = count($query->result());
		
		$class = '';
		$citem = 1;
        
        foreach($query->result() as $row)
        {
            if($type=='li')
            {

                if($page==$row->menuitem)
                    $class .= 'current ';
				if($citem == $end)
					$class .= 'last ';
				if($citem == '1')
					$class .= 'first ';
		
				$class= '';
				$citem++;	
			
				
                
                if($submenu==1 && $row->subitems>0)
                {
                    $query = $ci->db->query("SELECT m.* FROM menuitems m
                                LEFT JOIN menus n ON m.menu_id=n.menu_id 
                                WHERE n.holder='{$menuh}' AND m.parent_id={$row->menuitem_id} 
                                GROUP BY m.menuitem_id 
                                ORDER BY m.sort_order ASC");

                    if($query->num_rows()>0)
                    {
                    	$menu .= '<li class="'.$class.' dropdown">';
                		$menu .= '<a href="'.$row->menulink.'" class="data-toggle" data-toggle="dropdown">'.lang(trim($row->menuitem)).'</a>'."\n";
                		$menu .= "\n<ul class=\"dropdown-menu\">";
	                    foreach($query->result() as $line)
	                    {
	                        $menu .= "\n".'<li><a href="'.$line->menulink.'">'.lang(trim($line->menuitem))."</a></li>\n";
	                    }
	                    $menu .= "\n</ul>";
                		$menu .= "</li>\n";
                    }
                    else
                    {
                    	$menu .= '<li class="'.$class.'">';
                		$menu .= '<a href="'.$row->menulink.'"><span>'.lang(trim($row->menuitem)).'</span></a>'."\n";
                		$menu .= "</li>\n";
                    }

                }
                else
                {
                	$menu .= '<li class="'.$class.'">';
                	$menu .= '<a href="'.$row->menulink.'"><span>'.lang(trim($row->menuitem)).'</span></a>'."\n";
                	$menu .= "</li>\n";
                }	
		
				
            }
            elseif($type=='|')
            {
                if($page==$row->menuitem)
                    $cls = ' class="current"';
                else
                    $cls ='';
                $menu .= ' <a href="'.$row->menulink.'"'.$cls.'>'.lang($row->menuitem).'</a> |';
            }
		    else
		    {
	                if($page==$row->menuitem)
	                    $cls = ' class="current"';
	                else
	                    $cls ='';
	                $menu .= ' <a href="'.$row->menulink.'"'.$cls.'>'.lang($row->menuitem).'</a> <br/>';		
		    }
            
            
        }
        
        return $menu;
        
    }
    
    function get_menu_entries_with_heading($menuh,$submenu=0,$type='',$page='')
    {
        	$ci=& get_instance();
        	$ci->load->database();
        
        	$query = $ci->db->query("SELECT m.*,COUNT(i.menuitem_id) AS subitems,n.menu AS name FROM menuitems m
	                            LEFT JOIN menus n ON m.menu_id=n.menu_id 
	                            LEFT JOIN menuitems i ON m.menuitem_id=i.parent_id 
	                            WHERE n.holder='{$menuh}' AND m.parent_id=0 
	                            GROUP BY m.menuitem_id 
	                            ORDER BY m.sort_order ASC");

        	$menu = '';
	$name = '';
        
        	foreach($query->result() as $row)
        	{	    
            		if($type=='li')
            		{
                		$menu .= '<li';

                		if($page==$row->menuitem)
                    			$menu .= ' class="current"';
							if($row->menuitem_id==156 || $row->menuitem_id==157){
								$menu .= '><a href="'.base_url().''.$row->menulink.'"><h4 style="color:#41C1C0;">'.lang(trim($row->menuitem)).'</h4></a>'."\n";
							}else{
								$menu .= '><a href="'.base_url().''.$row->menulink.'"><h4>'.lang(trim($row->menuitem)).'</h4></a>'."\n";
							}
                		
                
                		if($submenu==1 && $row->subitems>0)
                		{
			                    $query = $ci->db->query("SELECT m.* FROM menuitems m
			                                LEFT JOIN menus n ON m.menu_id=n.menu_id 
			                                WHERE n.holder='{$menuh}' AND m.parent_id={$row->menuitem_id} 
			                                GROUP BY m.menuitem_id 
			                                ORDER BY m.sort_order ASC");
		    
                    			$menu .= "\n<ul>";

			              foreach($query->result() as $line)
			              {
			                        $menu .= "\n".'<li><a href="'.base_url().''.$line->menulink.'">'.lang($line->menuitem)."</a></li>\n";
			              }
			              
			              $menu .= "\n</ul>";
			}
		
		$menu .= "</li>\n";
            }
            elseif($type=='|')
            {
                if($page==$row->menuitem)
                    $cls = ' class="current"';
                else
                    $cls ='';
                $menu .= ' <a href="'.base_url().''.$row->menulink.'"'.$cls.'>'.lang($row->menuitem).'</a> |';
            }
	    else
	    {
                if($page==$row->menuitem)
                    $cls = ' class="current"';
                else
                    $cls ='';
                $menu .= ' <a href="'.base_url().''.$row->menulink.'"'.$cls.'>'.lang($row->menuitem).'</a> <br/>';		
	    }
	    
	    $name = $row->name;
            
            
        }
        
        return $menu;
        
    }
    
    function get_tiny_cart()
    {
        $ci=& get_instance();
        $cart_id = $ci->session->userdata('cart_id');
        $cart_id = $cart_id>0 ? $cart_id:0;
        
        $cart = $ci->db->query("SELECT * FROM order_items WHERE cart_id={$cart_id}");
        $items = 0;
        $value = 0;
        foreach($cart->result() as $row)
        {
        		$value += $row->product_price;
        		$items++;
        		
        		$addons = $ci->db->query("SELECT * FROM order_addons WHERE orderitem_id=".$row->orderitem_id);
        		
        		foreach($addons->result() as $addon)
        		{
        			$value += $addon->addon_quantity * $addon->addon_price;
        		}
        
        }
        
        $result->total = $value;

	if($ci->session->userdata('coupon') && $items>0)
	{
		$coupon = get_coupon_discount($ci->session->userdata('coupon'),$value);	
		$value -= $coupon->discount_amount ? $coupon->discount_amount: $coupon->discount_percentage * $value / 100;			
	}
	
        $result->items = $items;
        $result->gtotal = $value;
	
        return $result;
    }
    
    function get_dates($dm=0,$to=0)
    {
	
        $ci=& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('delivery_methods',array('delivery_method_id'=>$dm));
        $res = $query->row();
        
        $dates = array();
        $days = explode(',',$res->delivery_days);
	
	$holidays = $ci->db->get_where('occasions',array('occasion_type'=>'holiday'));
	$hdays = $holidays->result();
        
        if($query->num_rows()>0)
        {
	    
            if(date('H:i:s',time())>=$res->stoppage_time)
            {
                $j = 1;              
            }
            else
            {
                $j = 0;    
            }
	    
	   if($res->delivery_within>0)
	   {
		$j++;
	   }
	    

            $i=0;	    


            while($i<$to)
            {                
                $now = date('Y-m-d',time() + ($j*24*60*60));
                $day = date('w',time() + ($j*24*60*60));
		$nwday = date('j-n',time() + ($j*24*60*60));
		
		$holiday = false;
		
		foreach($hdays as $hold)
		{
		    $hday = $hold->occasion_day.'-'.$hold->occasion_month;
		    
		    if($hday==$nwday)
		    {
			$holiday = true;
		    }
		}
		
		++$day;

                if(in_array($day,$days) && !$holiday)
                {
                    $dates[] = $now;
                    $i++;
                }
                $j++;
	
            }
	    
            return $dates;
        }
    }
    
    
    function get_next_dates()
    {   
        $ci=& get_instance();
        $ci->load->database();
        $query = $ci->db->get('delivery_methods');
	
	$dates = array();
	
	$holidays = $ci->db->get_where('occasions',array('occasion_type'=>'holiday'));
	
	$hdays = $holidays->result();
	
	foreach($query->result() as $row)
	{
	    $days = explode(',',$row->delivery_days);
	    
	    $j = 0;
	    

	    
	    if(date('H:i:s',time())>=$row->stoppage_time)
            {
                $j = $j+1;              
            }
	    
	    $j = $j + $row->delivery_within;

            $i=0;

	    while($i<10)
            {                
                $now = date('Y-m-d',time() + ($j*24*60*60));
                $day = date('w',time() + ($j*24*60*60));
		$nwday = date('j-n',time() + ($j*24*60*60));
		$day ++;
		
		$holiday = false;
		
		foreach($hdays as $hold)
		{
		    $hday = $hold->occasion_day.'-'.$hold->occasion_month;
		    
		    if($hday==$nwday)
		    {
			$holiday = true;
		    }
		}
		

                if(in_array($day,$days) && !$holiday)
                {
		    if($now == date('Y-m-d',time()))
		    {
			$deliverymsg = 'Delivery Today';
		    }
		    elseif($now == date('Y-m-d',time() + (24*60*60)))
		    {
			$deliverymsg = 'Delivery Tomorrow';			
		    }
		    else
		    {
			$deliverymsg = 'Delivery on '.date('l',time() + ($j*24*60*60));			
		    }
		    
                    $dates[$row->delivery_method_id] = $deliverymsg;
                    $i=$i+10;
                }
                $j++;               
            }
	    
	    
	}
	
        return $dates;
	
    }
    
    function get_menu_holders()
    {
        $placeholders = array('topmenu','mainmenu','mymemorial','footermenu','sidemenu1','sidemenu2','sidemenu3','sidemenu4','welcome','footer1','footer2','footer3','footer4','footer5');
        return $placeholders;
    }
    
    function get_home_sliders()
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('product_slides');
        $ci->db->join('products','product_slides.product_id=products.product_id','left');
        $ci->db->join('product_prices','product_slides.product_id=product_prices.product_id','left');
		$ci->db->join('product_options',"products.product_id=product_options.product_id AND option_type='occasion'",'left');
		$ci->db->join('occasions','product_options.optionrecord_id=occasions.occasion_id AND occasion_status=1','left');
        $ci->db->group_by('product_slides.slide_id');
        $ci->db->order_by('product_slides.sort_order','asc');
        $query = $ci->db->get();
	
        $slides = '';
        $count = 0;

        $slides .= '<ol class="carousel-indicators">'."\n";

        foreach($query->result() as $row)
        {
        	if($count<1)
        		$class = ' class="active" ';
        	else
        		$class = '';

        	$slides .= '<li data-target="#myCarousel" data-slide-to="'.$count.'" '.$class.'></li>'."\n";
        	$count++;
        }

        $slides .= '</ol>'."\n";

        $slides .= '<div class="carousel-inner">'."\n";

        $count = 0;

        foreach($query->result() as $row)
        {
        	$count++;

            $combined = substr($row->title_placement,0,1).substr($row->title_color,0,1);
	    
		    if(!empty($row->occasion_name))
				$path = base_url().strtolower(url_title($row->occasion_name)).'/';
		    else
				$path = base_url();
		    
		    $slides .= '<div class="item'.($count==1 ? ' active':'').'"><a href="'.$path.$row->url.'"><img src="'.img_format('productres/'.$row->product_picture, 'thumb').'" style="height:220px; width:222px;" /></a></div>';
	            
        }

        $slides .= '</div>'."\n";

       
        
        return $slides;
    }
    
    function get_firstname()
    {
        $ci=& get_instance();
        
        return $ci->session->userdata('user_firstname') ? $ci->session->userdata('user_firstname'):'Guest';

    }
    
    function mkdate($year=0,$month=0,$day=0)
    {
        return mktime(0,0,0,$month,$day,$year);
    }
   
    function get_company_discount($amount,$id=0)
    {
		
        $ci=& get_instance();
        $ci->load->database();
       
        $query = $ci->db->query("SELECT u.business_discount AS udiscount,p.business_discount AS pdiscount,p.double_discount AS double_discount,u.user_role AS user_role 
        						FROM users u LEFT JOIN users p ON u.parent_id=p.user_id 
        						WHERE u.user_id={$id}");
        
        $discount = 0;
        
        foreach($query->result() as $user)
        {
        	if($user->user_role=='company')
        	{
        		$discount += $user->udiscount*1;
        	}
        	else
        	{
        		//$discount += $user->pdiscount;
			
        		$discount += $user->udiscount*1;
			
			/*
                        
                        if($user->double_discount==1)
                            $discount = $discount*2;
                            
			*/
    
        	}
        }
        
        $percentage = $amount * $discount / 100;
        
        return $percentage;
        
    }
    
    
    function get_coupon_discount($code,$amount)
    {
	
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('discounts');
       // $ci->db->where('discount_type','coupon');
        $ci->db->where('discount_start <=',date('Y-m-d',time()));
        $ci->db->where('discount_expiry >=',date('Y-m-d',time()));
        $ci->db->where('discount_limit >=','1');
        $ci->db->where('discount_minimum <=',$amount ? $amount:'0');
        $ci->db->where('discount_name',$code);
        
        $query = $ci->db->get();
        
        return $query->row();
    }
    
    
    function get_discount($amount)
    {
	
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('discounts');
        $ci->db->where('discount_type','discount');
        $ci->db->where('discount_start <=',date('Y-m-d',time()));
        $ci->db->where('discount_expiry >=',date('Y-m-d',time()));
        $ci->db->where('discount_limit >=','1');
        $ci->db->where('discount_minimum <=',$amount ? $amount:'0');
        
        
        $query = $ci->db->get();
        
        return $query->row();
        
    }
    
    function get_stoppage_time($id)
    {
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->from('delivery_methods');
	$ci->db->where('delivery_method_id',$id);
	    
	$query = $ci->db->get();
	
	$res = $query->row();
	
	$stoppagetime = date('Y-m-d '.$res->stoppage_time,time());
	
	return strtotime($stoppagetime);
    }
    
    function get_delivery_countries($id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('group_locations');
        $ci->db->join('countries','group_locations.location_id=countries.country_id');
        $ci->db->where('group_locations.location_type','country');
        $ci->db->where('group_locations.group_id',$id);
        $query = $ci->db->get();
        
        return $query->result();
    }
    
    function get_available_provinces($id)
    {
	$ci=& get_instance();
        $ci->load->database();
        $ci->db->from('provinces');
        $ci->db->join('group_locations','group_locations.location_id=provinces.province_id');
	$ci->db->join('product_locations','group_locations.group_id=product_locations.group_id');
	$ci->db->join('products','product_locations.product_id=products.product_id');
        $ci->db->where('group_locations.location_type','province');
        $ci->db->where('products.product_id',$id);
	$ci->db->group_by('provinces.province_id');
	$ci->db->order_by('provinces.country_id, provinces.province_name','ASC');
        $query = $ci->db->get();
        
        return $query->result();
    }
    
    function get_available_countries($id)
    {
	$ci=& get_instance();
        $ci->load->database();
        $ci->db->from('countries');
        $ci->db->join('group_locations','group_locations.location_id=countries.country_id');
	$ci->db->join('product_locations','group_locations.group_id=product_locations.group_id');
	$ci->db->join('products','product_locations.product_id=products.product_id');
        $ci->db->where('group_locations.location_type','country');
        $ci->db->where('products.product_id',$id);
	$ci->db->group_by('countries.country_id');
	$ci->db->order_by('countries.country_id','ASC');
        $query = $ci->db->get();
        
        return $query->result();
    }
    
    function get_delivery_provinces($id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('group_locations');
        $ci->db->join('provinces','group_locations.location_id=provinces.province_id');
        $ci->db->where('group_locations.location_type','province');
        $ci->db->where('group_locations.group_id',$id);
        $query = $ci->db->get();
        
        return $query->result();
    }
    
    function get_occasions($id=0)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->from('occasions');
        $ci->db->where('occasion_type <>','holiday');
	$ci->db->where('occasion_status >','-1');
	$ci->db->order_by('occasion_name','ASC');
        $query = $ci->db->get();
        
        return $query->result();
    }
    
    if(!function_exists('img_format')) {
    function img_format($src='', $format='', $index_page=FALSE) {
        // Load a codeigniter instance
        $CI =& get_instance();
        // Get the image format configurations
        $CI->config->load('my_image_formats');
        $formats = $CI->config->item('image_formats');        
        // The cached name of the file is just a md5 hash of the src and the format
        $hash = md5($format.$src);
        // Get the file extension (if we are converting get the new extension eg. jpg->gif)
        if(isset($formats[$format]['image_convert'])) $ext = '.'.$formats[$format]['image_convert'];
        else $ext = '.'.end(explode('.', $src));
        // Get the general path to the system
        $path = str_replace(SELF,'',FCPATH);    
        // Check if the image has already been generated in the cache
        if(!file_exists($path.'cache/'.$hash.$ext)) {
            // Make sure format is valid
            if(isset($formats[$format])) {
                // Increase memory allowance
                ini_set('memory_limit','36M');  
                // Load the image manipulation library                
                $CI->load->library('imaging');
                $CI->imaging->upload($path.$src);
                if($CI->imaging->uploaded) {
                    // Some default settings
                    $CI->imaging->file_new_name_body = $hash;
                    $CI->imaging->file_auto_rename = FALSE;
                    $CI->imaging->file_overwrite = TRUE;
                    // Settings for the format as defined in the config
                    foreach($formats[$format] as $key => $value) {
                        $CI->imaging->$key = $value;
                    }
                    // Process
                    $CI->imaging->Process($path.'cache');
                    if($CI->imaging->processed) $src = 'cache/'.$hash.$ext;
                }
            }         
        } else $src = 'cache/'.$hash.$ext;
        // Pass to the normal img function
        return '/'.$src;
    }
}


if(!function_exists('img_resized')) {
    function img_resized($src='', $format='', $index_page=FALSE) {
        // Load a codeigniter instance
        $CI =& get_instance();
        // Get the image format configurations
	
	list($width,$height) = explode('x',$format);
	
        $CI->config->load('my_image_formats');
        //$formats = $CI->config->item('image_formats');        
        // The cached name of the file is just a md5 hash of the src and the format
        $hash = md5($format.$src);
        // Get the file extension (if we are converting get the new extension eg. jpg->gif)
        //if(isset($formats[$format]['image_convert'])) $ext = '.'.$formats[$format]['image_convert'];
       // else $ext = '.'.end(explode('.', $src));
	$ext = '.'.end(explode('.', $src));
        // Get the general path to the system
        $path = str_replace(SELF,'',FCPATH);    
        // Check if the image has already been generated in the cache
	
        if(!file_exists($path.'cache/'.$hash.$ext)) {
            // Make sure format is valid
	    
	     ini_set('memory_limit','36M');  
	    // Load the image manipulation library                
	    $CI->load->library('imaging');
	    $CI->imaging->upload($path.$src);	    
	   
	    if($CI->imaging->uploaded) {
		// Some default settings
		
		$CI->imaging->file_new_name_body = $hash;
		$CI->imaging->file_auto_rename = FALSE;
		$CI->imaging->file_overwrite = TRUE;
		// Settings for the format as defined in the config
		$CI->imaging->image_x = $width;
		$CI->imaging->image_y = $height;
		$CI->imaging->image_ratio = true;
		$CI->imaging->image_unsharp = true;
		$CI->imaging->image_resize = true;

		// Process
		$CI->imaging->Process($path.'cache');
		if($CI->imaging->processed) {  $src = 'cache/'.$hash.$ext; }
	    }
	    
	    
                    
        } else $src = 'cache/'.$hash.$ext;
        // Pass to the normal img function
        return '/'.$src;
    }
} 

function vdump($var)
{
	print('<pre>');
	print_r($var);
	print('</pre>');
	die();
	
}

function img($image,$size,$attributes='')
{
	return '<img src="'.img_format('productres/'.$image,$size).'" '.$attributes.' />';

}

function getimg($image,$size,$attributes='')
{
	return '<img src="'.img_resized($image,$size).'" '.$attributes.' />';

}

function admin_authorized()
{
	$ci =& get_instance();
	return $ci->session->userdata('admin_authorized');
}

function highlight_error($field)
{
	if(is_array($field))
	{
	    	foreach($field as $key=>$val)
	    	{

	    		if(!empty($val)) { return ' error-field ';  }
	    	}
	}
	else
	{
	    	return empty($field) ? '':' error-field ';
	}
}


function highlightclass($field)
{
    if($field!='')
        echo ' fielderror';
}

function curl($url,$params = array(),$is_coockie_set = false)
{

    if(!$is_coockie_set){
    /* STEP 1. let’s create a cookie file */
    $ckfile = tempnam ("/tmp", "CURLCOOKIE");

    /* STEP 2. visit the homepage to set the cookie properly */
    $ch = curl_init ($url);
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec ($ch);
    }

    $str = ''; $str_arr= array();
    foreach($params as $key => $value)
    {
    $str_arr[] = urlencode($key)."=".urlencode($value);
    }
    if(!empty($str_arr))
    $str = '?'.implode('&',$str_arr);

    /* STEP 3. visit cookiepage.php */

    $Url = $url.$str;

    $ch = curl_init ($Url);
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec ($ch);
    return $output;
}

function Translate($word,$conversion = 'en_to_fr')
{
    $word = urlencode($word);
    // dutch to english
    if($conversion == 'nl_to_en')
    $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

    // english to hindi
    if($conversion == 'en_to_fr')
    $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=fr&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';

    // hindi to english
    if($conversion == 'hi_to_en')
    $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=hi&tl=en&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1';

    //$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

    $name_en = curl($url);

    $name_en = explode('"',$name_en);
    return  $name_en[1];
}


function imgLang($file='')
{

    $ci =& get_instance();

    if($ci->session->userdata('langshort')!='')
    {
        $file = str_replace('-LN', '-'.$ci->session->userdata('langshort'), $file);
    }    
    else
    {
        $file = str_replace('-LN', '-EN',$file);
    }

    return $file;
    
}

function accessGrant($page)
{
    $ci =& get_instance();
    
    $permissions = explode(',',$ci->session->userdata('permissions'));
    
    if(in_array($page,$permissions))
    {
	return TRUE;
    }
    else
    {
	return FALSE;
    }
}

function rightLang($en,$fr)
{
    $ci =& get_instance();

    if(strlen($fr)<2)
    {
        return $en;
    }
    else
    {
        if($ci->session->userdata('language')=='french')
        {
            return $fr;
        }
        else
        {
            return $en;
        }
    }

}

function ip2Country()
{
    $ci =& get_instance();
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $country = $ci->session->userdata('countryCode');
    
    if(strlen($country)>1)
    {
	return $country;
    }
    else
    {
	$url = "http://api.ipinfodb.com/v3/ip-country/?key=a64c4922c55384c0dcc0a842407cc0a4e0f2c0273cf4e8a209b9d835e8e44726&ip=".$ip."&format=json";
	
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	
	$rawdata = curl_exec($ch);
	
	curl_close($ch);
	
	$ipinfo = json_decode($rawdata);
	
	$ci->session->set_userdata('countryCode',$ipinfo->countryCode);
	
	return $ipinfo->countryCode;
    
    }
    
    
}


function showCalendar($method=0,$days=30,$def='')
{
    echo draw_calendar(time(),time() + 60*60*24*$days,$method,$def);
}


/************************** Draw Calender ************************************/

function draw_calendar($start,$finish,$method=0,$def=''){
    
    $month = date('m',$start);
    $year = date('Y',$start);
    $day = date('d',$start);
    
    $fmonth = date('m',$finish);
    $fyear = date('Y',$finish);
    $fday = date('d',$finish);
    
    $months = $fmonth - $month;
    $years = $fyear - $year;
    
    $months += ($years * 12);
    
    $ci =& get_instance();    
    $query = $ci->db->get_where('delivery_methods',array('delivery_method_id'=>$method));
    
    $calendar = '';
    
    if($row = $query->row())
    {
	$ddays = explode(',',$row->delivery_days);
	$delay = $row->delivery_within;
	$stoppage = $row->stoppage_time;
	
	list($stophour,$stopminute,$stopsecond) = explode(':',$stoppage);
	$stoppage = mktime($stophour,$stopminute,$stopsecond,date('m',time()),date('d',time()),date('Y',time()));
	
	$holidays = array();
	$hdays = $ci->db->query("SELECT * FROM occasions WHERE occasion_type!='occasion'");
	
	foreach($hdays->result() as $row)
	{
	    $holidays[] = date('d-m-Y',mktime(0,0,0,$row->occasion_month,$row->occasion_day,$year));
	}
	
	for($j=0; $j<= $months; $j++) {
	
	    $calendar .= '<div class="monthname">'.date('F Y',mktime(0,0,0,$month,1,$year)).'</div>';
	    
	    /* draw table */
	    $calendar .= '<table cellpadding="0" cellspacing="0" class="calendar" border="1">';
	    /* table headings */
	    $headings = array(lang('Sun'),lang('Mon'),lang('Tue'),lang('Wed'),lang('Thu'),lang('Fri'),lang('Sat'));
	    $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';
    
	    /* days and weeks vars now ... */
	      
	    if(mktime(0,0,0,$month,1,$year)>=mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time())))
	    {
	      $startday = '1';
	    }
	    else
	    {
	      $startday = date('d',time());
	    }
	    
	    $running_day = date('w',mktime(0,0,0,$month,$startday,$year));
	    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	    $days_in_this_week = 1;
	    $day_counter = 0;
	    $dates_array = array();
	    
	    /* row for week one */
	    $calendar.= '<tr class="calendar-row">';
	  
	    /* print "blank" days until the first of the current week */
	    for($x = 0; $x < $running_day; $x++):
	      $calendar.= '<td class="calendar-day-np"><div class="disabled">&nbsp;</div></td>';
	      $days_in_this_week++;
	    endfor;
	    
	    $dcount = 0;
	    
	    /* keep going with days.... */
	    for($list_day = $startday; $list_day <= $days_in_month; $list_day++):
	    
		$datediff =  mktime(0,0,0,$month,$list_day,$year) - mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
		$dcount = $datediff/(60*60*24);
	    
		$now = mktime(0,0,0,$month,$list_day,$year);
	      
		  if(($list_day==12) && ($days_in_this_week==1)  )
					{
				$calendar.= '<td class="calendar-day" style="background-color:#FFFF99">';
					}
					else
					{
						$calendar.= '<td class="calendar-day" >';
					}
		
		//$calendar.= '<td class="calendar-day">';
		$nday = mktime(date('H',time()),date('i',time()),date('s',time()),$month,$list_day,$year);
	  
		if(!in_array(date('w',$now)+1,$ddays) || in_array(date('d-m-Y',$now),$holidays))
		{
		    $calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p></p></div>';
		}
		else
		{
		    if(date('d-m-Y',mktime(0,0,0,$month,$list_day,$year))==$def)
		    {
			$sele = ' selected';
			echo $def;
		    }
		    else
		    {
			$sele = '';
		    }
		    
		    if($delay<$dcount)
		    {
          //san code for mother day or any other events
		    
			/* if(($list_day!=2) &&($list_day!=9)  &&($list_day!=19) && ($list_day!=26)) 
			 {
					 if(($list_day==12) && ($days_in_this_week==1)  )
					{
					
						$calendar.= '<a href="#" class="daypick'.$sele.'" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l, d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
					 
					  $calendar.= '<div class="day-number" >'.$list_day.'</div>';
					   $calendar.= '<p>std. shipping +$6.99 </p>';
					  $calendar.= '</a>';	    
					}
					else {
						if(($list_day==2) &&($list_day==9) && ($month==6)  ) {
							 $calendar.= '<div class="day-number">'.$list_day.'</div>';
							
						}
						else {
						  $calendar.= '<a href="#" class="daypick'.$sele.'" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l, d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
					 $calendar.= '<div class="day-number">'.$list_day.'</div>';
					   $calendar.= '<p>std. shipping </p>';
					  $calendar.= '</a>';	    
						}
					  
					  
					}
					
				}
				
				else
				{
					$calendar.= '<div class="day-number">'.$list_day.'</div>';
   			   }*/
		  
		  
		  		 $calendar.= '<a href="#" class="daypick'.$sele.'" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l, d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
		      /* add in the day number */
		      $calendar.= '<div class="day-number">'.$list_day.'</div>';
    
		      $calendar.= '<p>std. shipping</p>';
		      $calendar.= '</a>';	  
		
		  
		  }
		  else
		  {
		      if($delay==$dcount)
		      {
			  if($dcount=='0' && $stoppage < time())
			  {
			      $calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p></p></div>';	
			  }
			  else
			  {
			      $calendar.= '<a href="#" class="daypick" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
			      /* add in the day number */
			      $calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			      $calendar.= '<p>std. shipping</p>';
			      $calendar.= '</a>';			    
		  
			  }
		      }
		      else
		      {
			  if($method==2 && $stoppage > time())
			  {
			      //$calendar.= '<a href="#" class="daypick special" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
			      /* add in the day number */
			      //$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			      //$calendar.= '<p>std. shipping +$10</p>';
			      //$calendar.= '</a>';
			       $calendar.= '<div class="disabled">&nbsp;</div>';	
			  }
			  else
			  {
			      $calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p></p></div>';
			  }
				   
		      }
		  }
		  
	  
	      }
	      
	      $calendar.= '</td>';
	      
	      $canbreak = false;
	      
	  
	      if($running_day == 6):
		$calendar.= '</tr>';
		
		if(($day_counter+1) != $days_in_month):
		  $calendar.= '<tr class="calendar-row">';
		endif;
		$running_day = -1;
		
		if($now<=$finish)
		$days_in_this_week = 0;
		
		if($now>$finish)
		{
		    $canbreak = true;
		}
		
	       
	      endif;
	      
	      $days_in_this_week++; $running_day++; $day_counter++;
	      
	      $dcount++;
	      
	      if($canbreak)
	      {
		break;
	      }
	      
    
	    endfor;
		    
    
	    /* finish the rest of the days in the week */
	    if($days_in_this_week < 8):
	      for($x = 1; $x <= (8 - $days_in_this_week); $x++):
		$calendar.= '<td class="calendar-day-np"><div class="disabled">&nbsp;</div></td>';
	      endfor;
	    endif;
	  
	    /* final row */
	    $calendar.= '</tr>';
	  
	    /* end the table */
	    $calendar.= '</table>';
	    
	    /* all done, return result */
	    
	    if($month==12) { $month = 1; $year++; } else { $month++; }
	    
	} // End of Months
	
	
    }
    
    return $calendar;

  
}



function is_floral_basket($id)
{
    $ci =& get_instance();
    $ci->load->database();
    $ci->db->from('product_subcategories');
    $ci->db->where('product_id',$id);
    $ci->db->where('subcategory_id',91);
	
    $query = $ci->db->get();
    
    return $query->num_rows();
}

function is_https_on()
{
    if ( ! isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' )
    {
        return FALSE;
    }

    return TRUE;
}

function use_ssl($turn_on = TRUE)
{
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if ( $turn_on )
    {
        if ( ! is_https_on() && $_SERVER['REMOTE_ADDR'] != '127.0.0.1')
        {
            redirect('https://' . $url, 'location', 301 );
            exit;
        }
    }
    else
    {
        if ( is_https_on() )
        {
            redirect('http://' . $url, 'location', 301 );
            exit;
        }
    }
}

function see($show_my_content = "foo", $ex = "exit")
{
	echo "<pre>";
	print_r($show_my_content); 
	echo "</pre>";
	
	// to continue give a second var anything other than "exit"
	echo ($ex == "exit")? exit : "";
	
}

function seef($show_my_content_in_file = "")// see in file. 
{
	$file = 'here_it_is.txt';
	$current = file_get_contents($file);
	$current .= $show_my_content_in_file."\n" ;
	file_put_contents($file, $current);
	
	/* 
	 * usage :  	$str = $this->db->last_query();  seef($str);
	 */
}


/*>>>>>>>>>>>>>>>>>>>>>>>>  ADDED FOR the template CLAVA    >>>>>>>>>>>>>>>>>>>>>>>>*/

function get_categ_menuitems( $menuitem_id )
{
	$ci = & get_instance();
	$ci->load->database();
	
	$query = $ci->db->query("SELECT m.* FROM menuitems m
							LEFT JOIN menus n ON m.menu_id=n.menu_id 
							WHERE n.holder='mainmenu' AND m.parent_id={$menuitem_id} 
							GROUP BY m.menuitem_id 
							ORDER BY m.sort_order ASC");
	
	return $query->result();
}

function get_funeral_home($id)
{
	$ci = & get_instance();
	$ci->load->database();
	
	$query = $ci->db->get_where('funeral_homes',array('id'=>$id));
	
	return $query->row();
}

function calendars()
{
	echo new_calendar(date('m',time()),date('Y',time()));
	echo new_calendar(date('m',strtotime('+1 month')),date('Y',strtotime('+1 month')));
}

function new_calendar($month,$year){

	$prevmonth = new DateTime("{$year}-{$month}-15");
	$nextmonth = new DateTime("{$year}-{$month}-15");
	$prevmonth->modify('-1 month');
	$nextmonth->modify('+1 month');

	/* draw table */
	$calendar = '<div class="msg"></div>';
	$calendar = '<div id="cal_'.$month.$year.'" class="month-calendar">';

	$calendar .= '<div class="navi"><div class="pull-left"><a  class="prev" class="btn btn-xs btn-default"';

	if(strtotime($year.'-'.$month.'-'.'01') > strtotime(date('Y-m-01',time())))
		$calendar .= ' href="#cal_'.$prevmonth->format('mY').'" ';
	else
		$calendar .= ' href="#" ';

	$calendar .= '><i class="glyphicon glyphicon-chevron-left"></i></a></div>';
	$calendar .= '<div class="pull-right"><a  class="next" class="btn btn-xs btn-default"';
	
	if(strtotime($year.'-'.$month.'-'.'01') < strtotime('last day this month'))
		$calendar .= ' href="#cal_'.$nextmonth->format('mY').'" ';
	else
		$calendar .= ' href="#" ';

	$calendar .= '><i class="glyphicon glyphicon-chevron-right"></i></a></div>';
	$calendar .= '<div class="title">'.date('M Y',strtotime($year.'-'.$month.'-01')).'</div></div>';
	$calendar .= '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('S','M','T','W','T','F','S');
	$calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			if(strtotime($year.'-'.$month.'-'.$list_day)>=strtotime(date('Y-m-d',time())))
			{
				$calendar.= '<div class="day-number"><a href="#" name="'.$year.'-'.$month.'-'.$list_day.'" class="day-link">'.$list_day.'</a></div>';
			}
			else
			{
				$calendar.= '<div class="day-number"><a href="#" class="off-date">'.$list_day.'</a></div>';
			}

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
			$calendar.= '</td>';
			if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table></div>';
	
	/* all done, return result */
	return $calendar;
}