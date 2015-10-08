<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Pages <a href="<?php echo current_url(); ?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="45%">Page Name</th>
	<th width="25%">Unique Handle</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  foreach($pages as $dval) : 
	  ?> 
      <tr>
        <td><?php echo $dval->page_id;?></td>
        <td class="left <?php if($dval->core) echo 'core';?>"><?php echo $dval->page_name;?></td>
	<td class="left <?php if($dval->core) echo 'core';?>"><?php echo $dval->page_handle;?></td>
        <td nowrap="nowrap" class="left"><a href="<?php echo current_url();?>/edit/<?php echo $dval->page_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><?php if(!$dval->core) { ?><a href="<?php echo current_url();?>/Delete/<?php echo $dval->page_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a><?php } ?></td>
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