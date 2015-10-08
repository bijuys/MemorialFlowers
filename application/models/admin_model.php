<?php

class Admin_Model extends CI_Model{
	
	function Admin_Model()
	{
		parent::__construct();
	}

	function login($vars)
	{
		$this->db->from('users');
		$this->db->where('user_name',$vars['uname']);
		$this->db->where('user_password',$vars['pword']);
		$this->db->where('user_role','administrator');
		$query = $this->db->get();
	
		if($query->num_rows()>0)
		{
			$row = $query->row();
			
			$this->db->from('permissions');
			$this->db->join('sections','sections.section_id=permissions.section_id','left');
			$this->db->where('permissions.user_id',$row->user_id);
			$this->db->group_by('permissions.section_id');
			
			$res = $this->db->get();
			
			$sections = $res->result();
			
			$permission = array();
			
			if(count($sections))
			{
				foreach($sections as $section)
				{
					$permission[] = $section->section_code;
				}
			}
			
			$this->session->set_userdata('permissions',implode(',',$permission));
			
			return $row;
			
		}
		else
		{
			return false;
		}
	
	}
	
	function getAdmins()
	{

		$this->db->from('users');
		$this->db->where('users.user_role','administrator');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function getAdmin($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id,
							    'user_role'=>'administrator'));
		
		$admin = $query->row();
		
		$this->db->from('permissions');
		$this->db->join('sections','sections.section_id=permissions.section_id','left');
		$this->db->where('permissions.user_id',$id);
		$this->db->group_by('permissions.section_id');
		
		$query = $this->db->get();
		
		$admin->sections = $query->result();
		
		return $admin;
		
	}
	
	function create($vars)
	{
		$this->db->set('user_name',$vars['user_name']);
		$this->db->set('user_password',$vars['user_password']);
		$this->db->set('user_email',$vars['user_email']);
		$this->db->set('user_firstname',$vars['user_firstname']);
		$this->db->set('user_lastname',$vars['user_lastname']);
		$this->db->set('user_address1',$vars['user_address1']);
		$this->db->set('user_address2',$vars['user_address2']);
		$this->db->set('user_city',$vars['user_city']);
		$this->db->set('user_postalcode',$vars['user_postalcode']);
		$this->db->set('user_province', $vars['user_province']=='' ? $vars['user_province2']:$vars['user_province']);
		$this->db->set('user_country_id',$vars['user_country_id']);
		$this->db->set('user_phone1',$vars['user_phone1']);
		$this->db->set('user_role','administrator');	
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');
		$this->db->insert('users');
		
		$id = $this->db->insert_id();
		
		if(isset($vars['sections']) && count($vars['sections']))
		{
			foreach($vars['sections'] as $key=>$val)
			{
				$this->db->insert('permissions',array('user_id'=>$id,
								      'section_id'=>$key));
			}
		}
		
		return $id;
		
		
	}
	
	function update($vars)
	{
		$this->db->set('user_name',$vars['user_name']);
		$this->db->set('user_password',$vars['user_password']);
		$this->db->set('user_email',$vars['user_email']);
		$this->db->set('user_firstname',$vars['user_firstname']);
		$this->db->set('user_lastname',$vars['user_lastname']);
		$this->db->set('user_address1',$vars['user_address1']);
		$this->db->set('user_address2',$vars['user_address2']);
		$this->db->set('user_city',$vars['user_city']);
		$this->db->set('user_postalcode',$vars['user_postalcode']);
		$this->db->set('user_province', $vars['user_province']=='' ? $vars['user_province2']:$vars['user_province']);
		$this->db->set('user_country_id',$vars['user_country_id']);
		$this->db->set('user_phone1',$vars['user_phone1']);
		$this->db->set('user_role','administrator');	
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');
		$this->db->where('user_id',$vars['user_id']);
		$this->db->where('user_role','administrator');
		$this->db->update('users');
		
		$id = $vars['user_id'];
		
		$this->db->delete('permissions',array('user_id'=>$id));		
		
		
		if(isset($vars['sections']) && count($vars['sections']))
		{
			foreach($vars['sections'] as $key=>$val)
			{
				$this->db->insert('permissions',array('user_id'=>$id,
								      'section_id'=>$key));
			}
		}
		
		return $id;
		
		
	}
	
	function getSections()
	{
		$query = $this->db->get('sections');
		return $query->result();
	}
	
	function delete($id)
	{
		$this->db->delete('permissions',array('user_id'=>$id));
		
		$this->db->delete('users',array('user_id'=>$id,
						'user_role'=>'administrator'));
		
		return $this->db->affected_rows();
		
	
	}
	
	function is_exists($value,$field,$id)
	{
		$this->db->from('users');
		$this->db->where($field,$value);
		$this->db->where('user_id <>',$id);
		$query = $this->db->get();
		if($query->num_rows>0)
			return TRUE;
		else
			return FALSE;
	}
	
}
	
?>
