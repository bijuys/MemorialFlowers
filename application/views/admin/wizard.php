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
              <tr>
                   <td>Enter Start Date</td>
                   <td>
                          <select name="start_month">
                            <?php for($i=1;$i<=12;$i++) { ?>
                                    <option value="<?php echo $i;?>" <?php
                                    
                                    if($_POST)
                                      echo $_POST['start_month']==$i ? 'selected="selected"':'';
                                    else
                                      echo $m==$i ? 'selected="selected"':'';
                                      
                                    ?>><?php echo date('M',strtotime('2010-'.$i.'-01'));?></option>
                            <?php } ?>
                          </select>
                          
                          <select name="start_day">
                          <?php for($i=1;$i<=31;$i++) { ?>
                                    <option value="<?php echo $i;?>" <?php
                                    
                                    if($_POST)
                                      echo $_POST['start_day']==$i ? 'selected="selected"':'';
                                    else
                                      echo $i==1 ? 'selected="selected"':'';
                                      
                                    ?>><?php echo $i;?></option>
                            <?php } ?>        
                          </select>
                          
                          <select name="start_year" <?php echo $y==$i ? 'selected="selected"':'';?>>
                            <?php for($i=2010;$i<=date('Y',time());$i++) { ?>
                                    <option value="<?php echo $i;?>" <?php
                                    
                                    if($_POST)
                                      echo $_POST['start_year']==$i ? 'selected="selected"':'';
                                    else
                                      echo $y==$i ? 'selected="selected"':'';
                                      
                                    ?>><?php echo $i;?></option>
                            <?php } ?>      
                          </select>
                      
                   </td>
              </tr>
              <tr>
                      <td>Enter End Date</td>
                      <td>
                         <select name="end_month">
                            <?php for($i=1;$i<=12;$i++) { ?>
                                    <option value="<?php echo $i;?>" <?php
                                    
                                    if($_POST)
                                      echo $_POST['end_month']==$i ? 'selected="selected"':'';
                                    else
                                      echo $m==$i ? 'selected="selected"':'';
                                      
                                    ?>><?php echo date('M',strtotime('2010-'.$i.'-01'));?></option>
                            <?php } ?>      
                          </select>
                      
                          <select name="end_day">
                            <?php for($i=1;$i<=31;$i++) { ?>
                                    <option value="<?php echo $i;?>" <?php
                                    
                                    if($_POST)
                                      echo $_POST['end_day']==$i ? 'selected="selected"':'';
                                    else
                                      echo $i==$d ? 'selected="selected"':'';
                                      
                                    ?>><?php echo $i;?></option>
                            <?php } ?>        
                          </select>
                      
                          <select name="end_year">
                            <?php for($i=2010;$i<=date('Y',time());$i++) { ?>
                                    <option value="<?php echo $i;?>"  <?php
                                    
                                    if($_POST)
                                      echo $_POST['end_year']==$i ? 'selected="selected"':'';
                                    else
                                      echo $y==$i ? 'selected="selected"':'';
                                      
                                    ?>><?php echo $i;?></option>
                            <?php } ?>           
                          </select>
                                            
                                            
                      </td>
              </tr>
              <tr>
                      <td valign="top">Report Type</td>
                      <td><input type="radio" name="report_type" value="product" checked="checked"> Product<br/>
                      <input type="radio" name="report_type" value="daily"> Daily<br/>
                      <input type="radio" name="report_type" value="sales"> Orders<br/>
                      <input type="radio" name="report_type" value="coupon"> Coupons<br/>
                      <input type="radio" name="report_type" value="customer"> Customer<br/>
                      <input type="radio" name="report_type" value="affiliate"> Affiliate<br/>
                      <input type="radio" name="report_type" value="occasion"> Occasion<br/>
                      <input type="radio" name="report_type" value="yearly"> Yearly<br/>
                      <input type="radio" name="report_type" value="monthly"> Monthly<br/>
                      
                      
                      </td>
              </tr>
              <tr>
                   <td>Filter by Customer</td>
                   <td><input type="text" name="customer" value=""/></td>
              </tr>
              <tr>
                   <td>Filter by Affiliate</td>
                   <td><input type="text" name="affiliate" value=""/></td>
              </tr>
              <tr>
                   <td>&nbsp;<input type="hidden" name="step" value="1" /></td>
                   <td> <input type="submit" name="navigate" value="Go"/></td>
                   <td><input type="hidden" name="page" value="1" /></td>
              </tr>
              
      </table>
    </div><!-- Shadow -->
        <?php echo form_close(); ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>