<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Enter Province Info</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors();   ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">
            Enter Province Info
            </th>
          </tr>
        <tr>
          <td class="label" width="50%">Country </td>
          <td width="50%"><select>
          <?php foreach($countries as $country) { ?>
              <option value="<?php echo $country->country_id;?>"><?php echo $country->country_name;?></option>          
          <?php } ?>          
          </select>
          </td>
        </tr>
        <tr>
          <td class="label">Province Name</td>
          <td><input name="province_name" type="text" id="province_name" maxlength="45" value="<?php echo set_value('province_name',$province->province_name); ?>" /></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="province_id" type="hidden" value="<?php echo set_value('province_id',$province->province_id); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>