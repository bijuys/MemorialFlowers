<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Landing Pages SEO Content <a href="http://www.whatabloom.com/siteadmin/productgroups/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>    <div id="shadow">
    <?php if(count($productgroups)): ?>

    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="70%">Product Group</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($productgroups as $row) : 
	  
	  	if($row->publish_home==0){
	  
	  ?> 
      <tr>
        <td><?php echo $row->productgroup_id;?></td>
        <td class="left"><?php echo $row->productgroup_name;?></td>
        <td><a href="http://www.whatabloom.com/siteadmin/productgroups/edit/<?php echo $row->productgroup_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="http://www.whatabloom.com/siteadmin/productgroups/Delete/<?php echo $row->productgroup_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php } endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <p class="notfound">No Landing Pages exists... Please create One</p>
    <?php endif; ?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>