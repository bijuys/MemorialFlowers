<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Menu Items for <?php echo $menu->menu; ?> <a href="<?=current_url();?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a> </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="30%">Item Label</th>
	<th width="10%">Order</th>
        <th width="20%">Menu Link</th>
	<th width="10%">Width</th>
	<th width="30%">Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  $tempid = 0;
	  foreach($items as $dkey=>$dval) : 
	  ?> 
      <tr>
        <td class="left"><?php echo $dval->menuitem;?></td>
	<td><?php echo $dval->sort_order; ?></td>
        <td class="left"><?php echo $dval->menulink;?></td>
	<td class="left"><?php echo $dval->parent_id > 0 ? '----------':$dval->width ;?></td>
        <td class="left"><a href="<?php echo current_url();?>/edit/<?php echo $dval->menuitem_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a>
	<a href="<?php echo current_url();?>/Delete/<?=$dval->menuitem_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php 
	  //$tempid = $dval->parent_category_id;
	  endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>/menu" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>