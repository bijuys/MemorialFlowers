<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Location Groups <a href="http://www.whatabloom.com/siteadmin/locationgroups/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>    <div id="shadow">
    <?php if(count($groups)): ?>

    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="70%">Group Name</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($groups as $row) : ?> 
      <tr>
        <td><?php echo $row->group_id;?></td>
        <td class="left"><?php echo $row->group_name;?></td>
        <td><a href="<?php echo current_url();?>/edit/<?php echo $row->group_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?php echo $row->group_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <p class="notfound">No groups exists... Please create One</p>
    <?php endif; ?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>