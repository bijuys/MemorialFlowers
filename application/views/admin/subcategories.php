<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Sub Categories <a href="http://www.whatabloom.com/siteadmin/subcategories/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="30%">Sub Category Name</th>
        <th width="10%">Products</th>
	<th width="25%">Parent Category</th>
        <th width="5%">Status</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  	$tempid = 0;
	  foreach($subcategories as $dkey=>$dval) : 
	  ?> 
      <tr>
        <td><?php echo $dval->subcategory_id;?></td>
        <td align="left">
		<?php echo $dval->subcategory_name;?></td>
        <td align="center"><?php echo $dval->products; ?></td>
	<td align="left">
		<?php echo $dval->category_name;?></td>
        <td align="center"><?php if($dval->subcategory_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        <td><a href="<?php echo current_url();?>/edit/<?php echo $dval->subcategory_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$dval->subcategory_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php 
	  //$tempid = $dval->parent_category_id;
	  endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>