<div id="sidebar">
      <div class="sidebar-item" id="sidebar-new-affiliates">
            <h2>Recent Affilaites</h2>
            <?php if(count($affiliates)) : ?>
                  <ul class="recent-entry">
            <?php
                        foreach($affiliates as $row) :
            ?>
                  <li><a href="<?php echo base_url().'admin/affiliates/edit/'.$row->affiliate_id;?>"><?php echo $row->firstname.' '.$row->lastname;?></a><br/>
                      <small><?php echo $row->email;?></small>
                  </li>
            <?php
                        endforeach;
            ?>
                  </ul>
                  <p class="more"><em><a href="<?php echo base_url().'admin/affiliates';?>">More Affiliates</a></em></p>
            <?php
                  endif;
            ?>
      </div>
      <div class="sidebar-item" id="sidebar-new-customers">
            <h2>Today's Sales</h2>
            <ul class="recent-entry">
                  <li>
            <a href="<?php echo base_url().'admin/reports/sales';?>">Daily Sales Report</a>
                  </li>
            </ul>
      </div>
      <div class="sidebar-item" id="sidebar-new-products">
            <h2>Recent Products</h2>
            <?php if(count($products)) : ?>
                  <ul class="recent-entry">
            <?php
                        foreach($products as $row) :
            ?>
                  <li><a href="<?php echo base_url().'admin/products/edit/'.$row->product_id;?>"><?php echo $row->product;?></a><br/>
                      <small>(<?php echo $row->product_id;?>)</small>
                  </li>
            <?php
                        endforeach;
            ?>
                  </ul>
                  <p class="more"><em><a href="<?php echo base_url().'admin/products';?>">More Products</a></em></p>
            <?php
                  endif;
            ?>        
      </div>
</div>