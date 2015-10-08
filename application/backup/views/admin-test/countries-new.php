<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Enter Country Info</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Country Info
            </th>
          </tr>
        <tr>
          <td class="label">Country Code</td>
          <td><input name="short_code" type="text" id="short_code" maxlength="7" value="<?php echo set_value('short_code',$country->short_code); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Country Name</td>
          <td><input name="country_name" type="text" id="country_name" maxlength="45" value="<?php echo set_value('country_name',$country->country_name); ?>" /></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="country_id" type="hidden" value="<?php echo set_value('country_id',$country->country_id); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>