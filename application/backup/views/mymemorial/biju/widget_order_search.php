<h3 style="-webkit-border-top-right-radius: 10px;-moz-border-radius-topright: 10px;margin-top:0px;border-top-right-radius:10px;"><?php echo lang('search_orders');?></h3>
<div class="sidebar-item">
  <form action="<?php echo base_url().'orders/active';?>" name="search" id="sidebar-prodsearch" method="post">
    <p><label><?php echo lang('product');?>/<?php echo lang('id');?>/<?php echo lang('keyword');?></label>
      <input type="text" name="search" value="" id="search" />
    </p>
    <p>
      <input type="hidden" name="action" value="search" />
      <input type="submit" name="submit" value="Search Orders" />
    </p>
  </form>
</div>