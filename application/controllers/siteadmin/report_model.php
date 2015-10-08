<?php

class Report_model extends Model {
    
    function Report_model() {
        parent::Model();
    }
    
    function get_Product($vars)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= date(' H:i:s',time());
        
        $this->db->select('products.*,order_items.*,delivery_methods.*,
                          SUM(order_items.product_price) AS total,
                          COUNT(order_items.orderitem_id) AS quantity');
        $this->db->from('products');
        $this->db->join('order_items','products.product_id=order_items.product_id','left');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('products.product_id');
        
        die($this->db->last_query());
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_Customer($vars)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= date(' H:i:s',time());
        
        $affiliate_id = isset($vars['affiliate_id']) ? $vars['affiliate_id']:'0';
        
        $this->db->select('users.*,orders.*,a.user_name AS affiliate,
                          SUM(orders.amount+orders.shipping+orders.tax-orders.coupon-orders.discount) AS total,
                          SUM(orders.coupon+orders.discount) AS less,
                          COUNT(orders.order_id) AS orders');
        $this->db->from('users');
        $this->db->join('orders','users.user_id=orders.user_id','left');
        $this->db->join('users a','users.referer_id=a.user_id','left');
        $this->db->where('users.user_role','customer');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('users.user_id');
        
        if($affiliate_id>0)
            $this->db->where('users.referer_id',$affiliate_id);
        
        $query = $this->db->get();
        
        //die($this->db->last_query());
        
        return $query->result();
    }
    
    
    function get_Company($vars)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= date(' H:i:s',time());
        
        $this->db->select('p.*,o.*,COUNT(u.user_id) AS total_users, COUNT(o.order_id) AS total_orders,
                          SUM(o.amount) AS totals, SUM(o.company_less) AS total_less');        
        $this->db->from('users p');
        $this->db->join('users u','p.user_id=u.parent_id','left');
        $this->db->join('orders o','u.user_id=o.user_id','left');
        $this->db->group_by('p.user_id');
        $this->db->where('o.status_id','2');
        $this->db->where('o.order_date >=',$start);
        $this->db->where('o.order_date <=',$end);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    
    function get_Affiliate($vars)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= date(' H:i:s',time());
        
        $this->db->select('users.*,orders.*,
                          SUM(orders.amount) AS total,
                          SUM(orders.commission) AS affcommission,
                          COUNT(orders.order_id) AS orders');
        $this->db->from('users');
        $this->db->join('orders','users.user_id=orders.affiliate_id','left');
        $this->db->where('users.user_role','affiliate');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('users.user_id');
        
        $query = $this->db->get();
        
        //die($this->db->last_query());
        
        return $query->result();
    }


    
    function get_Sales($vars)
    {
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= date(' H:i:s',time());
        
        $customer_id = isset($vars['customer_id']) ? $vars['customer_id']:'0';
        $affiliate_id = isset($vars['affiliate_id']) ? $vars['affiliate_id']:'0';
        
        $this->db->select('orders.*,users.*,a.user_name AS affiliate,COUNT(order_items.orderitem_id) AS items,billing_details.*');
        $this->db->from('orders');
        $this->db->join('users','orders.user_id=users.user_id','left');
        $this->db->join('users a','orders.affiliate_id=a.user_id','left');
        $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->group_by('orders.order_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');

        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);

        $query = $this->db->get();
        
        return $query->result();       
        
    }
    


    
}

?>