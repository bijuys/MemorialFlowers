<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Companies <a href="http://www.whatabloom.com/siteadmin/companies/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
       <div id="shadow">   
    <?php if(count($companies)): ?>
    <div id="comp_search">
      <?php echo form_open('/siteadmin/companies/search'); ?>
        Search Companies <input type="text" name="search" id="search" />
        <input type="submit" name="submit" value="Search" />
        
      </form>      
    </div>
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Customers</th>
        <th>Signup Code</th>
        <th>Started</th>
        <th>Discount</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($companies as $row) : ?> 
      <tr>
        <td><?php echo $row->user_id;?></td>
        <td class="left"><?php echo $row->user_business;?></td>
        <td class="left"><?php echo $row->user_firstname.' '.$row->user_lastname;?></td>
        <td class="left"><?php echo $row->user_email;?></td>
        <td><?php //echo $row->customers;?></td>
        <td class="left"><?php echo $row->company_code;?></td>
        <td class="left"><?php echo date('d-M-y',strtotime($row->user_created));?></td>
        <td class="right"><?php echo number_format($row->business_discount,2).'%';?></td>
        <td><?php if($row->user_status==1) : ?>
            <img src="/images/accept.png" />
            <?php else: ?>
            <img src="/images/block.png" />
        <?php endif;?></td>
        <td nowrap="nowrap"><a href="/siteadmin/companies/edit/<?php echo $row->user_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="/siteadmin/companies/Delete/<?=$row->user_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php echo isset($pagination) ? $pagination:''; ?>
    <?php else: ?>
    <p class="notfound">Sorry No <?php echo $this_class; ?> Found.</p>
    <?php endif; ?>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>