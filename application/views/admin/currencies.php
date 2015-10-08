<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Currencies <a href="http://www.whatabloom.com/siteadmin/currencies/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">Currency</th>
        <th width="5%">Symbol</th>
        <th width="20%">Description</th>
        <th width="5%">Prefix</th>
        <th width="5%">Suffix</th>
        <th width="10%">Exchg Rate</th>
        <th width="20%">Last Updated</th>
        <th width="5%">Default</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($currencies as $dkey=>$dval) : ?> 
      <tr <?php echo $dval->base_currency==1 ? 'style="font-weight: bold;"':''; ?>>
        <td><?php echo $dval->currency_id;?></td>
        <td class="left"><?php echo $dval->currency_symbol;?></td>
        <td class="left">
          <?php echo $dval->currency_name;?>
        </td>
        <td><?php echo $dval->prefix;?></td>
        <td><?php echo $dval->suffix;?></td>
        <td><?php echo number_format($dval->exchange_rate,4);?></td>
        <td><?php 
                  $difference = time() - $dval->timestamp;

                  if($difference<(60*60))
                  {
                    echo number_format($difference/60,0);
                    echo ' minutes ago';
                  }
                  elseif($difference<(60*60*24))
                  {
                    echo number_format($difference/(60*60),0);
                    echo ' hours ago';
                  }
                  elseif($difference<(60*60*24*7))
                  {
                    echo number_format($difference/(60*60*24),0);
                    echo ' days ago';
                  }
                  elseif($difference<(60*60*24*7*4))
                  {
                    echo number_format($difference/(60*60*24*7),0);
                    echo ' weeks ago';
                  }
                  elseif($difference<(60*60*24*7*4*365))
                  {
                    echo number_format($difference/(60*60*24*7*4),0);
                    echo ' months ago';
                  }
                  else
                  {
                    echo number_format($difference/(60*60*24*7*4*365),0);
                    echo ' years ago';                    
                  } ?>

                 </td>
        <td><?php if($dval->base_currency) { echo 'Yes'; } else { echo '-'; } ?></td>
        <td><a href="<?php echo current_url();?>/edit/<?php echo $dval->currency_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$dval->currency_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>