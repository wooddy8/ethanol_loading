<!--Connect Database -->
<?php include('../connect_db/connect.php') ?>

<!--Config Service On System -->
<?php include('../connect_service/config_service.php') ?>

  <!--Check Session user in Page -->
  <?php
  session_start();   

  if(empty($_SESSION['id_user']))
  {
      //การป้องกันการเข้าถึง Url โดยตรง ให้ทำการ redirect ไปหน้า login 
      header("location:index.php");
  }
  ?>

<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ethanal Loading</title>
  <!--Made with love by Mutiullah Samim -->

  <!--Bootsrap 4 CDN
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
-->

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!--Custom styles-->
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Demier Group</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../home">
            <i class="fa fa-home"></i>
            Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php if ($_SESSION['group_allow'] == 5) {

          ?>
          <li class="nav-item">
            <a class="nav-link" href="../user_login">
              <i class="fa fa-users">
              </i>
              ข้อมูลผู้ใช้งาน
            </a>
          </li>
          <?php
        }
        ?>
        <?php if ($_SESSION['group_allow'] == 5) {

          ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-database">
              </i>
              ข้อมูลการใช้งาน
            </a>
          </li>
        <?php
          }
        ?>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa fa-key">
              </i>
              เปลี่ยนรหัสผ่าน
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ">
          <button class="btn btn-primary"><i class="fa fa-user"></i> <?php echo $_SESSION['name_lastname'] ?></button>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">
              <i class="fa fa-sign-out-alt">
              </i>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </nav><script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>

  </body>