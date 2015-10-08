<?php include_once('header.php');
$vaseID = $this->session->userdata('vaseID');

?>
            <div class="content">
            <div id="content-frame" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
                <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
				
                <?php $msg = $this->session->flashdata('message');
                    if(!empty($msg)) { ?>
                <?php echo $msg; ?>                   
                <?php }  ?>
            <?php if(count($cart)) { ?>
                <table border="0" cellpadding="15" cellspacing="0" class="table" width="100%" >
            <?php
                            $total_price = 0;
                            foreach($cart as $row) {
                                $total_price += $row->product_price;
                    ?>
                    <tr>
                        <th><?php echo lang('Product');?></th>
                        <th></th>
                        <th><?php echo lang('Quantity');?></th>
                        <th class="right"><?php echo lang('Total');?></th>
                    </tr>
                    <tr>
                        <td class="thumb" width="15%">
                            <?php if($row->custom_vase==1) : ?>
                                <div class="vase-wrapper">
                                <div class="vasebg">
                                    <img src="/images/vaseBGc.jpg"  width="117" height="130" style="width:117px; height:130px;"   />
                                </div>
                                <div class="vase">
                                    <?php if($vaseID>0) : ?>
                                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" width="117" height="130"  style="width:117px; height:130px;" />
                                    <?php else : ?>
                                    <img src="/images/vaseIMGc.png"  width="117" height="130" style="width:117px; height:130px;"/>
                                    <?php endif; ?>
                                </div>
                                <div class="vaseproduct">
                                    <img src="<?php echo img_format('productres/'.$row->product_picture,'sthumbpng');?>"  style="width:117px; height:130px;" width="117" height="130" />
                                </div>
                                </div>
                            <?php else : ?>                            
                                <img src="<?php echo img_format('productres/'.$row->product_picture,'sthumb');?>"  style="width:117px; height:130px;" />
                            <?php endif; ?>
                        </td>
                        <td class="pinfo" width="60%">
                            <h4><?php echo ucwords(strtolower(rightLang($row->product_name,$row->product_name_fr))); ?></h4>
                            <p><strong><?php echo lang('Code');?>:</strong><?php echo $row->product_code;?></p>
                            <p><strong><?php echo lang('Arrives');?>:</strong> <?php echo ucwords(date('l, d M Y',strtotime($row->delivery_date)));?></p>
                        </td>
                        <td class="center" >1<br/><a href="/shop/rem/<?php echo $row->orderitem_id;?>" onclick="javascript:return confirm('<?php echo lang('Are you sure you want to remove this item from your cart'); ?>?'); return false;" >
                        <button  name="rem" class="btn btn-danger btn-mini"  /><?php echo lang('Remove');?></button></a></td>
                        <td class="pprice right" width="25%"><?php echo getRate($row->product_price)?></p></td>
                    </tr>
                    <?php foreach($row->addons as $addon) {
                                $total_price += $addon->addon_price*$addon->addon_quantity;                        
                        ?>
                    <tr>
                            <td class="addonrow"><img src="<?php echo img_format('productres/'.$addon->addon_picture,'sthumb');?>" /></td>
                            <td class="addonrow">
                                <?php echo ucfirst(strtolower($addon->addon_name)); ?> - <?php echo ucfirst(strtolower($addon->description)); ?> (<?php echo getRate($addon->addon_price); ?>)
                            </td>
                            <td class="center">
                                <?php echo form_open('/shop/update',array('name'=>'form'.$addon->order_addon_id, 'id'=>'form'.$addon->order_addon_id)); ?>
                            <input type="text" size="3" name="addon[<?php echo $addon->order_addon_id;?>]" id="addon<?php echo $addon->order_addon_id;?>" value="<?php echo $addon->addon_quantity;?>" class="input-mini" />
                            <button type="submit"  name="submit" value="<?php echo lang('Update');?>"  class="btn btn-warning btn-mini">Update</button>  
                            <?php echo form_close(); ?>
                            </td>
                            <td class="right">
                            <?php echo getRate(($addon->addon_price * $addon->addon_quantity))?></td>
                            
                    </tr>
                    <?php
                        }
                      }
                    ?>                         
                    <tr>
                        <td class="bott right" colspan="2">
                        
						
						
						<?php echo form_open(current_url());?>
                        <p class="lead"><?php echo lang('Do you have a Discount Coupon?');?></p>
                        <input type="text" name="coupon" value="<?php echo isset($coupon) ? $coupon->discount_name:'';?>" placeholder="Enter your coupon code here" />
						<input type="submit" name="coupon_submit" class="btn btn-success" value="<?php echo lang('Apply');?>" style="margin-top:-10px;" /> 
                        <?php if(isset($coupon)) { echo lang('You get').': <span class="error">-'.getRate($coupon->discount).'</span> OFF'; } ?><?php echo form_close();?>
                        
						
						
						
						</td>
                        <td class="bott">&nbsp;</td>
                        <td class="bott right">
                            <p class="lead">
                            <?php echo lang('Grand Total');?>: <big><?php echo getRate(isset($coupon) ? $total_price-$coupon->discount : $total_price);?></big></p></td>
                    </tr>
                </table>
                <div class="buttons text-right">
                    <button name="shopmore" id="shopmore" onclick="javascript: window.location='/products';" class="btn btn-large" ><?php echo lang('Continue Shopping');?></button>
                    <button name="checkout" id="checkout" onclick="javascript: window.location='/shop/checkout';" class="btn btn-inverse btn-large" ><?php echo lang('Proceed with Checkout');?></button>
                </div>
                    <?php } else { ?>
                    <div class="empty"><h3><?php echo lang('Sorry, the cart is empty!');?></h3><p><?php echo lang('Please');?> <a href="/products"><?php echo lang('add a product');?></a> <?php echo lang('to cart');?></p></div>
                    <?php } ?>
                    <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- main_content -->
            <div class="clear"></div>
            </div> <!-- content -->
<?php include_once('footer.php'); ?>
       