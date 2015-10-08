<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Create Delivery Location');?></h1>
          <div class="contents clearfix">
            <div class="section">
             
              <div>
                <?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
                <?php if(validation_errors()) echo '<ul class="errlist">'.validation_errors().'</ul>'; ?>
                <div class="formdiv">
                  
				  <?php echo form_open('mymemorial/addresses/new_address','class="common_form"'); ?>
                    <div class="row-fluid">
                      
                  <div class="span12 form-horizontal" style="margin-top:20px;">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Address Name');?></label>
                    <div class="controls">
                      <input type="text" name="name" id="name" value="" size="25" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Address');?></label>
                    <div class="controls">
                      <input type="text" name="address" id="address" value="" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('City');?></label>
                    <div class="controls">
                      <input type="text" name="city" id="city" value="" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Postalcode');?></label>
                    <div class="controls">
                      <input type="text" name="postalcode" id="postalcode" value="" />
                      </div>
                    </div>                 
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Province');?></label>
                    <div class="controls">
                      <select name="province" id="province">
                      <option value=""><?php echo lang('select_one');?></option>
                      <?php foreach($provinces as $row) :?>
                        <option value="<?php echo substr($row->short_code,3,2); ?>"><?php echo $row->province_name;?></option>                      
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
                        <option value="<?php echo $row->country_id;?>"><?php echo $row->country;?></option>                      
                      <?php endforeach; ?>
                      </select>
                      </div>
                      </div>
                  </div>
                  <div class="span12 form-horizontal" style="margin-top:20px;">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Contact Person');?></label>
                    <div class="controls">
                      <input type="text" name="contact_firstname" id="contact_firstname" value="" size="25" />
                    <input type="text" name="contact_lastname" id="contact_lastname" value="" size="25" />
                      </div>
                    </div>  
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Phone');?></label>
                    <div class="controls">
                      <input type="text" name="phone" id="phone" value="" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Email');?></label>
                    <div class="controls">
                      <input type="text" name="email" id="email" value="" size="25" />
                      </div>
                    </div>
                  
                  <div class="control-group">
                      <div class="controls">
                     <input type="submit" name="submit" value="<?php echo lang('Create Address');?>" class="btn btn-inverse" />
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