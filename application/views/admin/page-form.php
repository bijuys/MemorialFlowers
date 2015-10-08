<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php 
	
	if($page->page_id==8){
		
		echo 'Home Page SEO Content';
		
	}else{
	
	echo $action.' Page'; } ?> </h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Page Details</th>
        </tr>
        <tr>
          <td class="label">Page Name</td>
          <td><input name="page_name" type="text" id="page_name" value="<?php echo set_value('page_name',isset($page)?$page->page_name:''); ?>" size="40" /></td>
        </tr>
        <?php if(isset($page) && $page->core) { ?>
        <input name="page_handle" type="hidden" id="page_handle" value="<?php echo set_value('page_handle',isset($page)?$page->page_handle:''); ?>" />
        <?php }
        else
        { ?>
        <tr>
          <td class="label">Unique Handle</td>
          <td><input name="page_handle" type="text" id="page_handle" value="<?php echo set_value('page_handle',isset($page)?$page->page_handle:''); ?>" /></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="label">H1 Text</td>
          <td>
            <div id="htabs">
              <ul class="multilangsel">
                  <li><a href="#htab-1">English</a></li>
                  <li><a href="#htab-2">French</a></li>
              </ul>
              <div id="htab-1">
                <input name="h1" type="text" id="h1" value="<?php echo set_value('h1',isset($page)?$page->h1:''); ?>" size="120" />
              </div>
              <div id="htab-2">
                <input name="h1_fr" type="text" id="h1_fr" value="<?php echo set_value('h1_fr',isset($page)?$page->h1_fr:''); ?>" size="120" />
              </div>
            </div> 
          </td>
        </tr>
        <tr>
          <td class="label" valign="top">Contents English</td>
          <td> 
            <div id="contents-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <textarea name="contents" cols="60" rows="15" id="contents" class="ckeditor"><?php echo set_value('contents',isset($page)?$page->contents:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="contents_fr" cols="60" rows="15" id="contents_fr" class="ckeditor"><?php echo set_value('contents_fr',isset($page)?$page->contents_fr:''); ?></textarea>
              </div>
            </div> 
          </td>
        </tr>
        <tr>
          <td class="label" valign="top">Content Placement</td>
          <td>
            
            <input type="radio" name="content_position" value="top" <?php
              
            if($_POST && $_POST['content_position']=='top')
              echo 'checked="checked"';
            elseif(isset($page) && $page->content_position=='top')
            {
              echo 'checked="checked"';
            }  
            
            ?>>Top
            
            <input type="radio" name="content_position" value="bottom" <?php
          
            if(!$_POST && !isset($page))
            {
              echo 'checked="checked"';
            }
            elseif($_POST)
            {
              if($_POST['content_position']=='bottom')
              {
                echo 'checked="checked"'; 
              }
            }
            elseif(isset($page))
            {
              if($page->content_position=='bottom')
              {
                echo 'checked="checked"';
              }
            }
          
          
          ?>>Bottom</td>
        </tr>
        <tr>
          <td class="label" valign="top">Title English</td>
          <td>
            <div id="title-tabs">
              <ul class="multilangsel">
                  <li><a href="#titletab-1">English</a></li>
                  <li><a href="#titletab-2">French</a></li>
              </ul>
              <div id="titletab-1">
                <input name="page_title" type="text" id="page_title" value="<?php echo set_value('page_title',isset($page)?$page->page_title:''); ?>" size="60" />
              </div>
              <div id="titletab-2">
                <input name="page_title_fr" type="text" id="page_title_fr" value="<?php echo set_value('page_title_fr',isset($page)?$page->page_title_fr:''); ?>" size="60" />
              </div> 
            </td>
        </tr>

        <tr>
          <td class="label" valign="top">Description</td>
          <td><textarea name="description" cols="60" rows="3" id="description"><?php echo set_value('description',isset($page)?$page->description:''); ?></textarea></td>
        </tr>
        <tr>
          <td class="label" valign="top">Keywords</td>
          <td><textarea name="keywords" cols="60" rows="3" id="keywords"><?php echo set_value('keywords',isset($page)?$page->keywords:''); ?></textarea></td>
        </tr>
        <tr>
          <td class="label" valign="top">Canonical Link</td>
          <td><input name="canonical" type="text" id="canonical" value="<?php echo set_value('canonical',isset($page)?$page->canonical:''); ?>" size="40" />
              (Leave Blank for auto update)
          </td>
        </tr> 
        <tr>
          <td class="label" valign="top">Banner Image</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($page) && ($page->banner_id=='0' || $page->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($page) && $page->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="page_id" type="hidden" id="page_id" value="<?php echo set_value('page_id',isset($page)?$page->page_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      
      <script>
          $(function() {
              $("#contents-tabs" ).tabs();
              $("#title-tabs" ).tabs();
              $("#htabs" ).tabs();
          });
      </script>
      
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php echo strtolower($this_class);?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>