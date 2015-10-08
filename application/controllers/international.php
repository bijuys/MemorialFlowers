<?php

class International extends MY_Controller {

	function Welcome()
	{
		parent::MY_Controller();
	}
	
	function index()
	{
		redirect('http://www.1800flowers.com/international');
		exit;
		
		/*
		 
		$this->load->model('Country_model');
            
		$data['main_countries'] = $this->Country_model->getMainCountries();
		$data['asia'] = $this->Country_model->getContinentCountries('AS');
		$data['africa'] = $this->Country_model->getContinentCountries('AF');
		$data['europe'] = $this->Country_model->getContinentCountries('EU');
		$data['northamerica'] = $this->Country_model->getContinentCountries('NA');
		$data['oceania'] = $this->Country_model->getContinentCountries('OC');
		$data['southamerica'] = $this->Country_model->getContinentCountries('SA');
		$data['alphacountries'] = $this->Country_model->alphaCountries();
		
		$this->load->view('international',$data);
		
		*/

	}
	
	function country($country)
	{
	
	}
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */