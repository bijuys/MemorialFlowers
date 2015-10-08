            <div class="ajax-edit">
                <?php $msg = $this->session->flashdata('message');
                    if(!empty($msg)) { ?>
                <div id="messenger"><?php echo $msg; ?></div>                    
                <?php }  ?>
                <?php echo form_open('#',array('class'=>'common_form clearfix','id'=>'ebilling')); ?>

                    <h3><?php echo lang('Edit Billing Details');?></h3>
                    <div class="form-control <?php highlightclass(form_error("firstname")); ?>">
                        <label for="firstname" class="form-label"><?php echo lang('First Name');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:$billing->firstname;?>" class="big" />                        
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("lastname")); ?>">
                        <label for="lastname" class="form-label"><?php echo lang('Last Name');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:$billing->lastname;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("address1")); ?>">
                        <label for="address1" class="form-label"><?php echo lang('Address Line 1');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:$billing->address1;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("address2")); ?>">
                        <label for="address2" class="form-label"><?php echo lang('Address Line 2');?></label>
                        <div class="form-field">
                            <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:$billing->address2;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("postalcode")); ?>">
                        <label for="postalcode" class="form-label"><?php echo lang('Postal Code');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:$billing->postalcode;?>" class="short" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("city")); ?>">
                        <label for="city" class="form-label"><?php echo lang('City');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:$billing->city;?>" size="30" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("province")); ?>">
                        <label for="province" class="form-label"><?php echo lang('Province/State');?><span class="mandatory">*</span></label>
                        <div class="form-field">
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
                    <div class="form-control <?php highlightclass(form_error("country_id")); ?>">
                        <label for="country_id" class="form-label"><?php echo lang('Country');?><span class="mandatory">*</span></label>
                        <div class="form-field">
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
                    <div class="form-control <?php highlightclass(form_error("email")); ?>">
                        <label for="email" class="form-label"><?php echo lang('Email');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:$billing->email;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("dayphone")); ?>">
                        <label for="dayphone" class="form-label"><?php echo lang('Day Phone');?><span class="mandatory">*</span></label>
                        <div class="form-field">
                            <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:$billing->dayphone;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control <?php highlightclass(form_error("evephone")); ?>">
                        <label for="evephone" class="form-label"><?php echo lang('Evening Phone');?></label>
                        <div class="form-field">
                            <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:$billing->evephone;?>" class="big" />
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="form-field">
                            <input type="submit" name="submit" value="Update" />
                        </div>                         
                    </div>
                    

                <?php echo form_close(); ?>
                
            </div>
            

       