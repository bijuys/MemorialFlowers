

        
		<?php //include("header.php"); ?>
		
		
		
		<?php
		/*echo $note;
		echo $inv;
		echo $db_cd;*/
		
			//echo $inv;
			
			//echo 'info';
			
			$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
		
			$tim = date('Y-m-d H:i:s',time());
			mysqli_query($con,"UPDATE order_items SET delivered=1 WHERE orderitem_id=".$o_id);
			mysqli_query($con,"INSERT INTO order_tracking (order_id, activity, date_time, user_by) VALUES ('".$inv_id."', 'Delivered', '".$tim."', '".$dri_id."')");
			header("Location: http://new.memorialflowers.ca");
		?>
				
		
		<?php //include("footer.php"); ?>