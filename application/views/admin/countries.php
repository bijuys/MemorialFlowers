<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Countries <a href="http://www.whatabloom.com/siteadmin/countries/create" class="button">Create</a>
    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="55%">Country Name</th>
        <th width="15%">Short Code</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($countries as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->country_id ?></td>
        <td class="left"><?php echo $dval->country_name ?></td>
        <td><?php echo $dval->short_code ?></td>
        <td><a href="<?php echo current_url() ?>/edit/<?php echo $dval->country_id ?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a>  <a href="<?php echo current_url() ?>/Delete/<?php echo $dval->country_id ?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="texttop" /> Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>