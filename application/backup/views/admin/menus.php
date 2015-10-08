<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Menus <a href="<?=current_url();?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="50%">Menu Name</th>
        <th width="20%">Menu Items</th>
	<th width="30%">Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  $tempid = 0;
	  foreach($menus as $dkey=>$dval) : 
	  ?> 
      <tr>
        <td class="left"><?php echo $dval->menu;?></td>
        <td><?php echo $dval->items;?></td>
        <td class="left"><a href="<?php echo current_url();?>/edit/<?php echo $dval->menu_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a> <a href="<?php echo current_url();?>/items/<?php echo $dval->menu_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Manage Items</a></td>
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