      <div class="sidebar-item" id="products-manage">
        <h2>Manage Products</h2>
        <ul class="side-menu">
          <li><a href="<?php echo base_url().'admin/products/create';?>">Create Product</a></li>
          <li><a href="<?php echo base_url().'admin/products';?>">Edit/Delete Product</a></li>
        </ul>       
      </div>
      <div class="sidebar-item" id="sidebar-search">
        
        <h2>Search Products</h2>
      <form action="<?php echo base_url();?>admin/products" method="post" id="sidebar-search">
        <p>
        <label for="affiliate_id">Affiliate #ID</label>
          <input type="text" name="affiliate_id" id="affiliate_id" value="<?php echo isset($_POST['affiliate_id']) ? $_POST['affiliate_id']:'';?>" />
        </p>
        <p>
          <label for="sales_min">Sales Min</label>
          <input type="text" name="sales_min" id="sales_min" value="<?php echo isset($_POST['sales_min']) ? $_POST['sales_min']:'';?>" />
        </p>
        <p>
          <label for="sales_max">Sales Max</label>
          <input type="text" name="sales_max" id="sales_max" value="<?php echo isset($_POST['sales_max']) ? $_POST['sales_max']:'';?>" />
        </p>
        <p>
          <label for="joined_after">Joined After</label>
          <input type="text" name="joined_after" id="joined_after" value="<?php echo isset($_POST['joined_after']) ? $_POST['joined_after']:'';?>" />
        </p>
        <p>
          <label for="joined_before">Joined Before</label>
          <input type="text" name="joined_before" id="joined_before" value="<?php echo isset($_POST['joined_before']) ? $_POST['joined_before']:'';?>" />
        </p>
        <p>
          <label for="keyword">Keyword</label>
          <input type="text" name="keyword" id="keyword" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword']:'';?>" />
        </p>
        <p>
          <input type="submit" name="submit" id="button" value="Search" />
        </p>
      </form>
      </div>