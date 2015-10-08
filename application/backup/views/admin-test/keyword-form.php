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
    <h2><?php echo $action; ?> Keyword Folders
    </h2>
    <?php  echo form_open_multipart(current_url()); ?>
    <?php echo validation_errors(); ?>
     
      
      
      
      
      
      
      
      
      
      
      
      
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Keyword Folder Info</th>
        </tr>
        <tr>
          <td width="300">Folder Name</td>
          <td align="left"><input name="folder_name" type="text" id="folder_name" tabindex="1" size="35" value="<?php if($_POST) { echo $_POST['folder_name']; } ?>" /></td>
        </tr>
        <tr>
          <td width="300">Folder Link</td>
          <td align="left"><input name="folder_link" type="text" id="folder_link" tabindex="1" size="35" value="<?php if($_POST) { echo $_POST['folder_link']; } ?>" /></td>
        </tr>
       
        
        
        <tr>
        <td colspan="2" align="center"><input name="button" type="submit" class="sbutton" id="button"  tabindex="17" value="<?php echo $action; ?> Keyword Folder" /></td>
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