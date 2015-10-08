<?php include_once('header.php'); ?>
<div class="content">
              <?php             
                if(isset($rec) && count($rec) && !empty($rec->banner_file)) :
                    echo '';
                    
                    if($this->session->userdata('language')=='french') :
                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$rec->banner_file_fr,'978x100').');">';
                    else :
                        echo '<div id="bannerhead" style="background: url('.img_resized('/banners/'.$rec->banner_file,'978x100').');">';
                    endif;
                    
                    if(!empty($rec->description)) :
                    
                        echo '<div class="category-desc"><div class="innerbox"><h3>'.lang($title).'</h3>';
                        
                        if($this->session->userdata('language')=='french') :
                            echo '<p>'.$rec->description_fr.'</p>';
                        else :
                            echo '<p>'.$rec->description.'</p>';
                        endif;
                        
                        echo '</div></div>';
                    
                    endif;                    
                    
                    echo '</div>';
                else :
                  echo '';
                endif;               
              ?>
            <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
            <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            <div class="row-fluid">
              <div class="span24">
                <iframe src="http://vase.memorialflowers.ca/?pageType=1&sessionId=<?php echo $this->session->userdata('session_id');?>&returnUrl=http://www.funeralflowers.ca/vaseCollections" style="width: 100%; height: 800px; border: none; margin-top: 10px;"></iframe>
              </div>
            </div>
                 
            <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
</div>
<?php include_once('footer.php'); ?>
       