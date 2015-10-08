<?php
$js=<<<JS
<script language="javascript">
<!--
   $(document).ready(function(){
    $('#create_account').click(function(){
    
    if($(this).attr("checked")==true)
    {
        $('#username').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        $('#cpassword').removeAttr('disabled');
    }
    else
    {
        $('#username').attr('disabled','disabled');
        $('#password').attr('disabled','disabled');
        $('#cpassword').attr('disabled','disabled');
    }
        
    });
   });
//-->
</script>
JS;
?>
<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <?php include_once('leftside.php');?>
            <div id="main_content" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Enter Billing Information</h2>
                <?php $msg = $this->session->flashdata('message');
                    if(!empty($msg)) { ?>
                <div id="messenger"><?php echo $msg; ?></div>                    
                <?php }  ?>
                <form action="/shop/billing" method="post" class="common_form clearfix">
                <div class="entry_page clearfix">
                    <div class="left_column">
                        <p><big><strong>Order Summary</strong></big></p>
                    <table cellpadding="3" cellspacing="0" class="payment_info" border="0" >
                        <tr>
                            <td>Product Total</td>
                            <td class="price"><?php echo '$'.number_format($totals['itemtotal'],2);?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td class="price">-<?php echo '$'.number_format($totals['coupon']+$totals['discount'],2);?></td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td class="price"><?php echo '$'.number_format($totals['shipping'],2);?></td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td class="price"><?php echo '$'.number_format($totals['tax'],2);?></td>
                        </tr>
                        <tr>
                            <td class="gtotal"><strong>Grand Total</strong></td>
                            <td class="gtotal price"><strong><?php echo '$'.number_format($totals['grandtotal'],2);?></strong></td>
                        </tr>
                    </table>
                    </div><!-- bill_amounts -->
                    <div class="entry_form clearfix">
                        <h3>Address details for Invoice<br/>
                        <small><span class="error">*</span> Marked fields are mandatory</small></h3>
                    <p <?php highlight(form_error("firstname")); ?>>
                        <label for="firstname">Firstname<span class="mandatory">*</span></label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:$billing->firstname;?>" class="big" />
                    </p>
                    <p <?php highlight(form_error("lastname")); ?>>
                        <label for="lastname">Lastname<span class="mandatory">*</span></label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:$billing->lastname;?>" class="big" />
                    </p>
                    <p <?php highlight(form_error("address1")); ?>>
                        <label for="address1">Address Line 1<span class="mandatory">*</span></label>
                        <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:$billing->address1;?>" class="big" /> 
                    </p>
                    <p <?php highlight(form_error("address2")); ?>>
                        <label for="address2">Address Line 2</label>
                        <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:$billing->address2;?>" class="big" />
                    </p>
                    <p <?php highlight(form_error("postalcode")); ?>>
                        <label for="postalcode">Postal Code<span class="mandatory">*</span></label>
                        <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:$billing->postalcode;?>" class="short" />
                    </p>
                    <p <?php highlight(form_error("city")); ?>>
                        <label for="city">City<span class="mandatory">*</span></label>
                        <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:$billing->city;?>" size="30" class="big" />
                    </p>
                    <br clear="all" />
                    <p <?php highlight(form_error("province")); ?>>
                        <label for="province">Province<span class="mandatory">*</span></label>
                        <select name="province">
                        <?php foreach($provinces as $province) { ?>
                            <option value="<?php echo $province->province_name;?>" <?php
                            if($_POST)
                            {
                                echo $p->province==$province->province_name ? 'selected="selected"':'';                                
                            }
                            elseif(isset($billing))
                            {
                                echo $billing->province==$province->province_name ? 'selected="selected"':'';
                            }                           
                            
                            
                            ?>><?php echo $province->province_name;?></option>
                            <?php } ?>
                            <option value="Other" <?php
                            if($_POST)
                            {
                                echo $p->province=='Other' ? 'selected="selected"':'';                                
                            }
                            elseif(isset($billing))
                            {
                                echo $billing->province=='Other' ? 'selected="selected"':'';
                            }
                            
                            ?>>Other/International</option>
                        </select>
                    </p>  
                    <p <?php highlight(form_error("country_id")); ?>>
                        <label for="country_id">Country<span class="mandatory">*</span></label>
                        <select name="country_id" id="country_id">
                            <?php foreach($countries as $country) { ?>
                            <option value="<?php echo $country->country_id;?>"><?php echo $country->country_name;?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <br clear="all" />
                    <p <?php highlight(form_error("email")); ?>>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:$billing->email;?>" class="big" />
                    </p>
                    <br clear="all" />
                    <p <?php highlight(form_error("dayphone")); ?>>
                        <label for="dayphone">Day Phone<span class="mandatory">*</span></label>
                        <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:$billing->dayphone;?>" class="big" />
                    </p>
                    <p <?php highlight(form_error("evephone")); ?>>
                        <label for="evephone">Evening Phone</label>
                        <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:$billing->evephone;?>" class="big" />
                    </p>
                    <br clear="all" />
                    <?php if(!$this->session->userdata('customer_id')) { ?>
                        <h3>
                             <label for="create_account"><input type="checkbox" name="create_account" id="create_account" value="1" <?php echo set_checkbox('create_account','1',TRUE);?> />Create Account</label>
                        </h3>
                    <p <?php highlight(form_error("username")); ?>>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="" class="medium" />

                    </p>
                    <br clear="all" />
                    <p <?php highlight(form_error("password")); ?>>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="" class="medium" />
                    </p>
                    <p <?php highlight(form_error("cpassword")); ?>>
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword" value="" class="medium" />
                    </p>
                    <br clear="all" />
                    <p>
                    	<label for="parent_id">Referer Company</label>
                        <select name="parent_id" id="parent_id">
                        	<option value="0" <?php if($_POST && $p->parent_id=='0') { echo 'selected="selected"'; }?>>Not Applicable</option>
                        	<?php foreach($companies as $company) { ?>
								<option value="<?php echo $company->user_id;?>" <?php if($_POST && $p->parent_id==$company->user_id) { echo 'selected="selected"'; }?>><?php echo $company->user_business;?></option>
                        	<?php } ?>
                        </select>                    
                    </p>
                     <p <?php highlight(form_error("company_code")); ?>>
                    	<label for="company_code">Company Code</label>
                    	<input type="text" id="company_code" name="company_code"  />
                    </p>
                    <br clear="all" />
                    <?php } ?>
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                 <div class="buttons">
                    <input type="button" name="shopmore" id="shopmore" class="resetbt" value="Shop more" onclick="javascript: window.location='/products';" />
                    <input type="submit" name="checkout" id="checkout" value="Checkout" class="submitbt" />
                </div>
                </form>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       