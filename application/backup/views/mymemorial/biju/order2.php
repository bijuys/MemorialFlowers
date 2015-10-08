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
    
    $("#datepicker" ).datepicker({onSelect:function(dateText, inst){
      $("#showdate").html(dateText);      
      },minDate: new Date(<?php echo date('Y, m-1, d',time());?>),
      maxDate: new Date(<?php echo date('Y, m-1, d',time()+(60*60*24*20));?>),
      altField: "#delivery_date",
      altFormat: "yy-mm-dd"
    });
    
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
              $("#delivery_options").html(data.delivery_options);
              $("#showshipping").html('$'+data.shipping);
              $("#showcountry").html($("#country_id option:selected").html());
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
    
    $('.selectbox').unbind('click').click(function(){
        var target = $(this);
        $.post("<?php echo base_url().'orders/additem';?>",{'id':$(this).val(),'price_id':$("#price-"+$(this).val()+" option:selected").val()}, function(data) {
            $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
              if(data)
              {
                $("#cart-details").html(data.cartview);
                $(".cart-total").html(data.carttotal);
                $("#cart-summary").html(data.cartsummary);
                init();
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
      <div class="page-title">
        <h1><?php echo lang('products_catalog');?></h1>
      </div>
      <div id="content" class="clearfix">
        <div id="page">
          <div class="contents">
            <a href="#" class="headlink"><h2><?php echo lang('step1_select_products');?></h2></a>
            <div class="formdiv" id="products">
              <div id="psearch">
                <form action="" method="post" name="psearch" >
                  <label><?php echo lang('search_products');?></label>
                <input type="text" name="keyword" value="" size="35" id="keyword" />
                <input type="button" name="submit" id="searchbutton" value="Search"/>
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
            <form method="post" action="<?php echo base_url().'orders/submit';?>" name="orderform" id="orderform">
            <input type="hidden" value="1" name="step" id="step" class="step"/>
            <a href="#" class="headlink"><h2><?php echo lang('step2_recipient_info');?></h2></a>
            <div class="formdiv" id="recepients">
              <div id="delivery-wrapper">
               <div class="formcol1">
                  <p>
                    <label for="occassion_id"><?php echo lang('occassion');?></label>
                    <select name="occassion_id" id="occassion_id">
                      <option value="0"><?php echo lang('select');?></option>
                      <?php if(count($occassions)): foreach($occassions as $occassion) : ?>
                      <option value="<?php echo $occassion->occassion_id;?>"><?php echo $occassion->occassion;?></option>
                      <?php endforeach; endif; ?>
                    </select>
                  </p>

                  <p>
                    <label for="firstname"><?php echo lang('first_name');?></label>
                    <input type="text" name="firstname" size="30" id="firstname" value="<?php if($this->session->userdata('firstname')) echo $this->session->userdata('firstname');?>" />
                  </p>
                  <p>
                    <label for="lastname"><?php echo lang('last_name');?></label>
                    <input type="text" name="lastname" id="lastname" size="30"  value="<?php echo $_POST ? $_POST['lastname']:'';?>" />
                  </p>
                  <p>
                    <label for="phone"><?php echo lang('phone');?></label>
                    <input type="text" name="phone" id="phone" size="30"  value="<?php echo $_POST ? $_POST['phone']:'';?>" />
                  </p>
                </div>
                <div class="formcol2">
                  <p>
                    <label for="businessname"><?php echo lang('business_name');?></label>
                    <input type="text" name="businessname" id="businessname" size="30"  value="<?php echo $_POST ? $_POST['businessname']:'';?>" />
                  </p>
                  <p>
                    <label for="address"><?php echo lang('address');?></label>
                    <input type="text" name="address" id="address" size="30"  value="<?php echo $_POST ? $_POST['address']:'';?>" />
                  </p>
                  <p>
                    <label for="postalcode"><?php echo lang('postalcode');?></label>
                    <input type="text" name="postalcode" id="postalcode" size="30"  value="<?php echo $_POST ? $_POST['postalcode']:'';?>" />
                  </p>
                  <p>
                    <label for="city"><?php echo lang('city');?></label>
                    <input type="text" name="city" id="city"  size="30" value="<?php echo $_POST ? $_POST['city']:'';?>" />
                  </p>
                  <p>
                    <label for="province_id"><?php echo lang('province');?></label>
                    <select name="province_id" id="province_id">
                      <option value="0"><?php echo lang('select_one');?></option>
                      <?php if(count($provinces)): foreach($provinces as $province) : ?>
                      <option value="<?php echo $province->province_id;?>"><?php echo $province->province;?></option>
                      <?php endforeach; endif; ?>
                    </select>
                  </p>
                  <p>
                    <label for="country_id"><?php echo lang('country');?></label>
                    <select name="country_id" id="country_id">
                      <option value="0"><?php echo lang('select_one');?></option>
                      <?php if(count($countries)): foreach($countries as $country) : ?>
                      <option value="<?php echo $country->country_id;?>"><?php echo $country->country;?></option>
                      <?php endforeach; endif; ?>                      
                    </select>
                  </p> 
                </div>
              </div>
                <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-two"><?php echo lang('next_step');?></a></div>
            </div>            
            <a href="#" class="headlink"><h2><?php echo lang('step3_delivery_details');?></h2></a>
            <div class="formdiv clearfix" id="deliverydet">
              <div class="date-pick">
                <h4><?php echo lang('select_delivery_date');?></h4>
                <input type="hidden" name="delivery_date" id="delivery_date" value="" />
                <div id="datepicker"></div>                
              </div>
              <div class="delivery-method">
                <h4><?php echo lang('delivery_method');?></h4>
                <span id="delivery_options"></span>
              </div>
              <div class="delivery-details">
                <h4><?php echo lang('delivery_details');?></h4>
                <p class="clearfix"><label><?php echo lang('delivery_date');?>:</label><span id="showdate"></span></p>
                <p class="clearfix"><label><?php echo lang('delivery_charge');?>:</label><span id="showshipping"></span></p>
                <p class="clearfix"><label><?php echo lang('delivery_country');?>:</label><span id="showcountry"></span></p>
              </div>
              <div id="messages" class="clearfix">
                <div class="col30">
                  <label><?php echo lang('card_message');?></label>
                  <textarea name="card_message"></textarea>
                  
                </div>
                <div class="col30">
                  <label><?php echo lang('delivery_instructions');?></label>
                  <textarea name="delivery_instructions"></textarea>                  
                  
                </div>
                <div class="col30">
                  <label><?php echo lang('note');?></label>
                  <textarea name="note"></textarea>                   
                </div>                
              </div>
                <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-three"><?php echo lang('next_step');?></a></div>
            </div>
            <a href="#" class="headlink"><h2><?php echo lang('step4_review_order');?></h2></a>
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
                        <p>First Name Last Name</p>
                        <p>address Lin1</p>
                        <p>City</p>
                        <p>Postalcode, COUNTRY</p>
                      <h5><?php echo lang('delivery_details');?></h5>
                        <p><?php echo lang('date');?>: 2012-06-30</p>
                        <p><?php echo lang('sending_fee');?>: <span id="sendingfee"></span></p>
                      
                    </div>                   
                  </div>
                </div>
                <div class="bottom-next"><a href="#" class="prev"><?php echo lang('previous');?></a><a href="#" class="next" id="step-four"><?php echo lang('finish');?>!</a></div>              
            </div>
            </form>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
          <h3 style="-webkit-border-top-right-radius: 5px;-moz-border-radius-topright: 5px;margin-top:0px;border-top-right-radius: 5px;"><?php echo lang('search_products');?></h3>
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
          <h3><?php echo lang('your_cart');?></h3>
          <div class="sidebar-item" id="sidebar-cart">

          </div>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
