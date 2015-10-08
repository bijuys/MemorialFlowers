<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  
  
  <div id="contents-wrapper">
    

<?		
		   $usage=0;
		   
						$startdate = date('Y-m-d',time());
		   
		 
		   
		   
			$categorytype = 0;
			$checkersocial = 0;
			IF(ISSET($_POST['socialtypemenu'])){
				$categorytype = $_POST['socialtypemenu'];
				$checkersocial = 1;
				
			}
						
			
			
		
		if(isset($_POST['submit'])) {
		
			
		     $query = "INSERT INTO socialmedia(customer_id,value,figuretype,
			 			start,end,maxuse,number,discounttype,category) VALUES ($customer,$value,$figuretype,
						'$start','$end',$usage,'$number','$type',$categorytype1)";
			mysql_query($query);
			$lastid = mysql_insert_id();
			unset($number);
			unset($start);
			unset($end);
			unset($value);
			unset($figuretype);
			unset($usage);
			unset($type);
			
		
		}
		
		
		
		
		
		$cu = mysql_query("SELECT * FROM customers");
?>





<br />
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#F3F0F9">
      <tr>
        <td class="mainheading">Social Media - Company/Program Profile </td>
      </tr>
    </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" align="left" valign="top">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td class="tinytext">:: <a href="../siteadmin">Admin home</a> &gt; <a href="socialmedia">Social Media</a>  </td>
  </tr>
  <tr>
    <td class="tinytext"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td><img src="../images/spacer.gif" width="15" height="1" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
/*
	if($success) {
?>
		  <table width="100%" height="150" border="0" cellpadding="5" cellspacing="0">
            <tr>
              <td align="center"><p class="successtext"><?=$success?></p><p><a href="<?=$_SERVER['HTTP_REFERER']?>" class="tinytext"><u>Back</u></a></p></td>
            </tr>
          </table>
          <p>
            <?php
	}
	else {
*/	
?>
          </p>
           <!-- Hello <form id="form1" name="form1" method="post" action="<?=$PHP_SELF?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
               <tr>
               <td width="50%" class="normaltext">Select a Customer</td>
                <td width="50%"><select name="customer" class="inputtext" onchange="javascript:this.form.submit();">
                <option value="0">All customers</option>  -->
                    <?php
					if(!isset($start))
						$start = date('Y-m-d',time());
					if(!isset($end))
						$end = date('Y',time()).'-12-31';
					if(!isset($value))
					    $value='0.00';
						/*
				while($line=mysql_fetch_array($cu)) {
						echo '<option value="'.$line['customer_id'].'"';
						if($customer==$line['customer_id']) {
								echo ' selected="selected" ';
								echo $customername = $line['firstname'].' '.$line['lastname'];
						}
						elseif(!isset($customer) && !isset($customername) || ($customer==0)) {
							$customername = 'All customers';
							$customer = 0;
						}
							
						echo '>';
						echo $line['firstname'].' '.$line['lastname'].' #'.$line['customer_id'].'</option>'."\n";
						
				}
				
					if($customer!=0)
						$result = mysql_query("SELECT * FROM socialmedia WHERE (customer_id=$customer OR customer_id=0) 
									AND dstatus=1");
					else
					*/
				
						$customername = 'All customers';
							$customer = 0;
							$customer_id = 0;
						$result = mysql_query("SELECT * FROM socialmedia WHERE customer_id=0 AND dstatus=1 AND category=$categorytype");
						
				?>
                <!-- </select></td> 
              </tr>				
            </table>   -->
			
					<?php 
					if ($checkersocial == '1'){
					
										
					$result2 = mysql_query("SELECT counter,socialtypename,description,socialcontactperson,socialcontactno FROM socialmedianame where counter=$categorytype") or die("error occured");
									
									
								while ($row2 = mysql_fetch_array($result2)) {
								
									
									
										
									
									}
									
					}
									
								 		
					
					
					?>
			
					<form name = "socialmedianame" action="<? echo current_url(); ?>" method="post" enctype="multipart/form-data" >
					<hr>
					<table>
					<tr><td>
					Program Name : &nbsp; &nbsp;&nbsp; 
					<input name="socialname" type="text"  id="Enter Social Media Name" size="23" /><br />
					</td></tr>
					<tr><td>
					Contact Person : &nbsp; &nbsp; 
					<input name="socialcontactperson" type="text"  id="Enter Social Contact"  size="23" /><br />
					</td></tr>
					<tr><td>
					Phone Number : &nbsp; &nbsp; 
					<input name="socialcontactno" type="text"  id="Enter Social Phone" size="23" /><br />

					</td></tr>
					<tr><td>
					Address : &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
					<textarea rows="3" cols="23" name="socialdescription"   ></textarea> <br />
					</td></tr>
					<tr><td>
					City : &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
					<input name="socialcity" type="text"  id="Enter Social Contact"  size="23" /><br />
					</td></tr>
					<tr><td>
					State : &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
					<input name="socialstate" type="text"  id="Enter Social Contact"  size="23" /><br />
					</td></tr>
					<tr><td>
					Email : &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
					<input name="socialemail" type="text"  id="Enter Social Contact"  size="23" /><br />
					</td></tr>
					
					<tr><td>
					<input name="submitsocialname" type="submit" value="Add" />	<br /><br />
					</td></tr>
					</table>
					
				
					</form>
			
			
						
				
				
				
					

					
					
          
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="center" class="tinytext"> [ <a href="socialmedia">Back to Social Media</a> ] </td>
            </tr>
          </table>
          <?php
// } // else ends here
?>	      </td>
          <td width="1" align="left" valign="top" background="../images/dotline.gif">&nbsp;</td>
          <td align="left" valign="top"><img src="../images/spacer.gif" width="15" height="10" /></td>
          <td width="50%" align="right" valign="top">
            <br />
            
            
				<!--
                <tr>
					
                  <td bgcolor="#FFFFFF" class="normaltext">Coupon</td>
                  <td bgcolor="#FFFFFF"><label for="couponid"></label>
                    <select name="discount_id" class="inputtext" id="couponid">
							<? // =$sel; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="normaltext">Popup image</td>
                  <td bgcolor="#FFFFFF"><label for="image"></label>
                  <input name="image" type="file" class="inputtext" id="image" /></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF">&nbsp;</td>
                  <td bgcolor="#FFFFFF"><label for="button"></label>
                      <input name="button" type="submit" class="inputtext" id="button" value="Submit" /></td>
                </tr> -->
              </table>
                        </form>
          </td>
        </tr>
      </table>
      <br />
    
            </td>
  </tr>
</table>

</div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>
