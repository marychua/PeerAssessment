    
<?php 
session_start();
if (empty($_SESSION['UID'])) 
{
    header('location: studentLogin.php');
}
require_once 'Database/dbConnect.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));
    
    
    $UID =  $_SESSION['UID'];
    $USEREMAIL = $_SESSION['USEREMAIL'];
    $ROLE =   $_SESSION['ROLE'];
    $GID =   $_SESSION['GID'];
    $FNAME =   $_SESSION['FNAME'];
    $LNAME =   $_SESSION['LNAME'];

    if(isset($_POST["submit"])) 
    {    
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            
            $updateuser ="UPDATE user SET USEREMAIL = '$email', FNAME = '$firstName', LNAME='$lastName', GENDER = '$gender', ADDRESS = '$address', CITY = '$city', STATE = '$state', ZIP = '$zip' WHERE UID = '$UID'";
            mysqli_query($db,$updateuser);
            

            $countfiles = count($_FILES['files']['name']);
            // Looping all files
            for($i=0;$i<$countfiles;$i++)
            {
                $UPLOADID = date("YmdHis".$i);
                $filename = $_FILES['files']['name'][$i];
                // Upload file
                move_uploaded_file($_FILES['files']['tmp_name'][$i],'upload/'.$filename);
                $ext=".".pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
                if($filename!="")
                {
                $sql = "UPDATE profile SET PICNAME = '$filename', EXTENSION = '$ext'  WHERE UID = '$UID'";
                mysqli_query($db, $sql); 
                }
            }
    }
        
?>
    
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css">
        <link href="fontawesome/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"><link rel="stylesheet" type="text/css" href="index.css">
        <title>Peer Assessment System</title>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Peer Assessment</h3>
                </div>
                    
                <ul class="list-unstyled components">
                    <p>Menu</p>
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="studentHomepage.php"'>Dashboard</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Rating</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            
                            <li>
                                <a  href="javascript:void(0)" onclick='location.href ="studentOwnRating.php"'>Own Rating</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" onclick='location.href ="studentMemberRating.php"' >Member Rating</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="studentAccount.php"' href="studentAccount.php">Account</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="studentContact.php"' href="studentContact.php">Contact</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="studentAbout.php"'>About</a>
                    </li>
                </ul>
                    
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="studentLogout.php"'  class="#">Log Out</a>
                    </li>
                </ul>
            </nav>
                
            <!-- Page Content  -->
            <div id="content">
                
                <nav class="navbar navbar-expand-lg navbar-light navbar-custom shadow-sm" style="background: white;">
                    <div class="container-fluid">
                        
                        <button type="button" id="sidebarCollapse" onclick="toggleSidebar()" class="btn sidebarCollapse">
                            <i class="fas fa-bars"></i>
                            <span>Close</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>
                        <form class="form-inline mt-3 mb-3 mr-5 d-flex justify-content-end">
                            <div class="dropdown">
                                <button class="btn text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#1da1f2; padding-right: 2.5rem;">
                                    <?php echo $FNAME." ".$LNAME ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item disabled">Student</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick='location.href ="studentAccount.php"'>Account Settings</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick='location.href ="studentLogout.php"' >Logout</a>
                                </div>
                            </div>
                        </form>           
                    </div>
                </nav>
                    
                    
                <div class="dashboard p-5">
                    <!-- Account Edit -->
                    <h2>Account Settings</h2> 
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>            
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="col">
                                            <div class="row  ml-3 mr-3 mt-3">
                                                <div class="col">
                            <?php
                                $queryselect1= "SELECT * FROM `user` INNER JOIN `profile` ON user.UID = profile.UID INNER JOIN `studentgroup` on studentgroup.GID = user.GID WHERE user.UID = '$UID'";
                                if($resultlist1 = mysqli_query($db, $queryselect1))
                                {
                                    if(mysqli_num_rows($resultlist1) > 0)
                                    {
                                        while($row1 = mysqli_fetch_array($resultlist1))
                                        {
                                        ?>                                                     
                                                    <div class="row mt-3 mb-4">
                                                        <div id="selectedFiles" class="col-6 text-right" style="margin-left: 0.70rem!important;align-self: center;">
                                                            <label for="files" class="btn "><img width="140" src="<?php echo "profile/".$row1['PICNAME']?>" style="border-radius:5%;"></label>
                                                        </div>
                                                        <div class="col text-left align-baseline pt-5 pb-5">
                                                            <h2><strong><?php echo $row1['FNAME']." ".$row1['LNAME']?></strong></h2>
                                                            <h5 class="text-secondary">(<?php echo $row1['USERNAME']?>)</h5>
                                                            <div>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 mb-4">
                                                        <form class="container-fluid" method="post" enctype="multipart/form-data">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="displayName">Student ID</label>
                                                                    <input type="text" class="form-control" id="displayName" name="displayName" value="<?php echo $row1['USERNAME']?>" disabled>    
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    
                                                                    <label for="group">Group</label>
                                                                    <input type="text" class="form-control" id="group" name="group" value="<?php echo $row1['GNAME']?>" disabled>
                                                                </div>    
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="firstName">First Name</label>
                                                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row1['FNAME']?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="lastName">Last Name</label>
                                                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row1['LNAME']?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="gender">Gender</label>
                                                                    <select id="gender" name="gender" class="form-control">
                                                                        <option disabled selected>Select Gender</option>
                                                                        <option value="Male" <?php if (isset($row1['GENDER']) && $row1['GENDER'] == 'Male' ) { echo 'selected';}?> >Male</option>
                                                                        <option value="Female" <?php if (isset($row1['GENDER']) && $row1['GENDER'] == 'Female' ) { echo 'selected';}?>>Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row1['USEREMAIL']?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $row1['ADDRESS']?>">
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputCity">City</label>
                                                                    <input type="text" class="form-control" name="city" id="city" value="<?php echo $row1['CITY']?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState">State</label>
                                                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $row1['STATE']?>">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="inputZip">Zip</label>
                                                                    <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $row1['ZIP']?>">
                                                                </div>
                                                            </div>
                                                            <input id="files" style="visibility:hidden;"  name="files[]" accept="image/*" type="file">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block mt-4">Save Changes</button>    
                                                        </form>
                                                    </div>  
                                        <?php
                                        }   
                                    }
                                    else
                                    {
                                    ?>

                                    <?php
                                    }
                                }     
                            ?>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
</div>
    
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    
<script type="text/javascript" src="index.js"></script>  
        <script>
            
            var selDiv = "";
            
            document.addEventListener("DOMContentLoaded", init, false);
            
            function init() {
                document.querySelector('#files').addEventListener('change', handleFileSelect, false);
                selDiv = document.querySelector("#selectedFiles");
            }
            
            function handleFileSelect(e) {
		
                if(!e.target.files || !window.FileReader) return;
		
                selDiv.innerHTML = "";
		
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                filesArr.forEach(function(f) {
                    if(!f.type.match("image.*")) {
                        return;
                    }
                    
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        
                        var html = "<label for=\"files\" class=\"btn \"><img width="140" src=\"" + e.target.result + "\" style="border-radius:5%;"></label>";
                        
                        selDiv.innerHTML += html;				
                    }
                    reader.readAsDataURL(f); 
                    
                });
		
		
            }
            
        </script> 
</body>
</html>