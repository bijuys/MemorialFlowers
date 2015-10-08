<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
<?php $vaseID = $this->session->userdata('vaseID'); ?>
      <div class="contents clearfix" style="width:100%;">
        <div class="row-fluid" style="width:100%;">
              <div class="span18" style="width:100%;">
			  <div style="margin: 15px 0px 0px 15px; font-size:35px; color:#236B8E; font-weight:bold;">Available Products for Customers</div><br />
                <div id="products">
                  <?php foreach($products as $row) : ?>    
                  <?php
                    
                      if(!isset($path) || empty($path))
                      {
                        if(!empty($row->occasion_name))
                        {
                          $upath = ''; //base_url().url_title(strtolower($row->occasion_name)).'/';
                        }
                        else
                        {
                          $upath = ''; //base_url().url_title(strtolower($row->category_name)).'/';
                        }
                        
                      }
                      else
                      {
                        $upath = base_url().$path.'/';
                      }
                  ?>
              
                <div class="product-item text-center" style="width:13.5%; margin-bottom:-60px;">
                  <?php echo form_open("/mymemorial/products/addcart"); ?>
                  <?php if($row->custom_vase==1) : ?>
                  <div class="vasebg">
                    <img src="/images/vaseBGc.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMGc.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>
                  </div>
                  
                  <?php else : ?>
                   <img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/>                
                  
                  <?php endif; ?>
                  
                    
                    <p class="product-name" style="font-size:16px; text-align:center; color:#236B8E;"><?php echo rightLang($row->product_name,$row->product_name_fr)."-".$row->product_id;  ?></p>
                    
                <?php
				
				
                          $prices = $row->prices;
                          $baseprice = $prices[0]->price_value;  
                  ?>
                  
                   <?php //if($row->prices!='') { ?>
                    <?php echo '<p class="lead">'.getRate($prices[0]->price_value).'</p>';  ?>                
                    <input type="hidden" name="product_id" value="<?php echo $row->product_id;?>" />
                    
                   
                    <select name="price_id" class="input-medium">                  
                      <?php foreach($row->prices as $price) : ?>
                          <option value="<?php echo $price->price_id;?>"><?php echo $price->price_name;
                          
                            if($baseprice < $price->price_value) { echo ' +'.getRate($price->price_value-$baseprice); }
                          
                          ?></option>                      
                      <?php endforeach; ?>
                    </select>
                    <?php //}?>
                
                <!--<button type="submit" class="btn-inverse btn"><?php //echo lang('Order');?></button>-->
                
                <!--<p class="delvinfo">
                  <?php
                /*
                if($row->delivery_method_id==1)
                {
                  echo lang('Same-Day Local Florist Delivery');
                }
                else
                {
                  echo lang('Shipped in a Giftbox');
                }
                */
                ?>
                  
                </p>-->
                </form>
                </div><!-- Product-Item //-->
        
               <?php endforeach; ?>
               <div class="clear" /></div>
                </div>
            </div><!-- Span 16 //-->
            <div class="span6" style="display:none;">
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      Search Products
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                      
                        <p>
                          <label>Product/ID/Keyword</label>
                          <input name="keyword" value="" id="keyword" type="text">
                        </p>
                        <p>
                          <input name="action" value="search" type="hidden">
                          <input name="submit" value="Search Product" type="submit">
                        </p>
             
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                      Your Cart                     
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        
                        <?php if(count($cart)) :
                                $total = 0;
                                foreach($cart as $item) : ?>
                                <div class="row-fluid sidebar-cart-item">
                                  <div class="span8">
                                    <img src="<?php echo img_format('productres/'.$item->product_picture, 'stamppng');?>" />
                                  </div>
                                  <div class="span16">
                                    <?php echo $item->product_name; ?> <br/>
                                    1 x <?php echo getRate($item->product_price); $total += $item->product_price; ?>
                                  </div>
                                </div>
                                
                                
                        <?php   endforeach; ?>
                        
                        <div class="sidebar-cart-total"> Total: <?php echo getRate($total); ?></div>  
                        
                        <?php
                              else : ?>
                                
                                <p> Your cart is empty! </p>
                              
                        <?php endif; ?>
                        
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
        </div><!-- Row Fluid //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
