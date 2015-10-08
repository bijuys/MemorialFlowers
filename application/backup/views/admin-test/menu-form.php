<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Navigation Menu</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Menu Info</th>
        </tr>
        <tr>
          <td class="label">Menu Name</td>
          <td><input name="menu" type="text" id="menu" value="<?php echo set_value('menu',isset($menu)?$menu->menu:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Place Holder</td>
          <td>
            <select name="holder">
              <?php if(count($holders)) { foreach($holders as $holder) { ?>
              <option <?php if(isset($_POST['holder']) && $_POST['holder']==$holder) { echo 'selected="selected"'; }
              elseif(isset($menu) && $menu->holder==$holder) { echo 'selected="selected"'; } ?>><?php echo $holder; ?></option>
              <?php } }?>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="menu_id" type="hidden" value="<?php echo set_value('menu_id',isset($menu)?$menu->menu_id:'0'); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/menu" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>