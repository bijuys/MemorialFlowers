// JavaScript Document






// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}



$(document).ready(function(){
	
	
	$("#addmore").click(function(e){
		e.preventDefault();
		$("#price-div").append('<p><input type="text" name="option[]" id="option[]" /> <input name="price[]" type="text" id="price[]" size="7" /> <input type="file" name="option_picture[]" /><small>[<a href="##" class="deloption">Del</a>]</small>');
		$(".deloption").bind('click',function(){
			$(this).parent().parent().remove();
		});
	});
	
	$(".remove").click(function(){
		$(this).remove();
		alert('test');
	});
	
	$(".deloption").click(function(){
		$(this).parent().parent().remove();
	});
	
	$(".accountchooser").click(function(){
       if($(this).val()=='company')
       {
			$("#signup_user_heading").html('Enter Company Information');
			$("#signup_company_box").attr('style','display:block;');
	   }
	   else
	   {
			$("#signup_user_heading").html('Enter Personal Information');	
			$("#signup_company_box").attr('style','display:none;');	
			$("#business").val('');
	   }

	});
	
	$(".lmenu").click(function(){
				
		if($(this).attr("src")=="/images/collapse.gif") {
			$(this).attr("src","/images/expand.gif");
			$(this).next().css("display","none");
		} else {
			$(this).attr("src","/images/collapse.gif");	
			$(this).next().css("display","");		
		}

	});

	$(".lmenu").trigger("click");
	$("#lm1").trigger("click");
	
});
