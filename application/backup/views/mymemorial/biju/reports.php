<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Reports');?></h1>
          <div class="contents">
            <div id="report-home">
              <?php echo form_open('',array('class'=>'form-horizontal')); ?>
                <h3><?php echo lang('Please choose your filter criteria');?></h3>
                
                <div class="control-group">
                  <label class="control-label"><?php echo lang('Enter Start Date');?></label>
                  
                  <div class="controls">
                      <select name="start_month" class="input-small">
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option selected="selected" value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                          </select>
                          
                          <select name="start_day" class="input-small">
                            <option selected="selected" value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                                    
                          </select>
                          
                          <select name="start_year" class="input-small">
                            <?php
                                    $currenty = date('Y',time());
                                    
                                    for($y=2010; $y<=$currenty; $y++) : ?>
                            
                                        <option value="<?php echo $y;?>" <?php
                                        
                                          if($y==$currenty) { echo ' selected="selected" '; }
                                        
                                        ?>><?php echo $y;?></option>
                                                                
                            <?php   endfor; ?>
                                  
                          </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><?php echo lang('Enter End Date');?></label>
                  <div class="controls">
                        <select name="end_month" class="input-small">
                                                                <option value="1">Jan</option>
                                                                <option value="2">Feb</option>
                                                                <option value="3">Mar</option>
                                                                <option value="4">Apr</option>
                                                                <option value="5">May</option>
                                                                <option value="6">Jun</option>
                                                                <option value="7">Jul</option>
                                                                <option value="8">Aug</option>
                                                                <option value="9">Sep</option>
                                                                <option selected="selected" value="10">Oct</option>
                                                                <option value="11">Nov</option>
                                                                <option value="12">Dec</option>
                                  
                          </select>
                      
                          <select name="end_day" class="input-small">
                                                                <option value="1">1</option>
                                                                <option selected="selected" value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                    
                          </select>
                      
                          <select name="end_year" class="input-small">
                            <?php
                                    $currenty = date('Y',time());
                                    
                                    for($y=2010; $y<=$currenty; $y++) : ?>
                            
                                        <option value="<?php echo $y;?>" <?php

                                          if($y==$currenty) { echo ' selected="selected" '; }
                                        
                                        ?>><?php echo $y;?></option>
                                                                
                            <?php   endfor; ?>
                                       
                          </select>
                    
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label"><?php echo lang('Report Type');?></label>
                  <div class="controls">
                    <label class="radio"><input type="radio" checked="checked" value="product" name="report_type"> <?php echo lang('Product');?></label>
                    <label class="radio"><input type="radio" value="sales" name="report_type"> <?php echo lang('Sales');?></label>
                    <!--<label class="radio"><input type="radio" value="customer" name="report_type"> <?php echo lang('Customer');?></label> //-->
                    <label class="radio"><input type="radio" value="occassion" name="report_type"> <?php echo lang('Occassion');?></label>
                    <label class="radio"><input type="radio" value="yearly" name="report_type"> <?php echo lang('Yearly');?></label>
                    <label class="radio"><input type="radio" value="monthly" name="report_type"> <?php echo lang('Monthly');?></label>
                    <label class="radio"><input type="radio" value="daily" name="report_type"><?php echo lang('Daily');?></label>                    
                  </div>                  
                </div>
                
                <div class="control-group">
                  
                  <div class="controls">
                      <input type="hidden" value="1" name="step">
                      <button type="submit" name="navigate" class="btn btn-success">Get Report</button>
                      <input type="hidden" value="1" name="page">
                  </div>
                </div>              
                
              </form>                        
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
