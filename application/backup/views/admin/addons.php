<?php include_once("header.php"); ?>

<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Addons <a href="http://www.whatabloom.com/siteadmin/addons/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create New</a>    </h2>
    <?php if(count($addons)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="50%">Addon Name</th>
        <th width="15%">Price</th>
        <th width="5%">Picture</th>
        <th width="20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($addons as $row) : ?> 
      <tr>
        <td><?php echo $row->addon_id;?></td>
        <td class="left"><?php echo $row->addon_name;?></td>
        <td class="left"><?php echo '$'.number_format($row->price,2);?></td>
        <td><img src="<?php echo img_format('productres/'.$row->addon_picture,'macro');?>" /></td>
        <td nowrap="nowrap"><a href="<?php echo current_url();?>/edit/<?php echo $row->addon_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$row->addon_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No <?php echo $this_class; ?> Found.</p>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>