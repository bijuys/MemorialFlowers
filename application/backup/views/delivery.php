<?php

$vaseID = $this->session->userdata('vaseID');

$js=<<<JS
<script language="javascript">
<!--

$(document).ready(function() {



        $('.useaddress').click(function(){
        
            if($(this).attr("checked"))
            {
                $('.useaddress').removeAttr("checked");
                $(this).attr("checked","checked");

            }
        });
        
        $(".aboveaddress").click(function(){
        
            if($(this).is(':checked'))
            {
            
                var id = $(this).attr("id").slice(12);
                var pid = id-1;
                
                $("#firstname"+id).val($("#firstname"+pid).val()) ;
                $("#lastname"+id).val($("#lastname"+pid).val()) ;
                $("#address1"+id).val($("#address1"+pid).val()) ;
                $("#address2"+id).val($("#address2"+pid).val()) ;
                $("#postalcode"+id).val($("#postalcode"+pid).val()) ;
                $("#city"+id).val($("#city"+pid).val()) ;
                $("#location_type"+id).val($("#location_type"+pid).val()) ;
                $("#province"+id).val($("#province"+pid).val()) ;
                $("#country_id"+id).val($("#country_id"+pid).val()) ;
                $("#dayphone"+id).val($("#dayphone"+pid).val());
                $("#evephone"+id).val($("#evephone"+pid).val()) ;
            }
        });




});


//-->
</script>
JS;

?>




<?php include_once('header.php'); ?>
            <div class="content">
                 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
                 <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
                <div id="main_content">
                <h2><?php echo lang('Delivery Details');?>
				
				<?php
				//echo $this->session->userdata('customer_account');
				
				?>
				</h2>
				
				
                <?php echo form_open(current_url(),array('class'=>'common_form clearfix')); ?>
                    <?php
                    $icount = 0;
                    foreach($delivery as $row) {
                        $icount++;
                        ?>
                    <?php 
                    if(validation_errors())
                    {
                        echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                    }
                    ?>
                
                <div class="row-fluid item-section">
                    <div class="span6" style="text-align:center;">
                        <h3><strong>Item <?php echo $icount;?> - <span style="color:#36648B; font-weight:bold;"><?php echo $row->product_code; ?></strong>  admin</h3>
                        
                        <?php if($row->custom_vase==1) : ?>
                         <div class="vase-wrapper">
                            <div class="vasebg">
                              <img src="/images/vaseBGc.jpg" />
                            </div>
                            <div class="vase">
                              <?php if($vaseID>0) : ?>
                                <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                              <?php else : ?>
                              <img src="/images/vaseIMGc.png" />
                              <?php endif; ?>
                            </div>
                            <div class="vaseproduct">
                            <img src="<?php echo img_format('productres/'.$row->product_picture,'thumbpng');?>" /></a>
                            </div>
                         </div>
                            <?php else : ?>
                            <div style="text-align:center;">
                            <img src="<?php echo img_format('productres/'.$row->product_picture,'thumb');?>" />
                            </div>
                            <?php endif; ?>
                        
                        
                        
                        
                        <p class="lead" style="text-align:center;"><?php echo $row->product_name; ?><?php echo lang('Item');?>
                        </p>                        
                    </div>
                    <div class="span12 form-horizontal">
                        
                        
                        
                        <div class="form-warning" style="margin-left:60px;">
							<h3><?php echo lang('Delivery Details');?></h3>
                            <span style="color:#8B1A1A;"><?php echo lang('Fields marked with (*) are mandatory.'); ?></span><br /><br />
                       </div>
                        
                        <?php if($icount>1) { ?>
                            <div class="control-group">
                                <div class="controls">
                                    <label for="aboveaddress<?php echo $row->orderitem_id;?>" class="checkbox">
                                    <input type="checkbox" name="aboveaddress[]" value="1" id="aboveaddress<?php echo $icount; ?>" class="aboveaddress" /><?php echo lang('Use above address');?></label>
                                </div>
                            </div>                  
                        <?php } ?>
                        <div class="control-group <?php highlightclass(form_error("firstname[{$row->orderitem_id}]")); ?>">
                            <label for="firstname<?php echo $icount;?>" class="control-label"><?php echo lang('First Name');?><span class="mandatory">*</span></label>
                            <div class="controls">
                            <!--    <input type="text" name="firstname[<?php echo $row->orderitem_id;?>]" id="firstname<?php echo $icount;?>" value="<?php echo $_POST ? $p->firstname[$row->orderitem_id]:$row->firstname;?>" class="big" />
                            -->    <input type="text" name="firstname[<?php echo $row->orderitem_id;?>]" id="firstname<?php echo $icount;?>" value="<?php echo $this->session->userdata('disease_firstname');?>" class="big" />
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("lastname[{$row->orderitem_id}]")); ?>">
                            <label for="lastname<?php echo $icount;?>" class="control-label"><?php echo lang('Last Name');?><span class="mandatory">*</span></label>
                            <div class="controls">
                            <!--    <input type="text" name="lastname[<?php echo $row->orderitem_id;?>]" id="lastname<?php echo $icount;?>" value="<?php echo $_POST ? $p->lastname[$row->orderitem_id]:$row->lastname;?>" class="big" />
                            -->    <input type="text" name="lastname[<?php echo $row->orderitem_id;?>]" id="lastname<?php echo $icount;?>" value="<?php echo $this->session->userdata('disease_lastname');?>" class="big" />
                            </div>
                        </div>
                        
                        
  <script type="text/javascript"> 
