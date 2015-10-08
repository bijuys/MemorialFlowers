<?php include_once("header.php"); ?>
  <div id="icons-wrapper">
    <table border="0" align="center" cellpadding="5" cellspacing="0" id="icons-table">
      <tr>
        <td>
        <?php if(accessGrant('products')) : ?>  
          <a href="<?php echo FCBASE; ?>/products"><img src="/admin/images/promotion.png" width="64" height="64" border="0" />Products</a>
        <?php else : ?>
          <a href="#"><img src="/admin/images/promotion_dim.png" width="64" height="64" border="0" /><strike>Products</strike></a>
        <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('orders')) : ?> 
              <a href="<?php echo FCBASE; ?>/orders/browse"><img src="/admin/images/dollar_currency_sign.png" width="64" height="64" border="0" />Orders</a></td>
          <?php else : ?>
              <a href="#"><img src="/admin/images/dollar_currency_sign_dim.png" width="64" height="64" border="0" /><strike>Orders</strike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('translation')) : ?> 
          <a href="<?php echo FCBASE; ?>/translation"><img src="/admin/images/ruler_pencil.png" width="64" height="64" border="0" />Translation</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/ruler_pencil_dim.png" width="64" height="64" border="0" /><strike>Translation</strike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('menu')) : ?> 
          <a href="<?php echo FCBASE; ?>/menu"><img src="/admin/images/computer_accept.png" width="64" height="64" border="0" />Menus</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/computer_accept_dim.png" width="64" height="64" border="0" /><strike>Menus</strike></a>
          <?php endif; ?>        
        </td>
        <td>
          <?php if(accessGrant('categories')) : ?> 
          <a href="<?php echo FCBASE; ?>/categories"><img src="/admin/images/office_folders.png" width="64" height="64" border="0" />Categories</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/office_folders_dim.png" width="64" height="64" border="0" /><strike>Categories</strike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('occasions')) : ?> 
          <a href="<?php echo FCBASE; ?>/occasions"><img src="/admin/images/green_flag.png" width="64" height="64" border="0" />Occasions</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/green_flag_dim.png" width="64" height="64" border="0" /><strike>Occasions</strike></a>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php if(accessGrant('customers')) : ?>
            <a href="<?php echo FCBASE; ?>/customers"><img src="/admin/images/users.png" width="64" height="64" border="0" />Customers</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/users_dim.png" width="64" height="64" border="0" /><strike>Customers</stike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('affiliates')) : ?>
          <a href="<?php echo FCBASE; ?>/affiliates"><img src="/admin/images/image.png" width="64" height="64" border="0" />Affiliates</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/image_dim.png" width="64" height="64" border="0" /><strike>Affiliates</strike></a>
          <?php endif; ?>
        
        </td>
        <td>
          <?php if(accessGrant('reports')) : ?>
          <a href="<?php echo FCBASE; ?>/reports/view/sales"><img src="/admin/images/chart_pie.png" width="64" height="64" border="0" />Reports</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/chart_pie_dim.png" width="64" height="64" border="0" /><strike>Reports</strike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('countries')) : ?>
          <a href="<?php echo FCBASE; ?>/countries"><img src="/admin/images/target.png" width="64" height="64" border="0" />Locations</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/target_dim.png" width="64" height="64" border="0" /><strike>Locations</strike></a>
          <?php endif; ?>
        </td>
        <td>
          <?php if(accessGrant('emails')) : ?>
          <a href="<?php echo FCBASE; ?>/emails"><img src="/admin/images/mail.png" width="64" height="64" border="0" />Mail Setup</a>
          <?php else : ?>
          <a href="#"><img src="/admin/images/mail_dim.png" width="64" height="64" border="0" /><strike>Mail Setup</strike></a>
          <?php endif; ?>        
        </td>
        <td>
          <a href="<?php echo FCBASE; ?>/welcome/logout"><img src="/admin/images/lock.png" width="64" height="64" border="0" />Logout</a>
        </td>
      </tr>
    </table>
  </div>
<?php include_once("footer.php"); ?>