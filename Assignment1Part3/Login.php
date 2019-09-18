<!-- Page for user to login -->
<?php include('UserCheck.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
         <?php require ("heading.php"); ?> 
    </head>
    <body style="background-color:darkseagreen;">
        <div id="header">
        <p>
            <img src="Logo.jpg" alt="Logo" width="80" height="80">
            
                <!-- <h1>Sports Massage</h1> -->
            </p>
            <p>
                <h2>Login to book an appointment</h2>
            </p>
        </div>
        <div id="login">
            <form action="" method="POST">
            <p>
                <label> UserName</label>    
            </p>
            <p>
            <input type="email" id="username" name="username" required="true" placeholder="Enter Email"style="width:100%;border-radius:10px;height: 25px;"/>
            </p>
            <div></div>
            <p>
                <label> Password</label>
            </p>
            <p>
                <input type="password" id="password" name="password" required="true" placeholder="Enter Password" style="width:100%;border-radius:10px;height: 25px;"/>
            </p>
            <p>
             <button type="submit" id="btn" name="login" > Login </button> 
            <a href="ForgotPassword.php" style="padding-left: 10px;">Forgot Password?</a>
            </p>
            <span><?php echo $error;?></span>
            </form>
        </div>
        <div id="register">
            <p> <label style="font-weight:normal;">Don't have an account? </label>
                <a href="Register.php">Register Now</a>
            </p>
        </div>
        <?php require ("footer.php"); ?>
    </body>
   
</html>
