<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Banners<a href="<?=current_url();?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="70%">Banner</th>
        <th width="70%">Link</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($banners as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->banner_id;?></td>
        <td class="left"><?php echo getimg('banners/'.$dval->banner_file,'200x100');?></td>
        <td class="left"><strong><?php echo $dval->banner_name;?></strong><br/><?php echo $dval->link_to;?></td>
        <td style="white-space:nowrap;"><a href="<?php echo current_url();?>/edit/<?php echo $dval->banner_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><br/><a href="<?php echo current_url();?>/Delete/<?=$dval->banner_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>