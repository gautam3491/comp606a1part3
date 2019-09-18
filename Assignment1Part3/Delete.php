<?php  
  
 if(!empty($_POST))  
 {  
    require 'dbconnect.php';
    /*$bookingid=$_POST["booking_id"];
    $query = "SELECT * FROM Bookings WHERE  BookingId =$bookingid";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);  
      echo json_encode($row);  */
      $output = '';  
      $message = '';  
      if($_POST["booking_id"] != '')  
      {  
           $query = "  
           DELETE FROM Bookings    
           WHERE Bookingid='".$_POST["booking_id"]."'";  
           $message = 'Booking cancelled';  
      }  
     //  else  
     //  {  
     //       $query = "  
     //       INSERT INTO tbl_employee(name, address, gender, designation, age)  
     //       VALUES('$name', '$address', '$gender', '$designation', '$age');  
     //       ";  
     //       $message = 'Data Inserted';  
     //  }  
      if(mysqli_query($mysqli, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM Bookings ORDER BY Bookingid DESC";  
           $result = mysqli_query($mysqli, $select_query);  
        //    $output .= '  
        //         <table class="table table-bordered">  
        //              <tr>  
        //                   <th width="70%">Massage Type</th>  
        //                   <th width="15%">Edit</th>  
        //                   <th width="15%">View</th>  
        //              </tr>  
        //    ';  
        //    while($row = mysqli_fetch_array($result))  
        //    {  
        //         $output .= '  
        //              <tr>  
        //                   <td>' . $row["MassageType"] . '</td>  
        //                   <td><input type="button" name="edit" value="Edit" id="'.$row["bookingid"] .'" class="btn btn-info btn-xs edit_data" /></td>  
        //                   <td><input type="button" name="view" value="view" id="' . $row["bookingid"] . '" class="btn btn-info btn-xs view_data" /></td>  
        //              </tr>  
        //         ';  
        //    }  
        //    $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>
 