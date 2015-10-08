<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Postalcodes <a href="<?php echo site_url("/siteadmin/postalcodes/create/".$country_id.'/'.$province_id.'/'.$city_id);?>"  class="button">Create</a>
    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th> ID</th>
        <th>Postalcode</th>
        <th>City</th>
        <th>Province</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($postalcodes as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->postalcode_id ?></td>
        <td><strong><?php echo $dval->postalcode ?></strong></td>
        <td><?php echo $dval->city_name ?></td>
        <td><?php echo $dval->province_name ?></td>
        <td><?php echo $dval->country_name ?></td>
        <td><a href="<?php echo current_url() ?>/edit/<?php echo $dval->postalcode_id ?>">Edit</a> | <a href="<?php echo current_url() ?>/Delete/<?php echo $dval->postalcode_id ?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;">Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>