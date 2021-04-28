    
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

if (empty($_GET['id'])) 
{
    header('location: studentHomepage.php');
}
    $RID = $_GET['id'];
    $UID =  $_SESSION['UID'];
    $USEREMAIL = $_SESSION['USEREMAIL'];
    $ROLE =   $_SESSION['ROLE'];
    $GID =   $_SESSION['GID'];
    $FNAME =   $_SESSION['FNAME'];
    $LNAME =   $_SESSION['LNAME'];
    $usersql = "SELECT * FROM user WHERE UID = '$RID'";    
    $userresult = mysqli_query($db, $usersql);
    $userrow = mysqli_fetch_array($userresult);
    $FIRSTNAME = $userrow['FNAME'];
    $LASTNAME = $userrow['LNAME'];  
    global $gradingstatus,$gradingcomment,$gradinggrid;
    $gradingsql = "SELECT * FROM grading WHERE GRADEID = '$RID' && UID = '$UID' ";    
    $gradingresult = mysqli_query($db, $gradingsql);
    $gradingrow = mysqli_fetch_array($gradingresult); 
    if(mysqli_num_rows($gradingresult) >0)
    {
        $gradingstatus = $gradingrow['STATUS'];
        $gradingcomment = $gradingrow['COMMENT'];
        $gradinggrid = $gradingrow['GRID'];
        $gradingrate = $gradingrow['RATE'];
    }
    else
    {
        $gradingstatus = "";
        $gradingcomment = "";
        $gradinggrid = "";
        $gradingrate = "";
    }
    if(isset($_POST["submit"])) 
    {
        if($gradingstatus == "")
        {
            $ID = date("R"."YmdHis");
            $RATE = $_POST['rate'];
            $COMMENT = $_POST['comment'];
            $STATUS = "Completed";        
            mysqli_query($db, "INSERT INTO `grading`(`GRID`, `GRADEID`,`UID`, `RATE`, `COMMENT`, `STATUS`) VALUES ('$ID','$RID','$UID','$RATE','$COMMENT','$STATUS')");   
            // Count total files
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
                $sql = "INSERT INTO upload (UPLOADID, UPLOADERID, REFERALID, GRID, FILENAME, EXTENSION) VALUES ('UP$UPLOADID','$UID','$RID','$gradinggrid','$filename','$ext')";
                mysqli_query($db, $sql); 
                }
            }
            header('Location: studentHomepage.php');   
        }
        else if($gradingstatus == "Pending")
        {
            $RATE = $_POST['rate'];
            $COMMENT = $_POST['comment'];
            $STATUS = "Completed";   
            $updategrade ="UPDATE grading SET RATE = '$RATE', COMMENT = '$COMMENT', STATUS = '$STATUS' WHERE GRID = '$gradinggrid'";
            mysqli_query($db,$updategrade);
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
                $sql = "INSERT INTO upload (UPLOADID, UPLOADERID, REFERALID, GRID, FILENAME, EXTENSION) VALUES ('UP$UPLOADID','$UID','$RID','$gradinggrid','$filename','$ext')";
                mysqli_query($db, $sql); 
                }
            }
            header('Location: studentHomepage.php');   
        }
        
    }
    if(isset($_POST["cancel"])) 
    {
        if($gradingstatus == "")
        {
            $ID = date("R"."YmdHis");
            $RATE = $_POST['rate'];
            $COMMENT = $_POST['comment'];
            $STATUS = "Pending";        
            mysqli_query($db, "INSERT INTO `grading`(`GRID`, `GRADEID`,`UID`, `RATE`, `COMMENT`, `STATUS`) VALUES ('$ID','$RID','$UID','$RATE','$COMMENT','$STATUS')");      
            // Count total files
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
                $sql = "INSERT INTO upload (UPLOADID, UPLOADERID, REFERALID, GRID, FILENAME, EXTENSION) VALUES ('UP$UPLOADID','$UID','$RID','$gradinggrid','$filename','$ext')";
                mysqli_query($db, $sql); 
                }
            }
            header('Location: studentHomepage.php');   
        }
        else if($gradingstatus == "Pending")
        {
            $RATE = $_POST['rate'];
            $COMMENT = $_POST['comment'];
            $updategrade ="UPDATE grading SET RATE = '$RATE', COMMENT='$COMMENT' WHERE GRID = '$gradinggrid'";
            mysqli_query($db,$updategrade);
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
                $sql = "INSERT INTO upload (UPLOADID, UPLOADERID, REFERALID, GRID, FILENAME, EXTENSION) VALUES ('UP$UPLOADID','$UID','$RID','$gradinggrid','$filename','$ext')";
                mysqli_query($db, $sql); 
                }
            }

            header('Location: studentHomepage.php');               
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
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
                    <h2>Rate Your Group Member</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>            
                    <div class="card mt-3 mb-3 shadow-sm container">
                        <form class="form-inline mt-3 mb-3 container-fluid" method="post" enctype="multipart/form-data">                                           
                            <div class="card-body">                                
                                <h5 class="card-title mt-5">How would you rate <span class="text-primary"><?php echo $FIRSTNAME." ".$LASTNAME ?></span>?</h5>   

                                <?php
                                if($gradingstatus=="")
                                {
                                ?>

                                <div class="row">   
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '1' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="1" <?php if (isset($gradingrate) && $gradingrate == '1' ) { echo 'checked';}?>> 1
                                        </label>
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '2' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="2" <?php if (isset($gradingrate) && $gradingrate == '2' ) { echo 'checked';}?>> 2
                                        </label>
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '3' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="3" <?php if (isset($gradingrate) && $gradingrate == '3' ) { echo 'checked';}?>> 3
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '4' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="4" <?php if (isset($gradingrate) && $gradingrate == '4' ) { echo 'checked';}?>> 4
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '5' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="5" <?php if (isset($gradingrate) && $gradingrate == '5' ) { echo 'checked';}?>> 5
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '6' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="6" <?php if (isset($gradingrate) && $gradingrate == '6' ) { echo 'checked';}?>> 6
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '7' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="7" <?php if (isset($gradingrate) && $gradingrate == '7' ) { echo 'checked';}?>> 7
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '8' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="8" <?php if (isset($gradingrate) && $gradingrate == '8' ) { echo 'checked';}?>> 8
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '9' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="9" <?php if (isset($gradingrate) && $gradingrate == '9' ) { echo 'checked';}?>> 9
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '10' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="10" <?php if (isset($gradingrate) && $gradingrate == '10' ) { echo 'checked';}?>> 10
                                        </label>
                                    </div>                         
                                </div> 
                                <h5 class="card-title mt-5">Give comments for your rating</h5>                                  
                                <div class="input-group">
                                    <textarea class="form-control" name="comment" id="comment" aria-label="With textarea"></textarea>
                                </div>
                                <h5 class="card-title mt-5">Photo of <span class="text-primary"><?php echo $FIRSTNAME." ".$LASTNAME ?></span></h5>      
                                <div class="card mt-3 mb-3 shadow-sm container">                                   
                                    <div class="card-body ">
                                        <input type="file" name="files[]" id="files" multiple accept="image/*"><br/>                                                                      
                                        <div class="row justify-content-center">
                                            <div id="selectedFiles" class="row"></div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-4 mb-4" value="SUBMIT">  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="cancel" class="btn btn-danger btn-block btn-lg mt-4 mb-4" value="CANCEL">  
                                    </div>
                                </div>                                  
                                <?php
                                }
                                else if ($gradingstatus == "Pending")
                                {
                                ?>
                                <div class="row">   
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '1' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="1" <?php if (isset($gradingrate) && $gradingrate == '1' ) { echo 'checked';}?>> 1
                                        </label>
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '2' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="2" <?php if (isset($gradingrate) && $gradingrate == '2' ) { echo 'checked';}?>> 2
                                        </label>
                                        <label class="btn btn-danger  <?php if (isset($gradingrate) && $gradingrate == '3' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="3" <?php if (isset($gradingrate) && $gradingrate == '3' ) { echo 'checked';}?>> 3
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '4' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="4" <?php if (isset($gradingrate) && $gradingrate == '4' ) { echo 'checked';}?>> 4
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '5' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="5" <?php if (isset($gradingrate) && $gradingrate == '5' ) { echo 'checked';}?>> 5
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '6' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="6" <?php if (isset($gradingrate) && $gradingrate == '6' ) { echo 'checked';}?>> 6
                                        </label>
                                        <label class="btn btn-warning  <?php if (isset($gradingrate) && $gradingrate == '7' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="7" <?php if (isset($gradingrate) && $gradingrate == '7' ) { echo 'checked';}?>> 7
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '8' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="8" <?php if (isset($gradingrate) && $gradingrate == '8' ) { echo 'checked';}?>> 8
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '9' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="9" <?php if (isset($gradingrate) && $gradingrate == '9' ) { echo 'checked';}?>> 9
                                        </label>
                                        <label class="btn btn-success  <?php if (isset($gradingrate) && $gradingrate == '10' ) { echo 'active';}?>">
                                            <input type="radio" name="rate" id="rate" value="10" <?php if (isset($gradingrate) && $gradingrate == '10' ) { echo 'checked';}?>> 10
                                        </label>
                                    </div>                         
                                </div> 
                                <h5 class="card-title mt-5">Give comments for your rating</h5>                                  
                                <div class="input-group">
                                    <textarea class="form-control" name="comment" id="comment" aria-label="With textarea"><?php echo $gradingcomment ?></textarea>
                                </div>
                                <h5 class="card-title mt-5">Photo of <span class="text-primary"><?php echo $FIRSTNAME." ".$LASTNAME ?></span></h5>      
                                <div class="card mt-3 mb-3 shadow-sm container">                                   
                                    <div class="card-body ">
                                        <input type="file" name="files[]" id="files" multiple accept="image/*"><br/>                                                                      
                                        <div class="row justify-content-center">
                                            <div id="selectedFiles" class="row">
                                            <?php
                                            $queryselect1= "SELECT *  FROM `upload` WHERE GRID = '$gradinggrid'";
                                            if($resultlist1 = mysqli_query($db, $queryselect1))
                                            {
                                                if(mysqli_num_rows($resultlist1) > 0)
                                                {
                                                    while($row1 = mysqli_fetch_array($resultlist1))
                                                    {
                                                    ?> 
                                                <a href="javascript:void(0)" onclick='window.open("<?php echo "upload/".$row1['FILENAME']?>")'><img src="<?php echo "upload/".$row1['FILENAME']?>"></a>
                                                <a href="javascript:void(0)" onclick="location.href='studentDeleteUpload.php?id=<?php echo $row1['UPLOADID']?>'"><button>Delete</button></a>
                                                
                                                    <?php
                                                    }   
                                                }
                                            }     
                                        ?>                                                 
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-4 mb-4" value="SUBMIT">  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="cancel" class="btn btn-danger btn-block btn-lg mt-4 mb-4" value="CANCEL">  
                                    </div>
                                </div>  
                                <?php    
                                }
                                else
                                {
                                ?>    
                                
                                <div class="input-group">
                                    <textarea class="form-control" name="comment" id="comment" aria-label="With textarea" disabled></textarea>
                                </div>
                                <h5 class="card-title mt-5">Photo of <span class="text-primary"><?php echo $FIRSTNAME." ".$LASTNAME ?></span></h5>      
                                <div class="card mt-3 mb-3 shadow-sm container">                                   
                                    <div class="card-body ">
                                        <input type="file" name="files[]" id="files" multiple accept="image/*" disabled><br/>                                                                      
                                        <div class="row justify-content-center">
                                            <div id="selectedFiles" class="row"></div>
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-lg mt-4 mb-4" value="Your Grading Has been Completed" disabled>  
                                    </div>
                                </div>
                                <?php
                                }
                                ?>                              
                            </div>                           
                        </form>        
                    </div>
                </div>
            </div>
        </div>
            
        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
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
                        
                        var html = "<a target=\"_blank\"  href=\"" + e.target.result + "\"><img src=\"" + e.target.result + "\"><br clear=\"left\"/>" + f.name + "<br clear=\"left\"/></a>";
                        
                        selDiv.innerHTML += html;				
                    }
                    reader.readAsDataURL(f); 
                    
                });
		
		
            }
            
        </script> 
            
            
        <script type="text/javascript" src="index.js"></script>  
    </body>
</html>
