<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Cancel Order</h2>
    <div id="shadow">
      <?php echo form_open('');?>
      
        <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
          <tr>
            <td>Enter Reason</td>
            <td>
              <textarea name="reason" rows="5" cols="35"></textarea>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Submit" /></td>
          </tr>
        </table>
      </form>
      </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>