<?php $js = '<script language="javascript" src="/js/jquery.js" type="text/javascript"></script>'; ?>
<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
<script>
<!--

$(document).ready(function(){
    
  $("#category_id").change(function(){
    
    var current = 0;
      
    $("#category_id option").each(function(){
      
      if($(this).attr('selected'))
      {
	current = $(this).val();
      }
      
    });

    $("#subcategory_id option").each(function(){
      
      $(this).removeAttr('disabled');
      $(this).css('display','');
      
      if($(this).attr('id')==current)
      {

      }
      else
      {
	$(this).attr('disabled','disabled');
	$(this).css('display','none');
	$(this).removeAttr('selected'); 
      }
    });      
    
  });
  
  $('#category_id').trigger('change');


  $("#product_name").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#product_name_fr").val(data);
      });
  });

  $("#product_description").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#product_description_fr").val(data);
      });
  }); 
  
  $("#landing_name").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#landing_name_fr").val(data);
      });
  });
  
  $("#delivery_method_id").change(function(){
      var pol = $("#delivery_method_id option:selected").attr('class');
      var policies = pol.split('|');
      
      $("#delivery_policy_id").val(policies[0]+"");
      $("#substitution_policy_id").val(policies[1]+"");
  }).trigger('change');
  
  
  
})


