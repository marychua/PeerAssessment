    
    
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
    
    $gradeid = $_GET['id'];
    $UID =  $_SESSION['UID'];
    $USEREMAIL = $_SESSION['USEREMAIL'];
    $ROLE =   $_SESSION['ROLE'];
    $GID =   $_SESSION['GID'];
    $FNAME =   $_SESSION['FNAME'];
    $LNAME =   $_SESSION['LNAME'];
        
        
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
<?php
$queryselect= "SELECT * FROM `grading` INNER JOIN `user` ON user.UID = grading.UID WHERE GRADEID = '$UID' && grading.UID = '$gradeid' ";
if($resultlist = mysqli_query($db, $queryselect))
{
    if(mysqli_num_rows($resultlist) > 0)
    {
        while($row = mysqli_fetch_array($resultlist))
        {
             $grid =  $row['GRID'];
            $mark = $row['RATE'];     
            ?>                    
                
                <div class="dashboard p-5">
                    <h2>Rating from <span class="text-primary"><?php echo $row['FNAME']." ".$row['LNAME'] ?></span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        
                        
                    <!--Ratings for-->
                    <div class="row mt-4">
                        <div class="col">
                            <!--name,rate,comment,photo-->
                            <div class="card">
                                
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="col">
                                            <div class="row  ml-3 mr-3 mt-3">
                                                <div class="col">
                                                    
                                                    <div class="row">
                                                        <div class="col-6 text-left">
                                                            <h5 style="margin-left: -15px;"><strong><?php echo $row['FNAME']." ".$row['LNAME'] ?></strong> (<?php echo $row['USERNAME']?>)</h5>
                                                        </div>
                                                        <!--                                                                <div class="col-6 text-right">
                                                                                                                            <p class="text-secondary">13/1/2020 · 12:00:00PM</p>  
                                                                                                                        </div>-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="row">
                                                                <p class="text-secondary mt-3">Rate</p>  
                                                            </div>
                                                            <?php
                                                            if($mark < 4)
                                                            {
                                                            ?>
                                                            <div class="row">
                                                                <h5 class="text-danger"><span class="badge badge-danger"><?php echo $row['RATE']?></span><strong>  Bad</strong></h5>
                                                            </div> 
                                                            <?php
                                                            }
                                                            else if ($mark <7 && $mark >3)
                                                            {
                                                            ?>
                                                            <div class="row">
                                                                <h5 class="text-warning"><span class="badge badge-warning"><?php echo $row['RATE']?></span><strong>  Great</strong></h5>
                                                            </div>                                                         
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="row">
                                                                <h5 class="text-success"><span class="badge badge-success"><?php echo $row['RATE']?></span><strong>  Excellent</strong></h5>
                                                            </div>                                                            
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <p class="text-secondary mt-3">Comment</p>  
                                                            </div>
                                                                
                                                            <div class="row">
                                                                <p class="text-primary">
                                                                    <?php echo $row['COMMENT']?>
                                                                </p>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <p class="text-secondary mt-3">Photo</p>  
                                                    </div>
                                                    <div class="row">   
                                                        <div class="row justify-content-center">
                                                            <?php
                                                    $queryselect1= "SELECT * FROM `upload` WHERE GRID  = '$grid'";
                                                    if($resultlist1 = mysqli_query($db, $queryselect1))
                                                    {
                                                        if(mysqli_num_rows($resultlist1) > 0)
                                                        {
                                                            while($row1 = mysqli_fetch_array($resultlist1))
                                                            {    
                                                                ?>    
                                                            <a target="_blank" href="<?php echo  "upload/".$row1['FILENAME']?>">
                                                                <img class="mb-4 mr-2 ml-2" style="max-height: 150px; width:auto;" src="<?php echo  "upload/".$row1['FILENAME']?>"/>
                                                            </a> 
                                                     <?php
                
                                                            }   
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
            <?php
                
            }   
        }
    }
    ?>                 
        </div>
    </div>
</div>
    
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    
<script type="text/javascript" src="index.js"></script>  
</script>
</body>
</html>