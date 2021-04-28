<?php 
session_start();
if (empty($_SESSION['UID'])) {
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
                    <h2>Student Dashboard</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        
                    <!-- Your Rating  -->
                    <h2>Your Rating</h2> 
                        
                    <div class="card mt-3 mb-3 shadow-sm">
                        <?php
                            $queryselect1= "SELECT GNAME FROM `studentgroup` WHERE GID = '$GID'";
                            if($resultlist1 = mysqli_query($db, $queryselect1))
                            {
                                if(mysqli_num_rows($resultlist1) > 0)
                                {
                                    while($row1 = mysqli_fetch_array($resultlist1))
                                    {
                                    ?> 
                        <h5 class="card-header"><?php echo $row1['GNAME'] ?></h5>
                                    <?php
                                    }   
                                }
                            }     
                        ?> 
                        <div class="card-body">
                        <?php
                            $queryselect1= "SELECT COUNT(GID) as COUNTING FROM `user` WHERE GID = '$GID' && ROLE = 'student'";
                            if($resultlist1 = mysqli_query($db, $queryselect1))
                            {
                                if(mysqli_num_rows($resultlist1) > 0)
                                {
                                    while($row1 = mysqli_fetch_array($resultlist1))
                                    {
                                    ?> 
                            <h5 class="card-title">Group Members <span class="std-count"> <?php echo $row1['COUNTING'] ?> students &middot; 1 teacher </span></h5>
                                    <?php
                                    }   
                                }
                            }     
                        ?>                             
                            <div class="row">
                                
                           <?php
                                $queryselect1= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE user.GID = '$GID' && user.UID != '$UID' && user.ROLE = 'student'";
                                if($resultlist1 = mysqli_query($db, $queryselect1))
                                {
                                    if(mysqli_num_rows($resultlist1) > 0)
                                    {
                                        while($row1 = mysqli_fetch_array($resultlist1))
                                        {
                                            $gradeid = $row1['UID'];
                                        ?>                                 
                                <div class="col-sm-4 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2">
                           <?php
                                $queryselect3= "SELECT * FROM  `profile` WHERE UID = '$gradeid'";
                                if($resultlist3 = mysqli_query($db, $queryselect3))
                                {
                                    if(mysqli_num_rows($resultlist3) > 0)
                                    {
                                        while($row3 = mysqli_fetch_array($resultlist3))
                                        {
                                            ?>
                                                
                                                    <img class="user-photo" src="<?php echo "profile/".$row3['PICNAME']?>" style="border-radius: 20%;">
                                                    <?php
                                        }
                                    }
                                }
                                ?>
                                                </div>
                                            <?php
                                            $queryselect2= "SELECT * FROM `grading`  WHERE UID = '$gradeid' && GRADEID = '$UID' ";
                                            if($resultlist2 = mysqli_query($db, $queryselect2))
                                            {
                                                if(mysqli_num_rows($resultlist2) > 0)
                                                {
                                                    while($row2 = mysqli_fetch_array($resultlist2))
                                                    {
                                                        $mark = $row2['RATE'] * 10;
                                                        if($row2['STATUS']=="Pending")
                                                        {
                                                     ?>                                                  
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-secondary">Pending</span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p class='text-secondary'>Pending On Rating</p>
                                                </div>
                                                    <?php
                                                        }
                                                         else
                                                        {
                                                             if($mark < 40)
                                                             {
                                                        ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-danger"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <a href="javascript:void(0)" onclick="location.href='studentIndvRating.php?id=<?php echo$row1['UID']?>'" class="btn-primary-custom rounder">View Rate</a>
                                                </div>                                                    
                                                        <?php
                                                             }
                                                             else if ($mark <70 && $mark >30)
                                                             {
                                                               ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-warning"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <a href="javascript:void(0)" onclick="location.href='studentIndvRating.php?id=<?php echo$row1['UID']?>'" class="btn-primary-custom rounder">View Rate</a>
                                                </div>                                                
                                                               <?php
                                                             }
                                                             else
                                                             {
                                                               ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-success"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <a href="javascript:void(0)" onclick="location.href='studentIndvRating.php?id=<?php echo$row1['UID']?>'" class="btn-primary-custom rounder">View Rate</a>
                                                </div>                                                 
                                                               <?php  
                                                             }
                                                        }
                                                    }   
                                                }
                                                else
                                                {
                                                    ?>
                                                        
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-secondary">Pending</span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p class='text-secondary'>Pending On Rating</p>
                                                </div>
                                                    <?PHP
                                                }     
                                            }
                                            ?>                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                        }   
                                    }
 else {
     
                                    ?>
                                <h5 class="card-title"><span class="std-count">You dont have a Teammate Yet</span></h5>
                                    <?php
                                        
                                        
 }
                                }     
                            ?>                                     
                                
                            </div>   
                        </div>
                    </div>
                        
                    <!-- Rate Member  -->
                    <h2>Rate Member</h2> 
                    <div class="card mt-3 mb-3 shadow-sm">
                        <?php
                            $queryselect1= "SELECT GNAME FROM `studentgroup` WHERE GID = '$GID'";
                            if($resultlist1 = mysqli_query($db, $queryselect1))
                            {
                                if(mysqli_num_rows($resultlist1) > 0)
                                {
                                    while($row1 = mysqli_fetch_array($resultlist1))
                                    {
                                    ?> 
                        <h5 class="card-header card-header-2"><?php echo $row1['GNAME'] ?></h5>
                                    <?php
                                    }   
                                }
                            }     
                        ?> 
                        <div class="card-body">
                        <?php
                            $queryselect1= "SELECT COUNT(GID) as COUNTING FROM `user` WHERE GID = '$GID' && ROLE = 'student'";
                            if($resultlist1 = mysqli_query($db, $queryselect1))
                            {
                                if(mysqli_num_rows($resultlist1) > 0)
                                {
                                    while($row1 = mysqli_fetch_array($resultlist1))
                                    {
                                    ?> 
                            <h5 class="card-title">Group Members <span class="std-count"> <?php echo $row1['COUNTING'] ?> students &middot; 1 teacher </span></h5>
                                    <?php
                                    }   
                                }
                            }     
                        ?>                             
                            <div class="row">
                                
                           <?php
                                $queryselect1= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE user.GID = '$GID' && user.UID != '$UID' && user.ROLE = 'student'";
                                if($resultlist1 = mysqli_query($db, $queryselect1))
                                {
                                    if(mysqli_num_rows($resultlist1) > 0)
                                    {
                                        while($row1 = mysqli_fetch_array($resultlist1))
                                        {
                                            $gradeid = $row1['UID'];
                                        ?>                                 
                                 <div class="col-sm-4 mt-3">   
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2">
                   <?php
                                $queryselect3= "SELECT * FROM  `profile` WHERE UID = '$gradeid'";
                                if($resultlist3 = mysqli_query($db, $queryselect3))
                                {
                                    if(mysqli_num_rows($resultlist3) > 0)
                                    {
                                        while($row3 = mysqli_fetch_array($resultlist3))
                                        {
                                            ?>
                                                
                                                    <img class="user-photo" src="<?php echo "profile/".$row3['PICNAME']?>" style="border-radius: 20%;">
                                                    <?php
                                        }
                                    }
                                }
                                ?>
                                                </div>
                                            <?php
                                            $queryselect2= "SELECT * FROM `grading`  WHERE GRADEID = '$gradeid' && UID = '$UID' ";
                                            if($resultlist2 = mysqli_query($db, $queryselect2))
                                            {
                                                if(mysqli_num_rows($resultlist2) > 0)
                                                {
                                                    while($row2 = mysqli_fetch_array($resultlist2))
                                                    {
                                                        $mark = $row2['RATE'] * 10;
                                                        if($row2['STATUS']=="Pending" || $row2['STATUS']== null)
                                                        {
                                                     ?>                                                  
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-secondary"><?php echo $row2['STATUS']?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <a href="javascript:void(0)" onclick="location.href='studentAssess.php?id=<?php echo $row1['UID']?>'" class='btn-success-custom rounder'">Rate Member</a>
                                                </div>
                                                    <?php
                                                        }
                                                         else
                                                        {
                                                             if($mark < 40)
                                                             {
                                                        ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-danger"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p class='text-secondary'>Rated</p>
                                                </div>                                                       
                                                        <?php
                                                             }
                                                             else if ($mark <70 && $mark >30)
                                                             {
                                                               ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-warning"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p class='text-secondary'>Rated</p>
                                                </div>                                                  
                                                               <?php
                                                             }
                                                             else
                                                             {
                                                               ?>
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-success"><?php echo $mark."%"?></span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p class='text-secondary'>Rated</p>
                                                </div>                                                  
                                                               <?php  
                                                             }
                                                        }
                                                    }   
                                                }
                                                else
                                                {
                                                    ?>
                                                        
                                                <div class="col-sm-5 pl-4" id="std-card-detail">
                                                    <h5 class="card-title"><?php echo $row1['FNAME']." ".$row1['LNAME'] ?></h5>
                                                    <p class="card-text">Rate: <span class="badge badge-secondary">Pending</span></p>
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <a href="javascript:void(0)" onclick="location.href='studentAssess.php?id=<?php echo $row1['UID']?>'" class='btn-success-custom rounder'">Rate Member</a>
                                                </div>
                                                    <?PHP
                                                }     
                                            }
                                            ?>                                                   
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                
                            </div>
                                
                                        <?php
                                        }   
                                    }
                                    else {
                                    ?>
                                <h5 class="card-title"><span class="std-count">You dont have a team member yet</span></h5>
                                    <?php
                                     }
                                }     
                            ?>                                     
                                
                           
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