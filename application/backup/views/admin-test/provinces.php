<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Provinces <a href="<?php echo current_url() ?>/create" class="button">Create</a>
    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="40%">Province Name</th>
        <th width="30%">Country</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($provinces as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->province_id ?></td>
        <td class="left"><?php echo $dval->province_name ?></td>
        <td class="left"><?php echo $dval->country_name ?></td>
        <td><a href="<?php echo current_url() ?>/edit/<?php echo $dval->province_id ?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" /> Edit</a> <a href="<?php echo current_url() ?>/Delete/<?php echo $dval->province_id ?>" class="ibutton" onclick="javascript:return confirm('Are you sure to Delete?'); false;"><img src="/images/delete.png" border="0" align="texttop" /> Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>