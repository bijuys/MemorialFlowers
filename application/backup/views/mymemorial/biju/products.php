<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
<script type="text/javascript">
<!--

  $(function(){
    
    $("#seemore").click(function(event){
      event.preventDefault();
      $("#productlist").fadeOut("slow");
      $("#productlist").after('<div id="product-load">&nbsp;</div>');
      $.post("<?php echo base_url().'orders/catalog';?>",{'start':$('#start').val(),'direction':'next'}, function(data) {
          $("#productlist").html(data);
          $("#productlist").fadeIn("slow");
          $("#product-load").remove();
          init();
      });
    })
    
    $("#seeold").click(function(event){
      event.preventDefault();
      $("#productlist").fadeOut("slow");
      $("#productlist").after('<div id="product-load">&nbsp;</div>');
      $.post("<?php echo base_url().'orders/catalog';?>",{'start':$('#start').val(),'direction':'prev'}, function(data) {
          $("#productlist").html(data);
          $("#productlist").fadeIn("slow");
          $("#product-load").remove();
          init();
      });
    })
    
    $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
      if(data.cart>0)
      {
        $("#sidebar-cart").html(data.sidecart);
        $("#cart-total").html(data.carttotal); 
      }
    },'json');
    
    $("#seemore").trigger('click');
    init();
    
    
  });
  
  function init(){
    $('.selectbox').click(function(){
      if($(this).is(':checked'))
      {
        var target = $(this);
        $.post("<?php echo base_url().'orders/additem';?>",{'id':$(this).val()}, function(data) {
            target.closest('div').addClass('selected');
            $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
              if(data.cart>0)
              {
                $("#sidebar-cart").html(data.sidecart);
                $("#cart-total").html(data.carttotal); 
              }
            },'json');
        });
      }
      else
      {
        var target = $(this);
        $.post("<?php echo base_url().'orders/remitem';?>",{'id':$(this).val()}, function(data) {
            target.closest('div').removeClass('selected');
            $.post("<?php echo base_url().'orders/cart';?>",{}, function(data) {
              if(data.cart>0)
              {
                $("#sidebar-cart").html(data.sidecart);
                $("#cart-total").html(data.carttotal); 
              }
            },'json');
        });    
      }
    });
  }

//-->
</script>
</head>
<body>
<?php include_once("header.php"); ?>
    <div class="clearfix" id="dash">
      <div class="page-title">
        <h1>Products Catalog</h1>
      </div>
      <div id="content" class="clearfix">
        <div id="page">
          <div class="contents">
            <a href=""><h2>Step 1: Select Products</h2></a>
            <div class="formdiv" id="products">
              <div id="products-wrap">
              <div class="product-items" id="productlist" ><input type="hidden" name="start" value="0" id="start" /></div>
              </div>
              <div class="bottom-nav"><a href="#" id="seeold">See Previous &laquo;</a> | <a href="#" id="seemore">&raquo; See More</a></div>
              <div class="bottom-next"><span id="cart-total">Total: $500.00</span><a href="#" class="next">Next Step</a></div>
            </div>
            <a href=""><h2>Step 2: Recepient Info</h2></a>
            <div class="formdiv" id="recepients">
              <form method="post" name="recepients" id="recepients">
                <div class="formcol1">
                  <p>
                    <label for="occassion_id">Occassion</label>
                    <select name="occassion_id">
                      <option value="0">Select</option>
                      <?php if(count($occassions)): foreach($occassions as $occassion) : ?>
                      <option value="<?php echo $occassion->occassion_id;?>"><?php echo $occassion->occassion;?></option>
                      <?php endforeach; endif; ?>
                    </select>
                  </p>
                  <p>
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" size="30" value="" />
                  </p>
                  <p>
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" size="30"  value="" />
                  </p>
                  <p>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" size="30"  value="" />
                  </p>
                </div>
                <div class="formcol2">
                  <p>
                    <label for="businessname">Business Name</label>
                    <input type="text" name="businessname" size="30"  value="" />
                  </p>
                  <p>
                    <label for="address">Address</label>
                    <input type="text" name="address" size="30"  value="" />
                  </p>
                  <p>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" size="30"  value="" />
                  </p>
                  <p>
                    <label for="city">City</label>
                    <input type="text" name="city"  size="30" value="" />
                  </p>
                  <p>
                    <label for="province_id">Province</label>
                    <select name="province_id">
                      <option value="0">Select One</option>
                      <?php if(count($provinces)): foreach($provinces as $province) : ?>
                      <option value="<?php echo $province->province_id;?>"><?php echo $province->province;?></option>
                      <?php endforeach; endif; ?>
                    </select>
                  </p>
                  <p>
                    <label for="country_id">Country</label>
                    <select name="country_id">
                      <option value="0">Select One</option>
                      <?php if(count($countries)): foreach($countries as $country) : ?>
                      <option value="<?php echo $country->country_id;?>"><?php echo $country->country;?></option>
                      <?php endforeach; endif; ?>                      
                    </select>
                  </p> 
                </div>
              </form>
                <div class="bottom-next"><a href="#" class="next">Next Step</a></div>
            </div>            
            <a href=""><h2>Step 3: Delivery Details</h2></a>
            <a href=""><h2>Step 4: Review Order</h2></a>    
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
          <h3 style="-webkit-border-top-right-radius: 5px;-moz-border-radius-topright: 5px;margin-top:0px;border-top-right-radius: 5px;">Search Products</h3>
          <div class="sidebar-item">
            <form action="" name="search" id="sidebar-prodsearch" method="post">
              <p><label>Product/ID/Keyword</label>
                <input type="text" name="search" value="" id="search" />
              </p>
              <p>
                <input type="submit" name="submit" value="Search Product" />
              </p>
            </form>
          </div>
          <h3>Your Cart</h3>
          <div class="sidebar-item" id="sidebar-cart">

          </div>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
