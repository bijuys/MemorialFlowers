<?php include_once('header.php'); ?>
<?php $dts = get_next_dates(); ?>
              <?php
             
                if(isset($page) && count($page) && !empty($page->banner_file)) :
                    echo '';
                    
                    if($this->session->userdata('language')=='french') :

                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$page->banner_file_fr,'978x100').');">';
                    else :
                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$page->banner_file,'978x100').');">';
                    endif;
                    
                   /* if(!empty($page->description)) :
                    
                        echo '<div class="category-desc"><div class="innerbox"><h3>'.lang($page->title).'</h3>';
                        
                        if($this->session->userdata('language')=='french') :
                            echo '<p>'.$page->description_fr.'</p>';
                        else :
                            echo '<p>'.$page->description.'</p>';
                        endif;
                        
                        echo '</div></div>';
                    
                    endif;
                    */
                    
                    
                    echo '</div>';
                    
                   
                else :
                  echo '';
                endif;               
                ?>
              
                <div id="birthday_months" class="clearfix">
                  <?php $count=0; ?>
                  <?php foreach($months as $month) : ?>
                
                  <div class="month-box" <?php if($count>=4) { echo 'style="margin-right:0px;"'; } ?>>
                  
                      <?php if($this->session->userdata('language')=='french') : ?>
                        <a href="/products/birthmonth_flowers/<?php echo $month->name;?>"><img src="<?php echo img_format('productres/'.$month->picture_fr, 'birthmonth');?>" /></a>
                        <p class="description">
                          <?php echo substr($month->description_fr,0,100);?> :<a href="/products/birthmonth_flowers/<?php echo $month->name;?>">
                          <em><?php echo lang('read more');?></em></a>
                        </p>
                      <?php else : ?>
                        <a href="/products/birthmonth_flowers/<?php echo $month->name;?>"><img src="<?php echo img_format('productres/'.$month->picture, 'birthmonth');?>" /></a>
                        <p class="description">
                          <?php echo substr($month->description,0,100);?>
                           :<a href="/products/birthmonth_flowers/<?php echo $month->name;?>"><em><?php echo lang('read more');?></em></a>
                        </p>                      
                      <?php endif; ?>
                  </div>  
                  
                  <?php if($count>=4) : $count=0; ?>
                    
                    <div class="clear"></div>
                  
                  
                  <?php endif; ?>
                  
                  <?php endforeach; ?>
                  
                </div>
                
                
                  <div class="currencyselect" style="text-align: center; margin: 10px 0;">
                    <?php echo form_open('/shop/currency',array('name'=>'setcurr')); ?>
                              <span class="setcurrency" id="setcurrency">
                                  <label><?php echo lang('Currency'); ?></label>
                                      <?php echo getCurrencyMenu('setcurr'); ?>
                              </span>
                    <?php echo form_close(); ?>
                  </div>

<?php include_once('footer.php'); ?>
       