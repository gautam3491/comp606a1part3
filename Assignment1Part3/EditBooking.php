<?php
require("usertab.php");
require 'dbconnect.php';
$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];
$email = $_SESSION['username'];
$currentDateTime = date('Y-m-d');
$query = "SELECT * FROM Bookings WHERE Email LIKE '$email' AND BookingDate >='$currentDateTime'";
$result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html>

<head>
     <title>View Edit Bookings</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
     <br /><br />
     <div class="container" style="width:700px;">
          <h3 align="center">Your upcoming bookings</h3>
          <br />
          <div class="table-responsive">
               <div align="right">
                    <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button>
               </div>
               <br />
               <div id="bookings_table">
                    <table class="table table-bordered">
                         <!-- <tr>  
                                    <th width="70%">Massage Type</th>  
                                    <th width="15%">Edit</th>  
                                    <th width="15%">View</th>  
                               </tr>   -->
                         <?php
                         while ($row = mysqli_fetch_array($result)) {
                              ?>
                              <tr>
                                   <td><?php echo $row["MassageType"] . " on " . date('d-M-Y', strtotime($row['BookedDate'])) . "," . date('H:i:s A', strtotime($row['Bookedtime'])); ?></td>
                                   <td><input type="button" name="edit" value="Edit" id="<?php echo $row["BookingId"]; ?>" class="btn btn-info btn-xs edit_data" /></td>
                                   <td><input type="button" name="edit" value="Cancel" id="<?php echo $row["BookingId"]; ?>" class="btn btn-info btn-xs delete_data" /></td>
                                   <td><input type="button" name="view" value="View" id="<?php echo $row["BookingId"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                              </tr>
                         <?php
                         }
                         ?>
                    </table>
               </div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<div id="add_data_Modal" class="modal fade">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Booking</h4>
               </div>
               <div class="modal-body">
                    <form method="post" id="insert_form">
                         <label>Enter Massage Type</label>
                         <input type="text" name="MassageType" id="MassageType" class="form-control" />
                         <br />
                         <label>Select Date</label>
                         <input type="date" name="BookingDate" id="dob" required="true" min="1900-01-01" title="No past dates." style="width:50%;border-radius:10px;height: 25px;">
                         <br />
                         <label>Select Time</label>
                         <br />
                         <label>Select Duration</label>
                         <select name="duration" id="duration" class="form-control">
                              <option value="30">30 minutes</option>
                              <option value="60">60 minutes</option>
                         </select>
                         <!-- <label> Amount</label>  
                          <input type="text" name="age" id="age" class="form-control" />   -->
                         <br />
                         <input type="hidden" name="booking_id" id="booking_id" />
                         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<script>
     $(document).ready(function() {
          $('#add').click(function() {
               $('#insert').val("Insert");
               $('#insert_form')[0].reset();
          });
          $(document).on('click', '.edit_data', function() {
               var booking_id = $(this).attr("id");
               $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                         booking_id: booking_id
                    },
                    dataType: "json",
                    success: function(data) {
                         $('#MassageType').val(data.MassageType);
                         $('#Email').val(data.Email);
                         $('#BookingDate').val(data.BookingDate);
                         $('#BookingTime').val(data.BookingTime);
                         $('#Duration').val(data.duration);
                         $('#booking_id').val(data.bookingid);
                         $('#Amount').val(data.amount);
                         $('#insert').val("Update");
                         $('#add_data_Modal').modal('show');
                    }
               });
          });
          $('#insert_form').on("submit", function(event) {
               event.preventDefault();
               if ($('#MassageType').val() == "") {
                    alert("Massage Type is required");
               } else if ($('#BookingDate').val() == '') {
                    alert("Booking Date is required");
               } else if ($('#Booking Time').val() == '') {
                    alert("Booking Time is required");
               } else if ($('#Duration').val() == '') {
                    alert("Duration is required");
               } else {
                    $.ajax({
                         url: "insert.php",
                         method: "POST",
                         data: $('#insert_form').serialize(),
                         beforeSend: function() {
                              $('#insert').val("Inserting");
                         },
                         success: function(data) {
                              $('#insert_form')[0].reset();
                              $('#add_data_Modal').modal('hide');
                              $('#bookings_table').html(data);
                         }
                    });
               }
          });
          $(document).on('click', '.view_data', function() {
               var booking_id = $(this).attr("id");
               if (booking_id != '') {
                    $.ajax({
                         url: "select.php",
                         method: "POST",
                         data: {
                              booking_id: booking_id
                         },
                         success: function(data) {
                              $('#booking_detail').html(data);
                              $('#dataModal').modal('show');
                         }
                    });
               }
          });
          $(document).on('click', '.delete_data', function() {
               var booking_id = $(this).attr("id");
               if (booking_id != '') {
                    $.ajax({
                         url: "delete.php",
                         method: "POST",
                         data: {
                              booking_id: booking_id
                         },
                         success: function(data) {
                              $('#booking_detail').html(data);
                              $('#dataModal').modal('show');
                         }
                    });
               }
          });
     });
</script>