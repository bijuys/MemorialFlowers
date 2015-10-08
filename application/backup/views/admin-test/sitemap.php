<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
<div id="contents-wrapper">
    <h2>Sitemap</h2>
    <?php echo form_open(current_url());?>
      <textarea rows="20" cols="100" name="sitemap" ><?php echo $sitemap;?></textarea>
      <p>
        <input type="submit" name="submit" value="Save Sitemap" />
        <input type="submit" name="submit" value="Generate New Sitemap Now!" />
      </p>
    <?php echo form_close();?>
      
  </div>
<div class="clear"></div>
<?php include_once("footer.php");?>