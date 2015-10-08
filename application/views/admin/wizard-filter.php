<?php $totals = array('total'=>0,
                      'quantity'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Product Sales Report</h2>
    <?php echo form_open(current_url()); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
              <tr>
                   <th colspan="2">Reports</th>
              </tr>
              <?php
                      if(isset($customers) && count($customers)) : 
               ?>
              <tr>
                   <td valign="top">Select a Customer</td>
                   <td>
                      <?php
                      $checked = false;
                      foreach($customers as $customer) :
                                            ?>
                          
                          <input type="radio" name="customer_id" value="<?php echo $customer->user_id;?>" <?php
                      if(!$checked) { echo 'checked="checked"'; $checked= true; } 
                          ?> /> <?php echo $customer->user_firstname.' '.$customer->user_lastname . '('.$customer->user_email.')'; ?> <br/>
                          
                      <?php
                      endforeach;                   
                      ?>                      
                   </td>
              </tr>
              <?php
                      endif;
               ?>
              <tr>
               <?php
                      if(isset($affiliates) && count($affiliates)) :
                 ?>
                <tr>
                   <td valign="top">Select a Customer</td>
                   <td>
 <?php
                      foreach($affiliates as $affiliate) :
                                            ?>
                          
                          <input type="radio" name="affiliate_id" value="<?php echo $affiliate->user_id;?>"/> <?php echo $affiliate->user_firstname.' '.$customer->user_lastname . '('.$customer->user_email.')'; ?> <br/>
                          
                      <?php
                                endforeach;                   
                      ?>                              
                      
                   </td>
              </tr>         
              <?php
                      endif;
               ?>
              <tr>
                      <td>&nbsp;<input type="hidden" name="serialized" value="<?php echo $serialized;?>" />
                      <input type="hidden" name="step" value="2" />
                      </td>
                      <td><input type="submit" name="navigate" value="Next"/></td>
              </tr>
              
      </table>
    </div><!-- Shadow -->
        <?php echo form_close(); ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>