function showstuff(element){ 

	
	
	if (element == "Business") {
		document.getElementById("inf").style.display = ""; 
		}
	else if (element == "Funeral Home") {
		document.getElementById("inf").style.display = ""; 
		}
	else if (element == "Hospital") {
		document.getElementById("inf").style.display = ""; 
		}
	else if (element == "School") {
		document.getElementById("inf").style.display = ""; 
		}
	else if (element == "Church") {
		document.getElementById("inf").style.display = ""; 
		}
	else{
		document.getElementById("inf").style.display = "none"; 
	}
	
	//style.display = "";
    //document.getElementById("look").style.display = element=="look"?"block":"none"; 
}




 
</script>                        
                        
                     
                        <div class="control-group <?php highlightclass(form_error("location_type[{$row->orderitem_id}]")); ?>">
                            <label for="location_type<?php echo $icount;?>" class="control-label"><?php echo lang("Location type");?><span class="mandatory">*</span>    </label>
                            <div class="controls">
                                <select name="location_type[<?php echo $row->orderitem_id;?>]" id="location_type<?php echo $icount;?>" <?php highlight(form_error("location_type[{$row->orderitem_id}]")); ?> onchange="showstuff(this.value);"> 
                                    <?php if($_POST)
                                            {
                                                $exloc = $_POST['location_type'][$row->orderitem_id];
                                            }
                                            else
                                            {
                                                if(isset($row) && !empty($row->location_type))
                                                {
                                                    $exloc = $row->location_type;
                                                }
                                                else
                                                {
                                                    $exloc = '';
                                                }
                                            }
    
                                    ?>
                                    <option value="">Select</option>
                                    <option value="Residence" <?php if($exloc=='Residence') echo 'selected="selected"'; ?>><?php echo lang('Residence');?></option>
                                    <option value="Business" <?php if($exloc=='Business') echo 'selected="selected"'; ?>><?php echo lang('Business');?></option>
                                    <option value="Funeral Home" <?php if($exloc=='Funeral Home') echo 'selected="selected"'; ?>><?php echo lang('Funeral Home');?></option>
                                    <option value="Hospital" <?php if($exloc=='Hospital') echo 'selected="selected"'; ?>><?php echo lang('Hospital');?></option>
                                    <option value="Apartment" <?php if($exloc=='Apartment') echo 'selected="selected"'; ?>><?php echo lang('Apartment');?></option>
                                    <option value="School" <?php if($exloc=='School') echo 'selected="selected"'; ?>><?php echo lang('School');?></option>
                                    <option value="Church" <?php if($exloc=='Church') echo 'selected="selected"'; ?>><?php echo lang('Church');?></option>
                                </select>
                            </div>
                        </div>
                        
     <script>
  function checklocationtype()
{
for(var i=1; i<2; i++){
	 var lotype = document.getElementById("location_type"+i).value;
	if((lotype == "Business") || (lotype == "Funeral Home")|| (lotype == "Hospital") ||(lotype == "School") || (lotype == "Church")) {
		
		 var lotypename = document.getElementById("location_type_name"+i).value;
			if(lotypename==''){
				alert("Please enter Location Name!");
				document.getElementById("inf").style.display = ""; 
				return false;
			}
		
		}
	
}
 
 
}
  </script>    
        
        
                        
                          <div id="inf" class="control-group <?php highlightclass(form_error("location_type_name[{$row->orderitem_id}]")); ?>" style="display: none;">
                        <label for="location_type_name<?php echo $icount;?>" class="control-label"><?php echo lang('Location Name');?><span class="mandatory">*</span></label>
                        <div class="controls">
                            <input type="text" name="location_type_name[<?php echo $row->orderitem_id;?>]" id="location_type_name<?php echo $icount;?>" value="<?php echo $_POST ? $p->location_type_name[$row->orderitem_id]:$row->location_type_name;?>" class="big" />
                        </div>
                    </div>
                     
                       
                        
                        
                        
                        <div class="control-group <?php highlightclass(form_error("address1[{$row->orderitem_id}]")); ?>">
                            <label for="address1<?php echo $icount;?>" class="control-label"><?php echo lang('Address Line 1');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="address1[<?php echo $row->orderitem_id;?>]" id="address1<?php echo $icount;?>" value="<?php echo $_POST ? $p->address1[$row->orderitem_id]:$row->address1;?>" class="big" />
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("address2[{$row->orderitem_id}]")); ?>">
                            <label for="address2<?php echo $icount;?>" class="control-label"><?php echo lang('Address Line 2');?></label>
                            <div class="controls">
                                <input type="text" name="address2[<?php echo $row->orderitem_id;?>]" id="address2<?php echo $icount;?>" value="<?php echo $_POST ? $p->address2[$row->orderitem_id]:$row->address2;?>" class="big" />
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("postalcode[{$row->orderitem_id}]")); ?>">
                            <label for="postalcode<?php echo $icount;?>" class="control-label"><?php echo lang('Postal Code');?><span class="mandatory">*</span></label>
                            <div class="controls">    
                                <input type="text" name="postalcode[<?php echo $row->orderitem_id;?>]" class="postalcode" id="postalcode<?php echo $icount;?>" value="<?php
                                if($_POST)
                                {
                                    echo $p->postalcode[$row->orderitem_id];
                                }
                                else
                                {
                                    if(empty($row->postalcode))
                                        echo $row->opostalcode;
                                    else
                                        echo $row->postalcode;
                                }
                                ?>"  class="short" />
                                
                                <?php if(form_error('postalcode['.$row->orderitem_id.']')) : ?>
                              <p style="color: red;">Please enter a valid Canadian postal code. <a href="http://www.canadapost.ca/cpotools/apps/fpc/personal/findByCity?execution=e2s1" target="_blank">Click here</a> if you do not have one. If you would like to ship outside of Canada please visit our <a href="http://ww31.1800flowers.com/international-flower-delivery" target="_blank">sister site</a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("city[{$row->orderitem_id}]")); ?>">
                            <label for="city<?php echo $icount;?>"  class="control-label big"><?php echo lang('City');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="city[<?php echo $row->orderitem_id;?>]" id="city<?php echo $icount;?>" value="<?php echo $_POST ? $p->city[$row->orderitem_id]:$row->city;?>" size="30" />
                            </div>
                        </div>
    
	
	
	 <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 120) {
          val.value = val.value.substring(0, 120);
        } else {
          $('#charNum').text(120 - len);
        }
      };
	  
	  function countCharp(val) {
        var len = val.value.length;
        if (len >= 6) {
          val.value = val.value.substring(0, 6);
        } else {
          $('#charNum').text(6 - len);
        }
      };
    </script>
	
	
                       <div class="control-group <?php highlightclass(form_error("province[{$row->orderitem_id}]")); ?>">
                            <label for="province<?php echo $icount;?>" class="control-label"><?php echo lang('Province');?><span class="mandatory">*</span></label>
                            <div class="controls">
                            <?php
                                $provinces = get_available_provinces($row->product_id);
                                
                                if(count($provinces))
                                { ?>
                                <select name="province[<?php echo $row->orderitem_id;?>]" id="province<?php echo $icount;?>" <?php highlight(form_error("province[{$row->orderitem_id}]")); ?>>
                                    <option value="" <?php
                                    
                                            if($_POST)
                                            {
                                                if($p->province[$row->orderitem_id]=='')
                                                    echo 'selected="selected"';
                                            }
                                            else
                                            {
                                                if($row->province=='' && $row->country_id<3)
                                                    echo 'selected="selected"';
                                            }
                                    
                                    ?>><?php echo lang('Please select');?></option>
                                        <?php foreach($provinces as $province) { ?>
                                            <option value="<?php echo $province->province_name;?>" <?php
                                            if($_POST)
                                            {
                                                if($p->province[$row->orderitem_id]==$province->province_name)
                                                    echo 'selected="selected"';
                                            }
                                            else
                                            {
                                                if($row->province==$province->province_name && $row->country_id<3)
                                                    echo 'selected="selected"';
                                            }
                                            
                                            ?>><?php echo $province->province_name;?></option>
                                        <?php }
                                       ?>
                                    </select><?php echo form_error('province'); ?>
                                    
                            <?php
                             }
                                else
                                {
                                ?>
                            <input type="text" name="province[<?php echo $row->orderitem_id;?>]" id="province<?php echo $icount;?>" value="<?php echo $_POST ? $p->province[$row->orderitem_id]:$row->province;?>" size="30" />
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("country_id[{$row->orderitem_id}]")); ?>">
                            <label for="country_id<?php echo $icount;?>" class="control-label"><?php echo lang('Country');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <select name="country_id[<?php echo $row->orderitem_id;?>]" id="country_id<?php echo $icount;?>">
                                <?php
                                $countries = get_available_countries($row->product_id);
                                foreach($countries as $country) { ?>
                                <option value="<?php echo $country->country_id;?>"
                                <?php
                                
                                if($_POST)
                                {
                                    if($p->country_id[$row->orderitem_id]===$country->country_id)
                                        echo 'selected="selected"';
                                }
                                else
                                {
                                    if($row->country_id===$country->country_id)
                                        echo 'selected="selected"';                                
                                }
                                
                                ?>><?php echo $country->country_name;?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("dayphone[{$row->orderitem_id}]")); ?>">
                            <label for="dayphone<?php echo $icount;?>" class="control-label"><?php echo lang('Day Phone');?><span class="mandatory">*</span></label>
                            <div class="controls">
                                <input type="text" name="dayphone[<?php echo $row->orderitem_id;?>]" id="dayphone<?php echo $icount;?>" value="<?php echo $_POST ? $p->dayphone[$row->orderitem_id]:$row->dayphone;?>" class="big" />
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("evephone[{$row->orderitem_id}]")); ?>">
                            <label for="evephone<?php echo $icount;?>" class="control-label"><?php echo lang('Evening Phone');?></label>
                            <div class="controls">
                                <input type="text" name="evephone[<?php echo $row->orderitem_id;?>]" id="evephone<?php echo $icount;?>" value="<?php echo $_POST ? $p->evephone[$row->orderitem_id]:$row->evephone;?>" class="big" />
                            </div>
                        <input type="hidden" name="orderitem_id[]" id="orderitem_id<?php echo $icount;?>" value="<?php echo $row->orderitem_id;?>" />
    
                        </div>
                        <div class="control-group">
                            
                            <div class="controls">
                                <label for="useaddress<?php echo $row->orderitem_id;?>" class="checkbox">
                                <input type="checkbox" name="useaddress[<?php echo $row->orderitem_id;?>]" id="useaddress<?php echo $icount;?>" value="1"  <?php   
                                if($_POST)
                                {
                                    echo isset($_POST['useaddress']) && $_POST['useaddress']==$row->orderitem_id ? 'checked="checked"':'';
                                }
                                elseif($this->session->userdata('useaddress'))
                                {
                                    echo $this->session->userdata('useaddress')==$row->orderitem_id ? 'checked="checked"':'';                            
                                }
                                
                                ?> class="useaddress" /> <?php echo lang('Use this address for billing');?></label>
                                <?php echo form_error("evephone[{$row->orderitem_id}]"); ?>
                            </div>
                        </div>
                        
                    </div><!-- Span9 ! //-->
                    <div class="span6">
                        
                        <h3><?php echo lang('Card Message');?></h3>
                        <div class="control-group">
                            <label for="delivery_date<?php echo $icount;?>" class="control-label-line"><?php echo lang('Delivery Date');?></label>
                            <div class="controls-line">
                                <?php if($row->special_delivery==1) : ?>
                                <strong style="display:block; clear: left; text-align:left;">Today</strong>
                                <input type="hidden" name="delivery_date[<?php echo $row->orderitem_id;?>]" value="<?php echo $row->delivery_date;?>"  id="delivery_date<?php echo $icount;?>" />
                                <?php else : ?>
                                <select name="delivery_date[<?php echo $row->orderitem_id;?>]" id="delivery_date<?php echo $icount;?>">
                                 
                                <?php $dates = get_dates($row->delivery_method_id,10);
                                     $found = FALSE;
                                     
                                     foreach($dates as $day) { ?>
                                <option value="<?php echo $day; ?>" <?php
                                
                                      if($_POST)
                                      {
                                        if($p->delivery_date[$row->orderitem_id]== $day)
                                        {
                                            echo 'selected="selected"';
                                            $found = TRUE;
                                        }
                                      }
                                      else
                                      {
                                        if($row->delivery_date==$day)
                                        {
                                            echo 'selected="selected"';
                                            $found = TRUE;
                                        }
                                      }
    
                                      ?>><?php echo date('M d Y D',strtotime($day));?></option>
                            <?php   }
                            
                                    if(!$found)
                                    {
                                      if($_POST)
                                      {
                                        echo '<option value="'.$p->delivery_date[$row->orderitem_id].'" selected="selected">'.date('M d Y D',strtotime($p->delivery_date[$row->orderitem_id])).'</option>'."\n";
                                      }
                                      else
                                      {
                                        echo '<option value="'.$row->delivery_date.'" selected="selected">'.date('M d Y D',strtotime($row->delivery_date)).'</option>'."\n";
                                      }
                                    }
                            
                            ?>
                                </select>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="occasion_id<?php echo $icount;?>" class="control-label-line"><?php echo lang('Occasion');?></label>
                            <div class="controls-line">
                                <select name="occasion_id[<?php echo $row->orderitem_id;?>]" id="occasion_id<?php echo $icount;?>">
                                    <option value=""><?php echo lang('Select an Occasion');?></option>
                                <?php
                                $occasions = get_occasions();
                                foreach($occasions as $occasion) { ?>
                                <option value="<?php echo $occasion->occasion_id;?>" <?php
                                if($_POST)
                                {
                                    if($p->occasion_id[$row->orderitem_id]===$occasion->occasion_id)
                                        echo 'selected="selected"';
                                }
                                else
                                {
                                    if($row->occasion_id===$occasion->occasion_id)
                                        echo 'selected="selected"';                                
                                }
                                
                                ?>><?php echo lang($occasion->occasion_name);?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group <?php highlightclass(form_error("card_message[{$row->orderitem_id}]")); ?>">
                            <label for="card_message<?php echo $icount;?>" class="control-label-line"><input type="checkbox" name="enclose_card[<?php echo $row->orderitem_id;?>]" class="enclose_card" id="enclose_card<?php echo $row->orderitem_id;?>" value="1" <?php
                            
                                if(!$_POST)
                                {
                                    if(empty($row->delivery_detail_id) || $row->delivery_detail_id<1)
                                    {
                                        echo ' checked="checked" ';
                                    }
                                    elseif($row->enclose_card==1)
                                    {
                                        echo ' checked="checked" ';
                                    }
                                    
                                }
                                else
                                {
                                    if((isset($_POST['enclose_card'][$row->orderitem_id]) && $_POST['enclose_card'][$row->orderitem_id]==1))
                                    {
                                        
                                        echo ' checked="checked" ';
                                    }
                                }
                            
                            ?> /> <?php echo lang('Message on Card');?></label>
                            <div class="controls-line">

                                <textarea name="card_message[<?php echo $row->orderitem_id;?>]" id="card_message<?php echo $row->orderitem_id;?>" rows="11" cols="25" <?php
                                
                                    if($_POST)
                                    {
                                        
                                        if(!isset($_POST['enclose_card']))
                                        {
                                            echo 'disabled="disabled"';
                                        }
                                    }
                                    else
                                    {
                                        
                                        if(isset($row->delivery_detail_id) && $row->delivery_detail_id>0)
                                        {
                                           
                                            if($row->enclose_card!=1)
                                            {
                                                
                                                echo 'disabled="disabled"';
                                            }
                                        }
                                    }
                                    
                                ?>><?php echo isset($_POST) && isset($_POST['card_message'][$row->orderitem_id]) ? $p->card_message[$row->orderitem_id]:(isset($row->card_message) && !$_POST ? $row->card_message:'');?></textarea>
                            </div>
                        </div>
                        
						
						
						
						<div class="control-group <?php highlightclass(form_error("ribbon_message[{$row->orderitem_id}]")); ?>">
                            <label for="ribbon_message<?php echo $icount;?>" class="control-label-line"> <?php echo lang('Message on Ribbon');?></label>
                            <div class="controls-line">

                                <textarea name="ribbon_message[<?php echo $row->orderitem_id;?>]" id="ribbon_message<?php echo $row->orderitem_id;?>" rows="11" cols="25" <?php
                                
                                    if($_POST)
                                    {
                                        
                                        if(!isset($_POST['enclose_card']))
                                        {
                                            echo 'disabled="disabled"';
                                        }
                                    }
                                    else
                                    {
                                        
                                        if(isset($row->delivery_detail_id) && $row->delivery_detail_id>0)
                                        {
                                           
                                            if($row->enclose_card!=1)
                                            {
                                                
                                                echo 'disabled="disabled"';
                                            }
                                        }
                                    }
                                    
                                ?>><?php echo isset($_POST) && isset($_POST['ribbon_message'][$row->orderitem_id]) ? $p->ribbon_message[$row->orderitem_id]:(isset($row->ribbon_message) && !$_POST ? $row->ribbon_message:'');?></textarea>
                            </div>
                        </div>
						
						
						
						
						
                        
                        
                    </div>   
                </div> <!-- Row Fluid! //-->
                
                
                <?php } ?>
                 <div class="buttons text-center">
                    <button name="shopmore" id="shopmore" onclick="javascript: window.location='/products';"  class="btn btn-large" ><?php echo lang('Shop more');?></button>
                    <button type="submit" name="checkout" id="checkout" value="" class="btn btn-large btn-inverse" onClick="return checklocationtype();" ><?php echo lang('Proceed with Checkout');?></button>
                </div>
                <?php echo form_close(); ?>

            </div> <!-- main -->
            <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- content -->
        <div id="postalcode-info" class="modalwin">
            <a href="#" class="closedit"><img src="<?php echo theme_url();?>/images/close-button.png" /></a>
        <div id="postalinfo"></div>
        </div>
        
      
      
      
        
        
        
        
