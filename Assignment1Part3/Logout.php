<!-- Clearing session on Logout -->
<?php 
include('LoginDB.php');
if (isset($_SESSION['username']))
{
    session_destroy();//closing session
    header("Location: Login.php");//redirecting to login page
}
?>