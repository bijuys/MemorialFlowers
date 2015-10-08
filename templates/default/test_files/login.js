// JavaScript Document
             //Candidate Login Form Client side Validation Created Date: 06-December-2008.


function trim_ws(str)
{
        temp=str.replace(/^\s*/, "");
        temp=temp.replace(/\s*$/,"");
        return temp;
}






function Loginvalid()
{
	
	   //Description: Validates the Username field.	
        var msg='';
	    var cardnumber=trim_ws(document.getElementById('cardnumber').value);
		var expiry_month=trim_ws(document.getElementById('expiry_month').value);
		
		var expiry_year=trim_ws(document.getElementById('expiry_year').value);
		var cvv=trim_ws(document.getElementById('cvv').value);
		var error=0;
		 if((cardnumber!='') && (expiry_month!='')&&(expiry_year!='')&& (cvv!=''))
       // if((cardnumber!='')&& (expiry_month!='')&& (expiry_year!='')&& (cvv!=''))
        {
			msg+='Your Order is under Process, Please wait!.';
			
               // msg+='Please be sure Billing Information, Order Summary and Payment Details are accurate. Thanks!<br>';
				//document.getElementById('username').style.borderColor ='red';		
				//document.getElementById('cardnumber').focus();
 			error=error+1;
				
			alert(msg);	
			return true;
        }
		else
		{
			msg+='Please be sure your Billing Information, Order Summary and Payment Details are accurate. Thanks!';
		 //msg+='Please wait.....<br>';	
		 //popup.confirm(msg);
		 alert(msg);
        return false;
		}
		
		/*if(error>0)
		{
			//alert('Control is here!');
			//popup.alert(msg);
			alert(msg);
			return true;
		}*/
		
}
