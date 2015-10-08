<?php include_once("header.php"); ?>

<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Cancel Requests</h2>
    <?php if(count($cancels)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="5%">Code</th>
        <th width="50%">Product Name</th>
        <th width="15%">Category</th>
        <th width="5%">Status</th>
        <th width="20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($products as $row) : ?> 
      <tr>
        <td><?php echo $row->product_id;?></td>
        <td class="left"><?php echo $row->product_code;?></td>
        <td class="left"><?php echo $row->product_name;?></td>
        <td class="left"><?php echo $row->category_name;?></td>
        <td><?php if($row->product_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        <td nowrap="nowrap"><a href="<?php echo current_url();?>/edit/<?php echo $row->product_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$row->product_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No Cancel Requests Found.</p>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>