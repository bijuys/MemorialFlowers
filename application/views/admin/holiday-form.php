<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Holiday</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Holiday Info</th>
        </tr>
        <tr>
          <td>Holiday</td>
          <td><input name="occasion_name" type="text" id="country_id" value="<?php echo set_value('occasion_name',isset($holiday)?$holiday->occasion_name:''); ?>" /></td>
        </tr>
        <tr>
          <td>Date</td>
          <td><select name="occasion_day" id="occasion_day">
          <?php for($i=1;$i<=31;$i++): ?>
          	<option value="<?php echo sprintf("%02d",$i);?>" <?php $oday = isset($holiday->occasion_day)?$holiday->occasion_day:set_value('occasion_day'); echo ($oday==$i) ? 'selected="selected"':''; echo $oday; ?>><?php echo sprintf("%02d",$i);?></option>
          <?php endfor; ?>
          </select>
            <select name="occasion_month" id="occasion_month">
 		<?php for($i=1;$i<=12;$i++): ?>
          	<option value="<?php echo sprintf("%02d",$i);?>" <?php $omon = isset($holiday->occasion_month)?$holiday->occasion_month:set_value('occasion_month'); echo ($omon==$i) ? 'selected="selected"':''; echo $oday; ?>><?php echo date('M',strtotime('01-'.sprintf("%02d",$i).'-2001'));?></option>
          <?php endfor; ?>
         </select></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="occasion_id" type="hidden" value="<?php echo set_value('occasion_id',isset($holiday)?$holiday->occasion_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php echo $this_class;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>