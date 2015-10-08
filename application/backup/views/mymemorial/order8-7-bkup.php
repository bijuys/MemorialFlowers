<?php

$nextday = date('Y-m-d',time()+(60*60*24*1));
$currentdate = date('Y, m-1, d',time());
$maxdate = date('Y, m-1, d',time()+(60*60*24*20));

$js = <<<ENDF

<script type="text/javascript">
<!--

$(function(){
  
  $("#searchbutton").click(function(event){
    event.preventDefault();
    
    $("#products-wrap").addClass("loading");
  
    $("#productlist").fadeOut("slow");
    $("#productlist").after('<div id="product-load">&nbsp;</div>');
    
    $.get('/mymemorial/orders/catalogSearch',{'keyword':$("#keyword").val()}, function(data) {
        $("#products-wrap").removeClass("loading");
        $("#productlist").html(data);
        $("#productlist").fadeIn("slow");
        $("#product-load").remove();
        init();
    });
  });
  
  $(".catload").click(function(event){
    event.preventDefault();

    var catid = $(this).attr('href');
    
    $("#products-wrap").addClass("loading");
  
    $("#productlist").fadeOut("slow");
    $("#productlist").after('<div id="product-load">&nbsp;</div>');
    
    var ie_fix = new Date().getTime();
    
    $.get('/mymemorial/orders/catalogSearch',{'catid':catid,'iefix':ie_fix}, function(data) {
        $("#products-wrap").removeClass("loading");
        $("#productlist").html(data);
        $("#productlist").fadeIn("slow");
        $("#product-load").remove();
        init();
    });
  
  });
  
  $("#searchbutton").trigger('click');
  
  $('form[name="spsearch"]').submit(function(event){
  
    event.preventDefault();
    
    $("#products-wrap").addClass("loading");
    
    var frm = $('form[name="spsearch"]').serialize();
    
    $("#productlist").fadeOut("slow");
    $("#productlist").after('<div id="product-load">&nbsp;</div>');
    
    var ie_fix = new Date().getTime();
    
    $.ajax({
        type: "GET",
        url: "/mymemorial/orders/catalogSearch?"+ie_fix,
        data: frm,
        dataType: 'html',
        success: function(data) {  
          $("#products-wrap").removeClass("loading");
          $("#productlist").html(data);
          $("#productlist").fadeIn("slow");
          $("#product-load").remove();
          init();
        }
    });       
    
    return false;
    
  });
  
  init();
  
  function init()
  {
    $('.selectbox').unbind('click').click(function(event){
      event.preventDefault(event);
      
        $("#mycart").html('');
        $("#cart-details").html('');
        $("#cart-total").html('');
      
        $("#mycart").addClass("loading");
        $("#cart-details").addClass("loading");
        $("#cart-total").addClass("loading");

        var target = $(this);
        var csrf = $("input[name='csrf1800']").val();
        
        $.post('/mymemorial/orders/addcart',{'product_id':$(this).attr('id'),'price_id':$("#price-"+$(this).attr('id')).val(),'csrf1800':csrf}, function(data) {
          
           var ie_fix = new Date().getTime();
          
           $.get('/mymemorial/orders/xmycart',{'keyword':'','iefix':ie_fix},function(data){
                
                $("#mycart").removeClass("loading");
                $("#cart-details").removeClass("loading");
                $("#cart-total").removeClass("loading");
           
                $("#mycart").html(data.sidecart);
                $("#cart-details").html(data.cartview);
                $("#cart-total").html(data.cartotal);
                cart_init();
            },'json');
        });      
    });
    
    $("#mycart").html('');
    $("#cart-details").html('');
    $("#cart-total").html('');
  
    $("#mycart").addClass("loading");
    $("#cart-details").addClass("loading");
    $("#cart-total").addClass("loading");
    
     var ie_fix = new Date().getTime();
    
    $.get('/mymemorial/orders/xmycart',{'keyword':'','iefix':ie_fix},function(data){
      
        $("#mycart").removeClass("loading");
        $("#cart-details").removeClass("loading");
        $("#cart-total").removeClass("loading");
    
        $("#mycart").html(data.sidecart);
        $("#cart-details").html(data.cartview);
        $("#cart-total").html(data.cartotal);
        cart_init();
        
    },'json');    
    
  }
  
  function cart_init()
  {
    $('.remove').bind('click',function(){
    
      $("#mycart").html('');
      $("#cart-details").html('');
      $("#cart-total").html('');
    
      $("#mycart").addClass("loading");
      $("#cart-details").addClass("loading");
      $("#cart-total").addClass("loading");
        
      var rid = $(this).attr('id');
      
      rid = rid.slice(4);
      
       var ie_fix = new Date().getTime();
    
      $.get('/mymemorial/orders/mycartrem',{'id':rid,'iefix':ie_fix},function(data) {
      
                $("#mycart").removeClass("loading");
                $("#cart-details").removeClass("loading");
                $("#cart-total").removeClass("loading");
      
                $("#mycart").html(data.sidecart);
                $("#cart-details").html(data.cartview);
                $("#cart-total").html(data.cartotal);
                cart_init();  
      },'json');
    });
    
    
    $('.rem').bind('click',function(){
        
      var rid = $(this).attr('id');
      
      rid = rid.slice(3);
      
      $("#mycart").html('');
      $("#cart-details").html('');
      $("#cart-total").html('');
    
      $("#mycart").addClass("loading");
      $("#cart-details").addClass("loading");
      $("#cart-total").addClass("loading");
      
       var ie_fix = new Date().getTime();
    
      $.get('/mymemorial/orders/mycartrem',{'id':rid,'iefix':ie_fix},function(data) {
              
                $("#mycart").removeClass("loading");
                $("#cart-details").removeClass("loading");
                $("#cart-total").removeClass("loading");
      
                $("#mycart").html(data.sidecart);
                $("#cart-details").html(data.cartview);
                $("#cart-total").html(data.cartotal);
                cart_init();
                
      },'json');
    });
    
  }
  
  $('.next').click(function(event){
     event.preventDefault();
     
     var nid = $(this).attr("id");
     var form = $("#orderform");
     
      var ie_fix = new Date().getTime();
     
     if(nid=='step-one')
     {
          $.ajax({
              type: "GET",
              url: "/mymemorial/orders/xmycart?"+ie_fix,
              data: form.serialize(),
              dataType: 'json',
              success: function(data) {  
                if(data.items>0)
                {
                  $("#step").val('2');
                  $('#sectionbody-1').css("display","none");
                  $('#sectionbody-2').css("display","block");            
                }
                else
                {
                  alert("Please select a Product first!");
                }
              }
          });        
     }
     else if(nid=='step-two')
     {
          var delvdata = form.serialize();
          
          $("#delivery-wrapper").html("");
          $("#delivery-wrapper").addClass("loading");
          
          $.ajax({
            type: "POST",
            url: "/mymemorial/orders/deliveryaddress",
            data: delvdata,
            dataType: 'json',
            success: function(data) {
                
                  if(data.validation=='ok')
                  {
                  
                          $("#deliverydet").html('');
                          $("#deliverydet").addClass("loading");
                      
                          $('#sectionbody-2').css("display","none");
                          $('#sectionbody-3').css("display","block");
                          
                          $("#delivery-wrapper").removeClass("loading");
                          $("#delivery-wrapper").html(data.html);
                      
                          $.ajax({
                            type: "POST",
                            url: "/mymemorial/orders/itemdelivery",
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(data) {
                            
                                  $("#deliverydet").removeClass("loading");
                                  $("#deliverydet").html(data.html);
                                
                                  var count = data.count;
                                  var i = 0;
                            
                                  while(i<count)
                                  {
                                      i++;
                                      
                                      $("#datepicker"+i).datepicker({minDate: new Date({$currentdate}),
                                        maxDate: new Date({$maxdate}),
                                        altField: "#delivery_date"+i,
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
                                      
                                      var ey = 1;
                                  }
                            }
                      
                      });
                    }
                    else
                    {
                      alert('Please correct your entry!');
                      $("#delivery-wrapper").removeClass("loading");
                      $("#delivery-wrapper").html(data.html);
                    
                    }     
    
                } 
        }); 
     
     }
     else if(nid=='step-three')
     {
     
        var form = $("#orderform");
        
        $.ajax({
            type: "POST",
            url: "/mymemorial/orders/updatedelivery",
            data: form.serialize(),
            dataType: 'html',
            success: function(response) {
              
               $.ajax({
               
                  type: "POST",
                  url: '/mymemorial/orders/cartsummary',
                  data: form.serialize(),
                  dataType: 'json',
                  success: function(data){
                     
                      $("#step").val('4');
                      
                      $("#cart-summary").html(data.cartsummary);
                      $("#drecipientname").html($("#firstname").val()+' '+$("#lastname").val());
                      $("#drecipientaddress").html($("#address").val());
                      $("#drecipientcity").html($("#city").val());
                      $("#drecipientpostalcode").html($("#postalcode").val());
                      $("#drecipientprovince").html($("#province option:selected").text());
                      $("#drecipientcountry").html($("#country_id option:selected").text());          
                 
                      $('#sectionbody-3').css("display","none");
                      $('#sectionbody-4').css("display","block");
                  }
                  
              });
 
            }
        });
        
       
     }
     else if(nid=='step-four')
     {
     
        var form = $("#orderform");
        
        var formvars = form.serialize();
        
        $("#payment").addClass('loading');
     
     
        $.ajax({
            type: "POST",
            url: '/mymemorial/orders/checkcard',
            data: formvars,
            dataType: 'json',
            success: function(data) {
            
                if(data.validation=='success')
                {
                  $("#orderform").submit();
                }
                else
                {
                  $("#payment").removeClass('loading');
                  $("#payment").html(data.html);
                  alert('Please correct the error before you continue...');
                }
            }
        });    
      }
  });
  
  
  $('.prev').click(function(event){
     event.preventDefault();
     
     var nid = $(this).attr("id");
     
     if(nid=='pstep-four')
     {
        $('#sectionbody-4').css("display","none");
        $('#sectionbody-3').css("display","block");
     }
     else if(nid=='pstep-three')
     {
        $('#sectionbody-3').css("display","none");
        $('#sectionbody-2').css("display","block");
     }
     else if(nid=='pstep-two')
     {
        $('#sectionbody-2').css("display","none");
        $('#sectionbody-1').css("display","block");
     }
     
  });
  

  
  
});
  

//-->
</script>

ENDF;

?>

<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
<script>

$(function(){
  
  <?php
  
  if(isset($_POST) && isset($_POST['step']))
  {
    if($_POST['step']==1)
    {
  ?>
  
  
    $("#sectionbody-1").css("display","block");
      
      
  <?php
  
    }
    
  }
  else {
    
    ?>
    
    
    $("#sectionbody-1").css("display","block");
    
    
    <?php   
    
  }
  
  ?>
  
  
});


$("#datepicker1").datepicker();

</script>
      <div id="content" class="clearfix">
        <div class="row-fluid">
          <div class="span18">
          <h1><?php echo lang('Create Order');?></h1>
          <div class="contents">
            
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('Step 1: Select Products');?></h2></a>
              <div class="sectionbody" id="sectionbody-1">
                <div class="formdiv" id="products">
                <div id="psearch" class="clearfix">
                  <form action="" method="post" name="psearch" class="form-search" >
                    <input type="text" name="keyword" value="" size="35" id="keyword" placeholder="Search a Product" />
                   <button type="submit" class="btn btn-inverse" id="searchbutton"><?php echo lang('GO');?></button>
                </form>
                  <script>
                  <!--
                    $(function () {
                        $("#keyword").inputLabel();
                    });
                  //-->
                  </script>
                </div>
                <ul class="category_menu">
                  <li class="active"><a href="0" class="catload">All Categories</a></li>
                  <?php foreach($categories as $cat) : ?>
                    <li><a href="<?php echo $cat->category_id;?>" class="catload"><?php echo $cat->category_name;?></a></li>                  
                  <?php endforeach; ?>                  
                </ul>
                <div id="products-wrap">
                  <div class="product-items" id="productlist" >
                    
                    <input type="hidden" name="start" value="0" id="start" />
                  </div>
                </div>
                <div id="cart">
                  <h4><?php echo lang('Order Summary');?></h4>
                  <div id="cart-details">
                    
                    
                  </div>
                </div>
<div class="bottom-next">
  <span class="cart-total-display">
<?php echo lang('Total');?>: <span id="cart-total"></span></span><button class="next btn btn-success" id="step-one"><?php echo lang('Next Step');?></button></div>
                </div>
                </div><!-- Section Body-->
            </div><!-- Show products Section -->

            <?php echo form_open(base_url().'mymemorial/orders/submit',array('id'=>'orderform','name'=>'orderform'));?>
            <input type="hidden" value="<?php echo isset($_POST) && isset($_POST['step']) ? $_POST['step']:'1';?>" name="step" id="step" class="step"/>
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('Step 2: Recipient Info');?></h2></a>
              <div class="sectionbody" id="sectionbody-2">
              <div class="formdiv" id="recepients">
                <div id="delivery-wrapper" class="row-fluid">
                  <div class="span12">
                 <div class="formcol1 form-horizontal">
                  
                    <div class="control-group">
                      <label for="locationtype" class="control-label"><?php echo lang('Location Type');?></label>
                      <?php if(isset($session['locationtype']))
                            {
                              $loctype = $session['locationtype'];
                            }
                            else
                            {
                              $loctype = '';                              
                            }                        
                      ?>
                      <div class="controls">
                        <select id="locationtype" name="locationtype">
                          <option value=""><?php echo lang('Select One');?></option>
                          <option value="Funeral Home" <?php if($loctype=='Funeral Home') { echo 'select="select"'; } ?>><?php echo lang('Funeral Home');?></option>
                          <option value="Chapel" <?php if($loctype=='Chapal') { echo 'select="select"'; } ?>><?php echo lang('Chapel');?></option>                          
                        </select>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="firstname" class="control-label"><?php echo lang('Firstname');?></label>
                      <div class="controls">
                        <input type="text" name="firstname" size="30" id="firstname" value="<?php echo $session['firstname']; ?>" class="rounded" />
                      </div>  
                    </div>
                    
                    <div class="control-group">
                      <label for="lastname" class="control-label"><?php echo lang('Lastname');?></label>
                      <div class="controls">
                        <input type="text" name="lastname" id="lastname" size="30"  value="<?php echo $session['lastname']; ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="phone" class="control-label"><?php echo lang('Phone');?></label>
                      <div class="controls">
                        <input type="text" name="phone" id="phone" size="30"  value="<?php echo $session['phone']; ?>" />
                      </div>
                    </div>
                    
                  </div>
                 
                  </div>
                  <div class="span12">
                  <div class="formcol2 form-horizontal">
                    <div class="control-group">
                      <label for="address" class="control-label"><?php echo lang('Address');?></label>
                      <div class="controls">
                        <input type="text" name="address" id="address" size="30"  value="<?php echo $session['address']; ?>" />
                      </div>  
                    </div>
                    <div class="control-group">
                      <label for="postalcode" class="control-label"><?php echo lang('Postalcode');?></label>
                      <div class="controls">
                        <input type="text" name="postalcode" id="postalcode" size="30"  value="<?php echo $session['postalcode']; ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="city" class="control-label"><?php echo lang('City');?></label>
                      <div class="controls">
                        <input type="text" name="city" id="city"  size="30" value="<?php echo $session['city']; ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="province_id" class="control-label"><?php echo lang('Province');?></label>
                      <div class="controls">
                      <select name="province" id="province">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($provinces) && count($provinces)): foreach($provinces as $province) : ?>
                        <option value="<?php echo $province->province_name;?>" <?php
                        
                        if($session['province'])
                        {
                          if($session['province']==$province->province_name)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $province->province_name;?></option>
                        <?php endforeach; endif; ?>
                      </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="country_id" class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                      <select name="country_id" id="country_id">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($countries) && count($countries)): foreach($countries as $country) : ?>
                        <option value="<?php echo $country->country_id;?>" <?php
                        
                        if($session['country_id'])
                        {
                          if($session['country_id']==$country->country_id)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $country->country_name;?></option>
                        <?php endforeach; endif; ?>                      
                      </select>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                  <div class="bottom-next"><button class="prev btn btn-inverse" id="pstep-two"><?php echo lang('Previous');?></button> <button class="next btn btn-success" id="step-two"><?php echo lang('Next Step');?></button></div>
              </div>
              </div><!-- Section Body //-->
            </div><!-- Delivery address Section //-->
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('Step 3: Delivery Details');?></h2></a>
              <div class="sectionbody" id="sectionbody-3">
                <div class="formdiv clearfix" id="deliverydet">
                  
                
                </div>
                <div class="bottom-next"><button class="prev btn btn-inverse" id="pstep-three"><?php echo lang('Previous');?></button> <button class="next btn btn-success" id="step-three"><?php echo lang('Next Step');?></button></div>
              </div><!-- Section Body //-->
            </div><!-- End of Section :: Delivery details //-->
            <div class="section">
              <a href="#" class="headlink"><h2><?php echo lang('Step 4: Review Order');?></h2></a>
              <div class="sectionbody" id="sectionbody-4">
                <div class="formdiv" id="summary">
                    <div id="summary-wrapper" class="clearfix">
                      <div id="products-summary" class="sbox">
                        <h4><?php echo lang('Cart Summary');?></h4>
                        <div id="cart-summary">
                          
                          
                        </div>                    
                      </div>
                      <div class="row-fluid">
                        <div id="delivery-summary" class="span10">
                          <h4><?php echo lang('Delivery Summary');?></h4>
                          <div class="summary_delivery">
                            <h5><?php echo lang('Recepient Information');?></h5>
                              <p><span id="drecipientname"><?php lang('First Name');?></span></p>
                              <p><span id="drecipientaddress"><?php lang('Address');?></span></p>
                              <p><span id="drecipientcity"><?php lang('City');?></span> <span id="drecipientpostalcode"><?php lang('Postalcode');?></span></p>
                              <p><span id="drecipientprovince"></span>, <span id="drecipientcountry"></span></p>                          
                          </div>
                        </div>            
                        <div id="payment" class="form-horizontal span14">
                          <?php if($affiliate->customer_onaccount!=1) { ?>
                            <h4><?php echo lang('Pay by Credit Card');?></h4>
                            <div class="control-group">
                              <label for="payeename" class="control-label"><?php echo lang('Card Holder Name');?></label>
                              <div class="controls">
                                <input type="text" name="payeename" value="" id="payeename" size="25" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cc" class="control-label"><?php echo lang('Credit Card Number');?></label>
                              <div class="controls">
                                <input type="text" name="cc" value="" id="cc" size="25" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cexpiry" class="control-label"><?php echo lang('Expiry Date');?></label>
                              <div class="controls">
                                <select name="cmonth" id="cexpiry" class="input-small">
                                <?php for($i=1;$i<=12;$i++) : ?>
                                  <option value="<?php echo sprintf('%02d',$i); ?>"><?php echo sprintf('%02d',$i);?></option>
                                <?php endfor; ?>                            
                                </select>
                              
                                <select name="cyear" id="cyear" class="input-small">
                                  <?php $cyear = date('Y',time()); ?>
                                  <?php for($i=$cyear;$i<=$cyear+20;$i++) : ?>
                                  <option value="<?php echo substr($i,2,2);?>"><?php echo substr($i,2,2);?></option>
                                  <?php endfor; ?>                            
                                </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cvv" class="control-label"><?php echo lang('CVV');?></label>
                              <div class="controls">
                                <input type="text" name="cvv" value="" id="cvv" size="3" class="input-small" />
                              </div>
                            </div>
                          <?php } else { ?>
                          
                            <h4 style="text-align:right"><?php echo lang('Payment Method: On Account');?></h4>
                          
                          <?php } ?>
                          </div><!-- Payment //-->
                          
                        </div><!-- Row Fluid //-->
                    </div><!-- Summary wrapper//-->
                    <div class="bottom-next"><button class="prev btn btn-inverse"  id="pstep-four"><?php echo lang('Previous');?></button> <button class="next btn btn-success" id="step-four"><?php echo lang('Finish');?></button></div>              
                </div><!-- Formdiv Summary //-->
              </div><!-- Section Body //-->
            </div><!-- End of Section Final //-->
            </form>
          </div>
          </div> <!-- Span18 //-->
          <div class="span6">

            <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Search Products
                  </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                  <div class="accordion-inner">
                    <?php echo form_open('#',array('name'=>'spsearch','id'=>'spsearch')); ?>
                      <p>
                        <label>Product/ID/Keyword</label>
                        <input name="keyword" value="" id="keyword" type="text">
                      </p>
                      <p>
                        <button type="submit" class="btn btn-inverse btn-small">Search Products</button>
                      </p>
                    <?php echo form_close();?>
                  </div>
                </div>
              </div>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    Your Cart                     
                  </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse in">
                  <div class="accordion-inner" id="mycart">
                      
                      
                      
                  </div>
                </div>
              </div>
            </div>
 
          </div><!-- Sidebar //-->
        </div><!-- Row Fluid //-->

      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
