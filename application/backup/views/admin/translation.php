<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Translation </h2>
<div style="text-align: left; background: #ecf0f4; padding: 5px; margin: 15px 0;">
      <h4 style="display: block; padding: 7px; margin: 0px;">Add New Translation</h4>
      <?php echo form_open(FCBASE.'/translation/create'); ?>
        <table width="100%" cellpadding="5" cellspacing="0" border="0">
          <tr>
              <td style="padding-bottom: 0px;">English Original Text</td>
              <td style="padding-bottom: 0px;">French Translation</td>
              <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type="text" name="english" value="" id="english" style="width:100%;"/></td>
            <td><input type="text" name="french" value="" id="french"  style="width:100%;" /></td>
            <td width="5%"><input type="submit" name="submit" value="Create"/></td>
          </tr>
        </table>
        </form>

    </div>

    <h4 style="display: block; margin: 5px 7px; text-align: left;" >Existing Translations</h4>

    <div id="shadow">
      <?php echo form_open('',array('name'=>'translate'));?>

    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="45%">English Original</th>
        <th width="45%">French Translation</th>
        <th width="10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	       foreach($lang as $key=>$val) : 
	     ?> 
      <tr>
        <td class="left"><input type="text" name="english[]" value="<?php echo $english[$key];?>" style="width:100%" /></td>
        <td class="left"><input type="text" name="french[]" value="<?php echo isset($french[$key]) ? $french[$key]:'';?>" style="width:100%" /></td>
        <td nowrap="nowrap"><a href="<?php echo current_url();?>/delete/<?php echo $val;?>" class="remrow" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php 
	  //$tempid = $dval->parent_category_id;
	  endforeach; ?>
    <script>
      $(document).ready(function(){
          $(".remrow").click(function(c){
              var parentRow = $(this).parent().parent();
              parentRow.remove();
          });

          $("#english").change(function(){

            $.post("/translate/",{'text':$("#english").val()},function(data){
              $("#french").val(data);

            });

          });

      });

    </script>
    <tr>
      <td align="right" colspan="3"><input type="submit" name="action" value="Update" /></td>
    </tr>
      </tbody>
    </table>
  </form>
    </div>
    
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>