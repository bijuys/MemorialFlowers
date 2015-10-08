<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Banner</h2>
    <?php echo form_open_multipart(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Tile Banner Info</th>
        </tr>
        <tr>
          <td class="label" width="50%">Tile Banner Name</td>
          <td width="50%"><input name="banner_name" type="text" id="banner_name" value="<?php echo set_value('banner_name',isset($banner)?$banner->banner_name:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Tile Image</td>
          <td width="50%"><input name="banner_file" type="file" id="banner_file" /></td>
        </tr>
        <?php if(isset($banner) && $banner->banner_file!='') { ?>
        <tr>
          <td colspan="2" align="center"><img src="/banners/<?php echo $banner->banner_file;?>" /></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="label" width="50%">Tile Banner Link to</td>
          <td width="50%"><input name="link_to" type="text" size="35" id="link_to" value="<?php echo set_value('link_to',isset($banner)?$banner->link_to:''); ?>" /></td>
        </tr>
        <!--
        <tr>
          <td class="label" width="50%" valign="top">Assign to Pages</td>
          <td width="50%">
            <select multiple="multiple" name="pages[]" id="pages">
            
            <?php /* foreach($pages as $page)
            {
              echo '<option value="'.$page->page_id.'">';
              if($this->input->post())
              {
                if($page->banner_id<>NULL) { echo '&#42;'; }                
              }
              elseif(isset($banner))
              {
                if($page->banner_id<>NULL) { echo '&#42;'; }               
              }
              else
              {
                if($page->banner_id<>NULL) { echo '&#42;'; }                  
              }

              echo $page->page_name;
              echo '</option>'."\n";
             
            } */
            ?>
          </select>
           <br/>&#42; <small>Already assigned </small>
          </td>
        </tr>
        //-->
        <tr>
          <td>&nbsp;</td>
          <td><input name="banner_id" type="hidden"  id="banner_id" value="<?php echo set_value('banner_id',isset($banner)?$banner->banner_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/tiles" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>