<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Location Group</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Location Group Info</th>
        </tr>
        <tr>
          <td class="label">Group Name</td>
          <td><input name="group_name" type="text" id="category_id" value="<?php echo set_value('group_name',isset($group)?$group->group_name:''); ?>" size="35" /></td>
        </tr>
         <tr>
          <td valign="top" class="label">Select Countries</td>
          <td>
          <div class="scroll_win" style="height:150px;">
          <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="2">Country</th>
                <th>Shipping</th>
                <th align="center" nowrap="nowrap">Tax %</th>
               </tr> 
            	<?php foreach($countries as $row): ?>               
              <tr>
                <td><input name="country_id[<?php echo $row->country_id;?>]" type="checkbox" value="1" <?php 
				
					$cship = isset($_POST['country_shipping']) ? $_POST['country_shipping'][$row->country_id]:'';
					$ctax = isset($_POST['country_tax']) ? $_POST['country_tax'][$row->country_id]:'';
					
					echo isset($_POST['country_id'][$row->country_id]) ? 'checked="checked"':'';

					if(isset($group) && count($group->country_id)) 
					{
				
						foreach($group->country_id as $crow)
						{
							if($row->country_id == $crow->location_id)
							{
								echo 'checked="checked"';
								$cship = $crow->location_shipping;
								$ctax = $crow->location_tax;
							}
						}			
					}				
				 ?> /></td>
                <td nowrap="nowrap"><?php echo $row->country_name; ?></td>
                <td><input name="country_shipping[<?php echo $row->country_id;?>]" type="text" id="country_shipping[<?php echo $row->country_id;?>]" size="5" value="<?php echo isset($cship) ? $cship:'';?>" /></td>
                <td><input name="country_tax[<?php echo $row->country_id;?>]" type="text" id="country_tax[<?php echo $row->country_id;?>]" size="5" value="<?php echo isset($ctax) ? $ctax:'';?>" /></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>            </td>
        </tr>
        <tr>
          <td valign="top" class="label">Select Provinces</td>
          <td><div class="scroll_win" style="height:150px;">
            <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="2">Province</th>
                <th>Shipping</th>
                <th align="center" nowrap="nowrap">Tax %</th>
               </tr> 
              <?php foreach($provinces as $row): ?>
              <tr>
                <td><input name="province_id[<?php echo $row->province_id;?>]" type="checkbox" id="province_id[<?php echo $row->province_id;?>]" value="1" <?php 
				
					$pship = isset($_POST['province_shipping']) ? $_POST['province_shipping'][$row->province_id]:'';
					$ptax = isset($_POST['province_tax']) ? $_POST['province_tax'][$row->province_id]:'';
					
					echo isset($_POST['province_id'][$row->province_id]) ? 'checked="checked"':'';
					
					if(isset($group)) 
					{
						foreach($group->province_id as $prow)
						{
							if($row->province_id == $prow->location_id)
							{
								echo 'checked="checked"';
								$pship = $prow->location_shipping;
								$ptax = $prow->location_tax;
							}
						}			
					}				
				 ?>/></td>
                <td nowrap="nowrap"><?php echo $row->province_name; ?></td>
                <td><input name="province_shipping[<?php echo $row->province_id;?>]" type="text" id="province_shipping[<?php echo $row->province_id;?>]" size="5" value="<?php echo $pship;?>" /></td>
                <td><input name="province_tax[<?php echo $row->province_id;?>]" type="text" id="province_tax[<?php echo $row->province_id;?>]" size="5"  value="<?php echo $ptax;?>" /></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="group_id" type="hidden" id="group_id" value="<?php echo isset($group) ? $group->group_id:($_POST ? $_POST['group_id']:'');  ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php $this_class;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>