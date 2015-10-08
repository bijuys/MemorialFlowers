<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MemorialFlowers :: <?php $action; ?> Affiliate</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Affiliates List</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader"><?php echo $action; ?> Affiliate</div>
        <form name="entry-form" id="entry-form" action="<?php echo base_url().'admin/affiliates/create';?>" method="post">
        <?php // echo validation_errors(); ?>
        <fieldset>
            <legend>Personal/Company Info</legend>
        <p><label for="firstname">Firstname</label>
            <input type="text" name="firstname" size="35" value="<?php if($_POST) { echo $_POST['firstname']; } elseif(isset($affiliate)) { echo $affiliate->firstname; } ?>" id="firstname" />
        <?php echo form_error('firstname'); ?></p>
        <p><label for="lastname">Lastname</label>
            <input type="text" name="lastname" size="35"  value="<?php if($_POST) { echo $_POST['lastname']; } elseif(isset($affiliate)) { echo $affiliate->lastname; } ?>" id="lastname" />
        <?php echo form_error('lastname'); ?>
        </p>
        <p><label for="affiliatename">Affiliate Name</label>
            <input type="text" name="affiliatename" size="35"  value="<?php if($_POST) { echo $_POST['affiliatename']; } elseif(isset($affiliate)) { echo $affiliate->affiliatename; } ?>" id="affiliatename" />
        <?php echo form_error('affiliatename'); ?>
        </p>
        <p><label for="email">Email</label>
            <input type="text" name="email" size="35"  value="<?php if($_POST) { echo $_POST['email']; } elseif(isset($affiliate)) { echo $affiliate->email; } ?>" id="email" />
        <?php echo form_error('email'); ?>
        </p>
        <p><label for="password">Password</label>
            <input type="text" name="password" size="35"  value="<?php if($_POST) { echo $_POST['password']; } elseif(isset($affiliate)) { echo $affiliate->password; } ?>" id="password" />
       <?php echo form_error('password'); ?>
        </p>
        <p><label for="address">Address</label>
            <input type="text" name="address" size="35"  value="<?php if($_POST) { echo $_POST['address']; } elseif(isset($affiliate)) { echo $affiliate->address; } ?>" id="address" />
       <?php echo form_error('address'); ?>
        </p>
        <p><label for="city">City</label>
            <input type="text" name="city" value="<?php if($_POST) { echo $_POST['city']; } elseif(isset($affiliate)) { echo $affiliate->city; } ?>" id="city" />
        <?php echo form_error('city'); ?>
        </p>
        <p><label for="postalcode">Postalcode</label>
            <input type="text" name="postalcode" value="<?php if($_POST) { echo $_POST['postalcode']; } elseif(isset($affiliate)) { echo $affiliate->postalcode; } ?>" id="postalcode" />
        <?php echo form_error('postalcode'); ?>
        </p>
        <p><label for="province_id">Province/State</label>
            <select name="province_id">
                  <option value="">Select Province</option>
                  <?php if(count($provinces)) : ?>
                        <?php foreach($provinces as $pro) : ?>
                              <option value="<?php echo $pro->province_id;?>"><?php echo $pro->province;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        <?php echo form_error('province_id'); ?>
        </p>
        <p><label for="country_id">Country</label>
            <select name="country_id">
                  <option value="country_id">Select Country</option>
                  <?php if(count($countries)) : ?>
                        <?php foreach($countries as $count): ?>
                              <option value="<?php echo $count->country_id;?>"><?php echo $count->country;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        <?php echo form_error('country_id'); ?>
        </p>
        <p><label for="telephone">Telephone</label>
            <input type="text" name="telephone" value="<?php if($_POST) { echo $_POST['telephone']; } elseif(isset($affiliate)) { echo $affiliate->telephone; } ?>" id="telephone" />
        <?php echo form_error('telephone'); ?>
        </p>
        </fieldset>
        <fieldset>
            <legend>Affiliate Setup</legend>
        <p><label for="domain">Domain Name</label>
            <input type="text" name="domain" size="35"  value="<?php if($_POST) { echo $_POST['domain']; } elseif(isset($affiliate)) { echo $affiliate->domain; } ?>" id="domain" />
        </p>
        <p><label for="sitename">Sitename</label>
            <input type="text" name="sitename" size="35"  value="<?php if($_POST) { echo $_POST['sitename']; } elseif(isset($affiliate)) { echo $affiliate->sitename; } ?>" id="sitename" />
        </p>
        <p><label for="description">Description</label>
            <textarea name="description" cols="45" rows="5"><?php if($_POST) { echo $_POST['description']; } elseif(isset($affiliate)) { echo $affiliate->description; } ?></textarea>
        </p>
        <p><label for="template_id">Template</label>
            <select name="template_id">
                  <option value="">Select Template</option>
                  <?php if(count($templates)) : ?>
                  <?php foreach($templates as $template) : ?>
                        <option value="<?php echo $template->template_id;?>"><?php echo $template->template;?></option>
                  <?php endforeach;?>                  
                  <?php endif; ?>
            </select>
        </p>
        <p><label for="payment_type">Payment Type</label>
            <select name="payment_type">
                  <option value="0">Credit Card</option>
                  <option value="1">IE Check</option>
                  <option value="2">On Account (7 Days)</option>
                  <option value="3" selected="">On Account (15 Days)</option>
                  <option value="4">On Account (30 Days)</option>
            </select>
        </p>
        <p><label for="commission">Commission</label>
            <input type="text" name="commission" value="<?php if($_POST) { echo $_POST['commission']; } elseif(isset($affiliate)) { echo $affiliate->commission; } else { echo '0'; } ?>" id="commission" /> <label class="suffix-label">%</label>
        </p>
        <p><label for="localcode">Local Code</label>
            <input type="text" name="localcode" value="<?php if($_POST) { echo $_POST['localcode']; } elseif(isset($affiliate)) { echo $affiliate->localcode; } ?>" id="localcode" />
        </p>
        <p><label for="business_name">Business Name</label>
            <input type="text" name="business_name" size="35"  value="<?php if($_POST) { echo $_POST['business_name']; } elseif(isset($affiliate)) { echo $affiliate->business_name; } ?>" id="business_name" />
        </p>
        <p><label for="service_fee">Service Fee</label>
            <input type="text" name="service_fee" value="<?php if($_POST) { echo $_POST['service_fee']; } elseif(isset($affiliate)) { echo $affiliate->service_fee; } else { echo '0'; } ?>" id="service_fee" />
        </p>
        <p><label for="donate">Donate?</label>
            <input type="checkbox" name="donate" value="1" <?php if(isset($_POST) && isset($_POST['donate'])) { echo ' checked="checked" '; } elseif(isset($affiliate) && $affiliate->donate==1) { echo ' checked="checked" '; } ?>" id="donate" />
        </p>
        <p><label for="url">URL</label>
            <input type="text" name="url" size="35" value="<?php if($_POST) { echo $_POST['url']; } elseif(isset($affiliate)) { echo $affiliate->url; } ?>" id="url" />
        </p>
        <p><label for="managed">Managed?</label>
            <input type="checkbox" name="managed" value="1" <?php if(isset($_POST) && isset($_POST['managed'])) { echo ' checked="checked" '; } elseif(isset($affiliate) && $affiliate->managed==1) { echo ' checked="checked" '; } ?>" id="managed" />
        </p>
   <p><label for="active">Active?</label>
            <input type="checkbox" name="active" value="1" <?php if(isset($_POST) && isset($_POST['active'])) { echo ' checked="checked" '; } elseif(isset($affiliate) && $affiliate->active==1) { echo ' checked="checked" '; } ?>" id="managed" />
        </p>
            
        </fieldset>
        <p><label>&nbsp;</label>
            <input type="submit" name="submit" id="submit" value="<?php echo $action; ?> Affiliate" class="button"/>
        </p>
        </form>      
      </div><!-- Content //-->
</div><!-- Main //-->
    <div id="sidebar">
<?php include_once('sidebar.affiliate.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
