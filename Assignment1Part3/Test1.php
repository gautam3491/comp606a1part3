<?php  
 require("usertab.php");
 require 'dbconnect.php';
 $fname=$_SESSION['firstname'];
     $lname=$_SESSION['lastname'];
     $email=$_SESSION['username'];
     $currentDateTime = date('Y-m-d');
 $query = "SELECT * FROM Bookings WHERE Email LIKE '$email' AND BookingDate >='$currentDateTime'";
 $result = mysqli_query($mysqli, $query);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>View Bookings</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Your upcoming Bookings</h3>  
                <br />  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <!-- <tr>  
                               <th width="70%">Employee Name</th>  
                               <th width="30%">View</th>  
                          </tr>   -->
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row['MassageType']." on ".$row['BookingDate']; ?></td>  
                               <td><input type="button" name="view" value="View Details" id="<?php echo $row["BookingId"]; ?>"
                                class="btn btn-info btn-xs view_data" /></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Booking Details</h4>  
                </div>    
                <div class="modal-body" id="booking_detail">  
                </div>  
                <div class="modal-footer">  
                <input type="button" name="view" value="Edit Booking" id="<?php echo $row["BookingId"]; ?>"
                class="btn btn-info btn-xs edit_data" />
                <input type="button" name="view" value="Cancel Booking" id="<?php echo $row["BookingId"]; ?>"
                class="btn btn-info btn-xs delete_data" />
                <input type="button" class="btn btn-close" data-dismiss="modal" value="Close"  />
                     <!-- <button type="button" class="btn btn-edit" >Edit Booking</button> 
                     <button type="button" class="btn btn-cancel" >Cancel Booking</button> 
                     <button type="button" class="btn btn-close" data-dismiss="modal">Close</button> -->
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var booking_id = $(this).attr("id");  
           $.ajax({  
                url:"test.php",  
                method:"post",  
                data:{booking_id:booking_id},  
                success:function(data){  
                     $('#booking_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var booking_id = $(this).attr("id");  
           $.ajax({  
                url:"test.php",  
                method:"post",  
                data:{booking_id:booking_id},  
                success:function(data){  
                     $('#booking_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 $(document).ready(function(){  
      $('.edit_data').click(function(){  
           var booking_id = $(this).attr("id");  
           $.ajax({  
                url:"test.php",  
                method:"post",  
                data:{booking_id:booking_id},  
                success:function(data){  
                     $('#booking_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
 </script>
