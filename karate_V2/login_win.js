function create_window (image, width, height)
 {

	//width = width + 10;
	//height = height + 10;
	
	
	if (window.popup && !window.popup.closed) {
		window.popup.resizeTo(width, height);
	} 
	
	// Set the window properties:
	var specs = "location=no, scrollbars=no, menubars=no, toolbars=no, resizable=no, width=500, height=500, right=0,left=(screen.width-width)/2, var top=(screen.height-height)/2;

	// Set the URL:
	var url = "login.php" ;
	
	// Create the pop-up window:
	popup = window.open(,"Login", specs);
	popup.focus();
	
} // End of function.