<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Banner</h2>
    <?php echo form_open_multipart(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Banner Info</th>
        </tr>
        <tr>
          <td class="label">Banner Name</td>
          <td><input name="banner_name" type="text" id="banner_name" value="<?php echo set_value('banner_name',isset($banner)?$banner->banner_name:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Banner Image</td>
          <td>
            
            <div id="description-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <input name="banner_file" type="file" id="banner_file" />
              </div>
              <div id="desctab-2">
                <input name="banner_file_fr" type="file" id="banner_file_fr" />
              </div>
            </div>
            
          </td>
        </tr>
        <?php if(isset($banner) && $banner->banner_file!='') { ?>
        <tr>
          <td class="label">Current File</td>
          <td align="center">
            <?php echo $banner->banner_file_fr ? getimg('banners/'.$banner->banner_file, '200x100'):'';?>
            <?php echo $banner->banner_file_fr ? getimg('banners/'.$banner->banner_file_fr, '200x100'):'';?>
          </td>
        </tr>
        <?php } ?>
        <tr>
          <td class="label">Banner Link to</td>
          <td><input name="link_to" type="text" size="35" id="link_to" value="<?php echo set_value('link_to',isset($banner)?$banner->link_to:''); ?>" /></td>
        </tr>
        <!--
        <tr>
          <td class="label" valign="top">Assign to Pages</td>
          <td>
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
      <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/banners" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>