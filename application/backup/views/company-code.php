<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
				<div id="left-sidebar"><?php include_once('company_menu.php');?></div>
            <div id="main" class="clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update Discount Settings</h2>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php if($this->session->flashdata('message')) { echo '<div id="messenger">'.$this->session->flashdata('message').'</div>'; }  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <p class="mandatory_notice">Fields marked with <span class="mandatory">*</span> are mandatory.</p>
                <div class="entry_page clearfix">
                    <div class="wide_form clearfix">
                    <h4>Change your discount settings</h4>
                    <p>
                        <label for="business">Customer Signup Code<span class="mandatory">*</span></label>
                        <input type="text" name="company_code" id="company_code" value="<?php echo $_POST ? $p->company_code:(isset($user) ? $user->company_code:'');?>" size="30" />
                        <?php echo form_error("firstname"); ?>
                    </p>
                    <p>
                        <label for="business">Give double Discount?<span class="mandatory"></span></label>
                        <input type="checkbox" name="double_discount" id="double_discount" value="1" <?php
                        
                        if($_POST)
                        {
                            if(isset($_POST['double_discount']) && $_POST['double_discount']==1)
                                echo 'checked="checked"';
                        }
                        elseif(isset($user) && $user->double_discount==1)
                        {
                            echo 'checked="checked"';
                        }              
                        
                        ?>/>
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
       