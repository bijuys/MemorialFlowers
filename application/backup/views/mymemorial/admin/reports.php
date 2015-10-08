<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers Orders</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Sales Report</h1>
      </div>
      <div id="content" class="clearfix">
      <div id="tableheader">Select Report Options</div>
            <form action="" method="post" name="form1">
              <table cellspacing="0" cellpadding="0" border="0" align="center" id="form_table" class="reportoptions">
              <tbody>
                <tr>
                   <th colspan="2"><?php echo lang('please-choose-your-filter-criteria');?></th>
              </tr>
              <tr>
                   <td class="right">Start Date</td>
                   <td>
                          <select name="start_month">
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
                          
                          <select name="start_day">
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
                          
                          <select name="start_year">
                                                                <option value="2010">2010</option>
                                                                <option value="2011">2011</option>
                                                                <option selected="selected" value="2012">2012</option>
                                  
                          </select>
                      
                   </td>
              </tr>
              <tr>
                      <td class="right">End Date</td>
                      <td>
                         <select name="end_month">
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
                      
                          <select name="end_day">
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
                      
                          <select name="end_year">
                                                                <option value="2010">2010</option>
                                                                <option value="2011">2011</option>
                                                                <option selected="selected" value="2012">2012</option>
                                       
                          </select>
                                            
                                            
                      </td>
              </tr>
              <tr>
                      <td valign="top" class="right"><?php echo lang('report-type');?></td>
                      <td><input type="radio" checked="checked" value="product" name="report_type">Products<br>
                      <input type="radio" value="sales" name="report_type">Sales<br>
                      <input type="radio" value="customer" name="report_type">Customer<br>
                      <input type="radio" value="affiliate" name="report_type">Affiliates<br>
                      <input type="radio" value="occassion" name="report_type">Occassion<br>
                      <input type="radio" value="province" name="report_type">Provinces<br>
                      <input type="radio" value="city" name="report_type">Cities<br>
                      <input type="radio" value="yearly" name="report_type">Yearly<br>
                      <input type="radio" value="monthly" name="report_type">Monthly<br>
                      <input type="radio" value="daily" name="report_type">Daily<br>
                      
                      </td>
              </tr>
              <tr>
                   <td>&nbsp;<input type="hidden" value="1" name="step"></td>
                   <td> <input type="submit" value="Go" name="navigate"></td>
                   <td><input type="hidden" value="1" name="page"></td>
              </tr>
              
            </tbody>
              
            </table>  
                
                
            </form> 
      </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.order.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
