<!--Tyrone Overby
	New Karate site project
	-->
 <?php
    //ob_start()
  ?> 
<?php $page_title = 'Administration'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php echo $page_title; ?></title> 
  <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"> 
  
</head>

<body>
  <div id="wrapper">
    <div id="header">

      <h1>Customer administration</h1>
      
    </div> 

    <div id="tabs">
      <ul>
        <li><a href="create.php">Create Account</a></li>
        <li><a href="getrecords.php">Display Contact List</a></li>
        <li><a href="view_students.php">Display Current Students</a></li>
        <li><a href="eidt_user.php">Edit Student Info</a></li>
        <li><?php // Create a login/logout link:
              if (isset($_SESSION['user_id'])) {
                echo '<a href="logout.php">Logout</a>';
              } else {
                echo '<a href="javascript:login_win.js()">Login</a>';
              }
      ?></li>
      </ul> 
    </div>
  
  </div> 
 </body>
</html>