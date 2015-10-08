<?php
$js=<<<JS

JS;
?>
<?php include_once('header.php'); ?>
            <div class="content">
                 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
                 <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            <div id="main_content" >
                <h2><?php echo lang('Enter Your Billing Information');?></h2>
                <?php 
                    if(validation_errors())
                    {
                        echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                    }
                    ?>
                <?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
                
                <div class="row-fluid">
                    <div class="span6">
                        <h3><?php echo lang('Order Summary');?></h3>
                        <table cellpadding="3" cellspacing="0" class="table table-stripped" border="0" >
                            <tr>
                                <td><?php echo lang('Product Total');?></td>
                                <td class="right"><?php echo getRate($totals['itemtotal']);?></td>
                            </tr>
                            <?php if(($totals['coupon']+$totals['discount'])>0) : ?>
                            <tr>
                                <td><?php echo lang('Discount');?></td>
                                <td class="right">-<?php echo getRate($totals['coupon']+$totals['discount']);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($totals['service']==0 || $totals['shipping']>0) : ?>
                            <tr>
                                <td><?php echo lang('Shipping');?></td>
                                <td class="right"><?php echo getRate($totals['shipping']);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($totals['service']>0) : ?>
                            <tr>
                                <td><?php echo lang('Service fee');?></td>
                                <td class="right"><?php echo getRate($totals['service']);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($totals['surcharge']>0) : ?>
                            <tr>
                                <td><?php echo lang('Same day surcharge');?></td>
                                <td class="right"><?php echo getRate($totals['surcharge']);?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?php echo lang('Tax');?></td>
                                <td class="right"><?php echo getRate($totals['tax']);?></td>
                            </tr>
                            <tr>
                                <td class="gtotal"><strong><?php echo lang('Grand Total');?></strong></td>
                                <td class="right"><strong class="lead"><?php echo getRate($totals['grandtotal']);?></strong></td>
                            </tr>
                        </table>                        
                    </div>
                    
                    
                    <div class="span12 offset1">
                        <h3><?php echo lang('Billing Details');?></h3>
                        
                        <div class="form-warning">
                            <?php echo lang('Fields marked with (*) are mandatory.'); ?>
                        </div>
                        
                        <div class="control-group <?php highlightclass(form_error("firstname")); ?>">
                        <label for="firstname" class="control-label"><?php echo lang('First Name');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:$billing->firstname;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("lastname")); ?>">
                        <label for="lastname" class="control-label"><?php echo lang('Last Name');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:$billing->lastname;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("address1")); ?>">
                        <label for="address1" class="control-label"><?php echo lang('Address Line 1');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:$billing->address1;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("address2")); ?>">
                        <label for="address2" class="control-label"><?php echo lang('Address Line 2');?></label>
                        <div class="controls">
                            <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:$billing->address2;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("postalcode")); ?>">
                        <label for="postalcode" class="control-label"><?php echo lang('Postal Code');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:$billing->postalcode;?>" class="short" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("city")); ?>">
                        <label for="city" class="control-label"><?php echo lang('City');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:$billing->city;?>" size="30" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("province")); ?>">
                        <label for="province" class="control-label"><?php echo lang('Province/State');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <select name="province">
                                <option value="" <?php
                            
                                    if($_POST)
                                    {
                                        if($_POST['province']=='')
                                            echo 'selected="selected"';
                                    }
                                    else
                                    {
                                        if(isset($billing) && $billing->province=='')
                                            echo 'selected="selected"';
                                    }
                            
                            ?>><?php echo lang('Please select');?></option>
                                <?php echo province_options($_POST ? $_POST['province']:(isset($billing) ? $billing->province:'')); ?>
                            </select>
                        </div>
                    </div> 
                    <div class="control-group <?php highlightclass(form_error("country_id")); ?>">
                        <label for="country_id" class="control-label"><?php echo lang('Country');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <select name="country_id" id="country_id" style="width: 200px;">
                                    <option value="" <?php
                        
                                        if($_POST)
                                        {
                                            if($_POST['country_id']=='')
                                                echo 'selected="selected"';
                                        }
                                        else
                                        {
                                            if(isset($billing) && $billing->country_id=='')
                                                echo 'selected="selected"';
                                        }
                                
                                ?>><?php echo lang('Please select');?></option>
                                    <?php echo country_options($_POST ? $_POST['country_id']:(isset($billing) ? $billing->country_id:'')) ?>
                                </select>
                        </div>
                            
                    </div>
                    <div class="control-group <?php highlightclass(form_error("email")); ?>">
                        <label for="email" class="control-label"><?php echo lang('Email');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:$billing->email;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("dayphone")); ?>">
                        <label for="dayphone" class="control-label"><?php echo lang('Day Phone');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:$billing->dayphone;?>" class="big" />
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("evephone")); ?>">
                        <label for="evephone" class="control-label"><?php echo lang('Evening Phone');?></label>
                        <div class="controls">
                            <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:$billing->evephone;?>" class="big" />
                        </div>
                    </div>

                    <?php if(!$this->session->userdata('customer_id')) { ?>
                        <h3>
                            User Account
                        </h3>
                    <div class="control-group">
                        <div class="controls">
                            <label for="create_account" class="checkbox"><input type="checkbox" name="create_account" id="create_account" value="1" <?php echo set_checkbox('create_account','1',TRUE);?> /><?php echo lang('Create Account');?></label>
                        </div>
                    </div>
                    <div id="create_account_form">
                    
                    <div class="control-group <?php highlightclass(form_error("username")); ?>">
                        <label for="username" class="control-label"><?php echo lang('Username');?></label>
                        <div class="controls">
                            <input type="text" name="username" id="username" autocomplete="off" class="medium" value="<?php echo $_POST && isset($_POST['username']) ? $p->username:'';?>" />
                            <?php echo form_error('username'); ?>
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("password")); ?>">
                        <label for="password" class="control-label"><?php echo lang('Password');?></label>
                        <div class="controls">
                            <input type="password" name="password" id="password" autocomplete="off" value="" class="medium" />
                            <?php echo form_error('password'); ?>
                        </div>
                    </div>
                    <div class="control-group <?php highlightclass(form_error("cpassword")); ?>">
                        <label for="cpassword" class="control-label"><?php echo lang('Confirm Password');?></label>
                        <div class="controls">
                            <input type="password" name="cpassword" id="cpassword" value=""  autocomplete="" class="medium" />
                            <?php echo form_error('cpassword'); ?>
                        </div>
                    </div>
                    </div>

                    <?php } ?>
                        
                        
                    </div>
                    
                </div>
                
                <div class="text-center">
                    <button type="button" name="shopmore" id="shopmore" class="btn btn-large" value="<?php echo lang('Shop more');?>" onclick="javascript: window.location='/products';" ><?php echo lang('Shop more');?></button>
                    <button type="submit" name="checkout" id="checkout" value="<?php echo lang('Proceed with Checkout');?>" class="btn btn-large btn-inverse" ><?php echo lang('Proceed with Checkout');?></button>
                </div>
                <?php echo form_close(); ?>              
                

            </div> <!-- main -->

            <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- content -->

<script>
<!--

$(function() {  
    $('#create_account').click(function(){
    
    if($(this).is(":checked"))
    {
        $('#username').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        $('#cpassword').removeAttr('disabled');
        $('#parent_id').removeAttr('disabled');
        $('#company_code').removeAttr('disabled');
    }
    else
    {
        $('#username').attr('disabled','disabled');
        $('#password').attr('disabled','disabled');
        $('#cpassword').attr('disabled','disabled');
        $('#parent_id').attr('disabled','disabled');
        $('#company_code').attr('disabled','disabled');
    }
        
    });
});
//-->
</script>

<?php include_once('footer.php'); ?>
       