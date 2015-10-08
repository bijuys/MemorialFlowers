          <div class="ajax-edit">
                <?php 
                    if(validation_errors())
                    {
                        echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                    }
                    ?>
                <?php echo form_open('#',array('class'=>'common_form edelivery clearfix','id'=>'edelivery-'.$orderitem_id)); ?>
                <div class="deliverymodal clearfix">
                    <div class="col1 clearfix">
                    <h3><?php echo lang('Delivery Details');?></h3>

                    <div class="form-control <?php highlightclass(form_error("firstname")); ?>">
                        <label for="firstname" class="form-label"><?php echo lang('First Name');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:$row->firstname;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("lastname")); ?>">
                        <label for="lastname" class="form-label"><?php echo lang('Last Name');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:$row->lastname;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("location_type")); ?>">
                        <label for="location_type" class="form-label"><?php echo lang("Location type");?></label>
                        <div class="form-field">
                            
                            <select name="location_type" id="location_type" <?php highlight(form_error("location_type")); ?>>
                                <?php if(isset($_POST) && isset($_POST['location_type']))
                                        {
                                            $exloc = $_POST['location_type'];
                                        }
                                        elseif(isset($row))
                                        {
                                            $exloc = $row->location_type;
                                        }
                                        else
                                        {
                                            $exloc = '';
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
                    <div class="form-control <?php highlightclass(form_error("address1")); ?>">
                        <label for="address1" class="form-label"><?php echo lang('Address Line 1');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:$row->address1;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("address2")); ?>">
                        <label for="address2" class="form-label"><?php echo lang('Address Line 2');?></label>
                        <div class="form-field">
                            <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:$row->address2;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("postalcode")); ?>">
                        <label for="postalcode" class="form-label"><?php echo lang('Postal Code');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="postalcode" id="postalcode" value="<?php
                        if($_POST)
                        {
                            echo $p->postalcode;
                        }
                        else
                        {
                            echo $row->postalcode;
                        }
                        ?>"  class="short" /><?php echo form_error('postalcode'); ?>
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("city")); ?>">
                        <label for="city" class="form-label"><?php echo lang('City');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:$row->city;?>" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("province")); ?>">
                        <label for="province" class="form-label"><?php echo lang('Province');?><span class="mandatory">*</span></label>
                       <?php
                            $provinces = get_available_provinces($row->product_id);
                            
                            if(count($provinces))
                            { ?>
                        <div class="form-field">
                            <select name="province" id="province" <?php highlight(form_error("province")); ?>>
                        <option value="" <?php
                        
                                if($_POST)
                                {
                                    if($p->province=='')
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
                                    if($p->province==$province->province_name)
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
                        <input type="text" name="province" id="province" value="<?php echo $_POST ? $p->province:$row->province;?>" size="30" />
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("country_id")); ?>">
                        <label for="country_id" class="form-label"><?php echo lang('Country');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <select name="country_id" id="country_id">
                            <?php
                            $countries = get_available_countries($row->product_id);
                            foreach($countries as $country) { ?>
                            <option value="<?php echo $country->country_id;?>"
                            <?php
                            
                            if($_POST)
                            {
                                if($p->country_id===$country->country_id)
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
                    <div class="form-control <?php highlightclass(form_error("dayphone")); ?>">
                        <label for="dayphone" class="form-label"><?php echo lang('Day Phone');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:$row->dayphone;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("evephone")); ?>">
                        <label for="evephone" class="form-label"><?php echo lang('Evening Phone');?></label>
                        <div class="form-field">
                            <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:$row->evephone;?>" class="big" />
                        </div>
                    <input type="hidden" name="orderitem_id" id="orderitem_id" value="<?php echo $orderitem_id;?>" />
                    <input type="hidden" name="oid" id="oid" value="<?php echo $orderitem_id;?>" />
                    </div>
                    </div><!-- common_form-->
                    <div class="col2">
                        
                    <h3><?php echo lang('Card Message');?></h3>
                    <div class="form-control">
                        <div class="form-field">
                            <img src="<?php echo img_format('productres/'.$row->product_picture,'stamp');?>" />
                            <strong><?php echo $row->product_name; ?></strong>
                        </div>                        
                    </div>
                    <div class="form-control">
                        <label for="delivery_date" class="form-label"><?php echo lang('Delivery Date');?></label>
                            <div class="form-field">
                            <?php if($row->special_delivery==1) : ?>
                            <strong style="display:block; clear: left; text-align:left;">Today</strong>
                            <input type="hidden" name="delivery_date" id="delivery_date" value="<?php echo date('d-m-Y',strtotime($row->delivery_date));?>" />
                            <?php else : ?>
                             <input type="hidden" name="delivery_date" id="delivery_date"  value="<?php echo date('d-m-Y',strtotime($row->delivery_date));?>" />
                            <select name="upcoming" id="upcoming"  onchange="upcoming_date(this.value);" style="width:170px; vertical-align:text-middle;">
                                
                                <?php $dates = get_dates($row->delivery_method_id,10);
                            $found = FALSE;
                                foreach($dates as $day) { ?>
                            <option value="<?php echo date('d-m-Y',strtotime($day)); ?>" <?php
                                  
                                  if($_POST)
                                  {
                                    if($p->delivery_date== $day)
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

                                  ?>><?php echo date('l, d F',strtotime($day));?></option>
                                  
                                <?php   } ?>
                                
                                <optgroup label="....................................." class="vical"></optgroup>
                                
                                <?php
                        
                                    if(!$found)
                                    {
                                      if($_POST)
                                      {
                                        echo '<option value="'.date('d-m-Y',strtotime($p->delivery_date)).'" selected="selected">'.date('l, d F',strtotime($p->delivery_date)).'</option>'."\n";
                                      }
                                      else
                                      {
                                        echo '<option value="'.date('d-m-Y',strtotime($row->delivery_date)).'" selected="selected">'.date('l, d F',strtotime($row->delivery_date)).'</option>'."\n";
                                      }
                                    }
                        
                        
                                ?>
                                
                                <option value="cal"><?php echo lang('View calendar');?></option>
                            </select>
                            <a href="#calendar" name="datepick" id="datepick"><img src="/templates/default/images/cal.gif" style="vertical-align:middle;"/></a>                            
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-control">
                            <label for="occasion_id" class="form-label"><?php echo lang('Occasion');?></label>
                            <div class="form-field">
                                <select name="occasion_id" id="occasion_id">
                                <option value=""><?php echo lang('Select an Occasion');?></option>
                            <?php
                            $occasions = get_occasions();
                            foreach($occasions as $occasion) { ?>
                            <option value="<?php echo $occasion->occasion_id;?>" <?php
                            if($_POST)
                            {
                                if($p->occasion_id===$occasion->occasion_id)
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
                        <div class="form-control">
                            <label for="card_message" class="form-label"><?php echo lang('Message on Card');?></label>
                            <div class="form-field">
                                <textarea name="card_message" id="card_message" rows="11" cols="25"><?php echo $_POST ? $p->card_message:$row->card_message;?></textarea>
                            </div>
                        </div>
                                                                  
                    </div>
                    <div class="buttons">
                        <div class="form-field">
                            <input type="submit" name="checkout" id="checkout" value="<?php echo lang('Update');?>" class="submitbt" />
                        </div>
                </div>
                <?php echo form_close(); ?>
                </div>
            </div>
            
            <div id="calendarwrap">
             
                 
                <!-- #customize your modal window here -->
             
                <div id="calendar" class="window modalwin">
                    <?php
                    
                    $tmonth = date('m',time());
                    $tyear = date('y',time());
                    
                    if($tmonth<12)
                    {
                        $nmonth = $tmonth+1;
                        $nyear = $tyear;
                    }
                    else
                    {
                        $nmonth = 1;
                        $nyear = $tyear+1;
                    }
                    
		    echo showCalendar($row->delivery_method_id,25,date('d-m-Y',strtotime($row->delivery_date)));
                    
                    ?> 
                    <a href="#" class="close"><img src="<?php echo theme_url().'/images/close-button.png';?>" /></a>
             
                </div>
                <!-- Do not remove div#mask, because you'll need it to fill the whole screen --> 

            </div>
            
            <div id="postalcode-info" class="modalwin" style="display:none;">
                    <a href="#" class="closepostal"><img src="<?php echo theme_url();?>/images/close-button.png" /></a>
                    <div id="postalinfo"></div>
            </div>
            
<script>

    $(function(){
       
            //select all the a tag with name equal to modal
         $('#datepick').click(function(e) {
             //Cancel the link behavior
             e.preventDefault();
             //Get the A tag
             var id = $(this).attr('href');
          
             //Get the screen height and width
             var maskHeight = $(document).height();
             var maskWidth = $(window).width();
          
             //Get the window height and width
             var winH = $(window).height();
             var winW = $(window).width();
                    
             //Set the popup window to center
             $(id).css('top',  winH/2-$(id).height()/2);
             $(id).css('left', winW/2-$(id).width()/2);
          
             //transition effect
             $(id).fadeIn(2000); 
          
         });
         
        $("#upcoming").change(function(){
            //$("#special_delivery").removeAttr("checked");                
            var date = $("#upcoming :selected").val();
    
            if(date =='cal'){
                    $('#datepick').trigger("click");
            }
            else if(date =='')
            {
            
            }
            else{
            
                var selected = $("#upcoming :selected").val();
                
                $("#delivery_date").val($("#upcoming :selected").val());
                //$("#show_date").val($("#upcoming :selected").html());
                $('.selected').removeClass('selected');
                $("#"+selected).addClass('selected');
            }
    
        });
         
        $('.daypick').click(function(e){

            e.preventDefault();
    
            $('.window').hide();
                        
       
            //$("#special_delivery").removeAttr("checked");              
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
            $("#delivery_date").val($(this).attr('id'));
            

            
            if(optionExists($(this).attr('id')))
            {

            }
            else
            {

                var sid = $(this).attr('id');
                var name = $(this).attr('name');
                $('<option>').val(sid).text(name).insertAfter('.vical');
            }
            
            $("#upcoming").val($(this).attr('id'));
    
        });
        
        function optionExists(val) {
            $("#upcoming option").filter(function() {
               return this.value === val;
            }).length !== 0;
        }
        
        $('.window .close').click(function (e) {
            //Cancel the link behavior
            e.preventDefault();
            $('.window').hide();
        });
        
        $('.closepostal').click(function (e) {
            //Cancel the link behavior
            e.preventDefault();
            $('#postalcode-info').hide();
        });
        
        $('#postalcode').change(function(){
        
            //Get the screen height and width
              var maskHeight = $(document).height();
              var maskWidth = $(window).width();
           
              //Set height and width to mask to fill up the whole screen
              $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
               
              //transition effect     
              $('#mask').fadeIn(1000);    
              $('#mask').fadeTo("slow",0.8);  
              
                  
                  var id = $(this).attr("id");
                  
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
                          $("#city").val(data.city);
                          $("#province").val(data.province);
                          $("#contry_id").val(data.country);
                          
                          $('#postalcode-info').hide();

                      }
                      else
                      {
                          $('#postalinfo').html(data.message);
                      }
                      
                      
                      
                  },'json');
                  
              });
        
        

});



</script>
            

       