<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Order Details</h2>
    <div id="shadow">
        <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
            <tr>
                <td style="padding:0px; " valign="top">
                    <div id="order_billing">
                    <table width="100%" >
                        <tr>
                        <th colspan="2">Order ID #<?php echo $order->order_id;?></th>
                      </tr>
                      <tr>
                        <td valign="top" align="left"><h3>Billing Address:</h3>
                            <ul class="billingul">
                          <li><strong><?php echo ucwords(strtolower($order->firstname.' '.$order->lastname)); ?></strong></li>
                          <li><?php echo $order->address1.' '.$order->address2; ?></li>
                          <li><?php echo $order->city.' '.$order->postalcode; ?></li>
                          <li><?php echo $order->province.' '.$order->country_id; ?></li>
                          <li><?php echo $order->dayphone.' '.$order->evephone; ?></li>
                          <li><?php echo $order->email; ?></li>
                            </ul>
                            <h3>Customer Account:</h3>
                            <ul class="billingul">
                          <li><u>Customer</u>: <?php echo ucwords(strtolower($order->cfirstname.' '.$order->clastname));?></li>
                          <li><u>Username</u>: <?php echo $order->cusername;?></li>
                        <li><u>Affiliate</u>: <?php echo $order->user_name;?></li>
                        <li><u>Parent Company</u>: <?php echo $order->company;?></li>
                        <li><u>Order Date</u>: <?php echo date('M d Y H:i',strtotime($order->order_date));?></li>
                        <li><u>IP Address</u>: <?php echo $order->ipaddress; ?></li>
                        <li><u>Status</u>: <?php echo $order->status_code; ?></li>
                            </ul>

                        </td>
                      </tr>
                    </table>
                    </div>
                </td>
                <td style="padding: 0px;" valign="top"><table width="100%">
                        <tr>
                            <th colspan="2">Order Items
                            </th>
                          </tr>
                          <tr>
                            <td colspan="2">
                            
                            <table cellpadding="3" cellspacing="0" border="0" width="100%" class="order_details" >
                            <?php
                            if(count($order->items)) {
                            foreach($order->items AS $item)
                                  {  
                            ?>
                              <tr>
                                <td valign="top">
                                  <?php echo img($item->product_picture,'macro','align="left"'); ?>		
                                </td>
                                <td valign="top">
                                  <big><?php echo $item->product_name;?></big>
                                  <p><em>
                                  <?php echo $item->card_message ? '<q>'.$item->card_message.'</q>':'<q>This is just a test</q>';?>
                                  </em>
                                  </p>
                                  
                                  <?php if(isset($item->addons)) {
                                          $addon_total = 0;
                                          foreach($item->addons AS $addon)
                                          {
                                            $total = $addon->addon_quantity*$addon->addon_price;
                                            $addon_total += $total; 
                                  ?>
                                    <p class="addon_row"><span class="addon_name"> (+) <?php echo $addon->addon_name;?></span>
                                      <span class="addon_price"><?php echo $addon->addon_quantity.' x '.'$'.number_format($addon->addon_price,2).' = $'.number_format($total,2);?></span>
                                    </p>
                                  <?php
                                          }
                                    
                                   }
                                  ?>

                                </td>
                                <td valign="top">
                                  <?php echo strtoupper($item->firstname.' '.$item->lastname); ?> <br />
                                  <?php echo $item->address1.' '.$item->address2;?> <br />
                                  <?php echo $item->city.' '.$item->postalcode;?><br />
                                  <?php echo $item->province.' '.$item->country_id;?><br />
                                  <?php echo '<em>Phone</em> : '.$item->dayphone.' '.$item->evephone;?><br />
                                  <?php echo '<em>Email</em> : '.$item->email;?><br />
                                <?php if($item->delivery_method_id==2) { ?>
                                <?php if($order->status_id=='2') : ?>
                                  <div class="trackno" style="clear: both; float:none;">
                                    Tracking Code:<br/>
                                    <?php echo form_open('/siteadmin/orders/tracking',array('name'=>'trackform')); ?>
                                      <input type="text" name="tracking_code" value="<?php echo $item->tracking_code;?>" />
                                      <input type="hidden" name="orderitem_id" value="<?php echo $item->orderitem_id;?>" />
                                      <input type="submit" name="submit" value="SEND" />
                                    </form>
                                  </div>
                                  <?php endif; ?>
                                <?php } ?>
                                </td>
                                <td class="center">
                                  <big><?php echo date('M d Y',strtotime($item->delivery_date)); ?></big><br />
                                  <?php echo date('l',strtotime($item->delivery_date)); ?>
                                </td>
                                <td style="text-align:right" nowrap="nowrap">
                                  <big><?php echo '$'.number_format($item->product_price,2); ?></big><br />
                                  <?php echo isset($addon_total) && $addon_total>0 ? '(+) $'.number_format($addon_total,2):''; ?>

                                </td>
                              </tr>  
                            <?php
                                  }
                            }
                            ?>
                            </table>
                            <tr>
                              <th>
                                Merchandise Total
                              </th>
                              <th style="text-align:right;">
                                <?php echo '$'.number_format($order->amount,2);?>
                              </th>
                            </tr>
                            <tr>
                              <td>Shipping</td>
                              <td style="text-align:right;"><?php echo '$'.number_format($order->shipping,2);?></td>
                            </tr>
                            <tr>
                              <td>Service</td>
                              <td style="text-align:right;"><?php echo '$'.number_format($order->service,2);?></td>
                            </tr>
                            <tr>
                              <td>Surcharge</td>
                              <td style="text-align:right;"><?php echo '$'.number_format($order->surcharge,2);?></td>
                            </tr>
                            <tr>
                              <td>Tax</td>
                              <td style="text-align:right;"><?php echo '$'.number_format($order->tax,2);?></td>
                            </tr>
                            <?php if($order->discount>0) { ?>
                            <tr>
                              <td>Discount</td>
                              <td style="text-align:right; color:red;"><?php echo '$'.number_format($order->discount,2);?></td>
                            </tr>
                            <?php } 
                            
                                          if($order->coupon>0) { ?>
                            <tr>
                              <td>Coupon - <q><?php echo $order->coupon_code;?></q></td>
                              <td style="text-align:right; color:red;"><?php echo '$'.number_format($order->coupon,2);?></td>
                            </tr>
                            <?php }
                            
                                          if($order->company_less>0) { ?>
                            <tr>
                              <td>Company Customer Discount - </td>
                              <td style="text-align:right; color:red;"><?php echo '$'.number_format($order->company_less,2);?></td>
                            </tr>	  		
                            <?php } ?>
                            <tr>
                              <th>Grand Total <?php
        switch($order->payment_method)
        {
          case 'credit_card':
          {
            echo ' (Pay by Credit Card)';
            break;
          }
          case 'company_pay':
            {
              echo ' (Pay On Account)';
              break;
            }         
        }
        
        ?></th>
                              <th style="text-align:right;">
                                <?php echo '$'.number_format($order->amount+$order->shipping+$order->service+$order->surcharge+$order->tax-$order->discount-$order->coupon-$order->company_less,2);?>
                              </th>
                            </tr>
                            <tr>
                              <td colspan="2" style="text-align: center">
                                <?php if($order->status_code== 'PENDING') { ?>
                                <table width="100%">
                
                                <tr>
                                    <td>

                                        <a href="<?php echo FCBASE;?>/orders/status/<?php echo $order->order_id;?>/cancelled" onclick="javascript:return confirm('Status will be set as Cancelled, Are you sure?'); return false;" ><input type="button" value="Cancel Order" class="sbutton" /></a>
                                        
                                    </td>
                                    <td style="text-align:center">
                                        <a href="<?php echo FCBASE;?>/orders/status/<?php echo $order->order_id;?>/deleted" style="color:rgb(255,0,0);" onclick="javascript:return confirm('Deleted orders cannot be retrieved, are you sure?'); return false;" >Delete this Order!</a>
                                    </td>
                                    <td class="right" style="text-align:right">
                                        <a href="<?php echo FCBASE;?>/orders/status/<?php echo $order->order_id;?>/completed" onclick="javascript:return confirm('Status will be set as Completed, Are you sure?'); return false;" ><input type="button" value="Set as Completed" class="sbutton"/></a>
                                    </td>
                                    </tr>
                                </table>
                                <?php } else { ?>
                                     <a href="/siteadmin/orders/browse" ><input type="button" value="Back to Orders" class="sbutton"/></a>
                                <?php } ?>
                                <span style="color:red;"><p><?php echo $order->remarks; ?></p></span>
                              </td>
                           </tr>
                    </table>
                </td>
            </tr>
        </table>
        
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        
	
      </table>
      </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>