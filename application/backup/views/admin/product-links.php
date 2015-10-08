<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Product Links</h2>

   <div id="shadow">
    <?php echo form_open('',array('name'=>'translate')); ?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
	<th width="10%">Product Code</th>
        <th width="45%">Product Name</th>
        <th width="45%">Url String</th>
        
      </tr>
      </thead>
      <tbody>
      <?php 
	  foreach($products as $product) : 
      ?> 
      <tr>
        <td class="left"><?php echo $product->product_code;?></td>
        <td class="left"><?php echo $product->product_name;?></td>
        <td class="left"><input type="text" name="url[<?php echo $product->product_id;?>]" value="<?php echo $product->url;?>" size="50" />
	<input type="hidden" name="name[<?php echo $product->product_id;?>]" value="<?php echo $product->product_name;?>" />
	</td>
      </tr>
      <?php 
	  endforeach;
      ?>
      <tr>
	<td align="right" colspan="3"><input type="submit" name="action" value="Update" /></td>
      </tr>
      </tbody>
    </table>
  </form>
    </div>
    
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>