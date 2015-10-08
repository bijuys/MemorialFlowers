<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Select Main Categories</h2>
    <div id="shadow">
    <?=form_open(current_url());?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">Select</th>
        <th width="55%">Category Name</th>
        <th width="10%">Products</th>
        <th width="5%">Status</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  	$tempid = 0;
	  foreach($categories as $dkey=>$dval) : 
	  ?> 
      <tr>
        <td><input type="checkbox" name="categories[<?php echo $dval->category_id;?>]" id="maincategories" value="1" <?php echo $dval->main==1 ? 'checked="checked"':''; ?>></td>
        <td align="left">
		<?php echo $dval->category_name;?></td>
        <td align="center"><?php echo $dval->products; ?></td>
        <td align="center"><?php if($dval->category_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
      </tr>
      <?php 
	  //$tempid = $dval->parent_category_id;
	  endforeach; ?>
      </tbody>
    </table>
    <input name="button" type="submit" class="sbutton" id="button" value="Update" />
    <?=form_close();?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>