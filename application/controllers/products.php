<?php

class Products extends CI_Controller {

	function Products()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->Model('Order_model');
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
		$this->load->library('form_validation');
		$this->load->helper('security');
	}
	
	function index()
	{
		use_ssl(FALSE);
		
		$data['cat_name'] = 'All Products';
		$data['secti'] = 'products';
		$data['title'] = 'Browse all Products';
		$data['current_page']='products';
		$data['paths'] = array('Home'=>path(),'Products'=>'');
		$data['products'] = $this->Product_model->get_catalog_products(100,array());
		$data['page'] = $this->Pages_model->return_page('products');
		
		$this->load->view('products',$data);
	}
	
	
	
	function country($country)
	{
		use_ssl(FALSE);
		
		$data['current_page']='products';
		$data['title'] = $country ? 'Browse products for '.ucfirst(strtolower(str_replace('-',' ',$country))):'Browse all Products';
		$data['products'] = $this->Product_model->get_catalog_products(100,array('country'=>$country));
		$data['page'] = $this->Pages_model->return_page('products');
		$this->load->view('products',$data);	
	}
	
	function occasion($occasion,$pagin,$color='',$minimo=0,$maximo=0,$orderby2='')
	{
		
		$query = '';
		
		if($color=='all' || $color==''){
			$query .= '';
		}else{
			$query .= ' AND p.color="'.$color.'"';
		}
		if($minimo==''){
			$minimo = 0;
			$query .= ' AND pp.price_value>=0';
		}else{
			$query .= ' AND pp.price_value>='.$minimo;
		}
		if($maximo==''){
			$maximo=1000;
			$query .= ' AND pp.price_value<=1000';
		}else{
			$query .= ' AND pp.price_value<='.$maximo;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$orderby = 'po.display_order ASC';
		}else{
			$orderby = 'pp.price_value '.$orderby2;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$data['e_orderby'] = 'Best Match';
		}
		if($orderby2=='DESC'){
			$data['e_orderby'] = 'Highest Price';
		}
		if($orderby2=='ASC'){
			$data['e_orderby'] = 'Lowest Price';
		}
		
		$data['ti'] = 'occasion';
		$data['ti2'] = $occasion;
		$data['pagi'] = $pagin;
		$data['e_color'] = $color;
		$data['e_min'] = $minimo;
		$data['e_max'] = $maximo;
		
		if($orderby2==''){
			$data['sortby_val'] = 'BM';;
		}else{
			$data['sortby_val'] = $orderby2;
		}
		
		//TITLE INFORMATION
		$value_uri=$_SERVER['REQUEST_URI'];
		$pieces = explode("/", $value_uri);
		
		$data['noinfo'] = $pieces[0];
		$data['location'] = ucwords(str_replace("-"," ",$pieces[1]));
		$data['val'] = ucwords(str_replace("-"," ",$pieces[2]));
		//TITLE INFORMATION
		
		use_ssl(FALSE);
		
		$name = str_replace('-',' ',xss_clean($occasion));
		$this->load->model('Occasion_model');
		$data['cat_name'] = $name;
		$data['secti'] = 'Occasion';
		if($occ = $this->Occasion_model->get_occasion_byname($name))
		{
			if($occ->occasion_status!=1)
			{
				$this->notfound();
			}
			
			$data['rec'] = $occ;
			$data['path'] = $occasion; 
			
			if($page = $this->Pages_model->get_page($occ->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('occasion-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			
			$data['title'] = $occ->occasion_name;
			$data['paths'] = array('Home'=>path(),ucwords($occasion).''=>'');
			//$data['products'] = $this->Product_model->get_catalog_products(100,array('occasion'=>$occasion));
			$data['products'] = $this->Product_model->get_occas_pros($occ->occasion_id,$query,$orderby);	

			$to = $this->Product_model->get_occas_pros($occ->occasion_id,$query,$orderby);
			$e=0;
			foreach($to as $tito){
				$e=$e+1;
			}
			
			
			if($e==0){
			
				$data['no_pros'] = '0';
			
				$query = '';
				/*
				if($color=='all' || $color==''){
					$query .= '';
				}else{
					$query .= ' AND p.color="'.$color.'"';
				}
				*/
				$query .= ' AND pp.price_value>=0';
				
				$query .= ' AND pp.price_value<=1000';
				
				if($orderby2=='' || $orderby2=='BM'){
					$orderby = 'po.display_order ASC';
				}else{
					$orderby = 'pp.price_value '.$orderby2;
				}
				
				if($orderby2=='' || $orderby2=='BM'){
					$data['e_orderby'] = 'Best Match';
				}
				if($orderby2=='DESC'){
					$data['e_orderby'] = 'Highest Price';
				}
				if($orderby2=='ASC'){
					$data['e_orderby'] = 'Lowest Price';
				}
				
				$data['ti'] = 'occasion';
				$data['ti2'] = $occasion;
				$data['pagi'] = $pagin;
				$data['e_color'] = $color;
				$data['e_min'] = 0;
				$data['e_max'] = 1000;
				
				if($orderby2==''){
					$data['sortby_val'] = 'BM';;
				}else{
					$data['sortby_val'] = $orderby2;
				}
				
				$data['products'] = $this->Product_model->get_occas_pros($occ->occasion_id,$query,$orderby);	
				$to = $this->Product_model->get_occas_pros($occ->occasion_id,$query,$orderby);
				foreach($to as $tito){
					$e=$e+1;
				}
				
				
			
			}
			
			
			
			
			$pa = intval($e/15);
			$pa2 = $e%15;
			if($pa2>0){
				$pa = $pa+1;
			}else{
				$pa = $pa;
			}
			
			$data['tot_pro'] = $e;
			$data['tot_pag'] = $pa;

				
			
			$this->load->view('products',$data);		
		}
		else
		{
			$this->notfound();
		}
		
	}

	function sort($var)
	{
		use_ssl(FALSE);
			
		$data['title'] = "Price Range: {$from} - {$to}";
		$data['rec'] = '';
		$data['path'] ='';
		$data['paths'] = '';
		$data['products'] = $this->Product_model->get_catalog_products(100,array(),!empty($var) ? $var:'');

		$this->load->view('products',$data);
	
	}
	
	function pricing($from , $to)
	{
		use_ssl(FALSE);
			
		$data['title'] = "Price Range: {$from} - {$to}";
		$data['rec'] = '';
		$data['path'] ='';
		$data['paths'] = '';
		$data['products'] = $this->Product_model-> get_by_price($from, $to);

		$this->load->view('price_range_clava',$data);
	
	}
	
	function color($color)
	{
		use_ssl(FALSE);
		
		$name = str_replace('-',' ',xss_clean($color));
		$this->load->model('Color_model');
		$data['cat_name'] = $name;
		$data['secti'] = 'Color';
		if($clr = $this->Color_model->get_color_byname($name))
		{

			
			if($page = $this->Pages_model->get_page($clr->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				
				$page = $this->Pages_model->return_page('color-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}		
			
			$data['title'] = $clr->color_name;
			$data['rec'] = $clr;
			$data['path'] = $color;
			$data['paths'] = array('Home'=>path(),ucwords($color).''=>'');
			$data['products'] = $this->Product_model->get_catalog_products(100,array('color'=>$color));
			
			$this->load->view('products',$data);			
		}
		else
		{
			$this->notfound();
		}

	
	}
        
	function search()
	{
		use_ssl(FALSE);


	            if(isset($_POST['search']) && !empty($_POST['search']))
	            {
	                	$search = $this->input->post('search');
			
			$this->Product_model->save_search($search);
			
			$this->load->model('Color_model');
			$data['cat_name'] = $search;
			$data['secti'] = 'Search Result';
			$data['search_string'] = $_POST['search'];
			$data['title'] = $search;
			$data['path']='';
			$data['paths'] = array('Home'=>path(),'Search results'=>'');
			$data['products'] = $this->Product_model->get_search_products(100,array('search'=>$search));
			$data['page'] = $this->Pages_model->return_page('search-products');

			$this->load->view('search-products',$data);					
	            }
        	}
	
	function show($category,$pagin,$color='',$minimo=0,$maximo=0,$orderby2='')
	{
		use_ssl(FALSE);
		
		$query = '';
		
		if($color=='all' || $color==''){
			$query .= '';
		}else{
			$query .= ' AND p.color="'.$color.'"';
		}
		if($minimo==''){
			$minimo = 0;
			$query .= ' AND pp.price_value>=0';
		}else{
			$query .= ' AND pp.price_value>='.$minimo;
		}
		if($maximo==''){
			$maximo=1000;
			$query .= ' AND pp.price_value<=1000';
		}else{
			$query .= ' AND pp.price_value<='.$maximo;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$orderby = 'p.product_name ASC';
		}else{
			$orderby = 'pp.price_value '.$orderby2;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$data['e_orderby'] = 'Best Match';
		}
		if($orderby2=='DESC'){
			$data['e_orderby'] = 'Highest Price';
		}
		if($orderby2=='ASC'){
			$data['e_orderby'] = 'Lowest Price';
		}
		
		
		$data['ti'] = 'category';
		$data['ti2'] = $category;
		$data['pagi'] = $pagin;
		$data['e_color'] = $color;
		$data['e_min'] = $minimo;
		$data['e_max'] = $maximo;
		
		if($orderby2==''){
			$data['sortby_val'] = 'BM';;
		}else{
			$data['sortby_val'] = $orderby2;
		}
		
		//TITLE INFORMATION
		$value_uri=$_SERVER['REQUEST_URI'];
		$pieces = explode("/", $value_uri);
		
		$data['noinfo'] = $pieces[0];
		$data['location'] = ucwords(str_replace("-"," ",$pieces[1]));
		$data['val'] = ucwords(str_replace("-"," ",$pieces[2]));
		//TITLE INFORMATION
		
		$name = str_replace('-',' ',xss_clean($category));
		$data['cat_name'] = $name;
		$data['secti'] = 'Category';
		$this->load->model('Category_model');
		if($cat = $this->Category_model->get_category_byname($name))
		//if($cat = $this->Category_model->get_category_byname2($name))
		{
			$data['rec'] = $cat;
			$data['path'] = $category;	
			if($page = $this->Pages_model->get_page($cat->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('category-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			$data['title'] = $cat->category_name;
			$data['paths'] = array('Home'=>path(),ucwords($category).''=>'');
			//$data['products'] = $this->Product_model->get_catalog_products(100,array('category'=>$category));	
			$data['products'] = $this->Product_model->get_category_products($cat->category_id,$query,$orderby);				
			
			$to = $this->Product_model->get_category_products($cat->category_id,$query,$orderby);	
			$e=0;
			foreach($to as $tito){
				$e=$e+1;
			}
			
			if($e==0){
			
				$data['no_pros'] = '0';
				
				$query = '';
				/*
				if($color=='all' || $color==''){
					$query .= '';
				}else{
					$query .= ' AND p.color="'.$color.'"';
				}
				*/
				$query .= ' AND pp.price_value>=0';
				$query .= ' AND pp.price_value<=1000';
				
				if($orderby2=='' || $orderby2=='BM'){
					$orderby = 'p.product_name ASC';
				}else{
					$orderby = 'pp.price_value '.$orderby2;
				}
				
				if($orderby2=='' || $orderby2=='BM'){
					$data['e_orderby'] = 'Best Match';
				}
				if($orderby2=='DESC'){
					$data['e_orderby'] = 'Highest Price';
				}
				if($orderby2=='ASC'){
					$data['e_orderby'] = 'Lowest Price';
				}
				
				
				$data['ti'] = 'category';
				$data['ti2'] = $category;
				$data['pagi'] = $pagin;
				$data['e_color'] = $color;
				$data['e_min'] = 0;
				$data['e_max'] = 1000;
				
				if($orderby2==''){
					$data['sortby_val'] = 'BM';;
				}else{
					$data['sortby_val'] = $orderby2;
				}
				
				$data['products'] = $this->Product_model->get_category_products($cat->category_id,$query,$orderby);				
			
				$to = $this->Product_model->get_category_products($cat->category_id,$query,$orderby);	
				//$e=0;
				foreach($to as $tito){
					$e=$e+1;
				}
				
			
			}
			
			
			
			
			$pa = intval($e/15);
			$pa2 = $e%15;
			if($pa2>0){
				$pa = $pa+1;
			}else{
				$pa = $pa;
			}
			
			$data['tot_pro'] = $e;
			$data['tot_pag'] = $pa;
			
			
			$this->load->view('products',$data);						
		}
		else
		{
			$this->notfound();
		}
	}
	
	function catalog($pagin,$color='',$minimo=0,$maximo=0,$orderby2='')
	{
		use_ssl(FALSE);
		
		$query = '';
		
		if($color=='all' || $color==''){
			$query .= '';
		}else{
			$query .= ' AND p.color="'.$color.'"';
		}
		if($minimo==''){
			$minimo = 0;
			$query .= ' AND pp.price_value>=0';
		}else{
			$query .= ' AND pp.price_value>='.$minimo;
		}
		if($maximo==''){
			$maximo=1000;
			$query .= ' AND pp.price_value<=1000';
		}else{
			$query .= ' AND pp.price_value<='.$maximo;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$orderby = 'p.product_name ASC';
		}else{
			$orderby = 'pp.price_value '.$orderby2;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$data['e_orderby'] = 'Best Match';
		}
		if($orderby2=='DESC'){
			$data['e_orderby'] = 'Highest Price';
		}
		if($orderby2=='ASC'){
			$data['e_orderby'] = 'Lowest Price';
		}
		
		
		$data['ti'] = 'products';
		$data['ti2'] = 'catalog';
		$data['pagi'] = $pagin;
		$data['e_color'] = $color;
		$data['e_min'] = $minimo;
		$data['e_max'] = $maximo;
		
		if($orderby2==''){
			$data['sortby_val'] = 'BM';;
		}else{
			$data['sortby_val'] = $orderby2;
		}
		
		
		//TITLE INFORMATION
		$value_uri=$_SERVER['REQUEST_URI'];
		$pieces = explode("/", $value_uri);
		
		$data['noinfo'] = $pieces[0];
		$data['location'] = ucwords(str_replace("-"," ",$pieces[1]));
		$data['val'] = ucwords(str_replace("-"," ",$pieces[2]));
		//TITLE INFORMATION
		
		/*$name = str_replace('-',' ',xss_clean($category));
		$data['cat_name'] = $name;
		$data['secti'] = 'Products';*/
		//$this->load->model('Category_model');
			/*
			$data['rec'] = $cat;
			$data['path'] = $category;	
			if($page = $this->Pages_model->get_page($cat->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('category-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			*/
			$data['title'] = 'Catalog';
			//$data['paths'] = array('Home'=>path(),ucwords($category).''=>'');
			//$data['products'] = $this->Product_model->get_catalog_products(100,array('category'=>$category));	
			$data['products'] = $this->Product_model->get_full_catalog_products($query,$orderby);				
			$to = $this->Product_model->get_full_catalog_products($query,$orderby);	
			$e=0;
			foreach($to as $tito){
				$e=$e+1;
			}
			
			if($e==0){
			
				$data['no_pros'] = '0';
				
				$query = '';
				
				if($color=='all' || $color==''){
					$query .= '';
				}else{
					$query .= ' AND p.color="'.$color.'"';
				}
				
				$query .= ' AND pp.price_value>=0';
				$query .= ' AND pp.price_value<=1000';
				
				if($orderby2=='' || $orderby2=='BM'){
					$orderby = 'p.product_name ASC';
				}else{
					$orderby = 'pp.price_value '.$orderby2;
				}
				
				if($orderby2=='' || $orderby2=='BM'){
					$data['e_orderby'] = 'Best Match';
				}
				if($orderby2=='DESC'){
					$data['e_orderby'] = 'Highest Price';
				}
				if($orderby2=='ASC'){
					$data['e_orderby'] = 'Lowest Price';
				}
				
				
				$data['ti'] = 'products';
				$data['ti2'] = 'catalog';
				$data['pagi'] = $pagin;
				$data['e_color'] = $color;
				$data['e_min'] = 0;
				$data['e_max'] = 1000;
				
				if($orderby2==''){
					$data['sortby_val'] = 'BM';;
				}else{
					$data['sortby_val'] = $orderby2;
				}
				
				//TITLE INFORMATION
				$value_uri=$_SERVER['REQUEST_URI'];
				$pieces = explode("/", $value_uri);
				
				$data['noinfo'] = $pieces[0];
				$data['location'] = ucwords(str_replace("-"," ",$pieces[1]));
				$data['val'] = ucwords(str_replace("-"," ",$pieces[2]));
				//TITLE INFORMATION
				
				$data['products'] = $this->Product_model->get_full_catalog_products($query,$orderby);				
				$to = $this->Product_model->get_full_catalog_products($query,$orderby);	
				
				//$e=0;
				foreach($to as $tito){
					$e=$e+1;
				}
				
			}
			
			
			
			
			$pa = intval($e/15);
			$pa2 = $e%15;
			if($pa2>0){
				$pa = $pa+1;
			}else{
				$pa = $pa;
			}
			
			$data['tot_pro'] = $e;
			$data['tot_pag'] = $pa;
			
			
			$this->load->view('products',$data);						
		
	}
	
	function subcategory($subcat='',$pagin=0,$color='',$minimo=0,$maximo=0,$orderby2='')
	{
		use_ssl(FALSE);
		
		$query = '';
		$orderby = '';
		
		if($color=='all' || $color==''){
			$query .= '';
		}else{
			$query .= ' AND p.color="'.$color.'"';
		}
		if($minimo==''){
			$minimo = 0;
			$query .= ' AND pp.price_value>=0';
		}else{
			$query .= ' AND pp.price_value>='.$minimo;
		}
		if($maximo==''){
			$maximo=1000;
			$query .= ' AND pp.price_value<=1000';
		}else{
			$query .= ' AND pp.price_value<='.$maximo;
		}
		if($orderby2=='' || $orderby2=='BM'){
			$orderby = 'p.product_name ASC';
		}else{
			$orderby = 'pp.price_value '.$orderby2;
		}
		
		if($orderby2=='' || $orderby2=='BM'){
			$data['e_orderby'] = 'Best Match';
		}
		if($orderby2=='DESC'){
			$data['e_orderby'] = 'Highest Price';
		}
		if($orderby2=='ASC'){
			$data['e_orderby'] = 'Lowest Price';
		}
		
		$data['ti'] = 'subcategory';
		$data['ti2'] = $subcat;
		$data['pagi'] = $pagin;
		$data['e_color'] = $color;
		$data['e_min'] = $minimo;
		$data['e_max'] = $maximo;
		
		if($orderby2==''){
			$data['sortby_val'] = 'BM';;
		}else{
			$data['sortby_val'] = $orderby2;
		}
		
		//echo $color;
		
		$enl = str_replace('-',' ',$subcat);
		$data['enlace'] = $enl;
		
		//TITLE INFORMATION
		$value_uri=$_SERVER['REQUEST_URI'];
		$pieces = explode("/", $value_uri);
		
		$data['noinfo'] = $pieces[0];
		$data['location'] = ucwords(str_replace("-"," ",$pieces[1]));
		$data['val'] = ucwords(str_replace("-"," ",$pieces[2]));
		//TITLE INFORMATION
		
		
		
		$data['subcategory'] = $subcat;			
		
		$name = str_replace('-',' ',xss_clean($subcat));
		$this->load->model('Subcategory_model');
		$data['cat_name'] = $name;
		$data['secti'] = 'Sub-Category';
		$data['colores'] = $this->Subcategory_model->get_subcategory_byname($name);
		if($sub = $this->Subcategory_model->get_subcategory_byname($name))
		{
			$data['rec'] = $sub;
			$data['path'] = $subcat;	
			
			if($page = $this->Pages_model->get_page($sub->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('subcategory-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			
			$data['title'] = $sub->subcategory_name;
			$data['paths'] = array('Home'=>path(),ucwords($subcat).''=>'');
			//$data['products'] = $this->Product_model->get_catalog_products(100,array('subcategory'=>$subcat));	
			$data['products'] = $this->Product_model->get_subcat_pros($sub->subcategory_id,$query,$orderby);
			$to = $this->Product_model->get_subcat_pros($sub->subcategory_id,$query,$orderby);	
			$e=0;
			foreach($to as $tito){
				$e=$e+1;
			}
			
			
			if($e==0){
				
				$data['no_pros'] = '0';
			
				$query = '';
				$orderby = '';
				/*
				if($color=='all' || $color==''){
					$query .= '';
				}else{
					$query .= ' AND p.color="'.$color.'"';
				}
				*/
				$query .= ' AND pp.price_value>=0';
				
				$query .= ' AND pp.price_value<=1000';

				if($orderby2=='' || $orderby2=='BM'){
					$orderby = 'p.product_name ASC';
				}else{
					$orderby = 'pp.price_value '.$orderby2;
				}
				
				if($orderby2=='' || $orderby2=='BM'){
					$data['e_orderby'] = 'Best Match';
				}
				if($orderby2=='DESC'){
					$data['e_orderby'] = 'Highest Price';
				}
				if($orderby2=='ASC'){
					$data['e_orderby'] = 'Lowest Price';
				}
				
				$data['ti'] = 'subcategory';
				$data['ti2'] = $subcat;
				$data['pagi'] = $pagin;
				$data['e_color'] = $color;
				$data['e_min'] = 0;
				$data['e_max'] = 1000;
				
				if($orderby2==''){
					$data['sortby_val'] = 'BM';;
				}else{
					$data['sortby_val'] = $orderby2;
				}
				
				$data['products'] = $this->Product_model->get_subcat_pros($sub->subcategory_id,$query,$orderby);
				$to = $this->Product_model->get_subcat_pros($sub->subcategory_id,$query,$orderby);	
				foreach($to as $tito){
					$e=$e+1;
				}
				
			
			}
			
			
			
			$pa = intval($e/15);
			$pa2 = $e%15;
			if($pa2>0){
				$pa = $pa+1;
			}else{
				$pa = $pa;
			}
			
			$data['tot_pro'] = $e;
			$data['tot_pag'] = $pa;
			
			$this->load->view('products',$data);			
		}
		else
		{
			$this->notfound();
		}
		
	}
	
	function delivery($delivery)
	{
		use_ssl(FALSE);
		
		$name = str_replace('-',' ',xss_clean($delivery));
		$this->load->model('Deliverymethod_model');
		
		if($del = $this->Deliverymethod_model->get_deliverymethod_byname($name))
		{
			$data['rec'] = $del;
			$data['path'] = $delivery;	
			
			if($page = $this->Pages_model->get_page($del->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('delivery-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			
			$data['title'] = $del->delivery_method;
			$data['paths'] = array('Home'=>path(),ucwords($delivery).''=>'');
			$data['products'] = $this->Product_model->get_catalog_products(100,array('delivery'=>$delivery));
			$this->load->view('products',$data);			
		}
		else
		{
			$this->notfound();
		}
		
		/*
		$data['products'] = $this->Product_model->get_catalog_products(100,array('delivery'=>$delivery));
		$this->load->view('products',$data);	*/	
	}
	
	function path_product($path='',$prd='')
	{
		use_ssl(FALSE);
		
		if(empty($prd))
		{
			$prd = $path;
			$this->paths = array('Home'=>path());
			$this->item(substr(xss_clean($prd),0,150));
		}
		else
		{
			$path = str_replace('-',' ',substr(xss_clean($path),0,150));
			
			$this->load->model('Occasion_model');
			
			$pathinfo = '';
			
			$this->load->model('Category_model');
			$this->load->model('Subcategory_model');
			$this->load->model('Color_model');
			$this->load->model('Deliverymethod_model');
			
			if($obj = $this->Occasion_model->get_occasion_byname($path))
			{
				$pathinfo = $obj->occasion_name;
				$this->paths = array('Home'=>path(),ucwords($obj->occasion_name).''=>path('occasion/'.$obj->occasion_name));
				$this->item(substr(xss_clean($prd),0,150),$pathinfo);
			}
			elseif($obj = $this->Color_model->get_color_byname($path))
			{
				$pathinfo = $obj->color_name;
				$this->paths = array('Home'=>path(),ucwords($obj->color_name).''=>path('color/'.$obj->color_name));
				$this->item(substr(xss_clean($prd),0,150),$pathinfo);
			}
			elseif($obj = $this->Category_model->get_category_byname($path))
			{
				$pathinfo = $obj->category_name;
				$this->paths = array('Home'=>path(),ucwords($obj->category_name).''=>path('category/'.$obj->category_name));
				$this->item(substr(xss_clean($prd),0,150),$pathinfo);
			}
			elseif($obj = $this->Subcategory_model->get_subcategory_byname($path))
			{
				$pathinfo = $obj->subcategory_name;
				$this->paths = array('Home'=>path(),ucwords($obj->subcategory_name).''=>path('subcategory/'.$obj->subcategory_name));
				$this->item(substr(xss_clean($prd),0,150),$pathinfo);
			}
			elseif($obj = $this->Deliverymethod_model->get_deliverymethod_byname($path))
			{
				$pathinfo = $obj->delivery_method;
				$this->paths = array('Home'=>path(),ucwords($obj->delivery_method).''=>path('delivery/'.$obj->delivery_method));
				$this->item(substr(xss_clean($prd),0,150),$pathinfo);
			}
			else
			{
				$this->notfound();
			}

		}
		
		
	}

	function item($url='',$sub='')
	{
		
		$this->form_validation->set_message('callback_postalcode_check[postalcode]', 'Invalid Postalcode!');
		//$this->form_validation->set_rules("product_id", 'Product','required|numeric|max_length[10]');
		//$this->form_validation->set_rules("price_id", 'Price','required|numeric|max_length[10]');
		$this->form_validation->set_rules("price_id", 'Price','required');
		$this->form_validation->set_rules("category", 'Category','alpha_dash_space|max_length[25]');
		$this->form_validation->set_rules("upcoming", 'Upcoming','alpha_dash|max_length[10]|min_length[10]');
		
		if($_POST)
		{
			if(isset($_POST['option']) && count($_POST['option']))
			{
				foreach($this->input->post('option') as $key=>$val)
				{
					$this->form_validation->set_rules("option[".$key."]", 'Option','numeric|max_length[5]');
					$this->form_validation->set_rules("addon[".$key."]", 'Addon','numeric|max_length[3]');
				}				
			}

		}
		
		if(!isset($_POST['special_delivery']))
			$this->form_validation->set_rules("delivery_date", 'Delivery Date','required|alpha_dash|max_length[10]|min_length[9]');
		else
			$this->form_validation->set_rules("delivery_date", 'Delivery Date','alpha_dash|max_length[10]|min_length[10]');
			
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');

		if ($this->form_validation->run() == TRUE)
		{	
			if(isset($_POST['ship']))
			{
				$this->session->set_userdata('ship_to',$_POST['ship']);
			}	
			
				$pieces = explode("__", $this->input->post('price_id'));
				$precio_id = $pieces[0];
				$precio_nombre = $pieces[1];
			
			if($this->Order_model->add_to_cart($this->input->post(),$precio_id,$precio_nombre))
			{
				$this->session->set_flashdata('message','<div id="messenger">'.lang('1 Item is successfully added to your cart!').'</div>');
				redirect('/shop/cart');
				exit;				
			}
			else {
				$this->session->set_flashdata('message','<div id="messenger">'.lang('Failed to add the Item').'</div>');
				redirect('/shop/cart');
				exit;	
			}
		}
		else
		{
			
			$data['ribbon_textito'] = $this->input->post('ribbon_text');
			
			if(!$product = $this->Product_model->get_urlitem($url))
			{
				$this->notfound();	
			}
			else
			{
				$previousurl = $_SERVER['HTTP_REFERER'];
				$pieces = explode(".ca/", $previousurl);
		
				//echo $pieces[1];
				
				$pi2 = explode("/", $pieces[1]);
				
				
		
				$data['link_back'] = $pieces[1];
				$data['link_back_condi'] = $pi2[0];
				
				$pieces1 = explode("/", $pieces[1]);
				$subti = ucwords(str_replace("-"," ",$pieces1[1]));
				$data['subti'] = ucwords($subti);
				
				
				
				$page = $this->Pages_model->return_page('product');				
				
				$page->canonical = $this->config->item('base_url').$product->url;
				$page->page_title = !empty($product->seo_title) ? $product->seo_title:$page->page_title;
				$page->description = !empty($product->seo_description) ? $product->seo_description:$page->description;
				$page->keywords = !empty($product->seo_keywords) ? $product->seo_keywords:$page->keywords;
				$data['page'] = $page;
				$data['product'] = $product;
				$data['path'] = $sub;
				/*$data['category'] = $sub;*/
				$data['category'] = $this->Product_model->get_category_by_product($product->category_id);
				$this->paths[$product->product_name] = '';
				$data['paths'] = $this->paths;
				
				$data['sameitems'] = $this->Product_model->get_same($data['product']->category_id,3);
				$this->load->Model('Addon_model');
				$data['addons'] = $this->Addon_model->getProductAddons($data['product']->product_id);
				
				$this->load->view('product',$data);					
			}

		}
	}
	
	function __item($pid=0)
	{
		//$this->form_validation->set_rules('postalcode', 'Postal Code','callback_postalcode_check[postalcode]');
		//$this->form_validation->set_message('callback_postalcode_check[postalcode]', 'Invalid Postalcode!');
		$this->form_validation->set_rules("product_id", 'Product','required');
		$this->form_validation->set_rules("price_id", 'Price','required');
		$this->form_validation->set_rules("delivery_date", 'Delivery Date','required');
			
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');

		if ($this->form_validation->run() == TRUE)
		{
			if($this->Order_model->add_to_cart($this->input->post()))
			{
				$this->session->set_flashdata('message','1 Item is successfully added to your cart!');
				redirect('/shop/cart');
				exit;				
			}
			else {
				$this->session->set_flashdata('message','Failed to add the Item');
				redirect('/shop/cart');
				exit;	
			}

		}
		else
		{
			$data['current_page']='product';
			$data['product'] = $this->Product_model->get_item($pid);
			$this->load->Model('Addon_model');
			$data['addons'] = $this->Addon_model->getProductAddons($data['product']->delivery_method_id);
			$this->load->view('product',$data);
		}
	}
	
	function postalcode_check($value)
	{		
		
		if(empty($value))
			return TRUE;
		
		$this->load->model('Postalcode_model');
		
		if($this->Postalcode_model->is_valid($value))
		{
			//$this->form_validation->set_message('postalcode', 'Invalid Postal Code! Please Re-Enter');
			return TRUE;			
		}
		else
		{
			return FALSE;
		}		
	}
	
	function birthmonth_flowers($month='')
	{
		use_ssl(FALSE);
		
		$this->load->model('Monthproduct_model');
		
		if(empty($month))
		{
			$data['months'] = $this->Monthproduct_model->get_months();
			
			$data['page'] = $this->Pages_model->return_page('birthmonth-flowers');
			
			$this->load->view('birthday-months',$data);
			
		}
		else
		{
			$data['path'] = $month;
			$data['products'] = $this->Monthproduct_model->get_monthlyproducts($month);
			$data['page'] = $this->Pages_model->return_page('monthly-products');
			$data['rec'] = $this->Monthproduct_model->get_monthinfo($month);
			
			$this->load->view('monthly-products',$data);
			
		}	
		
	}
	
	function vase_collections()
	{
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		$vaseID = isset($_GET['vaseId']) ? $_GET['vaseId']:'';
		$status = isset($_GET['status']) ? $_GET['status']:'';
		
		if($status=='complete')
		{
			$this->session->set_userdata('vaseID',$vaseID);
			$this->session->set_userdata('vaseImage','http://cdn.vaseexpressions.com/renders/'.$vaseID.'z.png');
			$this->session->set_userdata('vaseImageThumb','http://cdn.vaseexpressions.com/renders/'.$vaseID.'c.png');
			$this->session->set_userdata('vaseImageSmall','http://cdn.vaseexpressions.com/renders/'.$vaseID.'t.png');
		}
		else
		{
			$this->session->set_userdata('vaseID','0');
			$this->session->set_userdata('vaseImage','http://cdn.vaseexpressions.com/renders/'.$vaseID.'z.png');
			$this->session->set_userdata('vaseImageThumb','http://cdn.vaseexpressions.com/renders/'.$vaseID.'c.png');
			$this->session->set_userdata('vaseImageSmall','http://cdn.vaseexpressions.com/renders/'.$vaseID.'t.png');
		}
		
		use_ssl(FALSE);
		
		$category = 'custom-vase';
		
		$name = str_replace('-',' ',xss_clean($category));
		$this->load->model('Category_model');
		
		if($cat = $this->Category_model->get_category_byname($name))
		{
			$data['rec'] = $cat;
			$data['path'] = $category;	
			
			if($page = $this->Pages_model->get_page($cat->page_id))
			{
				$data['page'] = $page;
			}
			else
			{
				$page = $this->Pages_model->return_page('category-products');
				$page->page_title = str_replace('%s',ucwords($name),$page->page_title);
				$page->page_title_fr = str_replace('%s',ucwords(lang($name)),$page->page_title_fr);
				$page->h1 = str_replace('%s',ucwords($name),$page->h1);
				$page->h1_fr = str_replace('%s',ucwords(lang($name)),$page->h1_fr);
				$data['page'] = $page;
			}
			
			$data['title'] = $cat->category_name;
			$data['paths'] = array('Home'=>path(),ucwords($category).''=>'');
			$data['products'] = $this->Product_model->get_catalog_products(100,array('category'=>$category));		
			$this->load->view('products',$data);			
		}
		else
		{
			$this->notfound();
		}
	}
	
	function vasebuilder()
	{
		$this->load->view('vasebuilder.php');	
		
	}
	
	
	function notfound()
	{
		$data['page'] = $this->Pages_model->return_page('404');
		set_status_header('404');
		$this->load->view('404.php',$data);
	}

	function homes()
	{
		$this->load->view('funeral-homes');
	}

	function fhomes()
	{
		$like = isset($_REQUEST['query']) ? $_REQUEST['query']:'';

		if(empty($like)) { return false; }

		$query = $this->db->from('funeral_homes')->like('name',$like)->get();

		$homes = array('query'=>'Unit');

		file_put_contents('uploads/request.text',$this->db->last_query());

		foreach($query->result() as $row)
		{
			$homes['suggestions'][] = array("value"=>$row->name.', '.$row->city,
							"name"=>$row->name,
							"address"=>$row->address,
							"city"=>$row->city,
							"postalcode"=>$row->postalcode,
							"phone"=>$row->phone,
							"province"=>$row->province,
							"data"=>$row->id);
		}

		die(json_encode($homes));
	}
	
	function calendar($month,$year)
	{
		echo new_calendar($month,$year);
	}

	function calendars()
	{
		echo new_calendar(date('m',time()),date('Y',time()));
		echo new_calendar(date('m',strtotime('+1 month')),date('Y',strtotime('+1 month')));
	}
	
	function update_prices()
	{
	
		$products = $this->Product_model->get_website_products();
		$a=0;
		foreach($products as $pr){
			$product_id = $pr->product_id;
			$product_picture = $pr->product_picture;
			$a=$a+1;
			$prices = $this->Product_model->get_website_product_prices($product_id);
			$y=0;
			foreach($prices as $price){
				$price_picture = $price->option_picture;
				$y=$y+1;
				if($y==1){
					$price_name = 'Standard';
					$price_val = 'X';
					if($price_picture!=''){
						$inf = $this->Product_model->update_price_new($price->price_id,$product_id,$price_name,$price_val,$price_picture);
					}else{
						$inf = $this->Product_model->update_price_new($price->price_id,$product_id,$price_name,$price_val,$product_picture);
					}
				}
				if($y==2){
					$price_name = 'Deluxe';
					$price_val = 'XX';
					/*if($price_picture!=''){*/
						$inf = $this->Product_model->update_price_new($price->price_id,$product_id,$price_name,$price_val,$price_picture);
					/*
					}else{
						$inf = $this->Product_model->delete_price_new($price->price_id,$product_id);
					}
					*/
				}
				if($y==3){
					$price_name = 'Premium';
					$price_val = 'XXX';
					/*if($price_picture!=''){*/
						$inf = $this->Product_model->update_price_new($price->price_id,$product_id,$price_name,$price_val,$price_picture);
					/*
					}else{
						$inf = $this->Product_model->delete_price_new($price->price_id,$product_id);
					}
					*/
				}
				if($y>3){
					$inf2 = $this->Product_model->delete_price_new($price->price_id,$product_id);
				}
				
			}
		}
		//echo $a;
		
	}
	
	function update_main_pic()
	{
		$products = $this->Product_model->get_website_products();
		$a=0;
		foreach($products as $pr){
			$product_id = $pr->product_id;
			$prices = $this->Product_model->get_website_product_prices($product_id);
			$i=0;
			foreach($prices as $price){
				$i=$i+1;
				if($i<=2){
					$price_picture = $price->option_picture;
				}
			}
			$inf = $this->Product_model->update_main_product_picture($product_id,$price_picture);
				
		}
		
	
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */