<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Color</h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Color Info</th>
        </tr>
        <tr>
          <td class="label" width="50%">Color Name</td>
          <td width="50%"><input name="color_name" type="text" id="color_name" value="<?php echo set_value('color_name',isset($color)?$color->color_name:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Color Code</td>
          <td width="50%"><input name="color_code" type="text" id="color_code" value="<?php echo set_value('color_code',isset($color)?$color->color_code:''); ?>" /></td>
        </tr>
        <tr>
           <td class="label" width="50%">Description</td>
          <td width="50%">
            
            <div id="description-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <textarea name="description" id="description" cols="45" rows="5"><?php echo set_value('description',isset($color)?$color->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" cols="45" rows="5"><?php echo set_value('description_fr',isset($color)?$color->description_fr:''); ?></textarea>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($color) && ($color->banner_id=='0' || $color->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($color) && $color->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
        <tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0" <?php if(($_POST && $_POST['page_id']==0) || (isset($color) && ($color->page_id=='0' || $color->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $color->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($color) && $color->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="color_id" type="hidden" id="color_id" value="<?php echo set_value('color_id',isset($color)?$color->color_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      
      <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/colors" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>