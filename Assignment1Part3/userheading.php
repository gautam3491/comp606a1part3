 <!--Header for the application -->
 <?php
include('UserCheck.php');?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
  body {
  font-family: Arial, Helvetica, sans-serif;
  }

  .navbar1 {
  overflow: hidden;
  background-color: #333; 
  }

  .navbar1 a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  }

  .dropdown {
  float: left;
  overflow: hidden;
    }

  .dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
  }

  .navbar1 a:hover, .dropdown:hover .dropbtn {
  background-color: red;
  }

  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  }

  .dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  }

  .dropdown-content a:hover {
  background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
  display: block;
  
  }
</style> 
    </head>
    <body> 

  
    <div class="navbar1">
  <a href="#home">Home </a>
  <a href="#news">About</a>
  <div class="dropdown">
    <button class="dropbtn"> 
     <?php echo $_SESSION['firstname']; ?> 
    
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#" >Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
</div>
            <!-- <nav id="navbar">
                <ul style="text-align:right;">
                     <a href="#">Home</a>|
                     <a href="#">About</a>|
                     <a href="#">Contact Us</a>
                </ul>
            </nav> -->
    </body>
</html>
