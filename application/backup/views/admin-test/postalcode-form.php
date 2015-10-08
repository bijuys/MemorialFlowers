<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Enter Postalcode</h2>
    <?php echo form_open(current_url());?>
  <?php echo set_value('button') ? validation_errors():''; ?>
  <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <td>Country </td>
          <td><select name="country_id" onchange="javascript:document.location.href('<?php echo site_url("/siteadmin/postalcodes/create/");?>');">
          <?php foreach($countries as $country) { ?>
              <option value="<?php echo $country->country_id;?>" <?php $cid = isset($city->country_id) ? $city->country_id:set_value('country_id'); echo $cid==$country->country_id ? 'selected="selected"':'';?>><?php echo $country->country_name;?></option>          
          <?php } ?>          
          </select>          </td>
        </tr>
        <tr>
          <td>Province</td>
          <td><select name="province_id" onchange="javascript:this.form.submit();">
            <?php foreach($provinces as $sprovince) { ?>
     <option value="<?php echo $sprovince->province_id;?>"  <?php $pid = isset($city->province_id) ? $city->province_id:set_value('province_id'); echo $pid==$sprovince->province_id ? 'selected="selected"':'';?>><?php echo $sprovince->province_name;?></option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>City</td>
          <td><select name="city_id" id="city_id" onchange="javascript:this.form.submit();">
            <?php foreach($cities as $city) { ?>
            <option value="<?php echo $city->city_id;?>"  <?php $tid = isset($postalcode->city_id) ? $postalcode->city_id:set_value('city_id'); echo $tid==$city->city_id ? 'selected="selected"':'';?>><?php echo $city->city_name;?></option>
            <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>Postalcode</td>
          <td><input name="postalcode" type="text" id="postalcode" maxlength="45" value="<?php echo isset($city->city_name) ? $city->city_name:set_value('city_name'); ?>" /></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="city_id" type="hidden" value="<?php echo isset($city->city_id) ? $city->city_id:set_value('city_id'); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>