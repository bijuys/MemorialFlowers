<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Reports');?></h1>
          <div class="contents">
            <div id="report-home">
              <?php echo form_open('',array('class'=>'form-horizontal')); ?>
                <h3><?php echo lang('Please choose your filter criteria');?></h3>
                
				
				<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
			  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
			  <link rel="stylesheet" href="/resources/demos/style.css" />
			  <script>
			  $(function() {
				$( "#datepicker1" ).datepicker();
				$( "#datepicker2" ).datepicker();
				
			  });
			  </script>
			
			
			
			
			
			<table style="width:100%; text-align:center; color: #4372AA; vertical-align:middle; height:40px;">
			<tr>
			<td style="vertical-align:middle;">
			
			
				<div style="padding-top:5px;">
					Start Date: &nbsp;&nbsp;<input type="text" name="datepicker1" id="datepicker1" style="height:25px; width:120px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; End Date:&nbsp;&nbsp; <input type="text" name="datepicker2" id="datepicker2" style="height:25px; width:120px;">&nbsp;&nbsp;&nbsp;
					
				</div>
				
			</td>
			</tr>
			</table>
				
				
                <div class="control-group" style="display:none;">
                  <label class="control-label"><?php echo lang('Enter Start Date');?></label>
                  
                  <div class="controls">
                      <select name="start_month" id="start_month" class="input-small">
                            <option value="01" selected="selected" >Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                          </select>
                          
                          <select name="start_day" id="start_day" class="input-small">
                            <option selected="selected" value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
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
                          
                          <select name="start_year" id="start_year" class="input-small">
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
                <div class="control-group" style="display:none;">
                  <label class="control-label"><?php echo lang('Enter End Date');?></label>
                  <div class="controls">
                        <select name="end_month" id="end_month" class="input-small">
                                                                <option value="01">Jan</option>
                                                                <option value="02">Feb</option>
                                                                <option value="03">Mar</option>
                                                                <option value="04">Apr</option>
                                                                <option value="05">May</option>
                                                                <option value="06">Jun</option>
                                                                <option value="07">Jul</option>
                                                                <option value="08">Aug</option>
                                                                <option value="09">Sep</option>
                                                                <option value="10">Oct</option>
                                                                <option value="11">Nov</option>
                                                                <option value="12" selected="selected">Dec</option>
                                  
                          </select>
                      
                          <select name="end_day" id="end_day" class="input-small">
                                                                <option value="01">1</option>
                                                                <option value="02">2</option>
                                                                <option value="03">3</option>
                                                                <option value="04">4</option>
                                                                <option value="05">5</option>
                                                                <option value="06">6</option>
                                                                <option value="07">7</option>
                                                                <option value="08">8</option>
                                                                <option value="09">9</option>
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
                                                                <option value="31" selected="selected">31</option>
                                    
                          </select>
                      
                          <select name="end_year" id="end_year" class="input-small">
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
                <br />
                <div class="control-group">
                  <label class="control-label"><?php echo lang('Report Type');?></label>
                  <div class="controls">
				    <label class="radio"><input type="radio" checked="checked" value="sales" name="report_type" id="report_type"> <?php echo lang('Sales');?></label>
                    <label class="radio"><input type="radio" value="product" name="report_type" id="report_type"> <?php echo lang('Product');?></label>
                   
                    <!--<label class="radio"><input type="radio" value="customer" name="report_type"> <?php echo lang('Customer');?></label> 
                    <label class="radio"><input type="radio" value="occassion" name="report_type" id="report_type"> <?php echo lang('Occassion');?></label>
                    <label class="radio"><input type="radio" value="yearly" name="report_type" id="report_type"> <?php echo lang('Yearly');?></label>
                    <label class="radio"><input type="radio" value="monthly" name="report_type" id="report_type"> <?php echo lang('Monthly');?></label>
                    <label class="radio"><input type="radio" value="daily" name="report_type" id="report_type"><?php echo lang('Daily');?></label>       -->             
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