//-->
</script>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Landing Page
    
    
    
   
    
    </h2>
    <?php  echo form_open_multipart(current_url()); ?>
    <?php echo validation_errors(); ?>
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Landing Page Info</th>
        </tr>
        <tr>
          
          
          <input type="hidden" name="landing_id" id="landing_id" value="<?php echo isset($lan) ? $lan->landing_id: $_POST['landing_id']; ?>">

          
          
          <td>Select a Landing Group</td>
          <td><select name="landing_group" id="landing_group"  tabindex="3" >
          
          <?php foreach($landing_groups as $row):  
		  
		  if($lan->landing_group==$row->folder_id){
			  
		  
		  ?>
           <option value="<?php echo $row->folder_id;?>" selected="selected"><?php
	    echo $row->folder_name;?></option>
           
           
           <?php }else{ ?>
           
            <option value="<?php echo $row->folder_id;?>"><?php
	    echo $row->folder_name;?></option>
        
        
        
          <?php } endforeach; ?>
          </select>          </td>
          
          
          
          
          
          
          
         
          <td>Landing Footer H1</td>
          <td><input name="landing_footerh1" type="text" id="landing_footerh1" tabindex="1" size="40" value="<?php echo isset($lan) ? $lan->landing_footerh1: $_POST['landing_footerh1']; ?>" /></td>
        </tr>
        <tr>
        
        
        
        
        
        
         
         
          <td>Select a City</td>
          <td><select name="landing_city" id="landing_city"  tabindex="3" >
           
           
          <?php foreach($cities as $row):  
		  
		  if($lan->landing_city==$row->city_name){
		  ?>
            <option value="<?php echo $row->city_name;?>" selected="selected"><?php
	    echo $row->city_name;?></option>
          
          <?php }else{ ?>
          
            <option value="<?php echo $row->city_name;?>"><?php
	    echo $row->city_name;?></option>
         
          <?php } endforeach; ?>
          </select>          </td>
         
         
         
         
         
         
         
         
         
	            <td>Landing Footer H1 Text</td>
          <td>
	    <textarea name="landing_footerh1_text" id="landing_footerh1_text" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_footerh1_text: $_POST['landing_footerh1_text']; ?></textarea>
	  </td>
      
      
      
      
      
      
      
        </tr>
        <tr>
          <td>H1 English/French</td>
          <td>
	    <div id="product-tabs">
              <ul class="multilangsel">
                  <li><a href="#title-1">English</a></li>
                  <li><a href="#title-2">French</a></li>
              </ul>
              <div id="title-1">
                <input name="landing_h1" type="text" id="landing_h1" tabindex="1" size="45" value="<?php echo isset($lan) ? $lan->landing_h1: $_POST['landing_h1']; ?>" />
              </div>
              <div id="title-2">
                <input name="landing_h1_fr" type="text" id="landing_h1_fr" tabindex="1" size="45" value="<?php echo isset($lan) ? $lan->landing_h1_fr: $_POST['landing_h1_fr']; ?>" />
              </div>
            </div>
          </td>





          <td>Landing Footer H2</td>
          <td><input name="landing_footerh2" type="text" id="landing_footerh2" tabindex="1" size="30" value="<?php echo isset($lan) ? $lan->landing_footerh2: $_POST['landing_footerh2']; ?>" /></td>
          
          
          
          
          
        </tr>
        <tr>
          <td>City Phone Number</td>
          <td><input name="landing_phone" type="text" id="landing_phone" tabindex="1" size="20" value="<?php echo isset($lan) ? $lan->landing_phone: $_POST['landing_phone']; ?>" /></td>
          
          
          
          
          
          
	   <td>Landing Footer H2 Text</td>
          <td>
	    <textarea name="landing_footerh2_text" id="landing_footerh2_text" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_footerh2_text: $_POST['landing_footerh2_text']; ?></textarea>
	  </td>
        </tr>

        <tr>
          
          
          <td>Main Banner Text1</td>
          <td>
	    <textarea name="landing_mainbanner_text1" id="landing_mainbanner_text1" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_mainbanner_text1: $_POST['landing_mainbanner_text1']; ?></textarea>
	  </td>
          
          
          
          
          
          
          <td>Landing SEO Title</td>
          <td>
	    <textarea name="landing_seo_title" id="landing_seo_title" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_seo_title: $_POST['landing_seo_title']; ?></textarea>
	  </td>
      
      
      
      
        </tr>
        <tr>
          
          
      <td>Main Banner Text2</td>
          <td><input name="landing_mainbanner_text2" type="text" id="landing_mainbanner_text2" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_mainbanner_text2: $_POST['landing_mainbanner_text2']; ?>" /></td>
      
      
      
      
         <td>Landing SEO Description</td>
          <td>
	    <textarea name="landing_seo_description" id="landing_seo_description" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_seo_description: $_POST['landing_seo_description']; ?></textarea>
	  </td>
        </tr>
           <tr>
          
          <td>Welcome Body Text</td>
          <td><input name="landing_introduction_text" type="text" id="landing_introduction_text" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_introduction_text: $_POST['landing_introduction_text']; ?>" /></td>
          
          
          
          
              <td>Landing SEO Keywords</td>
          <td>
	    <textarea name="landing_seo_keywords" id="landing_seo_keywords" rows="7" cols="30"><?php echo isset($lan) ? $lan->landing_seo_keywords: $_POST['landing_seo_keywords']; ?></textarea>
	  </td>
        </tr>
        
       
        
        
	
	
        
       
        
        
        
        
        
         
        
         
         
          
          <tr>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>  
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          
         
        
        </tr>
        
        
        
      </table>
      
      
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Products Names for Landing Page</th>
        </tr>
        <tr>
          <td width="300">Product #1 Name</td>
          <td align="left"><input name="landing_product1" type="text" id="landing_product1" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product1: $_POST['landing_product1']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #2 Name</td>
          <td align="left"><input name="landing_product2" type="text" id="landing_product2" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product2: $_POST['landing_product2']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #3 Name</td>
          <td align="left"><input name="landing_product3" type="text" id="landing_product3" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product3: $_POST['landing_product3']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #4 Name</td>
          <td align="left"><input name="landing_product4" type="text" id="landing_product4" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product4: $_POST['landing_product4']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #5 Name</td>
          <td align="left"><input name="landing_product5" type="text" id="landing_product5" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product5: $_POST['landing_product5']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #6 Name</td>
          <td align="left"><input name="landing_product6" type="text" id="landing_product6" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product6: $_POST['landing_product6']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #7 Name</td>
          <td align="left"><input name="landing_product7" type="text" id="landing_product7" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product7: $_POST['landing_product7']; ?>" /></td>
        </tr>
        <tr>
          <td width="300">Product #8 Name</td>
          <td align="left"><input name="landing_product8" type="text" id="landing_product8" tabindex="1" size="35" value="<?php echo isset($lan) ? $lan->landing_product8: $_POST['landing_product8']; ?>" /></td>
        </tr>
        
        
        <tr>
        <td colspan="2" align="center"><div style="width:700px;" align="center"><input name="button" type="submit" class="sbutton" id="button"  tabindex="17" value="<?php echo $action; ?> Landing City" /></div></td>
        </tr>
      </table>
      
      <script>
          $(function() {
              $("#product-tabs" ).tabs();
	      $("#description-tabs" ).tabs();
		   $("#landing-tabs" ).tabs();
	      $("#contents-tabs" ).tabs();
          });
      </script>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>