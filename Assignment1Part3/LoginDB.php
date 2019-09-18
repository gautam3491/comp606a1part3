<!-- //This page displays the logged-in user's data from database in html table format -->
<!DOCTYPE html>
<html>
<head>
        <title>User Profile</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <!-- Include jQuery from Google CDN(Content Delivery Network) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Load locally stored version of jQuery -->
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Include DevExtreme themes -->
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.5/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.5/css/dx.light.css" />

     <!-- DevExtreme Library -->
     <script src="https://cdn3.devexpress.com/jslib/19.1.5/js/dx.all.js"></script> 
        <?php require("usertab.php"); ?>
</head>
<body>   

<?php
// include('UserCheck.php');
if (isset($_SESSION['username']))
{
    require 'dbconnect.php';//Establishing connection with the database.
    $fname=$_SESSION['firstname'];
    $lname=$_SESSION['lastname'];
    $email=$_SESSION['username'];//getting email-id stored in session
    echo '</br>';
    echo "<font size='5' face='Arial'>";
    echo "<b>".$fname."</b>"."  "."<b>".$lname."</b>".",";
    echo '</br>';
    echo '</br>';
    echo "Your upcoming bookings.";
    echo '</br>';
    echo '</br>';
    $currentDateTime = date('Y-m-d');
    //Retrieving data from database for the logged in user.
    $sql="SELECT * FROM Bookings WHERE Email LIKE '$email' AND BookingDate >='$currentDateTime'";
    $result=mysqli_query($mysqli,$sql);
    echo  "<div style='display: flex;flex-direction: column;'>";
      //Displaying the data .
    while($rows = mysqli_fetch_array($result))//if data exists for the user
    {

        echo "<div>";
        echo "<i>". $rows['MassageType'] . "</i>"." ".date('d-M-Y',strtotime($rows['BookingDate']))." ".$rows['BookingTime']." ".$rows['Duration']." "."minutes "."$".$rows['Amount'];
        echo "<br />";
        echo "</div>";
    }
    echo "</div>";
    // else
    // {
    //   echo "You don't have any bookings.";
    // }
    //Creating html table  
//     echo "<table border='3'>
//     <tr>
//     <th>Firstname</th>
//     <th>Lastname</th>
//     <th>Gender</th>
//     <th>Email</th>
//     <th>Address</th>
//     <th>Street</th>
//     <th>Suburb</th>
//     <th>City</th>
//     <th>P.O</th>
//     <th>Mobile</th>
//     <th>Date Of Birth</th>
//     </tr>";
//     //Retrieving data from database for the logged in user.
//     $sql="SELECT * FROM UserDetails WHERE Email LIKE '$email'";
//     $result=mysqli_query($mysqli,$sql);
//     //Displaying the data in table format.
//     while($row = mysqli_fetch_array($result))//if data exists for the user
//     {
//         echo '</br>';
//         echo "<b>Hello </b> "."<b>".$row['FirstName']."</b>".",";
//         echo "<tr>";
//         echo "<tr>";
//         echo "<td>" . $row['FirstName'] . "</td>";
//         echo "<td>" . $row['LastName'] . "</td>";
//         echo "<td>" . $row['Gender'] . "</td>";
//         echo "<td>" . $row['Email'] . "</td>";
//         echo "<td>" . $row['Address'] . "</td>";
//         echo "<td>" . $row['Street'] . "</td>";
//         echo "<td>" . $row['Suburb'] . "</td>";
//         echo "<td>" . $row['City'] . "</td>";
//         echo "<td>" . $row['PO'] . "</td>";
//         echo "<td>" . $row['Mobile'] . "</td>";
//         echo "<td>" . $row['DOB'] . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
//         echo '</br>';   
//         echo '</br>';   
//         echo '</br>';   
//  
}
 ?>
   <!-- Calling Logout.php to clear session and logout -->
   <!-- <a href="Logout.php">Logout</a> -->
    
    </body>  
    <?php require("footer.php"); ?>
 </html>   

       