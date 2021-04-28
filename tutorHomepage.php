    
    
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
    
       $TID = $_SESSION['TID'];
       $TUTORNAME = $_SESSION['TUTORNAME'];
       $ROLE = $_SESSION['ROLE'];

       $limit = 5;  
if (isset($_GET["page"])) 
{
	$page  = $_GET["page"]; 
	} 
	else
        { 
	$page=1;
	};  
$start_from = ($page-1) * $limit; 

    $querycountstudent= "SELECT count(UID) as countuser FROM `user` WHERE ROLE = 'student'";
    $resultcount = mysqli_query($db, $querycountstudent);
    $rowcount = mysqli_fetch_array($resultcount);
    $countuser = $rowcount['countuser'];

    
    
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
         <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    

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
                        <a href="javascript:void(0)" onclick='location.href ="tutorAccount.php"'>Account</a>
                    </li>-->
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="tutorContact.php"'>Contact</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick='location.href ="tutorAbout.php"'>About</a>
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
                    <h2>Tutor Dashboard</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    
                    <div class="card mt-3 mb-3 shadow-sm container">
                        
                        <div class="card-body">
                            <h5 class="card-title text-center">Search Student</h5>
                            <div class="row">
                                <form class="form-inline mt-3 mb-3 justify-content-center container-fluid text-center"  method="post">
                                    <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Search..." aria-label="Search" style="width: 40%;">
                                    <select class="custom-select" required name="filterby" id="filterby" >
                                    <option value="" disabled selected>Filter by</option>
                                        <option value="ID">Id</option>
                                        <option value="NAME">Name</option>
                                        <option value="GROUP">Group</option>
                                    </select>
                                    <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit" style="max-width: 15%; width: 15%;">Search</button>
                                    <button class="btn btn-outline-danger ml-2 my-2 my-sm-0" onclick='location.href ="tutorHomepage.php"' style="max-width: 15%; width: 15%;">Clear</button>
                                </form> 
                            </div>   
                        </div>
                    </div>
                    
                    <!-- View Student  -->

                    <div class="card mt-3 mb-3 shadow-sm">
                        <div class="card-body">

                            <h5 class="card-title">Students <span class="std-count text-success"><?php echo $countuser?> students</span></h5>
                            <div class="row">
                            <table id="myTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th onclick="sortTable(0)" scope="col">#</th>
                                    <th  scope="col">ID</th>
                                    <th  scope="col">Name</th>
                                    <th  scope="col">Group</th>
                                    <th  scope="col">Average Grade</th>
                                    <th  scope="col">Group Completion</th>
                                    <th  scope="col">Group Status</th>
                                    <th  scope="col">Email</th>
                                    <th  scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_POST["search"]))
                                    {
                                        if($_POST["filterby"] == "ID")
                                        {
                                            $queryselect= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE USERNAME LIKE  '%".$_POST["search"]."%' && ROLE = 'student' ";  
                                        }
                                        else if ($_POST["filterby"] == "NAME")
                                        {
                                            $queryselect= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE FNAME LIKE  '%".$_POST["search"]."%' && ROLE = 'student' ";    
                                        }
                                        else if ($_POST["filterby"] == "GROUP")
                                        {
                                            $queryselect= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE GNAME LIKE  '%".$_POST["search"]."%' && ROLE = 'student' ";  
                                        }
                                    }
                                    else
                                    {          
                                    $queryselect= "SELECT * FROM `user` INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE ROLE = 'student' ORDER BY UID ASC LIMIT $start_from, $limit ";
                                    }
                                    if($resultlist = mysqli_query($db, $queryselect))
                                    {
                                        if(mysqli_num_rows($resultlist) > 0)
                                        {
                                            $i=1;
                                            while($row = mysqli_fetch_array($resultlist))
                                            {
                                                $UID = $row['UID'];
                                                $GID = $row['GID'];
                                                $completion = 0;
                                                $queryselect3= "SELECT count(GRID) as countrate FROM `grading` INNER JOIN `user` ON grading.UID = user.UID INNER JOIN `studentgroup` ON studentgroup.GID = user.GID WHERE user.GID = '$GID' && grading.STATUS = 'Completed'";
                                                $countresult3 = mysqli_query($db, $queryselect3);
                                                $countrow3 = mysqli_fetch_array($countresult3); 
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
                                                $completion = $countrow3['countrate'];
                                                $username = $row['USERNAME'];
                                                $email = $row['USEREMAIL'];
                                                $firstname = $row['FNAME'];
                                                $lastname = $row['LNAME'];
                                                $groupname = $row['GNAME'];
                                                $avgmark = $mark*10/2;
                                                 
                                                ?>
                                                <tr>
                                                <th scope="row"><?php echo $i?></th>
                                                <td><?php echo $row['USERNAME']?></td>
                                                <td><?php echo $row['FNAME']?></td>
                                                <td><?php echo $row['GNAME']?></td>
                                                <td><?php echo $avgmark?>%</td>
                                                <td><?php echo $completion?>/6 </td>
                                                <?php 
                                                if($completion <3)
                                                {
                                                ?>
                                                    <td class="text-danger">Incomplete</td>
                                                    <td><a href="javascript:void(0)" onclick="location.href='tutorHomepage.php?sendreminder=true'" class="btn-success-custom2 rounder">Send Reminder</a></td>
                                                    <?php if (isset($_GET['sendreminder'])) {require 'SendReminder.php';}?>
                                                <?php
                                                }
                                                else 
                                                {
                                                ?>
                                                    <td class="text-success">Complete</td>
                                                    <td><a href="javascript:void(0)" onclick="location.href='tutorHomepage.php?sendreport=true'" class="btn-success-custom rounder">Send Report</a></td>
                                                      <?php if (isset($_GET['sendreport'])) {require 'SendReport.php';}?>
 <?php
                                                }
                                                ?>

                                                <td><a href="javascript:void(0)" onclick="location.href='tutorViewDetail.php?id=<?php echo$row['UID']?>'" class="btn-primary-custom rounder">View Details</a></td>

                                                </tr>  

                                                <?php  
                                                $i++;    
                                            }
                                        }
                                    }
                                    ?>                                     
                                </tbody>
                                </table>

                            </div>   
                        </div>
                        
                    </div>
                    <nav aria-label="page-nav">
