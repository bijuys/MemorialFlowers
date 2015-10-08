<?php

   
    function get_menu_entries($menu)
    {
        
        $ci=& get_instance();
        $ci->load->database(); 
        
        $ci->db->from('menuitems');
        $ci->db->join('menus','menuitems.menu_id=menus.menu_id');
        $ci->db->where('menus.holder',$menu);
        $ci->db->order_by("menuitems.sort_order","asc");
        $query = $ci->db->get();
        

        return $query->result();
        
    }    
   


?>