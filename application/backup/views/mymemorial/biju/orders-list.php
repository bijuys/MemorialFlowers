<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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
        <h1><?php echo lang('my_orders');?></h1>
      </div>
      <div id="content" class="clearfix">
        <div id="page">
          <div class="contents">
            <?php if(count($orders)) :?>
            <table class="data">
              <thead>
                <tr>
                  <th><?php echo lang('order_summary');?></th><th><?php echo lang('recipient');?></th>
                  <th><?php echo lang('address');?></th><th><?php echo lang('delivery_date');?></th>
                  <th><?php echo lang('value');?></th><th><?php echo lang('status');?></th>
                </tr>
              </thead>
              <?php foreach($orders as $order) : ?>
              <tbody>
                <tr>
                  <td class="center" width="15%" >
                    </td>
                  <td class="center" width="20%"><?php echo $order->firstname.' '.$order->lastname; ?></td>
                  <td class="center" width="20%"><?php echo $order->address.'<br/>'.$order->city.' '.$order->postalcode.'<br/>'.$order->province.' '.$order->country; ?></td>
                  <td class="center" width="15%"><?php echo date('d M Y',strtotime($order->orderdate)); ?></td>
                  <td class="center" width="10"><?php echo '$'.number_format($order->total,2);?></td>
                  <td class="center" width="20%" style="white-space: nowrap;">
                  <a href="#" class="linkbutton"><?php echo lang('print_order');?></a>
                  </td>
                </tr>
              </tbody>
              <?php endforeach; ?>
            </table>
            <?php endif; ?>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
          <h3 style="-webkit-border-top-right-radius: 5px;-moz-border-radius-topright: 5px;margin-top:0px;border-top-right-radius: 5px;"><?php echo lang('search_orders');?></h3>
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
         <?php inlcude_once('widget_cart.php'); ?>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
