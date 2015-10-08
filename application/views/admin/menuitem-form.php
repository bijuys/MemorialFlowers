<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Menu Item</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Menu Item Info</th>
        </tr>
        <tr>
          <td class="label">Menu Item Name</td>
          <td><input name="menuitem" type="text" id="menuitem" value="<?php echo set_value('menuitem',isset($item)?$item->menuitem:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Prent Item</td>
          <td><select name="parent_id">
              <option value="0">No Parent</option>
              <?php foreach($menuitems as $mi) { ?>
              <option value="<?php echo $mi->menuitem_id;?>"
                                   <?php
                                   
                                   if($_POST)
                                   {
                                     echo $_POST['parent_id']==$mi->menuitem_id ? 'selected="selected"':'';
                                   }
                                   elseif(isset($item))
                                   {
                                     echo $item->parent_id==$mi->menuitem_id ? 'selected="selected"':'';                                    
                                   }
                                   
                                   ?>><?php echo $mi->menuitem;?></option> 
              <?php } ?>
              </select>
          </td>
        </tr>
        <tr>
          <td class="label">Link To</td>
          <td><select name="menu_type">
              <option value="#">Custom Link</option>
              <?php
              $optstart = FALSE;
              foreach($menutypes as $key=>$val) {
                if(is_numeric($key)) {
                  if($optstart)
                  {
                    echo '</optgroup>';
                    $optstart = FALSE;
                  }
                 
                  echo '<optgroup label="'.$val.'">';
                  $optstart = TRUE;
                }
                else
                { ?>
              <option value="<?php echo $val;?>" <?php
              if($_POST)
              {
                echo $_POST['menu_type']==$val ? 'selected="selected"':'';
              }
              elseif(isset($item))
              {
                echo $item->menulink==$val ? 'selected="selected"':'';  
              }
              ?>><?php echo $key;?></option>
              <?php }
                  if($optstart)
                  {
                    echo '</optgroup>';
                    $optstart = FALSE;
                  }
              } ?>
              </select>
          </td>
        </tr>
        <tr>
          <td class="label">Custom Link</td>
          <td><input name="menulink" type="text" id="menulink" value="<?php echo set_value('menulink',isset($item)?$item->menulink:''); ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="label">Sort Order</td>
          <td><input name="sort_order" type="text" id="sort_order" value="<?php echo set_value('sort_order',isset($item)?$item->sort_order:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Menu Item Width<br/>(For example: 150px, 10%...)</td>
          <td><input name="width" type="text" id="width" value="<?php echo set_value('width',isset($item)?$item->width:''); ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="menuitem_id" type="hidden" value="<?php echo set_value('menuitem_id',isset($item)?$item->menuitem_id:'0'); ?>" />
          <input type="hidden" name="menu_id" value="<?php echo $menu->menu_id;?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/menu/items/<?php echo $menu->menu_id;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>