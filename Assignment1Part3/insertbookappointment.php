<?php
session_start();

if (isset($_POST["book"])) {
    require 'dbconnect.php';

    $serviceid = $_POST["id"];
    $email = $_POST['email'];
    $massagetype = $_POST["massagetype"];
    $duration = $_POST['duration'];
    $amount = $_POST['amount'];
    $bookeddate = $_POST['date'];
    $bookedtime = $_POST['time'];
    $msg = $_POST['message'];
    $employeeid = $_POST['therapist'];
    // echo $employeeid;

    $sql = "select * from bookings where employeeid=" . $employeeid . " and bookedtime='" . $bookedtime . "' and bookeddate='" . $bookeddate . "'";

    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_num_rows($result);
    echo $row;
    if ($row == 0) {
        $sql1 = "select * from bookings where email='" . $email . "' and serviceid=" . $serviceid . " and bookedtime='" . $bookedtime . "' and bookeddate='" . $bookeddate . "'";
        $result1 = mysqli_query($mysqli, $sql1);
        $row1 = mysqli_num_rows($result1);
        if ($row1 == 0) {
            $sqlsp = "CALL spAddBooking('$email', '$massagetype', $duration, $amount, '$msg', $serviceid, $employeeid, '$bookeddate','$bookedtime')"; // 
            if (!$mysqli->query($sqlsp)) { //If SP execution failed.
                $message = 'Failed to book';
                echo ($mysqli->error);
            } else {
                //Saving values to session variables to use later.
                // $_SESSION['firstname']=$firstname;
                // $_SESSION['lastname']=$lastname;
                // $_SESSION['username']=$email;
                header("Location: editbooking.php"); //redirecting to Welcome page                       
            }
        } else {
            $_SESSION['message'] = 'Already Booked!!';
            header("Location: BookAppointment.php");
        }
    } else {

        $_SESSION['message'] = 'Therapist unavailable!!';
        header("Location: BookAppointment.php");
    }
}
