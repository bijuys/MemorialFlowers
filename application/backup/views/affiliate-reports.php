<?php include_once('header.php'); ?>
<?php $totals = array('total'=>0,
                      'quantity'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php $gtotal=0.00; ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include('affiliate_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>My Reports</h2>
                <div class="report_wrapper">
                <h3>Select a Report Type</h3>
                <?php echo form_open('/affiliates/reports',array('id'=>'reports-form'));?>
                    <p>
                        <input type="radio" name="report_type" value="Product" checked="checked" /> Product<br/>
                        <input type="radio" name="report_type" value="Invoice" /> Invoice<br/>
                        <input type="radio" name="report_type" value="Customer" /> Customer<br/>
                        <input type="radio" name="report_type" value="Occasion" /> Occasion<br/>
                        <input type="radio" name="report_type" value="Yearly" /> Yearly<br/>
                        <input type="radio" name="report_type" value="Monthly" /> Monthly<br/>
                        <input type="radio" name="report_type" value="Daily" /> Daily<br/>
                    </p>
                    <p>
                        <label>Start Date</label>
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
                    </p>
                    <p>
                        <label>End Date</label>
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
                        
                    </p>
                    <p><input type="submit" value="Get Report" name="submit" /></p>
                <?php echo form_close(); ?>
                </div>
            </div> <!-- main -->
            <div id="sidebar"></div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       