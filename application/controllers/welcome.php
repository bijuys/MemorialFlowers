<?php

class Welcome extends CI_Controller {

	function Welcome()
	{
				
		parent::__construct();

		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
		$this->load->Model('Banner_model');
		$this->load->Model('Affiliate_model');
		
	}

	function index()
	{
		use_ssl(FALSE);
		
		$this->session->set_userdata('clava', 'allowed');
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
        		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);
		$data['tiles'] = $this->Banner_model->get_tiles();
     	
		$use_id = '';
		
		//MOUNT PLEASANT CONFIG - NOT WORKING ANYMORE
		$host=$_SERVER['HTTP_HOST'];
		if($host=='mountpleasant.memorialflowers.ca'){
			if($this->session->userdata('location')>0){
				$re = $this->session->userdata('referer');
				$this->session->set_userdata('test_affiliate',5886161);
				$data['id_af'] = $this->Affiliate_model->get_affiliate($re);
				if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
					$this->session->sess_destroy();
					$this->load->view('test_launch.php',$data);
				}else{
					$this->load->view('index.php',$data);
				}
			}else{
				if($use_id != ''){
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}else{
						$data['aff_id'] = $this->Affiliate_model->get_affiliate($use_id);
						$this->session->set_userdata('logo',$use_logo);
						$this->session->set_userdata('disco','0.'.$use_disc);
					}
					$this->load->view('test_launch.php',$data);
				}else{
					if($_SERVER['REQUEST_URI']=='/affiliate/mf') {
						$this->session->sess_destroy();
					}
					$this->load->view('test_launch.php',$data);
				}
			}	
		}
		//MOUNT PLEASANT CONFIG - NOT WORKING ANYMORE
		
		//BASIC FUNERALS - OPENS IN NEW TEMPLATE
		if($_SERVER['REQUEST_URI']=='/affiliate/basic-funerals'){
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//BASIC FUNERALS - OPENS IN NEW TEMPLATE
		
		//BASIC FUNERALS - OPENS IN NEW TEMPLATE
		if($_SERVER['REQUEST_URI']=='/affiliate/morris'){
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//BASIC FUNERALS - OPENS IN NEW TEMPLATE
		
		//LIFE NEWS SETUP - THIS IS WORKING FINE
		if(substr($_SERVER['REQUEST_URI'],0,20)=='/affiliate/life-news'){
			$d_id = '';
			$d_firstname = '';
			$d_lastname = '';
			$val10 = substr($_SERVER['REQUEST_URI'],21,50);
			if($val10 != ''){
				if($val10 == 'b1'){
					$this->session->set_userdata('disease_id',$d_id);
					$this->session->set_userdata('disease_firstname',$d_firstname);
					$this->session->set_userdata('disease_lastname',$d_lastname);
					$this->session->set_userdata('ban_id',1);
				}else if($val10 == 'b2'){
					$this->session->set_userdata('disease_id',$d_id);
					$this->session->set_userdata('disease_firstname',$d_firstname);
					$this->session->set_userdata('disease_lastname',$d_lastname);
					$this->session->set_userdata('ban_id',2);
				}else if($val10 == 'b3'){
					$this->session->set_userdata('disease_id',$d_id);
					$this->session->set_userdata('disease_firstname',$d_firstname);
					$this->session->set_userdata('disease_lastname',$d_lastname);
					$this->session->set_userdata('ban_id',3);
				}else{
					$this->session->set_userdata('disease_id',$val10);
					$d_id = $this->db->get_where('diseases', array('data_id' => $val10));
					if ($d_id->num_rows == 1){ 
						foreach ($d_id->result() as $row){
							$d_id = $row->id;  # THIS DOES NOT WORK
							$d_firstname = $row->firstname;
							$d_lastname = $row->lastname;
						}
					}
					$this->session->set_userdata('disease_id',$d_id);
					$this->session->set_userdata('disease_firstname',$d_firstname);
					$this->session->set_userdata('disease_lastname',$d_lastname);
					$this->session->set_userdata('ban_id',4);
				}
			}else{
				$this->session->set_userdata('disease_id',$d_id);
				$this->session->set_userdata('disease_firstname',$d_firstname);
				$this->session->set_userdata('disease_lastname',$d_lastname);
				$this->session->set_userdata('ban_id',0);
			}			
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//LIFE NEWS SETUP - THIS IS WORKING FINE
		
		//SCI SETUP - THIS IS WORKING FINE
		if($_SERVER['REQUEST_URI']=='/affiliate/sci'){
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//SCI SETUP - THIS IS WORKING FINE
		
		//CANADIAN OBITUARIES SETUP - THIS IS WORKING FINE
		if($_SERVER['REQUEST_URI']=='/affiliate/canadian-obituaries'){
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//CANADIAN OBITUARIES SETUP - THIS IS WORKING FINE
		
		//YOUR LIFE MOMENTS SETUP - THIS IS WORKING FINE
		if($_SERVER['REQUEST_URI']=='/affiliate/your-life-moments'){
			$this->session->set_userdata('location',9);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//YOUR LIFE MOMENTS SETUP - THIS IS WORKING FINE
			
		//YOUR LIFE MOMENTS SETUP - THIS IS WORKING FINE
		if($_SERVER['REQUEST_URI']=='/affiliate/perkopolis'){
			$this->session->set_userdata('location',0);
			$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
			$letsgetsitelink=$lets_get_aff_url[2];
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id;  # THIS DOES NOT WORK
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			redirect('/');	
		}
		//YOUR LIFE MOMENTS SETUP - THIS IS WORKING FINE		
		
		//LEGACY SETUP - THIS IS WORKING FINE
		$lets_get_aff_url=explode('/',$_SERVER['REQUEST_URI']);
		$letsgetsitelink=$lets_get_aff_url[1];
			
		if($letsgetsitelink=='legacy'){
			$this->session->set_userdata('location',9);
			$letsgetsitelink2=$lets_get_aff_url[2];
			$value=explode('_',$letsgetsitelink2);
			
			$funeral_id=$value[0];
			$person_id=$value[1];
			$compa_brand=$value[2];
			$proid=$value[3];
			
			$q = $this->db->get_where('users', array('user_description' => $letsgetsitelink));
			if ($q->num_rows == 1){ 
				foreach ($q->result() as $row){
					$use_id = $row->user_id; 
					$use_logo = $row->user_logo;
					$use_disc = $row->business_discount;
				}
			}
			$data['referer']='';
			$data['referer_discount']='';
			$data['referer']=$use_id;
			$data['referer_discount']='0.'.$use_disc;
			$this->session->set_userdata('referer',$data['referer']);
			$this->session->set_userdata('referer_discount',$data['referer_discount']);
			$data['logo']='';
			$data['logo']=$use_logo;
			$this->session->set_userdata('logo', $data['logo']);
			
			$this->session->set_userdata('fhid', $funeral_id);
			$this->session->set_userdata('cobrand', $compa_brand);
			$this->session->set_userdata('pid', $person_id);
			
			echo $proid;
			
			if($proid!=''){
				$pro = $this->db->get_where('products', array('product_code' => $proid));
				foreach ($pro->result() as $row){
					$lin = $row->url;
				}
				redirect('http://www.memorialflowers.ca/'.$lin);
			}else{
				redirect('/');
			}
				
		}

		//LEGACY SETUP - THIS IS WORKING FINE		
		
		/***************************************************************************/
		/*************************** MEMORIAL FLOWERS WEBSITE **********************/
		$host=$_SERVER['HTTP_HOST'];
		if($host=='dignity.dev' || $host=='www.memorialflowers.ca' || $host=='test.memorialflowers.ca'){
			$this->session->set_userdata('location',9);    
			if($this->session->userdata('location')>0){
				$re = $this->session->userdata('referer');
				$data['id_af'] = $this->Affiliate_model->get_affiliate($re);
				if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
					$this->session->sess_destroy();
					$this->load->view('launch.php',$data);
				}else{

					$this->load->view('index',$data);	
				}
			}else{
				if($use_id != ''){
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}else{
						$data['aff_id'] = $this->Affiliate_model->get_affiliate($use_id);
						$this->session->set_userdata('logo',$use_logo);
						$this->session->set_userdata('disco','0.'.$use_disc);
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}
					//HOME PAGE		
				}else{
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}	
					//HOME PAGE
				}
			}
		}
		/*************************** MEMORIAL FLOWERS WEBSITE **********************/
		/***************************************************************************/
	}

	function temp() 
	{
		use_ssl(FALSE);
		$this->session->set_userdata('clava', 'allowed');
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
        		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);

		$data['tiles'] = $this->Banner_model->get_tiles();
		
		$data['enlace'] = 'Home';
		
		//parse_str(parse_url($url, PHP_URL_QUERY), $array);
		/*$fid = $_SERVER['loc'];
		$dna = $_SERVER['dname'];*/
		//http://dmtest.svccorp.com/_link/ecommerce?linkmode=redirect&type=general&brand=dmc&loc=3121&dname=John+Joseph+Ryan
		
		$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		parse_str($query, $params);
		$fid = $params['loc'];
		//$dna = $params['dname'];
		$dna1 = $params['lname'];
		$dna2 = $params['fname'];
		$dna = $dna2." ".$dna1;
		if($dna==''){
			$dna='No';
		}
		
		//echo $fid;
		
		//if($fid!='' && $dna!=''){
		if($fid!=''){
			redirect('in-memory-of/'.$fid.'/'.$dna);
			//$this->load->view('index',$data);
		}else{
		
			$this->load->view('index',$data);
		}
		
		/*
     	
		$use_id = '';
		
		$host=$_SERVER['HTTP_HOST'];
		if($host=='dignity.dev' || $host=='www.memorialflowers.ca'){
			$this->session->set_userdata('location',9);    
			if($this->session->userdata('location')>0){
				$re = $this->session->userdata('referer');
				$data['id_af'] = $this->Affiliate_model->get_affiliate($re);
				if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
					$this->session->sess_destroy();
					$this->load->view('launch.php',$data);
				}else{
					$this->load->view('index',$data);
				}
			}else{
				if($use_id != ''){
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}else{
						$data['aff_id'] = $this->Affiliate_model->get_affiliate($use_id);
						$this->session->set_userdata('logo',$use_logo);
						$this->session->set_userdata('disco','0.'.$use_disc);
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}
					//HOME PAGE		
				}else{
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}	
					//HOME PAGE
				}
			}
		}
		/*************************** MEMORIAL FLOWERS WEBSITE **********************/
		/***************************************************************************/
	}
	
	function in_memory_of($id,$name)
	{
		echo $id.'_'.$name;
		
		$name = str_replace("%20","-",$name);
		if($name=='No'){
			$name = '';
		}else{
			$name = $name;
		}
		
		$this->session->set_userdata('fun_id', $id);
		$this->session->set_userdata('memory_of', $name);
		
		redirect('/');
		
		/*
		use_ssl(FALSE);
		$this->session->set_userdata('clava', 'allowed');
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
        		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);

		$data['tiles'] = $this->Banner_model->get_tiles();
		
		$data['enlace'] = 'Home';

		$this->load->view('index',$data);
		*/
	}
	
	function test_page()
	{
	
		use_ssl(false);
		$this->session->set_userdata('location',9);    
		
		$this->load->Model('Pages_model');
		$data['page_lan'] = $this->Pages_model->get_lan_pages();    
		
		$template = $this->Pages_model->home_page_info();
		$data['pros'] = $this->Product_model->get_home_pros($template->page_id);
		
		$this->load->view('new-test',$data);
		
	}
	
	
	function new_template()
	{
		use_ssl(FALSE);
		
		$this->session->set_userdata('clava', 'allowed');
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
            
		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);
		$data['tiles'] = $this->Banner_model->get_tiles();
     	
		$use_id = '';
		
		
		
		/***************************************************************************/
		/*************************** MEMORIAL FLOWERS WEBSITE **********************/
		$host=$_SERVER['HTTP_HOST'];
		if($host=='new.memorialflowers.ca' || $host=='www.memorialflowers.ca'){
			if($this->session->userdata('location')>0){
				$re = $this->session->userdata('referer');
				$data['id_af'] = $this->Affiliate_model->get_affiliate($re);
				if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
					$this->session->sess_destroy();
					$this->load->view('launch.php',$data);
				}else{
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('index_template',$data);
					}else{
						$this->load->view('index',$data);
					}	
				}
			}else{
				if($use_id != ''){
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}else{
						$data['aff_id'] = $this->Affiliate_model->get_affiliate($use_id);
						$this->session->set_userdata('logo',$use_logo);
						$this->session->set_userdata('disco','0.'.$use_disc);
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}
					//HOME PAGE		
				}else{
					if($_SERVER['REQUEST_URI']=='/affiliate/mf'){
						$this->session->sess_destroy();
					}
					//HOME PAGE
					if( $this->session->userdata('clava') && $this->session->userdata('clava')=='allowed'){ 
						$this->load->view('home_clava.php',$data);
					}else{
						$this->load->view('launch.php',$data);
					}	
					//HOME PAGE
				}
			}
		}
		/*************************** MEMORIAL FLOWERS WEBSITE **********************/
		/***************************************************************************/
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function test($id)
	{
		use_ssl(FALSE);
		
		
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
            
		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);
		$data['tiles'] = $this->Banner_model->get_tiles();
     	
		$use_id = '';
		//echo "url ".$_SERVER['REQUEST_URI'];
		
			
			
		
		
		
		
		
		
		
		

		if($this->session->userdata('location')>0){
		 $re = $this->session->userdata('referer');
		 
		 $this->session->set_userdata('test_affiliate',5886161);
		 
		
		
		$data['id_af'] = $this->Affiliate_model->get_affiliate($re);
		
		//echo $_SERVER['REQUEST_URI'];
		
			if($_SERVER['REQUEST_URI']=='/affiliate/mf') {
			$this->session->sess_destroy();
			$this->load->view('test_launch.php',$data);
			}
			else
			{
				
			$this->load->view('index.php',$data);
			}
		
				
		}
		
		
		
		
		
		else{
				
			if($use_id != '') {
				 			
						
					if($_SERVER['REQUEST_URI']=='/affiliate/mf') {
					$this->session->sess_destroy();
					}
					else {
						   
						//echo $use_id ;	
						$data['aff_id'] = $this->Affiliate_model->get_affiliate($use_id);
						//$this->session->set_userdata('logo') = $aff_id->user_logo;
						$this->session->set_userdata('logo',$use_logo);
						$this->session->set_userdata('disco','0.'.$use_disc);
						
					}
					
					    
					$this->load->view('test_launch.php',$data);
			        
			}
			else{
				
				if($_SERVER['REQUEST_URI']=='/affiliate/mf') {
			$this->session->sess_destroy();
				}
			
			$this->load->view('test_launch.php',$data);
			}
			
		}	
			
	}
	
	function sci($id)
	{
		
		use_ssl(FALSE);
		
		$this->load->Model('Pages_model');
		$data['page'] = $this->Pages_model->return_page('home');
            
		$data['current_page']='home';
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['group_products'] = $this->Product_model->get_home_groups(10);
		$data['tiles'] = $this->Banner_model->get_tiles();
     	
		$data['aff'] = $this->Affiliate_model->get_affiliate($id);
		$affiliate = $this->Affiliate_model->get_affiliate($id);
		
		$this->session->set_userdata('val','sci');
		$this->session->set_userdata('referer',$affiliate->user_id);
		$this->session->set_userdata('location',$affiliate->user_province);
		$this->session->set_userdata('business',$affiliate->user_business);
		$this->session->set_userdata('address',$affiliate->user_address1.' '.$affiliate->user_address2);
		$this->session->set_userdata('city',$affiliate->user_city);
		$this->session->set_userdata('postalcode',$affiliate->user_postalcode);
		
		if($this->session->userdata('location')>0){
			$this->load->view('sci-index.php',$data);
		}else{
			$this->load->view('sci_launch.php',$data);
		}
		
					
	}

	function location2()
	{
				if(isset($_POST['location']) && is_numeric($_POST['location']))
				{
					$this->session->set_userdata('location',$_POST['location']);
				}
		        redirect('/new-affiliate/mountpleasant');
	}
	
	function location()
	{
				if(isset($_POST['location']) && is_numeric($_POST['location']))
				{
					$this->session->set_userdata('location',$_POST['location']);
				}
		        redirect('/');
	}
	
	function page($handle)
	{
		use_ssl(FALSE);
		
		if(!empty($handle))
		{
			$this->load->Model('Pages_model');
			if($data['page'] = $this->Pages_model->return_page($handle))
			{
				$data['current_page'] = $data['page']->page_handle;
				$data['paths'] = array('Home'=>path(),$data['page']->page_name.''=>'');
				$this->load->view('page',$data);
			}
			else
			{
				$data['page'] = $this->Pages_model->return_page('404');
				set_status_header('404');
				$this->load->view('404.php',$data);
			}
		}
		else
		{
			$this->index();
		}	

	}
	
	function notfound()
	{
		$data['page'] = $this->Pages_model->return_page('404');
		$data['foo2'] = '404'; 
		set_status_header('404');
		$this->load->view('404.php',$data);
	}
	
	
	function confirm_del($id){
	
		//echo $id;
		/*$cute = explode("_", $id);
		$invoi = $cute[0];
		$or_id = $cute[1];*/
		
		$data['orde'] = $id;
		
		$this->load->view('confirm_delivery',$data);
	
	}
	
	function delivered($id){
	
		$cute = explode("_", $id);
		$invoi = $cute[0];
		$or_id = $cute[1];
		$driver_id = $cute[2];
		$or_item = $this->input->post('suggestion');
		
		$data['o_id'] = $or_id;
		$data['rece'] = $or_item;
		$data['inv_id'] = $invoi;
		$data['dri_id'] = $driver_id;
		

		$this->load->view('confirmation_del',$data);		
	
	}
	
	function donate($id)
	{
	
		$data['d_id'] = $id;
		$this->load->view('donate',$data);		
	
	}
	
	function lifenews()
	{  
		$this->load->Model('Diseases_model');	
		$this->load->helper('file');			
		$filename = get_dir_file_info('assets/xml_funerals/');		
	
		if (count($filename) > 1) 
		{
			foreach( $filename as $key => $value )
			{				
				// eliminating folders and other file types
				if( substr($value['name'], -4) != ".xml" ) continue;
								
				// create a SimpleXML object 
				if( ! $xml = simplexml_load_file($value['server_path']) ) 
				{ 
					//echo "Unable to load XML file"; 
				} 
				else 
				{ 						
					$i = 0;
					// loop over the elements  and insert into DB 'diseases'
					foreach( $xml as $element ) 
					{
						$fields = @array(
										'data_id' => (string)$element[$i]->field[0], 										 
										'firstname' => (string)$element[$i]->field[1], 
										'lastname' => (string)$element[$i]->field[2], 
										'filename' => $value['name']
								);

							if($this->Diseases_model->validate_data($fields))
							{
								$this->Diseases_model->insert_data($fields);
							}
							else
							{
								$i++;
								continue;
							}	
												
						$i++;							
					} 			
				} 				

				if( rename( $value['server_path'] , $value['relative_path']."completed_files/".$value['name'] ))
				{
					//echo $value['relative_path']."completed_files/".$value['name']." Moved<br/>";
					//@unlink($value['server_path']);
				}
				else
				{
					//echo $value['relative_path']."completed_files/".$value['name']." Not Moved<br/>";
				}	
							
			}				
		} 
		else 
		{
			//echo "Empty Folder...";
		}
		exit;
		
	
	}
	
	
	function policies()
	{
	
		$data['val'] = 'Policies';
		$this->load->view('policies',$data);	
	
	}
	
	function terms_of_use()
	{
	
		$data['val'] = 'Terms';
		$this->load->view('terms',$data);	
	
	}

	function aboutus()
	{
	
		$data['val'] = 'About us';
		$this->load->view('about-us',$data);	
	
	}
	
	function faqs()
	{
	
		$data['val'] = 'FAQs';
		$this->load->view('faqs',$data);	
	
	}

	
	//FUNCTION TO SHOW INVOICE IN PDF FORMAT TO PRINT
	
	/*
	function print_invoice2($id){
	
		echo 'oscar';
	}
	*/
	public function print_invoice2($id) 
	{
		//$invoice_id = $pieces[1];
		
		$orders = $this->Affiliate_model->get_order($id); 
		
		foreach($orders as $order){ 
		$html = '
		<html>
			<head>
			</head>
			<style>
				@page {
					margin-top: 1em;
					margin-bottom: 1em;
					margin-left: 0.3em;
					margin-right: 0.3em;
				}
			</style>
			<body style="margin-left:5%;margin-right:5%;">
			
				
				<table width="100%" style="font-family:Trebuchet MS,Helvetica,sans-serif;">
					<tr>
						<td>
							<br />
							<span style="font-size:18px;">
								<b>'.$order->invoice_id.'</b>
							</span>
						</td>
						<td align="right">
							<img src="http://test.memorialflowers.ca/templates/memorial/img/memlogo.png" width="200" height="50" />
							<br />
						</td>
					</tr>
				</table>
					
					
				<table width="100%" style="background-color:#B0B0B0;">
			<tr>
				<td width="100%">';
			
			$order_items = $this->Affiliate_model->get_order_items($order->cart_id,$order->order_id);
			$p =1;
			foreach($order_items as $item) {	
			
			$html .= '<table width="100%" style="font-family:Trebuchet MS,Helvetica,sans-serif;" border="0">
						<tr>
							<th colspan="2" class="text-center" style="height:30px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								<b>DS: '.$item->orderitem_id.'</b>
							</th>
						</tr>
						<tr>
							<th class="text-center" width="45%" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								<b>RECIPIENT INFORMATION</b>
							</th>
							<th class="text-center" width="55%" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								<b>DELIVERY DATE & TIME</b>
							</th>
						</tr>
						<tr>
							<td rowspan="3" style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								'.ucwords(strtolower($item->firstname.' '.$item->lastname)).'<br />';
								
								if($item->location_type=='Residence'){
									$html .= $item->location_type.'<br />';
								}else{
									$html .= ucwords(strtolower($item->location_type_name)).' ('.$item->location_type.')<br />';	
								}
						
					$html .= ucwords(strtolower($item->address1.' '.$item->address2)).'<br />
								'.ucwords(strtolower($item->city.' ')).', '.$item->province.'<br />';
								if($item->country_id ==1) {
									$html .= 'CA';
								}else{
									$html .= 'USA';
								}
								
						$html .= ' '.strtoupper($item->postalcode).'<br/>
								'.$item->dayphone; 
								if($item->evephone == '') {
									$html .= '';
								}else{
									$html .= ' | '.$item->evephone;
								}
						$html .= '</td>
							<td class="text-center" style="text-align:center;color:#802A2A;padding:5px;font-size:13px;background-color:#fff;">
								<b>'; 
								if($item->delivery_date == '0000-00-00') {
									$html .= $item->delivery_range;
								}else{
									$html .= date("F j, Y", strtotime($item->delivery_date));
								}
								if($item->delivery_time == '') {
									$html .= '';
								}else{
									$html .= ' at '.$item->delivery_time;
								}
						$html .= '</b>
							</td>
						</tr>
						<tr>
							<th class="text-center" style="height:30px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								CARD MESSAGE
							</th>
						</tr>
						<tr>
							<td class="keep-size" align="center" style="font-size:11px;line-height:130%;color:#555555;padding:5px;background-color:#fff;">
								'.$item->card_message.'
							</td>
						</tr>
					</table>';	

			$html .= '<table width="100%" style="font-family:Trebuchet MS,Helvetica,sans-serif;" border="0">
						<tr>
							<th class="text-center" colspan="2" width="45%" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								PRODUCT
							</th>
							<th class="text-center" width="40%" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								RIBBON
							</th>
							<th class="text-center" width="15%" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
								TOTAL
							</th>
						</tr>
						<tr>
							<td align="center" valign="top" colspan="2" style="font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								<table width="100%" border="0">
									<tr>
										<td width="30%" align="center">
											<img src="'.base_url().'/productres/'.$item->product_picture.'" width="90" height="100" />
										</td>
										<td width="70%" valign="top" style="padding:5px;font-size:11px;line-height:130%;color:#555555;">
											<b>Name</b><br />
											'.$item->product_name.'
											<br /><br />
											<b>Code</b>
											'.$item->product_code.'
											<br /><br />
											<b>Size</b>
											'.$item->price_name.' - ('.$item->price_val.')
										</td>
									</tr>
								</table>	
							</td>
							<td valign="top" style="padding:10px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">';
							
							$html .= $item->ribbon_text;
								/*
								$product_recipe = $this->Pdf_model->get_product_recipe($item->p_val,$item->product_id);
								foreach($product_recipe as $recipe) {
								$html .= '<b>* </b>';
									if($recipe->quantity!=0){ 
										$html .= $recipe->quantity.' '; 
									} 
								$html .= ucwords(strtolower($recipe->item_name)).'<br />';
								}
								*/
					$html .= '</td>
							<td align="center" style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								$ '.$item->product_price;
								
								if($item->ribbon_text!=''){
								
									$html .= '<br /> <b>+</b> <BR />$ 12.99';
								
								}
								
						$html .=	'</td>
						</tr>';
						
						/*	
						$item_addons = $this->Pdf_model->get_item_addons($item->orderitem_id,$item->db_id,$order->client_order_id);
						foreach($item_addons as $addon) { 
						
						$html .= '<tr>
							<td align="center" colspan="2" valign="top" style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								'.$addon->addon_name.'
							</td>
							<td align="center" style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								$'.$addon->addon_price.' X '.$addon->addon_quantity.'
							</td>
							<td align="center" style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;">
								$ '.$addon->addon_price*$addon->addon_quantity.'
							</td>
						</tr>';
						}
						*/
					$html .= '</table>';
				
					/*
					$html .= '<table width="100%" cellpadding="5" cellspacing="0" border="0">
						<tr>
							<th class="text-center" width="24%" style="padding:5px;font-size:9px;color:#555555;background-color:#DEDEDE;">
								P.O.
							</th>
							<th class="text-center" width="38%" style="padding:5px;font-size:9px;color:#555555;background-color:#DEDEDE;">
								RIBBON
							</th>
							<th class="text-center" width="38%" style="padding:5px;font-size:9px;color:#555555;background-color:#DEDEDE;">
								SPECIAL NOTES
							</th>
						</tr>
						<tr>
							<td style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;" valign="top">
								'.$item->order_po.'
							</td>
							<td style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;" valign="top">
								<b>Color: </b> 
								'.$item->ribbon_color.'<br />
								<b>Text:</b>&nbsp;&nbsp;';
								if($item->ribbon_text==''){
								$html .= 'No Ribbon Text';
								}else{
								$html .= $item->ribbon_text;
								} 
							$html .= '</td>
							<td style="padding:5px;font-size:11px;line-height:130%;color:#555555;background-color:#fff;" valign="top">';
								if($item->special_note==''){
									$html .= 'No Special Notes';
								}else{
									$html .= $item->special_note;
								} 
						$html .= '</td>
						</tr>
					</table>';			
					
					*/
					
				
			}


		$html .= '<table width="100%" style="font-family:Trebuchet MS,Helvetica,sans-serif;" border="0">
				<tr>
					<th colspan="2" class="text-center" style="height:35px;background-color:#DEDEDE;;color:#555555;font-size:9px;font-weight:bold;">
						BILLING INFORMATION
					</th>
				</tr>
				<tr>
					<th class="text-center" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
						CUSTOMER INFORMATION
					</th>
					<th class="text-center" style="height:35px;background-color:#DEDEDE;color:#555555;font-size:9px;font-weight:bold;">
						PAYMENT DETAILS
					</th>
				</tr>
				<tr>
					<td width="45%" style="padding:5px;font-size:11px;color:#555555;line-height:130%;background-color:#fff;">
						'.ucfirst($order->firstname.' '.$order->lastname).'<br/>
						'.ucfirst($order->address1.' '.$order->address2).'<br />
						'.ucfirst($order->city.', '.$order->province).'<br/>';
						if($order->country_id ==1) {
							$html .= 'CA';
						}else{
							$html .= 'US';
						}
				$html .= ' '.strtoupper($order->postalcode).'<br/>
						'.strtolower($order->email).' <br/>
						'.$order->dayphone;
						if($order->evephone == '') {
						
						}else{
							$html .= ' / '.$order->evephone;
						}
				$html .= '</td>
					<td width="55%" style="padding:5px;font-size:11px;color:#555555;line-height:130%;background-color:#fff;">
						<table cellpadding="2" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="45%" align="right">Purchase Price</td>
								<td width="10%" align="center">:</td>
								<td width="45%">$ '.$order->amount.' </td>
							</tr>
							<tr>
								<td align="right">Delivery Charge</td>
								<td align="center">:</td>
								<td>$ '.$order->shipping.' </td>
							</tr>
							<tr>
								<td align="right">Service Charge</td>
								<td align="center">:</td>
								<td>$ '.$order->service.' </td>
							</tr>
							<tr>
								<td align="right">Same Day Charge</td>
								<td align="center">:</td>
								<td>$ '.$order->surcharge.' </td>
							</tr>
							<tr>
								<td align="right">Discount</td>
								<td align="center">:</td>
								<td>$ ';
									$total_discount = $order->coupon+$order->company_less+$order->discount;
								$html .= $total_discount; 
									if($order->coupon_code!=''){
										$html .= ' <b>('.$order->coupon_code.')</b>';
									}	
						$html .= '</td>
							</tr>
							<tr>
								<td align="right">Tax</td>
								<td align="center">:</td>
								<td>$ '.$order->tax.'</td>
							</tr>
							<tr height="5">
								<td colspan="3"></td>
							</tr>
							<tr style="font-size:12px; font-weight:bold;">
								<td align="right">Total</td>
								<td align="center">:</td>
								<td>$ ';
									$gran_total = $order->amount + $order->shipping + $order->service + $order->surcharge - $total_discount + $order->tax;
									$html .= $gran_total;
							$html .= '</td>
							</tr>
						</table>                    
					</td>
				</tr>
			</table>';
			
			
			$html .= '</td></tr></table>
				
			</body></html>';	
		
		}	
		
		if(!empty($html))
		{	
		$this->load->library('dompdf_lib');		
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter', 'portrait');
		$this->dompdf->render();	
		$this->dompdf->stream("".$id,array('Attachment'=>0));
		}
		else
		{			
			echo  <<<EOD
			<script> alert("Sorry, Too Much Data To Process, Please Select Less !"); window.history.back();</script>
EOD;
			exit;
		}
	}
	
	
	function email_template()
	{
	
		$this->load->view('email-template');	
	
	}
	
	
	
	
	
	
	public function print_invoice($id) 
	{
	
		$previ = $_SERVER['HTTP_REFERER'];
		
		if($previ=='http://test.memorialflowers.ca/shop/checkout' || $previ=='http://www.memorialflowers.ca/mymemorial/orders/browse'){
		
			
		$ema_order = $this->Affiliate_model->get_email_order_info($id);
							
		$ema_deli = $this->Affiliate_model->get_delivery_order_info($ema_order->cart_id);
							
		$e_delivery = $this->Affiliate_model->get_delivery_order_info_details($ema_order->cart_id);
							
							/*
							$to = $ema_order->email;
							//$to = 'orabines@gmail.com';
							$header = "From: orders@memorialflowers.ca \r\n";
							$header .= "Cc: orabines@gmail.com \r\n";
							$header .= "MIME-Version: 1.0\r\n";
							$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$subject = "Order Confirmation - Dignity Memorial";
							*/
							
							$message = '<html>
										<style>
											@page {
												margin-top: 1em;
												margin-bottom: 1em;
												margin-left: 0.3em;
												margin-right: 0.3em;
											}
										</style>
										<body style="margin-left:5%;margin-right:5%;">';
							
							$message .= '
										<table width="100%" border="0" style="background-color:#FFF;">
											<tr>
												<td width="20%">
												
												</td>
												<td width="60%" align="center" valign="top">
													<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;background-color:#fff;border:1px solid #919191;">
														<tr style="background-color:#fff;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" align="center">
																<img src="'.base_url().'/templates/memorial/img/memlogo.png" style="width:200px;height:auto;">
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" style="padding:7px;">
																<br />
																<span style="font-size:18px;line-height:170%;">Thank You for your order.</span><br />
																<span style="font-size:12px;">Your order has been received and is now being processed. Your order details are shown below for your reference.</span><br /><br />
																<span style="font-size:14px;"><b>Order Number: '.$ema_order->invoice_id.'</b></span><br />
																<span style="font-size:12px;">Order Placed on '.date("M j, Y h:i:s A", strtotime($ema_order->order_date)).'</span><br />
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" style="padding:7px;background-color:#F4F4F4;">
																<span style="font-size:14px;"><b>Shipping Details</b></span><br />
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;margin-top:-5px;">
																	<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="2" width="100%" style="padding:6px;" valign="top">
																			'.$ema_deli->firstname.' '.$ema_deli->lastname.'<br />';
																			
																			if($ema_deli->location_type_name!=''){
																				$message .= $ema_deli->location_type_name.'<br />';
																			}
																	$message .= $ema_deli->address1.' '.$ema_deli->address2.'<br />
																			'.$ema_deli->city.', '.$ema_deli->province.' '.$ema_deli->postalcode.'<br />
																			'.$ema_deli->dayphone.'<br />
																		</td>
																	</tr>';
																	
																	foreach($e_delivery as $ed){
																	
																	$message .= '<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td  width="5%" style="padding-left:7px;padding-top:6px;padding-bottom:6px;" valign="top">
																			<img src="'.base_url().'productres/'.str_replace("%20"," ",$ed->option_picture).'" style="width:80em;">
																		</td>
																		<td width="90%" style="padding-left:-45px;padding-right:6px;padding-top:6px;padding-bottom:6px;color:#757167;" valign="top">
																			<span style="font-weight:bold;font-size:12px;">'.$ed->product_name.'</span><br />
																			<span style="line-height:160%;"><b>Item ID: </b>'.$ed->orderitem_id.' | <b>Delivery Date: </b>'.date("M j, Y", strtotime($ed->delivery_date)).'</span>';
																			
																			if($ed->card_message!=''){
																	$message .= '<br />
																			<b>Card Message</b><br />
																			<span style="line-height:160%;">'.$ed->card_message.'</span>';
																			}
																			if($ed->ribbon_text!=''){
																			
																				$message .= '<br />
																							<b>Ribbon Message</b><br />
																							'.$ed->ribbon_text.'';
																			
																			}
																			
																$message .= '</td>
																	</tr>';
																	
																	
																	}
																	
																	
																	
														$message .= '</table>
																
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" style="padding:7px;background-color:#F4F4F4;">
																<span style="font-size:14px;"><b>Billing Details</b></span><br />
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">
																	<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td width="50%" style="padding:7px;padding-top:3px;" valign="top">
																			'.$ema_order->firstname.' '.$ema_order->lastname.'<br />
																			'.$ema_order->address1.' '.$ema_order->address2.'<br />
																			'.$ema_order->city.', '.$ema_order->province.' '.$ema_order->postalcode.'<br />
																			'.$ema_order->dayphone.'<br />
																			'.$ema_order->email.'
																		</td>
																		<td width="50%" style="padding:7px;padding-top:3px;" valign="top">
																			<b>Payment Type</b><br />
																			'.$ema_order->cardtype.': xxxx xxxx xxxx '.substr($ema_order->cardnumber,-4).'
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="100%" style="padding:7px;padding-top:0px;">
															
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">
																	<tr style="color:#757167;font-size:12px;">
																		<td width="45%" style="padding-top:5px;" valign="top">
																			<span style="font-size:12px;"><b>Product Name</b></span><br />
																		</td>
																		<td width="23%" style="padding-top:5px;" align="center" valign="top">
																			<span style="font-size:12px;"><b>Price</b></span><br />
																		</td>
																		<td width="10%" style="padding-top:5px;" align="center" valign="top">
																			<span style="font-size:12px;"><b>Qty</b></span><br />
																		</td>
																		<td width="22%" style="padding-top:5px;" align="right" valign="top">
																			<span style="font-size:12px;"><b>Subtotal</b></span><br />
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding:7px;padding-top:-14px;" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">';
																
																	foreach($e_delivery as $ed){
																	
																		$message .= '<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																						<td width="45%" style="padding-top:5px;" valign="middle">
																							<span style="font-weight:bold;font-size:12px;">'.$ed->product_name.'';
																							
																							$rt = 0;
																							if($ed->ribbon_text!=''){
																								$rt = $ed->product_price+12.99;
																								$message .= '<span style="color:#757167;"> + Ribbon (C$ 12.99)</span>';
																							
																							}else{
																								$rt = $ed->product_price;
																							}
																							
																					$message .= '</span><br />	
																						</td>
																						<td width="23%" style="padding-top:5px;" valign="middle" align="center">
																							C$ '.$rt.'<br />	
																						</td>
																						<td width="10%" style="padding-top:5px;" valign="middle" align="center">
																							1<br />	
																						</td>
																						<td width="22%" style="padding-top:5px;" valign="middle" align="right">
																							C$ '.$rt.'<br />	
																						</td>
																					</tr>';
																	
																	}
																	
														$message .= '<tr style="background-color:#fff;color:#757167;font-size:13px;height:20px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="4" style="padding-top:10px;" valign="middle" align="right">
																				
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Sub-Total	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->amount.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Shipping	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->service.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Taxes	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->tax.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#F4F4F4;color:#757167;font-size:12px;height:35px;vertical-align:middle;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			<b>Total</b>	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			<b>C$ '.number_format(($ema_order->amount+$ema_order->service+$ema_order->tax),2).'</b><br />	
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
													</table>
												
													
												</td>
												<td width="20%">
												
												</td>
											</tr>
											<tr>
												<td>
												
												</td>
												<td align="center" style="font-family:Tahoma, Geneva, sans-serif;color:#757167;font-size:10px;">
													<br />
													<small>
														<b>
															This website and floral service is provided by Memorial Flowers, a division of 1882540 Ontario, which holds trademark rights in the Memorial Flowers brand and logo and in the copyright holder (&copy; 2015) in the Memorial Flowers content.
														</b>
													</small>
													
												</td>
												<td>
												
												</td>
											</tr>
										</table>
							
							
							
										';
							
							
							
							$message .= '</body></html>';
		
		if(!empty($message))
		{	
			$this->load->library('dompdf_lib');		
			$this->dompdf->load_html($message);
			$this->dompdf->set_paper('letter', 'portrait');
			$this->dompdf->render();	
			$this->dompdf->stream("".$id,array('Attachment'=>0));
		}
		else
		{			
			echo  <<<EOD
			<script> alert("Sorry, Too Much Data To Process, Please Select Less !"); window.history.back();</script>
EOD;
			exit;
		}
	
			
			
			
		
		}else{
		
			$this->load->view('404');
		
		}
	
		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */