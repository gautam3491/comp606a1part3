<?php  
 if(isset($_POST["booking_id"]))  
 {  
      $output = '';  
      
 require 'dbconnect.php';
 $bookingid=$_POST["booking_id"];
 $query = "SELECT * FROM Bookings WHERE  BookingId =$bookingid";
 $result = mysqli_query($mysqli, $query);
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Massage Type</label></td>  
                     <td width="70%">'.$row["MassageType"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Booking Date</label></td>  
                     <td width="70%">'.$row["BookingDate"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Booking Time</label></td>  
                     <td width="70%">'.$row["BookingTime"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Duration</label></td>  
                     <td width="70%">'.$row["Duration"].' minutes</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Amount</label></td>  
                     <td width="70%">$'.$row["Amount"].'</td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
    