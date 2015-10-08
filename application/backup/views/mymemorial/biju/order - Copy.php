<?php $page='Create Order'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
<script type="text/javascript">
<!--

  $(function(){
    
    $(".formdiv").css("display","none");
    if($("#step").val()=='1')
    {
      $("#products").css("display","block");
    }
    
    $("#searchbutton").click(function(event){
      event.preventDefault();
      $("#productlist").fadeOut("slow");
      $("#productlist").after('<div id="product-load">&nbsp;</div>');
      $.get("<?php echo base_url().'orders/catalogSearch';?>",{'keyword':$("#keyword").val()}, function(data) {
          $("#productlist").html(data);
          $("#productlist").fadeIn("slow");
          $("#product-load").remove();
          init();
      });
    });
    
    $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
      if(data)
      {
        $("#cart-details").html(data.cartview);
        $(".cart-total").html(data.carttotal);
        $("#cart-summary").html(data.cartsummary);
        init();
      }
    },'json');
    
    init();

    //$("#datepicker").datepicker("setDate",<?php echo date('Y, m-1, d',time()+(60*60*24*1));?>);
    
    $("#searchbutton").trigger('click');
    
  });
  
  function init(){
    
    $("#sidebar").height( $("#content").height());
    
    $(".dmethod").unbind('click').click(function(){
      
        $(".dmethod").each(function(){
            if($(this).attr("checked")=="checked")
            {
              var charge = $("#charge-"+$(this).val()).val();
              $("#showshipping").html('$'+charge);
              $("#sendingfee").html('$'+charge);
            }
        });
      
      
    });
    
    $('.next').unbind('click').click(function(event){
      event.preventDefault();
      var id = $(this).attr("id");
      if(id=='step-one')
      {
        $.post("<?php echo base_url().'orders/cart';?>",{},function(data){
            if(data.cart>0)
            {
              $("#step").val('2');
              $('html, body').animate({
                      scrollTop: $("#products").offset().top
                       }, 2000);
              $('#products').slideUp();
              $("#recepients").slideDown();              
            }
            else
            {
              alert('Please select a Product first!');
            }

        },"json");        
      }
      else if(id=='step-two')
      {

        $.post("<?php echo base_url().'orders/deliveryaddress';?>",{'occassion_id':$("#occassion_id").val(),
                                                          'firstname':$("#firstname").val(),
                                                          'lastname':$("#lastname").val(),
                                                          'phone':$("#phone").val(),
                                                          'businessname':$("#businessname").val(),
                                                          'address':$("#address").val(),
                                                          'postalcode':$("#postalcode").val(),
                                                          'city':$("#city").val(),
                                                          'province_id':$("#province_id").val(),
                                                          'country_id':$("#country_id").val()},function(data){
            
            if(data.validation=='ok')
            {
              
              $.post("<?php echo base_url().'orders/itemdelivery';?>",{},function(data){
                $("#deliverydet").html(data.html);
              
                var count = data.count;
                var i = 0;
                
                
                $("#itemtabs").tabs();
                
                $(".datepicker" ).datepicker({onSelect:function(dateText, inst){
                   $("#showdate").html(dateText);      
                   },minDate: new Date(<?php echo date('Y, m-1, d',time());?>),
                   maxDate: new Date(<?php echo date('Y, m-1, d',time()+(60*60*24*20));?>),
                   altField: "#delivery_date",
                   altFormat: "yy-mm-dd",
                   dateFormat: "mm-dd-yy",
                  beforeShowDay: function (date) {
                                    if (date.getDay() == 0 || date.getDay() == 1 || date.getDay() == 6) {
                                        return [false, ''];
                                    } else {
                                        return [true, ''];
                                    }
                                 }
                 });
                 
                 var queryDate = '<?php echo date('Y-m-d',time()+(60*60*24*1));?>';
                 
                 var parsedDate = $.datepicker.parseDate('yy-mm-dd', queryDate);
                 
                 $('.datepicker').datepicker('setDate', parsedDate);
                
              },"json");
              

              
              
              $("#delivery_options").html(data.delivery_options);
              $("#showshipping").html('$'+data.shipping);
              $("#showcountry").html($("#country_id option:selected").html());
              
              var day1 = $(".datepicker").datepicker('getDate').getDate();                 
              var month1 = $(".datepicker").datepicker('getDate').getMonth() + 1;             
              var year1 = $(".datepicker").datepicker('getDate').getFullYear();
              var fullDate = month1 + "-" + day1 + "-" + year1;
              var altDate = year1 + "-" + month1 + "-" + day1;
              
              $("#showdate").html(fullDate);
              $("#delivery_date").val(altDate);
              
              $("#step").val('3');
               $('html, body').animate({
                       scrollTop: $("#recepients").offset().top
                        }, 2000);
               $('#recepients').slideUp();
               $("#deliverydet").slideDown();               
               
            }
            else
            {
                $('#delivery-wrapper').html(data.form);
            }

        },"json");         
      }
      else if(id=='step-three')
      {
        $.post("<?php echo base_url().'orders/cart';?>",{},function(data){
            $("#step").val('4');
            
            $("#drecipientname").html($("#firstname").val()+' '+$("#lastname").val());
            $("#drecipientaddress").html($("#address").val());
            $("#drecipientcity").html($("#city").val());
            $("#drecipientpostalcode").html($("#postalcode").val());
            $("#drecipientprovince").html($("#province_id option:selected").text());
            $("#drecipientcountry").html($("#country_id option:selected").text());
            $("#ddeliverydate").html($("#showdate").html());
            $("#dsendingfee").html($("#showshipping").html());
               
            $('html, body').animate({
                    scrollTop: $("#deliverydet").offset().top
                     }, 2000);
            $('#deliverydet').slideUp();
            $("#summary").slideDown();
        },"json");         
      }
      else if(id=='step-four')
      {
        $("#orderform").submit();     
      }
      else
      {
        alert('Invalid use!');
      }

    });
    
    $('.prev').unbind('click').click(function(event){
      event.preventDefault(event);
      if($("#step").val()=='4')
      {
            $('html, body').animate({
                    scrollTop: $("#deliverydet").offset().top
                     }, 2000);
            $("#summary").slideUp();
            $('#deliverydet').slideDown();
            $("#step").val('3');
      }
      else if($("#step").val()=='3')
      {
            $('html, body').animate({
                    scrollTop: $("#recepients").offset().top
                     }, 2000);
            $('#deliverydet').slideUp();
            $("#recepients").slideDown();
            $("#step").val('2');
      }
      else if($("#step").val()=='2')
      {
            $('html, body').animate({
                    scrollTop: $("#products").offset().top
                     }, 2000);
            $('#recepients').slideUp();
            $("#products").slideDown();
            $("#step").val('1');        
      }
      else if($("#step").val()=='1')
      {
        
      }
    });
    
    $('.selectbox').unbind('click').click(function(event){
      event.preventDefault(event);
        var target = $(this);
        $.post("<?php echo base_url().'orders/additem';?>",{'id':$(this).attr('id'),'price_id':$("#price-"+$(this).attr('id')+" option:selected").val()}, function(data) {
            $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
              if(data)
              {
                $("#cart-details").html(data.cartview);
                $(".cart-total").html(data.carttotal);
                $("#cart-summary").html(data.cartsummary);
                $("#side-cart").replaceWith(data.sidecart);
              }
            },"json");
        });      
    });
    
    $("#keyword").keyup(function(){
      var val = $(this).val();
      if(val.length>3)
      {
        $.get("<?php echo base_url().'orders/catalogSearch';?>",{'keyword':val}, function(data) {
          $("#productlist").html(data);

        });        
      }
    });
    
    $("#keyword").blur(function(){
      init();
    });    
    
    $('.remove').click(function(event){
      event.preventDefault();
      var prod = $(this).attr("id");
      $.post("<?php echo base_url().'orders/remitem';?>",{'id':prod}, function(data) {
          if(data=='success')
          {
            $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
              if(data)
              {
                $("#cart-details").html(data.cartview);
                $(".cart-total").html(data.carttotal);
                $("#cart-summary").html(data.cartsummary);
                $("#side-cart").replaceWith(data.sidecart);
                init();
              }
            },'json');
          }
      });
    });
    
  }