<script>
<!--


$(function() {
    
    $('.postalcode').change(function(){
        
  //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
 
    //Set height and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
     
    //transition effect     
    $('#mask').fadeIn(1000);    
    $('#mask').fadeTo("slow",0.8);  
    
        
        var id = $(this).attr("id");
        id = id.slice(10);
        
        var pcode = $(this).val();
        
        var winH = $(window).height();
        var winW = $(window).width();
            
        $("#postalcode-info").css('top',  winH/2-$("#postalcode-info").height()/2);
        $("#postalcode-info").css('left', winW/2-$("#postalcode-info").width()/2);  
        
        $('#postalinfo').html('<div class="loading"></div>');
        
        //transition effect
        $("#postalcode-info").fadeIn(2000);
        
        var token = $("input[name=csrf1800]").val();
        
        $.post('/shop/getlocationinfo',{'postalcode':$(this).val(),'csrf1800':token},function(data){
            
            if(data.result=='ok')
            {
                $("#city"+id).val(data.city);
                $("#province"+id).val(data.province);
                $("#contry_id"+id).val(data.country);
                
                $('#mask').hide();
                $('#postalcode-info').hide();

                
            }
            else
            {
                $('#postalinfo').html(data.message);
            }
            
            
            
        },'json');
        
    });
    
    $('.enclose_card').click(function(){
        
        var id = $(this).attr("id");
        id = id.slice(12);
    
    if($(this).is(":checked"))
    {
        
        $('#card_message'+id).removeAttr('disabled');
    }
    else
    {
        $('#card_message'+id).val('');
        $('#card_message'+id).attr('disabled','disabled');
    }    
        
    });
    
    reinit();
    
 
        function reinit()
        {
            //if close button is clicked
            $('.closedit').click(function (e) {
                
                //Cancel the link behavior
                e.preventDefault();
                $("#postalcode-info").hide();
                $('#mask').hide();
                
            });          
            
            
        }   

});
//-->
</script>
<?php include_once('footer.php'); ?>
       