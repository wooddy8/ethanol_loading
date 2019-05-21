<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Custom CSS -->
<link href="../css/custom.css" rel="stylesheet" id="bootstrap-css">

<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-1.3.2.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
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
  <?php Include('../menu.php'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/01-card-rev.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ข้อมูลบัตรเติม<br>เอทานอล</h5>
          </div>
          <div class="card-footer text-muted">
              <a class="btn btn-secondary" href="../card/" role="button">Click</a>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/02-pressure-rev.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ข้อมูลการจ่าย<br>เอทานอล</h5>
          </div>
          <div class="card-footer text-muted">
            <a class="btn btn-secondary" href="../info_payment/" role="button">Click</a>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/03-oil-tank.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ข้อมูลเอทานอล<br>ในถังเก็บ</h5>
          </div>
          <div class="card-footer text-muted">
<a class="btn btn-secondary" href="../info_tank/" role="button">Click</a>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/04-pay-ethanol.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ระบบการจ่าย<br>เอทานอล</h5>
          </div>
          <div class="card-footer text-muted">
            <a class="btn btn-secondary" href="../ethanol_system/" role="button">Click</a>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/05-system-tank.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ระบบถังเก็บ<br>เอทานอล</h5>
          </div>
          <div class="card-footer text-muted">
            <a class="btn btn-secondary" href="../tank_system/" role="button">Click</a>
          </div>
        </div>
      </div>
      <div class="col-md-2 mt-5">
        <div class="card text-center">
          <img class="card-img-top" src="../image/icon/06-system-tank2.png" alt="Card image cap">
          <div class="card-body" id="card">
            <h5 class="card-title">ระบบถังเก็บ<br>สารแปลงสภาพ</h5>
          </div>
          <div class="card-footer text-muted">
            <a class="btn btn-secondary" href="../substance_system/" role="button">Click</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>