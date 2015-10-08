<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    
	
	
	<?php
		   $usage=0;
		   
		   
		   IF(ISSET($_POST['submitsocialname'])){
				$socialtypename = $_POST['socialname'];
				echo $socialtypename;
				$socialdescription = $_POST['socialdescription'];
				$query3 = "INSERT INTO socialmedianame(socialtypename,description) VALUES ('$socialtypename','$socialdescription')";
				mysql_query($query3);
								
			}
					
		   
		   
			$categorytype = 0;
			$checkersocial = 0;
			IF(ISSET($_POST['socialtypemenu'])){
				$categorytype = $_POST['socialtypemenu'];
				$checkersocial = 1;
				
			}
						
			
			
		
		if(isset($_POST['submit'])) {
		
			echo "came here";
			
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COUPONS :: <?=$defaultDomain?></title>
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<link href="admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:visited {
	text-decoration: none;
	color: #996699;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
a:link {
	text-decoration: none;
	color: #0000CC;
}
-->
</style>
</head>

<body>

<br />
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#F3F0F9">
      <tr>
        <td class="mainheading">Social Media - Coupon Validation </td>
      </tr>
    </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" align="left" valign="top">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td class="tinytext">:: <a href="siteadmin">Admin home</a> &gt; Coupons </td>
  </tr>
  <tr>
    <td class="tinytext"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="../images/dotline.gif">
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
	*/
	// else {
?>
          </p>
          
                    <?php
					if(!isset($start))
						$start = date('Y-m-d',time());
					if(!isset($end))
						$end = date('Y',time()).'-12-31';
					if(!isset($value))
					    $value='0.00';
						
				
						$customername = 'All customers';
							$customer = 0;
							$customer_id = 0;
						$result = mysql_query("SELECT * FROM socialmedia WHERE customer_id=0 AND dstatus=1 AND category=$categorytype");
						
				?>
               
			
					<?php 
					if ($checkersocial == '1'){
					
										
					$result2 = mysql_query("SELECT counter,socialtypename,socialcontactperson,description,socialcontactno,socialcity,socialstate,socialemail,startdate FROM socialmedianame where counter=$categorytype") or die("error occured");
									
									
								while ($row2 = mysql_fetch_array($result2)) {
									
									echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
									echo "<tr><td  class='actionheading'>";
									echo "You have selected, <br />
									Social Media Name as : ".$row2['socialtypename']; 
									echo "</td></tr>";
									echo "<tr><td> Contact Person : ".$row2['socialcontactperson'];
									echo "</td></tr>";
									echo "<tr><td> Contact no. : ".$row2['socialcontactno']."</td></tr>";
									echo "<tr><td> Address : ".$row2['description']."</td></tr>";
									echo "<tr><td> City : ".$row2['socialcity']."</td></tr>";
									echo "<tr><td> State : ".$row2['socialstate']."</td></tr>";
									echo "<tr><td> Email : ".$row2['socialemail']."</td></tr>";
									echo "<tr><td> Start Date : ".$row2['startdate']."</td></tr>";
									echo "</table>";
									echo "<hr>";
									
									}
									
					}
									
								 		
					
					
					?>
						<br />
						
						
						<?php
						
						if ( /*$_POST['socialtype'] == NULL*/ 1 == 1 ){
						
						?>
						<form action="socialmediaprofile" method="
						post"><input name="addprogram" type="submit" value="Add A New Program"></form>
						
						<br />
						

					
					   	<hr>		
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
						<tr>
						  <td colspan="2" class="actionheading">Select Social Media Type !
						</td>
						</tr>
						</table>

				
				
				
			<!--	<form name="socialtype" action="<?=current_url()?>" method="post" enctype="multipart/form-data" >
				-->
						<?php
							
						echo form_open(current_url());
					
						 $result1 = mysql_query("SELECT counter,socialtypename FROM socialmedianame") or die("error occured");
								
						 $cont1 = '';	
								while ($row = mysql_fetch_array($result1)) {
																
									$cont1 .= "<option value='$row[counter]'>$row[socialtypename]</option>";
								
									}
								 								
							?>
						
						<select name="socialtypemenu">
						<!-- <option value="0" selected>(please select:)</option>   -->
					    <?php 
						   echo $cont1;
						?>
						
						
											
						</select>
						<div><input type="submit" name="socialtype" value="Update" /></div>
						
						
						<?php
						
						}
						else
						{
						
						// do nothing
						
						}
						
						?>
				</form>
					<br />

					<table width="100%" border="0" cellpadding="2" cellspacing="0">
						<tr>
						  <td colspan="2" class="actionheading">Select a File for Multi Coupon !
						</td>
						</tr>
					</table>
			
			 <form action="<?=current_url()?>" method="post" enctype="multipart/form-data" name="submitdata" id="submitdata">
				<label for="file">Filename:</label>
				<input type="file" name="file" id="file" />
				<br />
				<input type="submit" name="submitdata" value="Upload" />
				</form>
					<br />
				
				<?php
				
		
							
				
		IF(ISSET($_POST['submitdata'])){	
		
		
		
					if ((($_FILES["file"]["type"] == "text/plain"))
					&& ($_FILES["file"]["size"] < 20000))
					  {
					  if ($_FILES["file"]["error"] > 0)
						{
						echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
						}
					  else
						{
						echo "Upload: " . $_FILES["file"]["name"] . "<br />";
						echo "Type: " . $_FILES["file"]["type"] . "<br />";
						echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
						echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

						  $_FILES["file"]["name"] = "currentfile.txt";
						  move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
						  echo "Stored in: " . "uploadmedia/" . $_FILES["file"]["name"];
						  
						}
					  }
					  
					else
					  {
					  echo "Invalid file";
					  }
					}
			 
					?>
						<br /><br />
					
					
								
						<form action="<?=current_url()?>" method="post" enctype="multipart/form-data" name="populatedata" id="populatedata">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
						<tr>
						  <td colspan="2" class="actionheading">Add Multi Social Media Coupon ! 
							<table width="100%" border="0" cellpadding="0" cellspacing="0" background="../images/dotline.gif">
							  <tr>
								<td><img src="../images/spacer.gif" width="10" height="1" /></td>
							  </tr>
							</table>				</td>
						  </tr>
						  <?//=$cerr?>
						
						
						<tr>
						  <td class="normaltext">Discount type </td>
						  <td><select name="type1" class="inputtext" id="type1">
							<option value="coupon">Coupon</option>
							<option value="gift">Gift Certificate</option>
						  </select>              </td>
						</tr>
						<tr>
						  <td class="normaltext">Value</td>
						  <td>
							<input name="value1" type="text" class="inputtext" id="value" value="<?//=$value1?>" size="7" dir="rtl" />
							<select name="figuretype1" class="inputtext" id="figuretype1">
							<option value="1">$</option>
							<option value="2">%</option>
							</select>                </td>
						</tr>
						<tr>
						  <td class="normaltext">Usage</td>
						  <td><select name="usage1" class="inputtext" id="usage1">
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Multi</option>
						  </select>              </td>
						</tr>
						<tr>
						  <td class="normaltext">Period</td>
						  <td><input name="start1" type="text" class="inputtext" id="start" value="<?=$start?>" size="10" />
							<span class="normaltext">to</span> 
							  <input name="end1" type="text" class="inputtext" id="end" value="<?=$end?>" size="10" /></td>
						</tr>
						<input name="categorytype1" type="hidden" id="categorytype1" value="<?=$categorytype?>"  />
						<tr>
						  <td width="50%">&nbsp;</td>
						  <td width="50%"><label>
							<input name="populatedata" type="submit" class="inputtext" id="populatedata" value="Create Multi" />
							<input name="customer" type="hidden" id="customer" value="<?=$customer?>" />
						  </label></td>
						</tr>
					  </table>
					  </form>
					<?php
					
					IF(ISSET($_POST['populatedata'])){
					
						$myFile = "currentfile.txt";
						$fh = fopen($myFile, 'r');
						$theData = fread($fh, filesize($myFile));
						fclose($fh);
						echo $theData;
						
						
						
						$keywords = preg_split("/[\s,]+/", $theData);
						
						$track1 = count($keywords);
						
						 $track = 0;
						 echo $keywords[0];
						 echo $keywords[1];
						 $dstatus = 1;
						while ($track<$track1){
						
						$query = "INSERT INTO socialmedia(customer_id,value,figuretype,
			 			start,end,maxuse,number,discounttype,dstatus,category) VALUES ($customer,$value1,$figuretype1,
						'$start1','$end1',$usage1,'$keywords[$track]','$type1',$dstatus,$categorytype1)";
						
						mysql_query($query);
						
						
						
						
						
						$track = $track + 1;
						
						}
						
						
					}
					
									
					
					?>
                         
							<br />
							<hr>
							
          <form action="<?=current_url()?>" method="post" enctype="multipart/form-data" name="new" id="new">
            <table width="100%" border="0" cellpadding="2" cellspacing="0">
            <tr>
              <td colspan="2" class="actionheading">Add a new Social Media Coupon ! 
                <table width="100%" border="0" cellpadding="0" cellspacing="0" background="../images/dotline.gif">
                  <tr>
                    <td><img src="../images/spacer.gif" width="10" height="1" /></td>
                  </tr>
                </table>				</td>
              </tr>
			  <?//=$cerr?>
            <tr>
              <td width="50%" class="normaltext">Code </td>
              <td width="50%"><label><input name="number" type="text" class="inputtext" id="number" value="<?//=$number?>" maxlength="45" />
              </label></td>
            </tr>
            
            <tr>
              <td class="normaltext">Discount type </td>
              <td><select name="type" class="inputtext" id="type">
                <option value="coupon">Coupon</option>
                <option value="gift">Gift Certificate</option>
              </select>              </td>
            </tr>
            <tr>
              <td class="normaltext">Value</td>
              <td>
                <input name="value" type="text" class="inputtext" id="value" value="<?=$value?>" size="7" dir="rtl" />
                <select name="figuretype" class="inputtext" id="figuretype">
				<option value="1">$</option>
				<option value="2">%</option>
                </select>                </td>
            </tr>
            <tr>
              <td class="normaltext">Usage</td>
              <td><select name="usage" class="inputtext" id="usage">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Multi</option>
              </select>              </td>
            </tr>
            <tr>
              <td class="normaltext">Period</td>
              <td><input name="start" type="text" class="inputtext" id="start" value="<?=$start?>" size="10" />
                <span class="normaltext">to</span> 
                  <input name="end" type="text" class="inputtext" id="end" value="<?=$end?>" size="10" /></td>
            </tr>
		
            <input name="categorytype1" type="hidden" id="categorytype1" value="<?=$categorytype?>"  />
            <tr>
              <td width="50%">&nbsp;</td>
              <td width="50%"><label>
                <input name="submit" type="submit" class="inputtext" id="submit" value="Create" />
                <input name="customer" type="hidden" id="customer" value="<?=$customer?>" />
              </label></td>
            </tr>
          </table>
		  </form>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td align="center" class="tinytext"> [ <a href="index.php">Back to Admin</a> ] </td>
            </tr>
          </table>
          <?php
