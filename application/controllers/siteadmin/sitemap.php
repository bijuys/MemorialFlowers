<?php

class Sitemap extends CI_Controller{

	function index()
	{
		if($_POST)
		{
			if(isset($_POST['submit']) && $_POST['submit']=='Save Sitemap')
			{
				
				
				file_put_contents('sitemap.xml',$_POST['sitemap']);
				
				redirect('/siteadmin/sitemap');
				
				
			}
			elseif($_POST['submit']=='Generate New Sitemap Now!')
			{
				
				$this->load->model('Product_model');
				$this->load->model('Category_model');
				$this->load->model('Subcategory_model');
				$this->load->model('Occasion_model');
				$this->load->model('Color_model');
				$this->load->model('Deliverymethod_model');
				
				$products = $this->Product_model->get_products_enhanced();
				$categories = $this->Category_model->get_categories();
				$subcategories = $this->Subcategory_model->get_subcategories();
				$occasions = $this->Occasion_model->get_occasions();
				$colors = $this->Color_model->get_colors();
				$deliverymethods = $this->Deliverymethod_model->get_deliverymethods();
				
				$time = date('Y-m-d',time());
				
				$string = '<?xml version="1.0" encoding="UTF-8"?>';
				
				$baseurl = $this->config->item('base_url');

				if(count($categories)) :
					foreach($categories as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/category/'.url_title(trim($row->category_name)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				if(count($subcategories)) :
					foreach($subcategories as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/subcategory/'.url_title(trim($row->subcategory_name)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				if(count($occasions)) :
					foreach($occasions as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/occasion/'.url_title(trim($row->occasion_name)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				if(count($colors)) :
					foreach($colors as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/color/'.url_title(trim($row->color_name)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				if(count($deliverymethods)) :
					foreach($deliverymethods as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/delivery/'.url_title(trim($row->delivery_method)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				if(count($products)) :
					foreach($products as $row) :
						$string .= '	<url>'."\n";
						$string .= '		<loc>'.$baseurl.'/'.url_title(trim($row->category_name)).'/'.url_title(trim($row->product_name)).'</loc>'."\n";
						$string .= '		<lastmod>'.$time.'</lastmod>'."\n";
						$string .= '		<changefreq>daily</changefreq>'."\n";
						$string .= '		<priority>0.5</priority>'."\n";
						$string .= '	</url>'."\n";
					endforeach;
				endif;
				
				
				$data['sitemap'] = $string;
				$this->load->view('admin/sitemap',$data);
				
				
			}
		}
		else
		{
			
			$data['sitemap'] = file_get_contents('sitemap.xml');
			$this->load->view('admin/sitemap',$data);			
		}

		
	}
	
	function generate()
	{

		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Occasion_model');
		$this->load->model('Color_model');
		$this->load->model('Deliverymethod_model');
		
		$data['products'] = $this->Product_model->get_products_enhanced();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$data['deliverymethods'] = $this->Deliverymethod_model->get_deliverymethods();
		
		$this->load->view('admin/sitemap-generate',$data);
	
	}
	
}
