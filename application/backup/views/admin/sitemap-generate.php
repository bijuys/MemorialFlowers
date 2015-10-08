<?php

$head = <<<EOF
  <?xml version="1.0" encoding="UTF-8"?>
EOF;

$time = date('Y-m-d',time());

?>

<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
<div id="contents-wrapper">
    <h2>Sitemap</h2>
    <?php echo form_open(current_url());?>
      <textarea rows="20" cols="100">
        <?php echo $head;?>        
          <urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
          <url>
              <loc>http://www.1800florists.ca</loc>
              <lastmod><?php echo $time; ?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>
          <?php if(count($categories)) :
                    foreach($categories as $row) : ?>      
          <url>
              <loc>http://www.1800florists.ca/category/<?php echo url_title(trim($row->category_name));?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>
          <?php if(count($occasions)) :
                    foreach($occasions as $row) : ?>      
          <url>
              <loc>http://www.1800florists.ca/occasion/<?php echo url_title(trim($row->occasion_name));?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>
          <?php if(count($subcategories)) :
                    foreach($subcategories as $row) : ?>      
          <url>
              <loc>http://www.1800florists.ca/subcategory/<?php echo url_title(trim($row->subcategory_name));?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>
          <?php if(count($colors)) :
                    foreach($colors as $row) : ?>      
          <url>
              <loc>http://www.1800florists.ca/color/<?php echo url_title(trim($row->color_name));?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>
          <?php if(count($deliverymethods)) :
                    foreach($deliverymethods as $row) : ?>      
          <url>
              <loc>http://www.1800florists.ca/delivery/<?php echo url_title(trim($row->delivery_method));?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>                
                
                
          <?php if(count($products)) :
                    foreach($products as $row) : ?>  
          <url>
              <loc>http://www.1800florists.ca/<?php echo $row->category_name;?>/<?php echo $row->url;?></loc>
              <lastmod><?php echo $time;?></lastmod>
              <changefreq>daily</changefreq>
              <priority>0.5</priority>
          </url>            
          <?php     endforeach;
                endif;  ?>
                
          </urlset>                    
      </textarea>
      <p>
      <input type="submit" value="Save to Sitemap.xml" />
      </p>
    <?=form_close();?>
  </div>
<div class="clear"></div>
<?php include_once("footer.php");?>