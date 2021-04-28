<?php
session_start();
require_once 'Database/dbConnect.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));
    
if(count($_POST)>0) 
{
    if($_POST["captcha_code"]==$_SESSION["captcha_code"])
    {
        if ($_POST['USERPASS']!== $_POST['confirm-password'])
        {
            $error_message = 'The two passwords do not match';
        }
        else
        {
            $email = $_POST['USEREMAIL'];
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailrepeat = "SELECT * FROM user WHERE USEREMAIL ='$email' LIMIT 1";
                $emailresult = mysqli_query($db, $emailrepeat);
                if (mysqli_num_rows($emailresult) > 0) 
                {
                    $error_message = "Email already exists";
                }
                else
                {
                    $username = $_POST['USERNAME'];
                    if(!filter_var($username, FILTER_VALIDATE_EMAIL))
                    {
                        $usernamerepeat = "SELECT * FROM user WHERE USERNAME ='$username' LIMIT 1";
                        $usernameresult = mysqli_query($db, $usernamerepeat);
                        if (mysqli_num_rows($usernameresult) > 0) 
                        {
                            $error_message = "Username already exists";
                        }
                        else
                        {
                            $UID = date("YmdHis");
                            $password = md5($_POST['USERPASS']);
                            $passwordemail = $_POST['USERPASS'];
                            $picname = "z4.jpeg";
                            $pixtension= "jpeg";
                            $GID = $_POST['GID'];
                            $FNAME = $_POST['FNAME'];
                            $LNAME = $_POST['LNAME'];
                            $role = "student";
                            mysqli_query($db, "INSERT INTO `user`(`UID`, `USERNAME`,`USEREMAIL`, `USERPASS`, `FNAME`, `LNAME`, `GID`, `ROLE` ) VALUES ('U$UID','$username','$email','$password','$FNAME','$LNAME','$GID','$role')");
                            mysqli_query($db, "INSERT INTO `profile`(`PID`,`UID`, `PICNAME`,`EXTENSION`) VALUES ('P$UID','U$UID','$picname','$pixtension)");
                            require 'EmailVerification.php';
                            $message = "You've successfully registered, please check your email.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                    }
                    else
                    {
                    $error_message = "Invalid Username";
                    }
                }
            }
            else 
            {
                $error_message = "Invalid Email"; 
            }              
        }
    }
    else
    {
        $error_message = "Incorrect Captcha Code";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="index.scss">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 p-5">
                    <form class="register-form" method="post" action="" >
                        <h2 class="site-title"><img class="logo" src="Image/site-logo1.png"/><strong>Peer Assessment</strong></h2> 
                            
                        <h2 class="login-title mb-3 mt-5"><strong>Join Us</strong></h2>
                        <p class="login-desc mb-5">Peer Assessment helps tutors and students to assess group work. Grade your peer's group work and know how others view you too!</p>
                        <P style="color: red"><?php if(isset($error_message)) { echo $error_message; } ?>  </p>  
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Student ID" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  minlength="9" maxlength="9" required="required" id="USERNAME" name="USERNAME" data-validate = "id">
                        </div>
                            
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" required="required" id="USEREMAIL" name="USEREMAIL" data-validate = "email">
                        </div>
                            
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required="required" id="USERPASS" name="USERPASS" data-validate = "password">
                        </div>
                            
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" required="required" id="confirm-password" name="confirm-password" data-validate = "confirm-password">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" required="required" id="FNAME" name="FNAME" data-validate = "First Name">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" required="required" id="LNAME" name="LNAME" data-validate = "Last Name">
                        </div>                            
                        <div class="form-group">
                            <select type="class-group" class="form-control" placeholder="Class Group" required="required" id="GID" name="GID" data-validate = "class-group">  
                            <?php
                                $queryselect1= 'SELECT studentgroup.GID, studentgroup.GNAME FROM `studentgroup` INNER JOIN `user` ON studentgroup.GID = user.GID GROUP BY studentgroup.GID HAVING COUNT(studentgroup.GID) < 4';
                                if($resultlist1 = mysqli_query($db, $queryselect1))
                                {
                                    if(mysqli_num_rows($resultlist1) > 0)
                                    {
                                        while($row1 = mysqli_fetch_array($resultlist1))
                                        {
                                        ?>    
                                <option value="<?php echo $row1['GID']?>"><?php echo $row1['GNAME']?></option> 
                                        <?php
                                        }   
                                    }
                                }     
                            ?>                            
                            </select>   
                        </div>
                            
                        <div class="row">
                            <div class="col-6 form-group small clearfix">
                                <img class="mb-2" src="captcha.php" style="width: 6rem;"/>
                            </div>                            
                            <div class="col-6 form-group">
                                <input type="text" id="captcha_code" name="captcha_code" class="form-control mb-2" placeholder="Verfication Code" required="required">
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block btn-lg login-btn mb-2" value="Register" >  
                            </div>
                        </div>
                        Already have an account?
                        <a href="javascript:void(0)" onclick='location.href ="studentLogin.php"'>                     
                            <strong>Sign In</strong>
                        </a>
                            
                            
                    <?php if(isset($success_message)) { ?>
                        <div class="Captcha-success"><?php echo $success_message; ?></div>
                    <?php } ?>
                    </form>
                </div> 
                <div class="col-6"> 
                    <div class="register-img-wrapper"><img class="register-img" src="Image/register-img.svg"/></div>
                </div>
            </div> 
        </div>
    </div>
</div>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>