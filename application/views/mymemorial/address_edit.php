<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Edit Delivery Location');?></h1>
          <div class="contents clearfix">
            <div class="section">
             
              <div>
                <?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
                <?php if(validation_errors()) echo '<ul class="errlist">'.validation_errors().'</ul>'; ?>
                <div class="formdiv">
                  <form action="http://new.memorialflowers.ca/mymemorial/addresses/update/<?php echo $address->location_id; ?>" method="post" accept-charset="utf-8" class="horizontal">
                    <div class="row-fluid">
                      
                  <div class="span12 form-horizontal" style="margin-top:20px;">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Address Name');?></label>
                    <div class="controls">
                      <input type="text" name="name" id="name" value="<?php echo $address->name;?>" size="25" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Address');?></label>
                    <div class="controls">
                      <input type="text" name="address" id="address" value="<?php echo $address->address;?>" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('City');?></label>
                    <div class="controls">
                      <input type="text" name="city" id="city" value="<?php echo $address->city;?>" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Postalcode');?></label>
                    <div class="controls">
                      <input type="text" name="postalcode" id="postalcode" value="<?php echo $address->postalcode;?>" />
                      </div>
                    </div>                 
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Province');?></label>
                    <div class="controls">
                      <select name="province" id="province">
                      <option value=""><?php echo lang('select_one');?></option>
                      <?php foreach($provinces as $row) :?>
                        <option value="<?php echo substr($row->short_code,3,2); ?>" <?php
                          if($address->province==substr($row->short_code,3,2))
                          {
                            echo 'selected="selected"';
                          }
                        
                        ?>><?php echo $row->province_name;?></option>                      
                      <?php endforeach; ?>
                    </select>
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                        <select name="country" id="country">
                          <option value="1">Canada</option>
                        <option value="">Select One</option>
                      <?php foreach($countries as $row) :?>
                        <option value="<?php echo $row->country_id;?>" <?php
                      
                          if($settings->user_country_id==$row->country_id)
                          {
                            echo 'selected="selected"';
                          }                       
                        
                        ?>><?php echo $row->country;?></option>                      
                      <?php endforeach; ?>
                      </select>
                      </div>
                      </div>
                  </div>
                  <div class="span12 form-horizontal" style="margin-top:20px;">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Contact Person');?></label>
                    <div class="controls">
                      <input type="text" name="contact_firstname" id="contact_firstname" value="<?php echo $address->contact_firstname;?>" size="25" />
                    <input type="text" name="contact_lastname" id="contact_lastname" value="<?php echo $address->contact_lastname;?>" size="25" />
                      </div>
                    </div>  
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Phone');?></label>
                    <div class="controls">
                      <input type="text" name="phone" id="phone" value="<?php echo $address->phone;?>" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Email');?></label>
                    <div class="controls">
                      <input type="text" name="email" id="email" value="<?php echo $address->email;?>" size="25" />
                      </div>
                    </div>
                  
                  <div class="control-group">
                      <div class="controls">
                     <input type="submit" name="submit" value="<?php echo lang('Update Address');?>" class="btn btn-inverse" />
                      </div>
                      </div>
                  </div>
                    </div>
                  </form>
                </div><!-- Form Div //-->
              </div>              
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once(APPPATH.'views/footer.php'); ?>