// } else ends here
?>	      </td>
          <td width="1" align="left" valign="top" background="../images/dotline.gif">&nbsp;</td>
          <td align="left" valign="top"><img src="../images/spacer.gif" width="15" height="10" /></td>
          <td width="50%" align="right" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBE4B1">
            <tr>
              <td align="left" class="textheading">Coupons for <?=$customername?> </td>
            </tr>
            <tr>
              <td align="left" bgcolor="#FFFFFF">
<?php
	if(mysql_num_rows($result)>0) {
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">  
    <tr>
      <td class="normaltext">Final Status </td>
      <td class="normaltext">Code</td>
      <td class="tinytext">Type</td>
      <td class="tinytext">Used</td>
	  <td class="tinytext">Entered</td>
      <td class="tinytext">&nbsp;</td>
    </tr>  
    <?php
	$totalactive = '0';
	$totalused = '0';
	$totalcoupons = '0';
	$sel = '';
	
		while($ln = mysql_fetch_array($result)) {
			$sel .= '<option value="'.$ln['number'].'">'.$ln['number'].'</option>'."\n";
			//if($ln["coupon_id"]==$lastid) { $bgc = "bgcolor=\"#F2F9EC\""; $star = "*"; }
			// else { unset($bgc); unset($star); }
	?>
    <tr><td class="normaltext" <?//=$bgc;?>>
    <?php
			if(($ln['used']<$ln['maxuse']) || ($ln['maxuse']==0)) {
			    echo '<img src="../images/true.gif" border="0">';
				$totalactive = $totalactive + 1;
				$totalcoupons = $totalcoupons + 1;
				}
			else {
		    echo '<img src="../images/false.gif" border="0">'.'Used';
			
			$totalused = $totalused + 1;
			$totalcoupons = $totalcoupons + 1;
			}
	?>
			</td><td class="normaltext" <?//=$bgc;?>>    
			
			
			
    <?php
			echo $ln["number"]." ".' - ';
			if($ln['figuretype']==1)
				echo '$'.$ln['value'];
			else
				echo $ln['value'].'%';
	?>
		</td><td class="tinytext"><?=$ln['discounttype']?>
     	</td>
		<td><?=$ln['used']?></td>
		<td class="normaltext" <?//=$bgc;?>>
		 <?php
			if($ln['activestatus']==1)
			    echo '<img src="../images/true.gif" border="0">'.'Active';
			else
				echo '<img src="../images/false.gif" border="0">';
	?>
		</td>
		<td>[<a href="delcoupon3.php?id=<?=$ln['discount_id'];?>" class="tinytext">DEL</a>]		</td></tr><tr><td background="../images/dotline.gif" colspan="6">
		<img src="../images/spacer.gif" width="10" height="1" border="0"></td></tr>
    <?php 		
		}
	?>
	
	
	
	<tr>
	
	
	<td colspan="6">
	<br />
	</td>
	</tr>
	
	<tr>
	
	
	<td colspan="6">
	<center><b> SOCIAL MEDIA REPORTS </b></center>
	</td>
	</tr>
	
	
		<tr>
	
	
	<td colspan="6">
	<br />
	</td>
	</tr>
	
	<tr>
	
	
	<tr>
	<td>
	Total Coupons</td>
	<td>
	Total Active</td>
	<td>
	Total Used </td>
	<td>
	</td>
	<td>
	</td>
	<td>
	</td>
	
	</tr>
	
	
		<tr>
	
	
	<td colspan="6">
	<br />
	</td>
	</tr>
	
	<tr>
	
	<tr>
	
	<td>
	<?=$totalcoupons?>
	</td>
	
	<td>
	<?=$totalactive?></td>
	<td>
	<?=$totalused?> </td>
	<td>
	</td>
	<td>
	</td>
	<td>
	</td>
	
	</tr>
	</b>
	</table>
	<?php
	}
	else {
			echo "Sorry no coupon is set!";
	}
?>			  </td>
            </tr>
          </table>
            <br />
            <br />
            <form id="form2" name="form2" method="post" action="setcouponmedia.php" enctype="multipart/form-data">
              <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#CBE4B1">
                <tr>
                  <td colspan="2" class="textheading">Search Instructions</td>
                </tr>
				<tr>
					<td bgcolor="#FFFFFF" class="normaltext" align="left">--> Press Ctrl + F <br />
					--> Type Activation Code <br /> 
					--> and Locate tick mark on the left <br />
					</td>
				</tr>
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
</body>
</html>
	
	
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>