<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Cities <a href="<?=current_url();?>/create" class="button">Create</a>
    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="40%">City Name</th>
        <th width="15%">Province</th>
        <th width="15%">Country</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($cities as $dkey=>$dval) : ?> 
      <tr>
        <td><?=$dval->city_id;?></td>
        <td class="left"><strong><?=$dval->city_name;?></strong></td>
        <td class="left"><?=$dval->province_name;?></td>
        <td class="left"><?=$dval->country_name;?></td>
        <td><a href="<?=current_url();?>/edit/<?=$dval->city_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" /> Edit</a>  <a href="<?=current_url();?>/Delete/<?=$dval->city_id;?>" class="ibutton" onclick="javascript:return confirm('Are you sure to Delete?'); false;"><img src="/images/delete.png" border="0" align="texttop" /> Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>