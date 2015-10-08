<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Policy</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Policy Text</th>
        </tr>
        <tr>
          <td class="label">Title English/French</td>
          <td>
              <div id="title-tabs">
                <ul class="multilangsel">
                    <li><a href="#title-1">English</a></li>
                    <li><a href="#title-2">French</a></li>
                </ul>
                <div id="title-1">
                  <input type="text" name="message_title" size="40" id="message_title" value="<?php echo set_value('message_title',isset($policy)?$policy->message_title:''); ?>" />
                </div>
                <div id="title-2">
                  <input type="text" name="message_title_fr" size="45" id="message_title_fr" value="<?php echo set_value('message_title_fr',isset($policy)?$policy->message_title_fr:''); ?>" />
                </div>
              </div>
            </td>
        </tr>
        <tr>
          <td class="label" valign="top">Policy</td>
          <td>
            
            <div id="description-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <textarea name="message_text" cols="80" rows="15" id="message_text"><?php echo set_value('message_text',isset($policy)?$policy->message_text:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="message_text_fr" cols="80" rows="15" id="message_text_fr"><?php echo set_value('message_text_fr',isset($policy)?$policy->message_text_fr:''); ?></textarea>
              </div>
            </div>
          </td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="message_id" type="hidden" id="message_id" value="<?php echo set_value('message_id',isset($policy)?$policy->message_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      <script>
          $(function() {
              $("#title-tabs" ).tabs();
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?=$this_class;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <script>
<!--
 $("#message_title").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#message_title_fr").val(data);
      });
  });

  $("#message_text").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#message_text_fr").val(data);
      });
  })


//-->
</script>
  <?php include_once("footer.php");?>