//-->
</script>
</head>
<body>
<?php include_once("header.php"); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
          <h1><?php echo lang('create_order');?></h1>
          <div class="contents">
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('step1_select_products');?></h2></a>
              <div class="sectionbody">
                <div class="formdiv" id="products">
                <div id="psearch" class="clearfix">
                  Memorial Products List. Looking for specific item? Search by typing the keyword!
                  <form action="" method="post" name="psearch" >
                  <input type="text" name="keyword" value="" size="35" id="keyword" />
                   <input type="submit" name="submit" id="searchbutton" value="GO" class="sbutton" style="margin-left:5px;" />
                </form>
                </div>
                <div id="products-wrap">
                <div class="product-items" id="productlist" ><input type="hidden" name="start" value="0" id="start" /></div>
                </div>
                <div id="cart">
                  <h4><?php echo lang('order_summary');?></h4>
                  <div id="cart-details">
                    
                    
                  </div>
                </div>
<div class="bottom-next"><span class="cart-total"><?php echo lang('total');?>: $0.00</span><a href="#" class="next" id="step-one"><?php echo lang('next_step');?></a></div>
                </div>
                </div><!-- Section Body-->
            </div><!-- Show products Section -->

            <form method="post" action="<?php echo base_url().'orders/submit';?>" name="orderform" id="orderform">
            <input type="hidden" value="1" name="step" id="step" class="step"/>
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('step2_recipient_info');?></h2></a>
              <div class="sectionbody">
              <div class="formdiv" id="recepients">
                <div id="delivery-wrapper">
                 <div class="formcol1">
                    <p>
                      <label for="occassion_id"><?php echo lang('occassion');?></label>
                      <select name="occassion_id" id="occassion_id">
                        <option value="0"><?php echo lang('select');?></option>
                        <?php if(count($occassions)): foreach($occassions as $occassion) : ?>
                        <option value="<?php echo $occassion->occassion_id;?>" <?php
                        if($this->session->userdata('del_occassion_id'))
                        {
                          if($this->session->userdata('del_occassion_id')==$occassion->occassion_id) echo 'selected="selected"';
                        } ?> ><?php echo $occassion->occassion;?></option>
                        <?php endforeach; endif; ?>
                      </select>
                    </p>
  
                    <p>
                      <label for="firstname"><?php echo lang('first_name');?></label>
                      <input type="text" name="firstname" size="30" id="firstname" value="<?php if($this->session->userdata('del_firstname')) echo $this->session->userdata('del_firstname');?>" class="rounded" />
                    </p>
                    <p>
                      <label for="lastname"><?php echo lang('last_name');?></label>
                      <input type="text" name="lastname" id="lastname" size="30"  value="<?php if($this->session->userdata('del_lastname')) echo $this->session->userdata('del_lastname');?>" />
                    </p>
                    <p>
                      <label for="phone"><?php echo lang('phone');?></label>
                      <input type="text" name="phone" id="phone" size="30"  value="<?php if($this->session->userdata('del_phone')) echo $this->session->userdata('del_phone');?>" />
                    </p>
                  </div>
                  <div class="formcol2">
                    <p>
                      <label for="businessname"><?php echo lang('business_name');?></label>
                      <input type="text" name="businessname" id="businessname" size="30"  value="<?php if($this->session->userdata('del_businessname')) echo $this->session->userdata('del_businessname');?>" />
                    </p>
                    <p>
                      <label for="address"><?php echo lang('address');?></label>
                      <input type="text" name="address" id="address" size="30"  value="<?php if($this->session->userdata('del_address')) echo $this->session->userdata('del_address');?>" />
                    </p>
                    <p>
                      <label for="postalcode"><?php echo lang('postalcode');?></label>
                      <input type="text" name="postalcode" id="postalcode" size="30"  value="<?php if($this->session->userdata('del_postalcode')) echo $this->session->userdata('del_postalcode');?>" />
                    </p>
                    <p>
                      <label for="city"><?php echo lang('city');?></label>
                      <input type="text" name="city" id="city"  size="30" value="<?php if($this->session->userdata('del_city')) echo $this->session->userdata('del_city');?>" />
                    </p>
                    <p>
                      <label for="province_id"><?php echo lang('province');?></label>
                      <select name="province_id" id="province_id">
                        <option value="0"><?php echo lang('select_one');?></option>
                        <?php if(count($provinces)): foreach($provinces as $province) : ?>
                        <option value="<?php echo $province->province_id;?>" <?php
                        
                        if($this->session->userdata('del_province_id'))
                        {
                          if($this->session->userdata('del_province_id')==$province->province_id)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $province->province;?></option>
                        <?php endforeach; endif; ?>
                      </select>
                    </p>
                    <p>
                      <label for="country_id"><?php echo lang('country');?></label>
                      <select name="country_id" id="country_id">
                        <option value="0"><?php echo lang('select_one');?></option>
                        <?php if(count($countries)): foreach($countries as $country) : ?>
                        <option value="<?php echo $country->country_id;?>" <?php
                        
                        if($this->session->userdata('del_country_id'))
                        {
                          if($this->session->userdata('del_country_id')==$country->country_id)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $country->country;?></option>
                        <?php endforeach; endif; ?>                      
                      </select>
                    </p> 
                  </div>
                </div>
                  <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-two"><?php echo lang('next_step');?></a></div>
              </div>
              </div><!-- Section Body //-->
            </div><!-- Delivery address Section //-->
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('step3_delivery_details');?></h2></a>
              <div class="sectionbody">
                <div class="formdiv clearfix" id="deliverydet">
                  
                    <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-three"><?php echo lang('next_step');?></a></div>
                </div>
              </div><!-- Section Body //-->
            </div><!-- End of Section :: Delivery details //-->
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('step4_review_order');?></h2></a>
              <div class="sectionbody">
                <div class="formdiv" id="summary">
                    <div id="summary-wrapper" class="clearfix">
                      <div id="products-summary">
                        <h4><?php echo lang('cart_summary');?></h4>
                        <div id="cart-summary">
                          
                          
                        </div>                    
                      </div>
                      <div id="delivery-summary">
                        <h4><?php echo lang('delivery_summary');?></h4>
                        <div class="summary_delivery">
                          <h5><?php echo lang('recipient_details');?></h5>
                            <p><span id="drecipientname">First Name Last Name</span></p>
                            <p><span id="drecipientaddress">address Lin1</span></p>
                            <p><span id="drecipientcity">City</span> <span id="drecipientpostalcode">Postalcode</span></p>
                            <p><span id="drecipientprovince"></span>, <span id="drecipientcountry"></span></p>
                          <h5><?php echo lang('delivery_details');?></h5>
                            <p><?php echo lang('delivery_date');?>: <span id="ddeliverydate"></span></p>
                            <p><?php echo lang('sending_fee');?>: <span id="dsendingfee"></span></p>
                          
                        </div>                   
                      </div>
                    </div>
                    <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-four"><?php echo lang('finish');?></a></div>              
                </div>
              </div><!-- Section Body //-->
            </div><!-- End of Section Final //-->
            </form>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
          <h3><?php echo lang('search_products');?></h3>
          <div class="sidebar-item">
            <form action="" name="search" id="sidebar-prodsearch" method="post">
              <p><label><?php echo lang('product');?>/<?php echo lang('id');?>/<?php echo lang('keyword');?></label>
                <input type="text" name="search" value="" id="search" />
              </p>
              <p>
                <input type="submit" name="submit" value="<?php echo lang('search_product');?>" />
              </p>
            </form>
          </div>
          <?php include_once('widget_cart.php');?>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
