<?php

class Menu extends CI_Controller {
	
	function Menu()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('menu'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Menu_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['menus']=$this->Menu_model->get_menus();
		$this->load->view('admin/menus',$data);
	}
	
	function items($menu_id='',$action='',$menuitem_id='')
	{
		switch(strtolower($action))
		{
			case 'create':
			{
				$this->createItem($menu_id,$menuitem_id);
				break;
			}
			case 'edit':
			{
				$this->editItem($menu_id,$menuitem_id);
				break;
			}
			case 'delete':
			{
				$this->deleteItem($menu_id,$menuitem_id);
				break;
			}
			default :
			{
				$data['items']=$this->Menu_model->get_menuitems($menu_id);
				$data['menu']=$this->Menu_model->get_menu($menu_id);
				$this->load->view('admin/menuitems',$data);
				break;
			}
		}
		
	}
	
	function deleteItem($menu_id,$menuitem_id)
	{
		$this->Menu_model->deleteItem($menuitem_id);
		redirect('/siteadmin/menu/items/'.$menu_id);		
	}
	
	function editItem($menu_id,$menuitem_id)
	{
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('menuitem', 'Menu Item Name','required');
		$this->form_validation->set_rules('sort_order', 'Sort Order','numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Update';
			$data['menu'] = $this->Menu_model->get_menu($menu_id);
			$data['item'] = $this->Menu_model->get_menuitem($menuitem_id);
			$data['menuitems'] = $this->Menu_model->get_menuitems($menu_id);
			$data['menutypes'] = $this->Menu_model->get_menu_types();
			$this->load->view('admin/menuitem-form',$data);
		}
		else
		{
			$this->Menu_model->updateItem($this->input->post());
			redirect('/siteadmin/menu/items/'.$menu_id);
			exit;
		}		
	}
	
	function createItem($menu_id,$menuitem_id)
	{
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('menuitem', 'Menu Item Name','required');
		$this->form_validation->set_rules('sort_order', 'Sort Order','numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$data['menuitems'] = $this->Menu_model->get_menuitems($menu_id);
			$data['menu'] = $this->Menu_model->get_menu($menu_id);
			$data['menutypes'] = $this->Menu_model->get_menu_types();
			$this->load->view('admin/menuitem-form',$data);
		}
		else
		{
			$this->Menu_model->createItem($this->input->post());
			redirect('/siteadmin/menu/items/'.$menu_id);
			exit;
		}		
	}
	
	function delete($id)
	{
		
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('menu', 'Menu Name','required');
		$this->form_validation->set_rules('holder', 'Place holder','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['menu'] = $this->Menu_model->get_menu($id);
			}
			$data['holders'] = get_menu_holders();
			$data['action'] = 'Update';
			$this->load->view('admin/menu-form',$data);
		}
		else
		{
			$this->Menu_model->update($this->input->post());
			redirect('/siteadmin/menu');
			exit;
		}
	}
	
	function create()
	{
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('menu', 'Menu Name','required');
		$this->form_validation->set_rules('holder', 'Place holder','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{				
			$data['action'] = 'Create';
			$data['holders'] = get_menu_holders();
			$this->load->view('admin/menu-form',$data);
		}
		else
		{
			$this->Menu_model->create($this->input->post());
			redirect('/siteadmin/menu');
			exit;
		}		
	}
		
}
