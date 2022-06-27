
  <?php

include_once 'config.php';
if (isset($_GET['id'])) {
$id = $_GET['id']; 
$sql3 = "SELECT * FROM `user` WHERE id = $id";




$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {        

  while ($row = $result3->fetch_assoc()) {


    $firstname = $row['firstname'];

    $id = $row['id'];

    $imageURL = '/intern-report/image'.$row['avatar'];

    $usertype = $row['usertype']; 
  }

?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title>Legoom HRMS - Dashboard</title>
    <link href="css/main.css" rel="stylesheet" media="all">
    <link href="css/block.css" rel="stylesheet" media="all">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Main CSS-->
<link href="css/main.css" rel="stylesheet" media="all">
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css'>



<style>
      .sidebar {
        height: 100%;
        width: 250px;
        position: absolute;
        left: 0;
        top: 0;
        padding-top: 40px;
        background-color: lightblue;
        }

        .sidebar div {
        padding-right: 1000px;
        font-size: 18px;
        }

        .form {
        }

        .body-text {
        font-size: 18px;
        }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      body {
            max-width: 100%;
            overflow-x: hidden;
            min-height: 108%;
            
            }


      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      
    </style>


    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php?id=<?=$id?>" style="font-size: 20px;">Legoom HRMS</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="form-control form-control-black " style="background-color: #212529;"></div>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="login" style="font-size: 20px;">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid" style="margin-top:-20px; margin-left:23px;">
  <div class="row">
    <nav id="sidebarMenu" class="d-md-block bg-light sidebar">
      <div class="position-sticky pt-3">
      <main>
      <?php
      
       include 'sidebar/index.php';
     ?>
  </div>
</main>
      </div>
    </nav>

    <div class="form">
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
    <div style="margin-left:280px; margin-right:40px; margin-top:-40px; height:300px;" >
    <div class="card card-5" >
    <div class="card-heading"><h2 class="title">Dashboard</h2></div>
    <div class="card-body">
    <?php if ($usertype == '2' || $usertype == '3'   ){ ?>
    <?php 
$sql4 = "SELECT count(*) from form WHERE date = CURDATE()";

$result4 = $conn->query($sql4);
$total= mysqli_query($conn,$sql4);
$row = mysqli_fetch_assoc($total);
$count = $row["count(*)"];


  ?>
<a href="attendance/index.php?id=<?=$id?>">
<div class="blocks wrapper" >
  <div class="block blue" style="border-radius: 8px;">
    <div class="heading">
    <p>Attendance</p>
    <div class="num"><?php echo $count ?></div>
    </div>
  </div>
</div>
<?php 
$sql5 = "SELECT count(*) from user";

$result5 = $conn->query($sql5);
$user= mysqli_query($conn,$sql5);
$row = mysqli_fetch_assoc($user);
$count = $row["count(*)"];


  ?>
<a href="users/index.php?id=<?=$id?>">
<div class="blocks wrapper">
  <div class="block orange" style="border-radius: 8px;">
    <div class="heading" style="color:block orange;"  >
    <p>User</p>
    <div class="num"><?php echo $count ?></div>
    </div>
  </div>
</div>
<?php } else {?>

  <?php 
$sql5 = "SELECT `status`,`date` from `form` WHERE `intern_id` = '$id' ORDER BY `date` DESC";

$result5 = $conn->query($sql5);
$status= mysqli_query($conn,$sql5);
$row = mysqli_fetch_assoc($status);


if ($row == true)
{
    $status = $row['status'];
    $message = $status;
    $date = date("j/n/Y", strtotime($row['date']));
    
     
}
else
{

     $message = "None";
     $date =  date("j/n/Y") ;
}
    
?>


<div class="blocks wrapper">
  <div class="block blue" style="border-radius: 8px;">
    <div class="heading">
    <p>Scrum Form Status </p>
    <div style="font-size: 1.5em;padding-top: 30px;"><?php echo $message ?></div>
    <div style="font-size: 0.5em;padding-top: 10px;"><?php echo $date ?></div>
    </div>
  </div>
</div>
<?php 
$sql4 = "SELECT * from form WHERE date = CURDATE() AND `intern_id` = '$id'";

$result4 = $conn->query($sql4);
$total= mysqli_query($conn,$sql4);
$row = mysqli_fetch_assoc($total);
if ($row == false)
{
     $message = "Not Submit";
     echo "<a href='/intern-report/form/create.php?id=$id'>";
}
else
    $message = "Submitted";
    $date =  date("j/n/Y") ;

  ?>

<div class="blocks wrapper">
  <div class="block orange" style="border-radius: 8px;">
    <div class="heading">
    <p>Intern Report</p>
   
    <div style="font-size: 1.5em;padding-top: 30px;"><?php echo $message ?></div>
    <div style="font-size: 0.5em;padding-top: 10px;"><?php echo $date ?></div>
    </div>
  </div>
</div>


  
    <?php } ?>
    <br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
    <hr>
    <footer><span id='date-time'></span>.</footer>
    </div>
 
  </div>
</div>
</div>
</div>
</div>
</div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="js/dashboard.js"></script>
<script>
var dt = new Date();
document.getElementById('date-time').innerHTML=dt;
</script>


</body>
</html>
<?php } } ?>