<script type="text/javascript" src="<?php echo theme_url();?>/css/jquery-1.7.1.min.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/css/alertbox_2_jquery.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/css/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo theme_url();?>/css/jquery-ui-1.8.6.min.js"></script>

<?php $vaseID = $this->session->userdata('vaseID'); ?>
<?php include_once('header.php'); ?>
            <div class="content clearfix">
                 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
                 <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            <div id="main_content" >
             <h2><?php echo lang('Confirm your Order');?></h2>
             
                <?php echo $elist; ?>
                                <?php 
                    if(validation_errors())
                    {
                        echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                    }
                    ?>
                <?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
                
                <div class="row-fluid">
                    
                    <div class="span6">
                        <h3><?php echo lang('Your Billing Information');?>
						
						<?php
				//echo $this->session->userdata('customer_id').'_'.$this->session->userdata('customer_account');
				
				?>
						</h3>
                        <p class="address">
                           <?php echo $billing->firstname.' '.$billing->lastname;?><br />
                           <?php echo $billing->address1.' '.$billing->address2;?><br />
                           <?php echo $billing->city.' - '.$billing->postalcode;?><br />
                           <?php echo $billing->province;?><br />
                           <?php echo $billing->dayphone.' '.$billing->evephone;?><br />
                           <?php echo $billing->email;?></p>
                         <!--  <p class="right">[<a href="#edit-billing" name="edbilling" id="edbilling"><?php //echo lang('Edit');?></a>]</p>-->
                         <h3><?php echo lang('Order Summary');?></h3>
                        <table cellpadding="3" cellspacing="0" class="table" border="0" >
                           <tr>
                               <td><?php echo lang('Product Total');?></td>
                               <td class="right"><?php echo getRate($totals['itemtotal']);?></td>
                           </tr>
                           
                           <?php //if(($totals['coupon']+$totals['discount'])>0) : 
                            //san code here. for actual file take a look on server named file checkout-12-7-2013
                            $affid=$this->session->userdata('referer');
							$bothsum=0;
                            if($totals['coupon']>0){
								
							$bothsum=$totals['coupon']+$totals['discount'];
							}
							if($affid!='') {
							$bothsum=0;	
							}
							?>
                             <?php 
								
								
								//if($bothsum>0) { ?>
                           
                           
                           
                           
                           
                           
                           <?php 
                            //if(($totals['discount']+$totals['coupon'])>0) {
                           ?>
                           <!--<tr>
                               <td><?php //echo lang('Discount');?></td>
                               <td class="right">-<?php //echo getRate($totals['discount']+$totals['coupon']);?></td>
                           </tr>-->
                           
                           
                           <tr>
                                <td>
								
								<?php 
								$dist = $totals['coupon']+$totals['discount'];
								echo lang('Discount');?></td>
                                <td class="right">-<?php echo getRate($dist);
								//echo getRate($bothsum);
								
								?></td>
                            </tr>
                            
                            <?php //} //endif; ?>
                           
                           
                           
                           
                           
                           
                           <?php 
                         //  }
                           
                            if($totals['companyless']>0) {
                           ?>
                           <tr>
                               <td><?php echo lang('Company Customer Less');?></td>
                               <td class="right">-<?php echo getRate($totals['companyless']);?></td>
                           </tr> 
                           <?php
                           }
                           
                           ?>
                           <?php if($totals['service']==0 || $totals['shipping']>0) : ?>
                           <tr>
                               <td><?php echo lang('Shipping');?></td>
                               <td class="right"><?php echo getRate($totals['shipping']);?></td>
                           </tr>
                           <?php endif; ?>
                           <?php if($totals['service']>0) : ?>
                           <tr>
                               <td><?php echo lang('Delivery fee');?></td>
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
                               <td class="gtotal right"><strong><?php echo getRate($totals['grandtotal']);?></strong></td>
                           </tr>
                        </table>
                        
                    </div>
                    
                    <div class="span12 offset1">
                        <h3><?php echo lang('Your Items');?></h3>
                        
                        <table border="0" cellpadding="15" cellspacing="0" class="table" >
                        <?php $total_price =0;
                        foreach($items as $item) { ?>
                        <tr><th colspan="3"><?php echo ucwords(strtolower($item->product_name));?> <small>[<a href="<?php echo '/shop/rem/'.$item->orderitem_id;?>"><?php echo lang('Remove this');?></a>]</small></th>
                        <tr>
                        <td class="thumb">
                            <?php if($item->custom_vase==1) : ?>
                                <div class="vase-wrapper">
                                <div class="vasebg">
                                    <img src="/images/vaseBGc.jpg"  width="70" height="70"   style="width:70px; height:70px;"    />
                                </div>
                                <div class="vase">
                                    <?php if($vaseID>0) : ?>
                                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" width="70" height="70" style="width:70px; height:70px;" />
                                    <?php else : ?>
                                    <img src="/images/vaseIMGc.png"  width="70" height="70" style="width:70px; height:70px;"/>
                                    <?php endif; ?>
                                </div>
                                <div class="vaseproduct">
                                    <img src="<?php echo img_format('productres/'.$item->product_picture,'sthumbpng');?>" width="70" height="70" style="width:70px; height:70px;" />
                                </div>
                                </div>
                            <?php else : ?>   
                                <img src="<?php echo img_format('productres/'.$item->product_picture,'stamp');?>"/>
                            <?php endif; ?>
                        </td>
                        <td>
                            <p>
                            <em><?php echo lang('Ships to');?>: </em>(<?php echo lang($item->location_type);?>): (<?php echo lang($item->location_type_name);?>)<br/>
                            <?php echo $item->firstname.' '.$item->lastname.'<br /> '; ?>
                                <?php echo $item->address1.' '.$item->address2.'<br /> '.$item->city.'-'.$item->postalcode;?><br />
                                <?php echo $item->province.' '.$item->dayphone;?>
                                <?php echo empty($item->evephone) ? '':' '.$item->evephone;?><br />
                                <?php echo $item->email;?></p>
                         <p><?php echo lang('On');?>: <?php echo date('l d M Y',strtotime($item->delivery_date));?></p>
                        <p><em><?php echo lang('Message');?>:</em> <?php echo $item->card_message;?></p>
                        <p><em><?php echo lang('Message on Ribbon');?>:</em> <?php echo $item->ribbon_text;?></p>
                        
                        <!--<p class="right">[<a href="#edit-delivery" name="edbilling" id="edit-<?php //echo $item->orderitem_id;?>" class="edelivery"><?php //echo lang('Edit');?></a>]</p>-->
                        </td>
                        <td>
                            <p><?php echo getRate($item->product_price);?></p>
                        </td>
                        </tr>
                        <?php foreach($item->addons as $addon) {
                                $total_price += $addon->addon_price*$addon->addon_quantity;                        
                        ?>
                       <tr>
                            <td class="addonrow">&nbsp;</td>
                            <td class="addonrow">
                            [<big>+</big>] <?php echo ucfirst(strtolower($addon->addon_name)); ?> (<?php echo getRate($addon->addon_price); ?>) x <?php echo $addon->addon_quantity;?>
                            </td>
                            <td class="addonrow">
                            <?php echo getRate($addon->addon_price*$addon->addon_quantity)?></td>
                        </tr>
                        <?php
                            }
                         } ?>
                        </table>    
                       <h3><?php echo lang('Payment'); ?> <?php //echo $this->session->userdata('user_firstname').' '.$this->session->userdata('customer_account'); ?></h3>
                       
                       
					   <?php 
					   
					   if($this->session->userdata('test_affiliate') == 5886161){
					   
						$this->session->set_userdata('referer',5886161);
						
					   }
					   
					   ?>
					   
					   <?php if($this->session->userdata('customer_account')==1 && $this->session->userdata('customer_id')<>0) {
						   echo "test";
						    ?>
					   
					   <p style="display: block; float: none;">
                            &nbsp;
                            <label>Payment: On Account</label>
                            <input type="hidden" name="company_pay" value="1" />
                             <input type="hidden" name="nameoncard" id="nameoncard" value="" size="30" />
                             <input type="hidden" name="cardtype" id="nameoncard" value="" size="30" />
                             <input type="hidden" name="cardnumber" id="nameoncard" value="" size="30" />
                             <input type="hidden" name="expiry_month" id="nameoncard" value="" size="30" />
                             <input type="hidden" name="expiry_year" id="nameoncard" value="" size="30" />
                             <input type="hidden" name="cvv" id="nameoncard" value="" size="30" />
							 <input type="hidden" name="use" id="use" value="<?php echo $this->session->userdata('customer_account'); ?>" size="30" />
                        </p>
					 
					   
					   <?php }else{ echo "admin"; ?>
					   
					   
					   <div class="form-warning">
                            <?php echo lang('Fields marked with (*) are mandatory.'); ?>
                       </div>
                       
                        <div class="control-group">
                            <label for="cardtype" class="control-label">Card Type<span class="mandatory">*</span></label>
                            <div class="controls">
                                <select name="cardtype" id="cardtype">
                                    <option value="visa">Visa</option>
                                    <option value="master">Master Card</option>
                                    <option value="american">American Express</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Name on Card<span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="nameoncard" value="<?php echo $billing->firstname.' '.$billing->lastname;?>" id="nameoncard" class="nameoncard" style="height:30px;" />  [<small><a href="#" class="editinline"><?php echo lang('Edit');?></a></small>]
                            </div>
                        </div>
                        <script>
                        
                            $(document).ready(function(){
                                
                                 $(".editinline").click(function(e){
                                    e.preventDefault();
                                    var ival = $(this).html();
                                    
                                    if(ival=='Edit')
                                    {
                                        $("#nameoncard").attr('class','');
                                        $(this).html('Save');
                                    }
                                    else
                                    {
                                        $("#nameoncard").attr('class','nameoncard');
                                        $(this).html('Edit');
                                    }
    
                                });
                                
                                
                            });
                                
                        
                        </script>
                        <div class="control-group <?php highlightclass(form_error("cardnumber")); ?>">
                            <label for="cardnumber" class="control-label"><?php echo lang('Card No');?>.<span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="cardnumber" id="cardnumber" maxlength="16" value="<?php if($_POST) echo $_POST['cardnumber'];?>" size="30" style="height:30px;" />
                                <?php echo form_error('cardnumber'); ?>
                            </div>
                        </div>
    
    
                        <div class="control-group">
                            <label for="expiry_month" class="control-label"><?php echo lang('Card Expiry');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <select name="expiry_month" id="expiry_month" class="input-mini"  <?php highlight(form_error("expiry_month")); ?>>
                                    <option value=""></option>
                                    <option value="01" <?php if($_POST && $_POST['expiry_month']=='01') echo 'selected="selected"';?>>01</option> 
                                    <option value="02" <?php if($_POST && $_POST['expiry_month']=='02') echo 'selected="selected"';?>>02</option>
                                    <option value="03" <?php if($_POST && $_POST['expiry_month']=='03') echo 'selected="selected"';?>>03</option>
                                    <option value="04" <?php if($_POST && $_POST['expiry_month']=='04') echo 'selected="selected"';?>>04</option>
                                    <option value="05" <?php if($_POST && $_POST['expiry_month']=='05') echo 'selected="selected"';?>>05</option>
                                    <option value="06" <?php if($_POST && $_POST['expiry_month']=='06') echo 'selected="selected"';?>>06</option>
                                    <option value="07" <?php if($_POST && $_POST['expiry_month']=='07') echo 'selected="selected"';?>>07</option>
                                    <option value="08" <?php if($_POST && $_POST['expiry_month']=='08') echo 'selected="selected"';?>>08</option>
                                    <option value="09" <?php if($_POST && $_POST['expiry_month']=='09') echo 'selected="selected"';?>>09</option>
                                    <option value="10" <?php if($_POST && $_POST['expiry_month']=='10') echo 'selected="selected"';?>>10</option>
                                    <option value="11" <?php if($_POST && $_POST['expiry_month']=='11') echo 'selected="selected"';?>>11</option>
                                    <option value="12" <?php if($_POST && $_POST['expiry_month']=='12') echo 'selected="selected"';?>>12</option>
                                </select>
                                <select name="expiry_year" id="expiry_year" class="input-small"  <?php highlight(form_error("expiry_year")); ?>>
                                    <option value=""></option>
                                    <?php for($i=0;$i<=15;$i++)
                                        {
                                            $ydate = time() + (60 * 60 * 24 * 365 * $i);
                                            $year = date('Y',$ydate);
                                    ?>
                                     <option value="<?php echo $year;?>" <?php
                                     
                                        if($_POST && isset($_POST['expiry_year']))
                                        {
                                            if($_POST['expiry_year']==$year)
                                            {
                                                echo 'selected="selected"';
                                            }
                                        }
                                     
                                     ?>><?php echo $year;?></option>                           
                                    <?php                                    
                                        }
                                    ?>
                                </select>
                                <?php echo form_error('expiry_month'); ?>
                                <?php echo form_error('expiry_year'); ?>
                            </div>
                        </div>
                        <div class="control-group<?php highlightclass(form_error("cvv")); ?>">
                            <label for="cvv" class="control-label"><?php echo lang('CVV2');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="cvv" id="cvv" class="input-mini" value="<?php if($_POST) echo $_POST['cvv'];?>" size="5" maxlength="4" style="height:30px;" /> &nbsp;
                                <a href="#" id="cvvhelp"><img src="<?php echo theme_url();?>/images/help.gif" /></a>
                                <?php echo form_error('cpassword'); ?>
                            </div>
                        </div>
                      
                        <?php } ?>
						
                    </div><!-- Span12 //-->              
                    
                    
                </div><!-- Row Fluid //-->
             
                <div class="text-center">
                    <input type="hidden" name="data" value="<?php echo $_POST ? $_POST['data']:$encoded;?>" />
                    <button type="button" name="editorder" id="editorder" value="<?php echo lang('Edit Order');?>" onclick="javascript: window.location='/shop/cart';" class="btn btn-large" ><?php echo lang('Edit Order');?></button>
                    <button type="submit" name="paynow" id="paynow" value="<?php echo lang('Pay Now');?>" class="btn btn-large btn-inverse" onClick="return Loginvalid();"><?php echo lang('Pay Now');?></button>
                </div>
 
                <?php echo form_close(); ?>

                <div id="edit-billing" class="modalwin">
                    <a href="#" class="closedit"><img src="<?php echo theme_url();?>/images/close-button.png" /></a>
                     <div id="boxform"></div>
                </div>
                
                <div id="edit-delivery" class="modalwin">
                     <a href="#" class="closedit"><img src="<?php echo theme_url();?>/images/close-button.png" /></a>
                     <div id="dboxform"></div>
                </div>
                
                <div id="whatcvv">
                    <div class="inner-wrapper">
                        <h3>CVV2</h3>
                        
                        <div class="col1">
                            
                            <p>The Security Code is a 3- or 4-digit number printed on your credit card. It provides added security when you use your card on the Internet or over the phone.</p>
                            
                            <h4>Visa and Mastercard</h4>
                            <p>A 3-digit number in reverse italics on the back of your credit card.</p>

                            <h4>Discover</h4>

                            <p>A 3-digit number in reverse italics on the back of your credit card.</p>
                            <h4>American Express</h4>

                            <p>A 4-digit number on the front, just above your credit card number.</p>

                        </div>
                        
                        <div class="col2">
                            <img src="<?php echo theme_url();?>/images/cvv-help.gif" />
                            
                        </div>
                        
                        <div style="float: right; position:absolute; bottom: 5px; right: 5px;">
                            <a class="closedit" href="#">Close</a>
                        </div>
                        
                    </div>
                    
                </div>
                
<script>
<!--
        
        $('#cvvhelp').click(function(e) {
            
            e.preventDefault();
            
            //Get the screen height and width
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
            
            var winH = $(window).height();
            var winW = $(window).width();
            
            $("#whatcvv").css('top',  winH/2-$("#whatcvv").height()/2);
            $("#whatcvv").css('left', winW/2-$("#whatcvv").width()/2);            
         
            //Set height and width to mask to fill up the whole screen
            $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
             
            //transition effect     
            $('#mask').fadeIn(1000);    
            $('#mask').fadeTo("slow",0.8);  
         
         
            //transition effect
            $("#whatcvv").fadeIn(2000);
            
            reinit();

        });
        
        
        $('.edelivery').click(function(e) {
            e.preventDefault();
            
            var did = $(this).attr("id");
            did = did.slice(5);
            
            //Get the screen height and width
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
            
            $("#dboxform").html('<div class="loading"></div>');
         
            //Set height and width to mask to fill up the whole screen
            $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
             
            //transition effect     
            $('#mask').fadeIn(1000);    
            $('#mask').fadeTo("slow",0.8);  
         
            //Get the window height and width
            var winH = $(window).height();
            var winW = $(window).width();
                   
            //Set the popup window to center
            $("#edit-delivery").css('top',  winH/2-$("#edit-delivery").height()/2);
            $("#edit-delivery").css('left', winW/2-$("#edit-delivery").width()/2);
            
            var token = $("input[name=csrf1800]").val();
            
            $.post('/shop/editdelivery/'+did,{'csrf1800':token},function(data){
                
                if(data.form)
                {
                    
                    $('#dboxform').html(data.form);
                    reinit();
                }
                   
            },'json');
         
            //transition effect
            $("#edit-delivery").fadeIn(2000);
            
            reinit();
            
        });
        
        $('#edbilling').click(function(e) {
            //Cancel the link behavior
            e.preventDefault();
            //Get the A tag
            
            $("#boxform").html('<div class="loading"></div>');
            
            
            var id = $(this).attr('href');
         
            //Get the screen height and width
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
         
            //Set height and width to mask to fill up the whole screen
            $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
             
            //transition effect     
            $('#mask').fadeIn(1000);    
            $('#mask').fadeTo("slow",0.8);  
         
            //Get the window height and width
            var winH = $(window).height();
            var winW = $(window).width();
                   
            //Set the popup window to center
            $(id).css('top',  winH/2-$(id).height()/2);
            $(id).css('left', winW/2-$(id).width()/2);
            
            var token = $("input[name=csrf1800]").val();
            
            $.post('/shop/editbilling',{'csrf1800':token},function(data){
                
                if(data.form)
                {
                    $('#boxform').html(data.form);
                    reinit();
                }
                   
            },'json');
         
            //transition effect
            $(id).fadeIn(2000);
            
            reinit();
     
        });
        
        function reinit()
        {
            //if close button is clicked
            $('.closedit').click(function (e) {
                
                //Cancel the link behavior
                e.preventDefault();
                $("#whatcvv").hide();
                $("#edit-billing").hide();
                $("#edit-delivery").hide();
                $('#mask').hide();
                
            });
            
            $("#ebilling").submit( function (e) {
                e.preventDefault();
                
                var fdata=$(this).serialize();
                
                $("#boxform").html('<div class="loading"></div>');
                
              $.post('/shop/editbilling',
                fdata,
                
                function(data){
                    
                    if(data.result=='failed')
                    {
                        $('#boxform').html(data.form);
                    }
                    else
                    {
                        $("#edit-billing").hide();
                        $('#mask').hide();
                        window.location.reload(true);
                    }
                    
                    reinit();
                },'json');
              return false;   
            });
            
            $(".edelivery").submit( function (e) {
                e.preventDefault();
                
                var oid = $(this).attr('id');
                oid = oid.slice(10);
                
                var fdata = $(this).serialize();
                
                $("#dboxform").html('<div class="loading"></div>');
              
                $.post('/shop/editdelivery/'+oid, fdata,         
                  function(data){
                      
                      if(data.result=='failed')
                      {
                          $('#dboxform').html(data.form);
                      }
                      else
                      {
                          $("#edit-delivery").hide();
                          $('#mask').hide();
                          window.location.reload(true);
                      }
                      
                      reinit();
                  },'json');
              
              return false;   
            });
            
            
            
        }
        
 
                
//-->
</script>
            </div> <!-- main -->
            <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- content -->
<?php include_once('footer.php'); ?>
       