<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Affiliates <a href="<?php echo current_url(); ?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
       <div id="shadow">   
    <?php if(count($affiliates)): ?>
        <div id="comp_search">
          <?php echo form_open('/siteadmin/affiliates/search'); ?>
    
        Search Affiliates <input type="text" name="search" id="search" />
        <input type="submit" name="submit" value="Search" />
        
      </form>      
    </div>
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
		<th>Password</th>
        <th>Last Login</th>
        <th>Started</th>
        <th>%</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($affiliates as $row) : ?> 
      <tr>
        <td><?php echo $row->user_id;?></td>
        <td class="left"><?php echo $row->user_firstname.' '.$row->user_lastname;?></td>
        <td class="left"><?php echo $row->user_email;?></td>
        <td class="left"><?php echo $row->user_name;?></td>
		<td class="left"><?php echo $row->user_password;?></td>
        <td class="left"><?php echo $row->user_lastlogin;?></td>
        <td class="left"><?php echo date('d-M-y',strtotime($row->user_created));?></td>
        <td><?php echo $row->affiliate_commission.'%'; ?>
        <td><?php if($row->user_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        <td nowrap="nowrap"><a href="<?php echo current_url();?>/edit/<?php echo $row->user_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$row->user_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <p class="notfound">Sorry No <?php echo $this_class; ?> Found.</p>
    <?php endif; ?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>