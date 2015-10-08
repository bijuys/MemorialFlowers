<h4><?php echo lang('Pay by Credit Card');?></h4>
<div class="show-error">
                  <?php echo validation_errors();?>
</div>
                            <div class="control-group">
                              <label for="payeename" class="control-label"><?php echo lang('Card Holder Name');?></label>
                              <div class="controls">
                                <input type="text" name="payeename" value="<?php echo $_POST['payeename'];?>" maxlength="35" id="payeename" size="25" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cc" class="control-label"><?php echo lang('Credit Card Number');?></label>
                              <div class="controls">
                                <input type="text" name="cc" value="<?php echo $_POST['cc'];?>" id="cc" size="25" maxlength="16" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cexpiry" class="control-label"><?php echo lang('Expiry Date');?></label>
                              <div class="controls">
                                <select name="cmonth" id="cexpiry" class="input-small">
                                <?php for($i=1;$i<=12;$i++) : ?>
                                  <option value="<?php echo sprintf('%02d',$i); ?>" <?php if($_POST['cmonth']==sprintf('%02d',$i)) { echo 'selected="selected"'; } ?>><?php echo sprintf('%02d',$i);?></option>
                                <?php endfor; ?>                            
                                </select>
                              
                                <select name="cyear" id="cyear" class="input-small">
                                  <?php $cyear = date('Y',time()); ?>
                                  <?php for($i=$cyear;$i<=$cyear+20;$i++) : ?>
                                  <option value="<?php echo substr($i,2,2);?>"  <?php if($_POST['cyear']==substr($i,2,2)) { echo 'selected="selected"'; } ?>><?php echo substr($i,2,2);?></option>
                                  <?php endfor; ?>                            
                                </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label for="cvv" class="control-label"><?php echo lang('CVV');?></label>
                              <div class="controls">
                                <input type="text" name="cvv" value="<?php echo $_POST['cvv'];?>" id="cvv" size="3" class="input-small" />
                              </div>
                            </div>