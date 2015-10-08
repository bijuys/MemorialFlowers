<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers New Product</title>
<?php include_once('headers.php'); ?>
<script src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url().'js/jquery-ui-1.8.22.custom.min.js';?>"></script>
<script>

      $(document).ready(function(){

            $("#postalcode").unbind('change').change(function(){
              $.post("<?php echo base_url().'admin/orders/getlocinfo';?>",{'postalcode':$("#postalcode").val()},function(data){
                  $("#city").val(data.city);
                  $("#province_id").val(data.province_id);
                  $("#country_id").val(data.country_id);
              },"json");
            });
            
            $("#deliverydate").datepicker({minDate: new Date(<?php echo date('Y, m-1, d',time());?>),
                       maxDate: new Date(<?php echo date('Y, m-1, d',time()+(60*60*24*20));?>),
                       altField: "#delivery_date",
                       altFormat: "yy-mm-dd",
                       dateFormat: "DD, d MM, yy"});
            
            var queryDate = '<?php echo date('Y-m-d',time()+(60*60*24*1));?>';
            
            var parsedDate = $.datepicker.parseDate('yy-mm-dd', queryDate);
            
            $('#deliverydate').datepicker('setDate', parsedDate);
            
            var day1 = $("#deliverydate").datepicker('getDate').getDate();                 
            var month1 = $("#deliverydate").datepicker('getDate').getMonth() + 1;             
            var year1 = $("#deliverydate").datepicker('getDate').getFullYear();
            var fullDate = month1 + "-" + day1 + "-" + year1;
            var altDate = year1 + "-" + month1 + "-" + day1;
          
            $("#delivery_date").val(altDate);
               
      });
      
</script>
<link href="<?php echo base_url();?>css/smoothness/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Create an Order</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader"><?php echo $action; ?> Order</div>
        <form name="entry-form" id="entry-form" action="" method="post">
        <?php // echo validation_errors(); ?>
        <fieldset>
            <legend>Account and Products</legend>
        <p><label for="affiliate_id">Select an Affiliate</label>
            <select name="affiliate_id" id="affiliate_id">
                  <?php foreach($affiliates as  $row) :  ?>
                  <option value="<?php echo $row->affiliate_id;?>"><?php echo $row->firstname . ' '. $row->lastname;?> (<?php echo '#'.$row->affiliate_id;?>)</option>
                  <?php endforeach; ?>
            </select>
        </p>
        <p><label for="product_id">Select Product/Prices</label>
            <select name="price_id[]" id="price_id" multiple="multiple" size="15" style="width:500px; font-size: 90%;" >
                  <?php foreach($products as  $row) :  ?>
                  <option value="<?php echo $row->price_id;?>"><?php echo $row->product; ?> ( <?php echo $row->title.'- $'.number_format($row->price,2);?>)</option>
                  <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="occassion_id">Occassion</label>
            <select name="occassion_id" id="occassion_id">
                  <?php foreach($occassions as $row) : ?>
                        <option value="<?php echo $row->occassion_id;?>"><?php echo $row->occassion;?></option>                  
                  <?php endforeach; ?>
            </select>
        </p>
        </fieldset>

        
        <fieldset>
            <legend>Recipient Info</legend>
      <p><label for="locationtype">Location Type</label>
      <select id="locationtype" name="locationtype">
            <option value="">Select One</option>
            <option value="Funeral Home">Funeral Home</option>
            <option value="Chapel">Chapel</option>                          
      </select></p>
        <p><label for="firstname">Firstname</label>
            <input type="text" name="firstname" size="35"  value="" id="firstname" />
        </p>
        <p><label for="lastname">Lastname</label>
            <input type="text" name="lastname" size="35"  value="" id="lastname" />
        </p>
        <p><label for="address">Address</label>
            <input type="text" name="address" size="35"  value="" id="address" />
        </p>
        <p><label for="postalcode">Postalcode</label>
            <input type="text" name="postalcode" size="35"  value="" id="postalcode" />
        </p>
        <p><label for="city">City</label>
            <input type="text" name="city" size="35"  value="" id="city" />
        </p>
        <p><label for="province_id">Province</label>
            <select name="province_id" id="province_id">
                  <?php foreach($provinces as $row) : ?>
                  <option value="<?php echo $row->province_id;?>"><?php echo $row->province;?></option>                  
                  <?php endforeach; ?>
            </select>
        </p>
        <p><label for="country_id">Country</label>
            <select name="country_id" id="country_id">
                  <?php foreach($countries as $row) : ?>
                  <option value="<?php echo $row->country_id;?>"><?php echo $row->country;?></option>                  
                  <?php endforeach; ?>
            </select>
        </p>
        <p><label for="phone">Phone</label>
            <input type="text" name="phone" size="35"  value="" id="phone" />
        </p>
        </fieldset>
        <fieldset>
           <legend>Delivery Information</legend>
        <p><label for="deliverydate">Delivery Date</label>
            <input type="text" name="deliverydate[]" size="35"  value="" id="deliverydate" />
            <input type="hidden" name="delivery_date[]" value="" id="delivery_date" />
        </p>
      <p><label for="deliverytime">Delivery Time</label>
              <select name="deliverytime[]" id="deliverytime">
                  <?php for($t=6;$t<=23;$t++) :
                          for($m=0;$m<=45;$m=$m+30) :
                              $time = date(mktime($t,$m));?>                            
                              <option value="<?php echo date('h:ia',$time);?>"><?php echo date('h:ia',$time);?></option>
                  <?php   endfor;
                        endfor; ?>
              </select>
      </p>
      <p><label for="businessname">Order PO</label>
            <input type="text" name="businessname[]" id="businessname" />
      </p>
      <p><label for="orderedby">Ordered By</label>
            <input type="text" name="orderedby[]" id="orderedby" />
      </p>
        <p><label for="message">Card Message</label>
            <textarea name="message[]" cols="60" rows="5"></textarea>
        </p>
        </p>
            <p><label for="ribbontext">Ribbon Text</label>
            <textarea name="ribbontext[]" cols="60" rows="5"></textarea>
        </p>
        </p>
            <p><label for="specialnotes">Special Notes</label>
            <textarea name="specialnotes[]" cols="60" rows="5"></textarea>
        </p>
        </fieldset>
        <p><label>&nbsp;</label>
            <input type="submit" name="submit" id="submit" value="<?php echo $action; ?> Order" class="button"/>
        </p>
        </form>      
      </div><!-- Content //-->
</div><!-- Main //-->
    <div id="sidebar">
      <?php include_once('sidebar.order.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
