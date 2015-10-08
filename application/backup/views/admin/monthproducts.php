<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Birthmonth Products</h2>
    <div id="shadow">
    <?php if(count($monthproducts)): ?>

    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="40%">Month</th>
        <th width="30%">Products</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($monthproducts as $row) : ?> 
      <tr>
        <td class="left"><?php echo $row->name;?></td>
        <td class="center"><?php echo $row->products;?></td>
        <td><a href="<?php echo current_url();?>/update/<?php echo $row->month_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Manage</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>