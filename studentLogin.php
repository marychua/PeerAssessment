<?php
session_start();
//Include config file
require_once 'Database/dbConnect.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));
if(count($_POST)>0) 
{
    $query = 'SELECT * FROM user WHERE USERNAME="'.$_POST['USERNAME'].'" AND USERPASS="'.md5($_POST['USERPASS']).'"';
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    $login = mysqli_fetch_assoc($result);
    $query2 = 'SELECT * FROM tutor WHERE TUTORNAME="'.$_POST['USERNAME'].'" AND TUTORPASS="'.md5($_POST['USERPASS']).'"';
    $result2 = mysqli_query($db, $query2);
    $rows2 = mysqli_num_rows($result2);
    $login2 = mysqli_fetch_assoc($result2);
    if(isset($login['USERNAME']))
    {
        
        setcookie("USERNAME", $_POST['USERNAME'], time() + (86400 * 30), "/");
        $_SESSION['UID'] = $login['UID'];
        $_SESSION['USEREMAIL'] = $login['USEREMAIL'];
        $_SESSION['ROLE'] = $login['ROLE'];
        $_SESSION['GID'] = $login['GID'];
        $_SESSION['FNAME'] = $login['FNAME'];
        $_SESSION['LNAME'] = $login['LNAME'];
        header('Location: studentHomepage.php');     
    }
    else if(isset($login2['TUTORNAME']))
    {
        setcookie("TUTORNAME", $_POST['TUTORNAME'], time() + (86400 * 30), "/");
        $_SESSION['TID'] = $login2['TID'];
        $_SESSION['TUTORNAME'] = $login2['TUTORNAME'];
        $_SESSION['ROLE'] = $login2['ROLE'];
        header('Location: tutorHomepage.php');     
    }  
    else 
    {
        $message = "Please check Username or Password";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
    
    
    
    
    
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.scss">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        <link rel="stylesheet" href="cookies/css/style.css">
        <title>Peer Assessment System</title>
    </head>
        
    <body>
        <div class="container-fluid">
            <div class="form">    
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row pt-5">
                        <div class="col-6 p-5"> 
                            <h2 class="site-title"><img class="logo" src="Image/site-logo1.png"/><strong>Peer Assessment</strong></h2>
                            <div class="login-img-wrapper"><img class="login-img1" src="Image/login-img.svg"/></div>
                        </div>
                        <div class="col-6 login-form" >
                            <h2 class="login-title mt-3 mb-3"><strong>Welcome Back!</strong></h2>
                            <p class="login-desc mb-5">Stay connected with Peer Assessment by logging into your account via username and password. </p> 
<!--                            <a href="#" class="no-acc">Forgot Password?</a>-->
                            <div class="form-group  ">
                                <p style=" color: red"><?php if(isset($message)) { echo $message; } ?></p>
                                <?php if(!isset($_COOKIE["USERNAME"]))    
                                {?>
                                <input type="text" class="form-control" placeholder="Student ID" required="required" id="USERNAME" name="USERNAME">
                                <?php
                                } 
                                else 
                                {
                                ?>
                                <input type="text" class="form-control" required="required" id="USERNAME" name="USERNAME" value="<?php echo $_COOKIE["USERNAME"]?>">
                                    
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control mb-2" placeholder="Password" required="required" id="USERPASS" name="USERPASS">
                            </div>
                                
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg login-btn mb-2"  ><a>Login</a></button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0)" onclick='location.href ="studentRegister.php"' class="btn btn-outline-primary btn-block btn-lg login-btn mb-3" >Create Account</a>
                                </div>
                            </div>
                            <!--<p class="login-desc mb-5">Are you a tutor? <a href="javascript:void(0)" onclick='location.href ="tutorLogin.php"'>Login As Tutor</a></p>-->
                        </div>   
                    </div>    
                </form>			
            </div>
        </div>
        <div id="cookieConsent">
            <div id="closeCookieConsent">x</div>
            This Website is using cookies.<a href="#" target="_blank">More info</a>. <a class="cookieConsentOK">Continue</a>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
            
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('.menu-toggle').click(function()
                {
                    $('.menu-toggle').toggleClass('active')
                    $('nav').toggleClass('active')
                })
            })
            $(document).ready(function()
            {   
                setTimeout(function () 
                {
                    $("#cookieConsent").fadeIn(200)
                }, 4000)
                $("#closeCookieConsent, .cookieConsentOK").click(function() 
                {
                    $("#cookieConsent").fadeOut(200)
                })
            })
        </script>
    </body>   
</html>