<?php  
 //fetch.php  
   
 if(isset($_POST["booking_id"]))  
 {  
    require 'dbconnect.php';
    $bookingid=$_POST["booking_id"];
    $query = "SELECT * FROM Bookings WHERE  BookingId =$bookingid";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>