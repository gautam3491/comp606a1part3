<!-- This page saves the data entered by user in to the database after required validations -->
<?php
session_start();
$message='';
if (isset($_POST['register']))
{
    require 'dbconnect.php';//Establishing connection with database
    $gender=$address=$street=$suburb=$city=$po=$dob=$lastname=$firstname=$email=$mobile=$password=$repassword='';
    //Retreiving values sent by http post method
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $street=$_POST['street'];
    $suburb=$_POST['suburb'];
    $city=$_POST['city'];
    $po=$_POST['po'];
    $mobile=$_POST['mobile'];
    $dob=$_POST['dob'];
    $password=$_POST['password'];
    $repassword=$_POST['confirmpassword'];
    $today=date('Y/m/d');//getting current date
    if($password !== $repassword)//Checking if passwords match
    {
        $message="Passwords not matching";
    }
    else if($dob>$today)//Checking if dob is a future date
    {
        $message='Date of birth cannot be a future date';
    }
    else
    {
        //Checking if the email already exists in the database
        $sql="SELECT * FROM UserDetails WHERE Email LIKE '$email'";
        $result=mysqli_query($mysqli,$sql);
        if($row = $result->fetch_row())//If email already registered
        {
           $message="Email already exists in database.";
        }
          else//if email is not already used
          {
            $password=md5($password);//Password encryption
            //Saving data to the database using SP
            //spAddUser inserts values to UserDetails table
            //Have 12 input parameters
            $sqlsp = "CALL spAddUser('$firstname', '$lastname','$gender', '$email', '$address','$street' ,'$suburb' ,'$city',$po,$mobile ,'$dob','$password')";
            if (!$mysqli->query($sqlsp)){//If SP execution failed.
            $message='Failed to register user';
            echo($mysqli->error);
             } 
            else {
                //Saving values to session variables to use later.
                $_SESSION['firstname']=$firstname;
                $_SESSION['lastname']=$lastname;
                $_SESSION['username']=$email;
                header("Location: Welcome.php");//redirecting to Welcome page                       
                }
          }     
    }     
}
?>
</body>

</html>