<!--                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>-->
                    <?php 
                    if(isset($_POST["search"]))
                    {
                        if($_POST["filterby"] == "ID")
                        {
                        }
                        else if ($_POST["filterby"] == "NAME")
                        {
                        }
                        else if ($_POST["filterby"] == "GROUP")
                        {
                        }
                    }
                    else
                    {                    
                        $result_db = mysqli_query($db,"SELECT COUNT(UID) FROM user WHERE ROLE = 'student'"); 
                        $row_db = mysqli_fetch_row($result_db);  
                        $total_records = $row_db[0];  
                        $total_pages = ceil($total_records / $limit); 
                        /* echo  $total_pages; */
                        $pagLink = "<ul class='pagination'><li class='page-item'><a class='page-link' href='tutorHomepage.php?page=".($page-1)."'>Previous</a></li>";  
                        for ($i=1; $i<=$total_pages; $i++) 
                        {       
                            $pagLink .= "<li class='page-item'><a class='page-link' href='tutorHomepage.php?page=".$i."'>".$i."</a></li>";	
                        }
                        echo $pagLink . "<li class='page-item'><a class='page-link' href='tutorHomepage.php?page=".($page+1)."'>Next</a></li></ul>";
                    }
                    ?>
                    </nav>
                </div>
            </div>
        </div>
            
        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            
        <script type="text/javascript" src="index.js"></script>  
        <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap.min.js></script>
    </script>
</body>
</html>