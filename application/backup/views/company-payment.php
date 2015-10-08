<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
				<div id="left-sidebar"><?php include_once('company_menu.php');?></div>
            <div id="main" class="clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update Payment Settings</h2>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php if($this->session->flashdata('message')) { echo '<div id="messenger">'.$this->session->flashdata('message').'</div>'; }  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <div class="entry_page clearfix">
                    <div class="wide_form clearfix">
                    <h4>Change your payment method!</h4>
                    <p>
                        <label for="business">Payment Method?<span class="mandatory"></span></label>
                        <input type="radio" name="payment_method" id="pmethod1" value="1" <?php
                        
                        if($_POST)
                        {
                            if(isset($_POST['payment_method']) && $_POST['payment_method']==1)
                                echo 'checked="checked"';
                        }
                        elseif(isset($user) && $user->customer_onaccount==1)
                        {
                            echo 'checked="checked"';
                        }              
                        
                        ?>/> On Account <br/>
	<input type="radio" name="payment_method" id="pmethod2" value="0" <?php
                        
                        if($_POST)
                        {
                            if(isset($_POST['payment_method']) && $_POST['payment_method']==1)
                                echo 'checked="checked"';
                        }
                        elseif(isset($user) && $user->customer_onaccount=='0')
                        {
                            echo 'checked="checked"';
                        }              
                        
                        ?>/> Credit Card <br/>
                    </p>
                    <p>
                        <input type="hidden" name="customer_id" value="<?php echo $_POST ? $p->customer_id:(isset($user) ? $user->user_id:'');?>" />
                        <label>&nbsp;</label>
                        <input type="submit" name="Update" id="update" value="Update" class="submitbt" />
                        <input type="reset" name="Reset" id="reset" value="Reset" class="resetbt" />
                    </p>
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       