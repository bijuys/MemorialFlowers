<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content" id="main-wrapper">
            <div id="left-sidebar"><?php include('user_menu.php');?></div>
            <div id="content-main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('Order Tracking');?></h2>
                <?php if($this->session->flashdata('message')) { echo '<div id="messenger">'.$this->session->flashdata('message').'</div>'; } ?>
                <?php echo validation_errors() ? '<div id="messenger" class="error">'.lang('Please correct Errors').'</div>':'';  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <div class="entry_page">
                    <div class="wide_form">
                    <fieldset>
                    <div class="form-control">
                        <label for="order_number" class="form-label"><?php echo lang('Enter order number');?></label>
			<div class="form-field">
			    <input type="text" name="order_number" id="order_number" autocomplete="off" value="" size="30" />
			    <?php echo form_error("order_number"); ?>
			</div>
		    </div>
                    <div class="form-control">
			<div class="form-field">
			    <input type="image" name="Update" id="update" src="<?php echo theme_url();?>/images/<?php echo imgLang('trackthis-LN.gif');?>" />
			</div>
                    </fieldset>
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       