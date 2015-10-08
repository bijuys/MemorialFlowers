<?php

class Report_model extends CI_Model {
    
    function Report_model() {
        parent::__construct();
    }
    
    function get_Product($vars,$offset=0,$limit=99999,$count=FALSE)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $start .= ' 00:00:00';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';
        
        $this->db->from('products');
        $this->db->join('categories','products.category_id=categories.category_id','left');
        $this->db->join('order_items','products.product_id=order_items.product_id','left');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
            $this->db->select('products.*, categories.*, order_items.*,delivery_methods.*,
                          SUM(order_items.product_price) AS total,
                          COUNT(order_items.orderitem_id) AS quantity, orders.amount, orders.tax');
            $this->db->group_by('products.product_id');

        
        if($count)
        {
            $query = $this->db->get();
            return $query->num_rows();
        }
        else
        {

            $this->db->limit($offset,$limit);
            $query = $this->db->get();
            
            return $query->result();
        }
    }
    
    function get_Customer($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';        
 
        $this->db->from('users');
        $this->db->join('orders','users.user_id=orders.user_id','left');
        $this->db->join('users a','users.referer_id=a.user_id','left');
        $this->db->where('users.user_role','customer');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);


        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);
        
        
        if($count)
        {
            $this->db->group_by('users.user_id');
            $res = $this->db->get();
            return $res->num_rows();
        }
        else
        {
            $this->db->select('users.*,orders.*,a.user_name AS affiliate,
                          SUM(orders.amount+orders.shipping+orders.tax-orders.coupon-orders.discount) AS total,
                          SUM(orders.coupon+orders.discount) AS less,
                          COUNT(orders.order_id) AS orders');
            $this->db->group_by('users.user_id');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();
        
            return $query->result();
        }
    }
    
    
    function get_Company($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';
        
        $this->db->select('p.*,o.*,COUNT(u.user_id) AS total_users, COUNT(o.order_id) AS total_orders,
                          SUM(o.amount) AS totals, SUM(o.company_less) AS total_less');        
        $this->db->from('users p');
        $this->db->join('users u','p.user_id=u.parent_id','left');
        $this->db->join('orders o','u.user_id=o.user_id','left');
        $this->db->group_by('p.user_id');
        $this->db->where('o.status_id','2');
        $this->db->where('o.order_date >=',$start);
        $this->db->where('o.order_date <=',$end);
        $this->db->limit($limit,$offset);
        
        
        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);
        
        if($count)
        {
            $query = $this->db->count_all_results();
            return $query;
        }
        else
        {
            $query = $this->db->get();
            return $query->result();
        }
    }
    
    
    
    function get_Affiliate($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';        

        $this->db->from('users');
        $this->db->join('orders','users.user_id=orders.affiliate_id','left');
        $this->db->where('users.user_role','affiliate');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        
        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);

        
        if($count)
        {
             return $this->db->count_all_results();
        }
        else
        {
            $this->db->select('users.*,orders.*,
                          SUM(orders.amount) AS total,
                          SUM(orders.commission) AS affcommission,
                          COUNT(orders.order_id) AS orders');
            $this->db->group_by('users.user_id');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();
            return $query->result();
        }
    }
    
    
    function get_Yearly($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
        
        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*, YEAR(orders.order_date) AS year, COUNT(orders.order_id) AS orders, SUM(orders.amount) AS amount, SUM(orders.tax) AS tax,
                              SUM(orders.shipping) AS shipping, SUM(orders.company_less) AS company_less, SUM(orders.coupon) AS coupons, SUM(orders.shipping) AS shipping,
                              SUM(orders.commission) AS commission');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->group_by("YEAR(orders.order_date)");
            $this->db->order_by('orders.order_date','DESC');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
                
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    function get_Monthly($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer_id']) ? $vars['customer_id']:'0';
        $affiliate_id = isset($vars['affiliate_id']) ? $vars['affiliate_id']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
        
        if($customer_id>0)
            $this->db->where('orders.user_id',$customer_id);
        if($affiliate_id>0)
            $this->db->where('orders.affiliate_id',$affiliate_id);         
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {


            $this->db->select('orders.*, YEAR(orders.order_date) AS year, COUNT(orders.order_id) AS orders, SUM(orders.amount) AS amount, SUM(orders.tax) AS tax,
                              SUM(orders.shipping) AS shipping, SUM(orders.company_less) AS company_less, SUM(orders.coupon) AS coupons, SUM(orders.shipping) AS shipping,
                              SUM(orders.commission) AS commission');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->group_by("MONTH(orders.order_date)");
            $this->db->order_by('orders.order_date','DESC');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    function get_Daily($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*,users.*,YEAR(orders.order_date) AS yer, MONTH(orders.order_date) AS mon, a.user_name AS affiliate,COUNT(order_items.orderitem_id) AS items,billing_details.*');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->group_by("DAY(orders.order_date)");
            $this->db->order_by('orders.order_date','DESC');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    
    
    function get_Coupon($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('discounts');
        $this->db->join('orders','orders.coupon_code=discounts.discount_name','left');
        $this->db->where('discounts.discount_type','coupon');
     
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {
            $this->db->select('discounts.*, COUNT(orders.order_id) AS orders');
            $this->db->group_by("discounts.discount_id");
            $this->db->order_by('discounts.discount_id','DESC');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();
            
            return $query->result();
            
        }
        

        
    }

    
    function get_Sales($vars,$offset=0,$limit=99999,$count=FALSE)
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
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*,users.*,a.user_name AS affiliate,COUNT(order_items.orderitem_id) AS items,billing_details.*');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->group_by('orders.order_id');
            $this->db->order_by('orders.order_id','DESC');
            $this->db->limit($offset,$limit);
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    
    
    
    
    
    /*****************************************************************************************/
    /*****************************************************************************************/
    /*****************************************************************************************/    
    /********************************** NEW SECTION ******************************************/
    /********************************************************** ******************************/
    /*****************************************************************************************/
    /* ###################################################################################### */
    
    function get_ProductReport($vars,$offset=0,$limit=99999,$count=FALSE)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        $start .= ' 00:00:00';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';
        
        $this->db->from('products');
        $this->db->join('categories','products.category_id=categories.category_id','left');
        $this->db->join('order_items','products.product_id=order_items.product_id','left');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where('orders.status_id','2');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
            $this->db->select('products.*, categories.*, order_items.*,delivery_methods.*,
                          SUM(order_items.product_price) AS total,
                          COUNT(order_items.orderitem_id) AS quantity, orders.amount, orders.tax');
            $this->db->group_by('products.product_id');

        
        if($count)
        {
            $query = $this->db->get();
            return $query->num_rows();
        }
        else
        {

            $query = $this->db->get();
            
            return $query->result();
            
            
        }
    }
    
    function get_DailyReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*,COUNT(orders.order_id) AS orders,
                              YEAR(orders.order_date) AS yer,
                              MONTH(orders.order_date) AS mon,
                              SUM(orders.amount) AS amount,
                              SUM(orders.tax) AS tax,
                              SUM(orders.shipping) AS shipping,
                              SUM(orders.service) AS service,
                              SUM(orders.surcharge) AS surcharge,
                              SUM(orders.coupon) AS coupon,
                              SUM(orders.discount) AS discount');
            $this->db->group_by("DAY(orders.order_date)");
            $this->db->order_by('orders.order_date','DESC');
            $this->db->where('orders.status_id','2');
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    function get_DeliveryReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';
        
        $this->db->select('*,COUNT(order_items.orderitem_id) AS items, SUM(orders.amount) AS amount');
        $this->db->from('order_items');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->join('products','order_items.product_id=products.product_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');
        $this->db->group_by('products.delivery_method_id');
            
            
         
        $query = $this->db->get();

        return $query->result();
        
    }
    
    
    function get_SalesReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->select('*,GROUP_CONCAT(products.product_name) AS products, GROUP_CONCAT(products.product_code SEPARATOR "<br/>") AS skus');        
        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');        
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*,users.*,a.user_name AS affiliate,COUNT(order_items.orderitem_id) AS items,billing_details.*');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->join('products','order_items.product_id=products.product_id','left');
            $this->db->join('occasions','order_items.occasion_id=occasions.occasion_id','left');
            $this->db->group_by('orders.order_id');
            $this->db->order_by('orders.order_id','DESC');
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    function get_RefundReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->select('*,GROUP_CONCAT(products.product_name) AS products, GROUP_CONCAT(products.product_code SEPARATOR "<br/>") AS skus');        
        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'0');        
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->select('orders.*,users.*,a.user_name AS affiliate,COUNT(order_items.orderitem_id) AS items,billing_details.*');
            $this->db->join('users','orders.user_id=users.user_id','left');
            $this->db->join('users a','orders.affiliate_id=a.user_id','left');
            $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
            $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
            $this->db->join('products','order_items.product_id=products.product_id','left');
            $this->db->join('occasions','order_items.occasion_id=occasions.occasion_id','left');
            $this->db->group_by('orders.order_id');
            $this->db->order_by('orders.order_id','DESC');
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    function get_CouponReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('orders');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->where("orders.status_id",'2');
        $this->db->where('orders.coupon_code <>','');
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {

            $this->db->join('discounts','orders.coupon_code=discounts.discount_name AND discounts.discount_type="coupon"','left');
            $this->db->group_by('orders.order_id');
            $this->db->order_by('orders.order_id','DESC');
            
            if($customer_id>0)
                $this->db->where('orders.user_id',$customer_id);
            if($affiliate_id>0)
                $this->db->where('orders.affiliate_id',$affiliate_id);
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    function get_AllusersReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->select('users.*,MAX(orders.order_date) AS lastorderdate');
        $this->db->from('users');
        $this->db->where("users.user_role",'customer');
        $this->db->join('orders','users.user_id=orders.user_id','left');
        $this->db->group_by('users.user_id');
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    

    
    function get_UserOrdersReport($vars,$offset=0,$limit=99999,$count=FALSE)
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
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->select('users.*,MAX(orders.order_date) AS lastorderdate, COUNT(orders.order_id) AS orders');
        $this->db->from('users');
        $this->db->where("users.user_role",'customer');
        $this->db->where("orders.status_id",'2');
        $this->db->join('orders','users.user_id=orders.user_id','left');
        $this->db->group_by('users.user_id');
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    function get_SearchReport($vars,$offset=0,$limit=99999,$count=FALSE)
    {
        
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        $start .= ' 00:00:00';
        
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
        $end .= ' 23:59:59';
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('searches');
        $this->db->join('users','searches.customer_id=users.user_id','left');
        $this->db->where("searches.search_time >=",$start);
        $this->db->where("searches.search_time <=",$end);
            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {
            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    function get_UserEmailReport($vars,$offset=0,$limit=99999,$count=FALSE)
    {
        
        
        $customer_id = isset($vars['customer']) ? $vars['customer']:'0';
        $affiliate_id = isset($vars['affiliate']) ? $vars['affiliate']:'0';

        $this->db->from('users');
        $this->db->where("users.user_role",'customer');            
            
        if($count)
        {
            return $this->db->count_all_results();
        }
        else
        {            
            $query = $this->db->get();

            return $query->result();
            
        }
        

        
    }
    
    
    /*********************** MyMemorial Functions **************************************/
    
    
    function reportProducts($affid,$d1,$d2)
    {
        $this->db->select('products.*, SUM(product_prices.price_value)/COUNT(order_items.orderitem_id) AS price,  SUM(order_items.product_price) AS total, COUNT(order_items.orderitem_id) AS sales');
        $this->db->from('products');
        $this->db->join('order_items','order_items.product_id=products.product_id','left');
        $this->db->join('product_prices','order_items.price_id=product_prices.price_id','left');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->group_by('products.product_id');
        $this->db->where('orders.affiliate_id',$affid);
        $this->db->where('orders.order_date >=',''.$d1.' 00:00:01');
        $this->db->where('orders.order_date <=',''.$d2.' 23:59:59');
        
        $res = $this->db->get();
        
        return $res->result();
        
    }
    
    
    function reportSales($affid,$d1,$d2)
    {
        $this->db->select('orders.*, COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('order_items','order_items.cart_id=orders.cart_id','left');
        $this->db->group_by('orders.order_id');
        $this->db->where('orders.affiliate_id',$affid);
		$this->db->where('orders.status_id',2);
        $this->db->where('orders.order_date >=',''.$d1.' 00:00:01');
        $this->db->where('orders.order_date <=',''.$d2.' 23:59:59');
		
        $res = $this->db->get();
        
        return $res->result();
    }
	
	function ordersreport_dignity($affid,$d1,$d2,$fh)
	{
		
		$query = $this->db->query('SELECT o.*, COUNT(oi.orderitem_id) AS items, SUM(oi.product_price) AS purchase,oi.product_name,dd.location_type_name,dd.location_id FROM orders o
								   LEFT JOIN order_items oi ON o.cart_id=oi.cart_id
								   LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
								   WHERE o.status_id=2 AND o.affiliate_id='.$affid.' AND o.order_date>="'.$d1.' 00:00:01" AND o.order_date<="'.$d2.' 23:59:59"'.$fh.'
								   GROUP BY o.order_id
								   ORDER BY o.order_id ASC');
								   
		return $query->result();
		
	}
	
	function cancelsreport_dignity($affid,$d1,$d2,$fh)
	{
		
		$query = $this->db->query('SELECT o.*, COUNT(oi.orderitem_id) AS items, SUM(oi.product_price) AS purchase,oi.product_name,dd.location_type_name,dd.location_id FROM orders o
								   LEFT JOIN order_items oi ON o.cart_id=oi.cart_id
								   LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
								   WHERE o.status_id=0 AND o.affiliate_id='.$affid.' AND o.order_date>="'.$d1.' 00:00:01" AND o.order_date<="'.$d2.' 23:59:59"'.$fh.'
								   GROUP BY o.order_id
								   ORDER BY o.order_id ASC');
								   
		return $query->result();
		
	}
	
	function reportSales2($affid,$d1,$d2,$d3)
    {
        $this->db->select('orders.*, COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('order_items','order_items.cart_id=orders.cart_id','left');
        $this->db->group_by('orders.order_id');
        $this->db->where('orders.affiliate_id',$affid);
		$this->db->where('orders.status_id',2);
        $this->db->where('orders.order_date >=',''.$d1.' 00:00:01');
        $this->db->where('orders.order_date <=',''.$d2.' 23:59:59');
		$this->db->where('orders.cobrand',''.$d3);
        
        $res = $this->db->get();
        
        return $res->result();
    }
    
	
	
	 function reportOrderBy($affid,$d1,$d2)
    {
		
	 $this->db->select('orders.*, order_items.order_by, COUNT( orders.user_id ) AS user_items, SUM(orders.amount) AS price_sum, SUM(orders.shipping) AS shipping, SUM( orders.tax ) AS tax, SUM( orders.service ) AS service, SUM( orders.surcharge ) AS surcharge, COUNT(orders.order_id) AS totalorder');
$this->db->from('orders');
        $this->db->join('order_items','order_items.cart_id=orders.cart_id','left');
      	$this->db->group_by('order_items.order_by');
		$this->db->where('orders.affiliate_id',$affid);
        $this->db->where('orders.order_date >=',''.$d1.' 00:00:01');
        $this->db->where('orders.order_date <=',''.$d2.' 23:59:59');
		$this->db->order_by('order_items.order_by','DESC');
        $res = $this->db->get();
        
        return $res->result();
        
    }
	
	 function reportMonthly($affid,$d1,$d2)
    {
		$makedate=$d2."-".$d1;
        $this->db->select('orders.*,MONTH(orders.order_date) AS month, YEAR(orders.order_date) AS year, COUNT(orders.order_id) AS orders, GROUP_CONCAT(orders.invoice_id SEPARATOR " ") AS invoices, 
                            SUM(orders.amount) AS amount, SUM(orders.shipping) AS shipping, SUM(orders.tax) AS tax, SUM( orders.service ) AS service, SUM( orders.surcharge ) AS surcharge');
                           // SUM(orders.service+orders.surcharge) AS other');
        $this->db->from('orders');
        $this->db->group_by('MONTH(orders.order_date)');
        $this->db->where('orders.affiliate_id',$affid);
	    $this->db->like('orders.order_date',$makedate,'after');
       
        $res = $this->db->get();    
        
        return $res->result();
    }
	
 function reportYearly($affid,$d1)
    {
		
		
		
        $this->db->select('orders.*,YEAR(orders.order_date) AS year, COUNT(orders.order_id) AS orders, GROUP_CONCAT(orders.invoice_id SEPARATOR " ") AS invoices, 
                            SUM(orders.amount) AS amount, SUM(orders.shipping) AS shipping, SUM(orders.tax) AS tax, SUM( orders.service ) AS service, SUM( orders.surcharge ) AS surcharge');
        $this->db->from('orders');
        $this->db->group_by('YEAR(orders.order_date)');
        $this->db->where('orders.affiliate_id',$affid);
        $this->db->like('orders.order_date',$d1,'after');
       // $this->db->where('orders.order_date <=',$this->end_date($vars));
       // $this->db->like('title', 'match', 'after'); 
        $res = $this->db->get();    
        
        return $res->result();
    }
	
	
	
    function reportDaily($affid,$vars)
    {
        $this->db->select('orders.*,DAY(orders.order_date) AS day, COUNT(orders.order_id) AS orders, GROUP_CONCAT(orders.invoice_id SEPARATOR " ") AS invoices, 
                            SUM(orders.amount) AS amount, SUM(orders.shipping) AS shipping, SUM(orders.tax) AS tax,
                            SUM(orders.service+orders.surcharge) AS other');
        $this->db->from('orders');
        $this->db->group_by('DAY(orders.order_date)');
        $this->db->where('orders.user_id',$affid);
        $this->db->where('orders.order_date >=',$this->start_date($vars));
        $this->db->where('orders.order_date <=',$this->end_date($vars));
        
        $res = $this->db->get();    
        
        return $res->result();
    }
    
   /* function reportMonthly($affid,$vars)
    {
        $this->db->select('orders.*,MONTH(orders.order_date) AS month, YEAR(orders.order_date) AS year, COUNT(orders.order_id) AS orders, GROUP_CONCAT(orders.invoice_id SEPARATOR " ") AS invoices, 
                            SUM(orders.amount) AS amount, SUM(orders.shipping) AS shipping, SUM(orders.tax) AS tax,
                            SUM(orders.service+orders.surcharge) AS other');
        $this->db->from('orders');
        $this->db->group_by('MONTH(orders.order_date)');
        $this->db->where('orders.user_id',$affid);
        $this->db->where('orders.order_date >=',$this->start_date($vars));
        $this->db->where('orders.order_date <=',$this->end_date($vars));
        
        $res = $this->db->get();    
        
        return $res->result();
    }
	
*/
	function getnewspaper()
	{

		$query = $this->db->query('SELECT cobrand FROM orders
								   WHERE affiliate_id=5886400 AND cobrand<>""
								   GROUP BY cobrand
								   ORDER BY cobrand ASC');
		return $query->result();
	}

    
    function reportOccasions($affid,$vars)
    {
        $this->db->select('occasions.*, SUM(order_items.product_price) AS total, COUNT(order_items.orderitem_id) AS sales');
        $this->db->from('occasions');
        $this->db->join('order_items','order_items.occasion_id=occasions.occasion_id','left');
        $this->db->join('product_prices','order_items.price_id=product_prices.price_id','left');
        $this->db->join('orders','order_items.cart_id=orders.cart_id','left');
        $this->db->group_by('occasions.occasion_id');
        $this->db->where('orders.affiliate_id',$affid);
        $this->db->where('orders.order_date >=',$this->start_date($vars));
        $this->db->where('orders.order_date <=',$this->end_date($vars));
        
        $res = $this->db->get();
        
        return $res->result();
    }
    
    function start_date($vars)
    {
        $start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
        $start .= '-';
        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
        $start .= '-';
        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
        
        return $start;
    }
    
    function end_date($vars)
    {
        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
        $end .= '-';
        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
        $end .= '-';
        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());

        return $end;
    }  

	function get_funeral_homes_list()
	{
		
		$query = $this->db->query('SELECT * FROM sci_list
								   ORDER BY sci_id ASC');
								   
		return $query->result();
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/************************************************************************* PDF REPORTS ********************************************************************************/
	function get_daily_orders($year,$month,$day)
	{
		$prev = $year-1;	
		$query = $this->db->query('SELECT calendar.datefield AS order_date, COUNT(orders.order_id) AS total FROM orders 
									RIGHT JOIN calendar ON (DATE(orders.order_date) = calendar.datefield)
									WHERE calendar.datefield>="'.$year.'-01-01" AND calendar.datefield<="'.$year.'-'.$month.'-'.$day.'"
									GROUP BY calendar.datefield
									ORDER BY calendar.datefield ASC');
								   
		return $query->result();
	
	}
	
	/************************************************************************* PDF REPORTS ********************************************************************************/
	
}

?>