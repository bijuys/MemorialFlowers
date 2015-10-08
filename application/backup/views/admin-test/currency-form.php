<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Currency</h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Currency Info</th>
        </tr>
        <tr>
          <td class="label" width="50%">Currency ID</td>
          <td width="50%"><input name="currency_id" type="text" id="currency_id" value="<?php echo set_value('currency_id',$_POST ? $_POST['currency_id']:(isset($currency) ? $currency->currency_id:''));?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Description</td>
          <td width="50%"><input name="currency_name" type="text" id="currency_name" value="<?php echo set_value('currency_name',$_POST ? $_POST['currency_name']:(isset($currency) ? $currency->currency_name:''));?>" size="35" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Symbol</td>
          <td width="50%"><input name="currency_symbol" type="text" id="currency_symbol" value="<?php echo set_value('currency_symbol',$_POST ? $_POST['currency_symbol']:(isset($currency) ? $currency->currency_symbol:''));?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Prefix</td>
          <td width="50%"><input name="prefix" type="text" id="prefix" value="<?php echo set_value('prefix',$_POST ? $_POST['prefix']:(isset($currency) ? $currency->prefix:''));?>" />
                 &nbsp; Suffix <input name="suffix" type="text" id="suffix" value="<?php echo set_value('suffix',$_POST ? $_POST['suffix']:(isset($currency) ? $currency->suffix:''));?>" />
          </td>
        </tr>   
        <tr>
          <td class="label" width="50%">Exchg Rate</td>
          <td width="50%"><input name="exchange_rate" type="text" id="exhange_rate" value="<?php echo set_value('exhange_rate',$_POST ? $_POST['exchange_rate']:(isset($currency) ? $currency->exchange_rate:''));?>" /></td>
        </tr>     
        <tr>
          <td class="label" width="50%">Base Currency</td>
          <td width="50%"><input type="checkbox" name="base_currency" value="1" id="base_currency" <?php
                if($_POST && isset($_POST['base_currency']))
                {
                  echo 'checked="checked"';
                }
                elseif(isset($currency) && $currency->base_currency==1)
                {
                  echo 'checked="checked"';
                }
          ?> /></td>
         
        </tr>  
        <tr>
          <td>&nbsp;</td>
          <td><input name="id" type="hidden" id="id" value="<?php echo set_value('id',isset($currency)?$currency->currency_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action;?>" /></td>
        </tr>
      </table>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/currencies" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>