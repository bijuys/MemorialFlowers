<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Occasions <a href="http://www.whatabloom.com/siteadmin/occasions/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="45%">Occasion Name</th>
        <th width="15%">Date</th>
        <th width="10%">Status</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($occasions as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->occasion_id;?></td>
        <td class="left"><?php echo $dval->occasion_name;?></td>
        <td class="left"><?php echo $dval->occasion_day ? date('d-M',strtotime($dval->occasion_day.'-'.$dval->occasion_month.'-2001')):'';?></td>
        <td><?php if($dval->occasion_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        <td><a href="<?php echo current_url();?>/edit/<?php echo $dval->occasion_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$dval->occasion_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>