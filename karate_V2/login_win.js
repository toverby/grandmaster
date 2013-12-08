
function popup(width,height) 
{
 
 if (window.popup && !window.popup.closed)
 {
 	window.popup.resizeTo(width, height);
 }

 
 
 var params = "width=400, height=400, location=no, scrollbars=no,
 toolbars=no, menubars=no, toolbars=no, resizable=yes, left=500, top=500";

url="login.php";
popup=window.open(url, "Login", params)
popup.focus();

}//end function




