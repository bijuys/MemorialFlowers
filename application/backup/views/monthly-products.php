<?php include_once('header.php'); ?>
<?php $dts = get_next_dates(); ?>
              <?php
              
                if(isset($rec) && count($rec) && !empty($rec->banner_file)) :
                    echo '';
                    
                    if($this->session->userdata('language')=='french') :
                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$rec->banner_file_fr,'978x100').');">';
                    else :
                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$rec->banner_file,'978x100').');">';
                    endif;
                    
                    /*
                    
                    if(!empty($rec->description)) :
                    
                        echo '<div class="category-desc"><div class="innerbox"><h3>'.lang($rec->name).'</h3>';
                        
                        if($this->session->userdata('language')=='french') :
                            echo '<p>'.$rec->description_fr.'</p>';
                        else :
                            echo '<p>'.$rec->description.'</p>';
                        endif;
                        
                        echo '</div></div>';
                    
                    endif;
                    
                    */
                    
                    echo '</div>';
                else :
                  echo '';
                endif;               
                ?>
             <div id="birthday_month" class="clearfix">
              
              <div id="birthday_month_main">
                <?php
                      if($this->session->userdata('language')=='french') :
                          echo '<img src="/productres/'.$rec->picture_fr.'" />';
                      else :
                          echo '<img src="/productres/'.$rec->picture.'" />';
                      endif;
                ?> 
                
              </div>
              
              <div id="birthday_month_thumbs" class="clearfix">
              <?php foreach($products as $row) : ?>    
                <div class="product-item clearfix">
                  <center>
                    <div class="item">
                  <a href="/<?php echo $row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'birthmonthitem');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  class="mpic" /></a>
                    <a class="product-name" href="/<?php echo $row->url;?>"><?php echo $row->product_code; ?></a>
                </div><!-- Item //-->
                </center>
                </div><!-- Product-Item //-->
        
               <?php endforeach; ?>                
              </div>              
              
             </div>
             
             <div id="birthday_month_description">
              <p>
                <?php
                      if($this->session->userdata('language')=='french') :
                          echo $rec->description_fr;
                      else :
                          echo $rec->description;
                      endif;
                ?>
              </p>
             </div>
             
<?php include_once('footer.php'); ?>
       