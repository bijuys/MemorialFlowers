<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MemorialFlowers :: <?php echo $action;?> Customer</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
           <h1>Customers List</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader"><?php echo $action; ?> Customer</div>
        <form name="entry-form" id="entry-form" action="<?php echo base_url().'admin/customers/create';?>" method="post">
        <?php // echo validation_errors(); ?>
        <fieldset>
            <legend>Login Info</legend>
            <p><label for="username">Username</label>
                  <input type="text" name="username" size="35"  value="<?php if($_POST) { echo $_POST['username']; } elseif(isset($customer)) { echo $customer->username; } ?>" id="username" />
                  <?php echo form_error('username'); ?>
            </p>
            <p><label for="password">Password</label>
                  <input type="text" name="password" size="35"  value="<?php if($_POST) { echo $_POST['password']; } elseif(isset($customer)) { echo $customer->password; } ?>" id="password" />
                  <?php echo form_error('password'); ?>
            </p>            
        </fieldset>
        
        <fieldset>
            <legend>Personal Info</legend>
        <p><label for="firstname">Firstname</label>
            <input type="text" name="firstname" size="35" value="<?php if($_POST) { echo $_POST['firstname']; } elseif(isset($customer)) { echo $customer->firstname; } ?>" id="firstname" />
        <?php echo form_error('firstname'); ?></p>
        <p><label for="lastname">Lastname</label>
            <input type="text" name="lastname" size="35"  value="<?php if($_POST) { echo $_POST['lastname']; } elseif(isset($customer)) { echo $customer->lastname; } ?>" id="lastname" />
        <?php echo form_error('lastname'); ?>
        </p>
        <p><label for="email">Email</label>
            <input type="text" name="email" size="35"  value="<?php if($_POST) { echo $_POST['email']; } elseif(isset($customer)) { echo $customer->email; } ?>" id="email" />
        <?php echo form_error('email'); ?>
        </p>
        <p><label for="address">Address</label>
            <input type="text" name="address" size="35"  value="<?php if($_POST) { echo $_POST['address']; } elseif(isset($customer)) { echo $customer->address; } ?>" id="address" />
       <?php echo form_error('address'); ?>
        </p>
        <p><label for="city">City</label>
            <input type="text" name="city" value="<?php if($_POST) { echo $_POST['city']; } elseif(isset($customer)) { echo $customer->city; } ?>" id="city" />
        <?php echo form_error('city'); ?>
        </p>
        <p><label for="postalcode">Postalcode</label>
            <input type="text" name="postalcode" value="<?php if($_POST) { echo $_POST['postalcode']; } elseif(isset($customer)) { echo $customer->postalcode; } ?>" id="postalcode" />
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
        <p><label for="dayphone">Day Phone</label>
            <input type="text" name="dayphone" value="<?php if($_POST) { echo $_POST['dayphone']; } elseif(isset($customer)) { echo $customer->dayphone; } ?>" id="dayphone" />
        <?php echo form_error('telephone'); ?>
        </p>
        <p><label for="eveningphone">Evening Phone</label>
            <input type="text" name="eveningphone" value="<?php if($_POST) { echo $_POST['eveningphone']; } elseif(isset($customer)) { echo $customer->eveningphone; } ?>" id="eveningphone" />
        <?php echo form_error('telephone'); ?>
        </p>
  <p><label for="newsletter">Newsletter?</label>
            <input type="checkbox" name="newsletter" value="1" <?php if(isset($_POST) && isset($_POST['newsletter'])) { echo ' checked="checked" '; } elseif(isset($customer) && $customer->newsletter==1) { echo ' checked="checked" '; } ?>" id="newsletter" />
        </p>
   <p><label for="active">Active?</label>
            <input type="checkbox" name="active" value="1" <?php if(isset($_POST) && isset($_POST['active'])) { echo ' checked="checked" '; } elseif(isset($customer) && $customer->active==1) { echo ' checked="checked" '; } ?>" id="active" />
        </p>
            
        </fieldset>
        
      
        <p><label>&nbsp;</label>
            <input type="submit" name="submit" id="submit" value="<?php echo $action; ?> Customer" class="button"/>
        </p>
        </form>      
      </div><!-- Content //-->
</div><!-- Main //-->
    <div id="sidebar">
<?php include_once('sidebar.customer.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
