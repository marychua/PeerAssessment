<?php 
session_start();
if (empty($_SESSION['TID'])) 
{
    header('location: tutorLogin.php');
}
require_once 'Database/dbConnect.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));
    
    
$UID = $_GET['id'];   
$TID = $_SESSION['TID'];
$TUTORNAME = $_SESSION['TUTORNAME'];
$ROLE = $_SESSION['ROLE'];
    
    global $totalcomment,$totalpic,$totalrate,$totalmarks,$firstname,$lastname,$completion ;
        $countsql = "SELECT AVG(RATE) as AverageRate, COUNT(COMMENT) as COUNTCOMMENT, COUNT(RATE) as COUNTRATE FROM grading WHERE GRADEID = '$UID' && STATUS = 'Completed' "; 
    $countresult = mysqli_query($db, $countsql);
    $countrow = mysqli_fetch_array($countresult); 
    $countsql2 = "SELECT COUNT(RATE) as COUNTRATE FROM grading WHERE GRADEID = '$UID' "; 
    $countresult2 = mysqli_query($db, $countsql2);
    $countrow2 = mysqli_fetch_array($countresult2); 
    $countsql3 = "SELECT COUNT(UPLOADID) as COUNTPIC FROM grading INNER JOIN `upload` ON upload.GRID = grading.GRID WHERE grading.GRADEID = '$UID' && STATUS = 'Completed' ";
    $countresult3 = mysqli_query($db, $countsql3);
    $countrow3 = mysqli_fetch_array($countresult3);         
    $querysql4 = "SELECT count(GRID) as countrate from `grading` WHERE UID = '$UID' && STATUS = 'Completed'";
    $countresult4 = mysqli_query($db, $querysql4);
    $countrow4 = mysqli_fetch_array($countresult4);    
    $queryselect= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID INNER JOIN profile on profile.UID = user .UID WHERE user.UID = '$UID' && ROLE = 'student'";
    $resultlist = mysqli_query($db, $queryselect);
    $row = mysqli_fetch_array($resultlist);
    $firstname = $row['FNAME'];
    $lastname = $row['LNAME'];
    $totalcomment = $countrow['COUNTCOMMENT'];
    $totalmarks = $countrow['AverageRate'] *10;
    $totalrate = $countrow['COUNTRATE'];
    $totalpic = $countrow3['COUNTPIC'];
    $completion = $countrow4['countrate'];
    $username = $row['USERNAME'];
    $GID = $row['GNAME'];
    $queryselect2= "SELECT * FROM `grading` WHERE GRADEID = '$UID'";
    $mark=0;
    if($resultlist2 = mysqli_query($db, $queryselect2))
    {
        if(mysqli_num_rows($resultlist2) > 0)
        {



            while($row2 = mysqli_fetch_array($resultlist2))
            {
                $mark = $mark + $row2['RATE']; 
            }


        }
    }
    $avgmark = $mark*10/2;
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
                    <li class="active">
                        <a href="javascript:void(0)" onclick='location.href ="tutorHomepage.php"'>Dashboard</a>
                    </li>
<!--                    <li>
                        <a href="tutorAccount.php">Account</a>
                    </li>-->
                    <li>
                        <a href="tutorContact.php">Contact</a>
                    </li>
                    <li>
                        <a href="tutorAbout.php">About</a>
                    </li>
                </ul>
                    
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="tutorLogout.php"'  class="#">Log Out</a>
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
                                    Sandra Garcia
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item disabled">Tutor</a>
                                    <div class="dropdown-divider"></div>
<!--                                    <a class="dropdown-item" href="#">Account Settings</a>-->
                                    <a class="dropdown-item" href="javascript:void(0)" onclick='location.href ="tutorLogout.php"'>Logout</a>
                                </div>
                            </div>
                        </form>           
                    </div>
                </nav>     
                <div class="dashboard p-5">
                    <h2>View Details</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>  
                    <!-- View Student  -->
                        
                    <div class="card mt-3 mb-3 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title text-primary"><strong><?php echo $firstname." ".$lastname?></strong></h3>
                                
                            <div class="row mt-4">
                                <div class="col">
                                    <h4 class="card-title ">Student Profile</h4>
                                    <div class="card">
                                        <div class="card-body"> 
                                            
                                            <div class="row">
                                                
                                                <div class="col text-center" style="margin-left: 0.70rem!important;">
                                                    <img width="140" src="<?php echo "profile/".$row['PICNAME']?>">
                                                </div>
                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Student ID</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <h4><?php echo $username?></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Name</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <h4><?php echo $firstname." ".$lastname?></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Group</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <h4><?php echo $GID?></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Average</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <h4><?php echo $avgmark?>%</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Student Completion</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <h4><?php echo $completion?>/2</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row std-detail">
                                                                        <p class="text-secondary">Status</p>  
                                                                    </div>
                                                                    <div class="row std-detail">
                                                                        <?php
                                                                        if($completion >= 2 )
                                                                        {
                                                                        ?>
                                                                        <h4 class="text-success">Complete</h4>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <h4 class="text-danger">Pending</h4>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>       
                                                    </div>
                                                </div>
                                                <div class="col-3" id="std-card-detail">
                                                    <div class="col mb-4">
                                                        <!-- Progress bar 1 -->
                                                        <h2 class="h6 font-weight-bold text-center mb-4">Average</h2>
                                                        <div class="progress mx-auto" data-value='<?php echo $avgmark?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar border-success"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar border-success"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <div class="h2 font-weight-bold"><?php echo $avgmark?><sup class="small">%</sup></div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center mt-4">
                                                            <div class="col-6 border-right">
                                                                <div class="h4 font-weight-bold mb-0"><?php echo $totalrate?></div><span class="small text-gray">Student Rated</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="h4 font-weight-bold mb-0"><?php echo $totalcomment?></div><span class="small text-gray">Comment Given</span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div> 
                                                </div> 
                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
       
                            <!--Ratings for-->
                            <div class="row mt-4">
                                <div class="col">
                                    <h4 class="card-title">Ratings for <span class="text-primary"><?php echo $firstname." ".$lastname?></span></h4>
                                    <!--name,rate,comment,photo-->
                                    <div class="row mt-4">
                                        <div class="col">
                                            <!--name,rate,comment,photo-->
                                    <?php
                                    $queryselect= "SELECT * FROM `grading` INNER JOIN `user` ON user.UID = grading.UID WHERE GRADEID = '$UID' && STATUS = 'Completed' ";
                                    if($resultlist = mysqli_query($db, $queryselect))
                                    {
                                        if(mysqli_num_rows($resultlist) > 0)
                                        {
                                            $i = 1;
                                            while($row = mysqli_fetch_array($resultlist))
                                            {
                                                
                                                 $grid =  $row['GRID'];
                                                $mark = $row['RATE'];     
                                                ?>                                
                                            <div class="card">
                                                <h5 class="card-header"><?php echo $i?></h5>
                                                <div class="card-body"> 
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row  ml-3 mr-3 mt-3">       
                                                                
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col-6 text-left">
                                                                            <h5 style="margin-left: -15px;"><strong><?php echo $row['FNAME']." ".$row['LNAME'] ?></strong> (<?php echo $row['USERNAME']?>)</h5>
                                                                        </div>
<!--<div class="col-6 text-right">
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
                                     <?php
                                         
                                           $i++;  }
                                        }
                                    }
                                               ?>        
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <!--name,rate,comment,photo-->    
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
</script>
</body>
</html>