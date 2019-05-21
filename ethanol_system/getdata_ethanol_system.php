<!--Connect Database -->
<?php include '../connect_db/connect.php'?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ethanal Loading</title>
</head>
<?php
date_default_timezone_set("Asia/Bangkok");

echo "Update Time : " . date("Y-m-d H:i:s");

$strSQL   = "SELECT * FROM ethanol_system where id_ethanol_system = 1 ";
$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
?>
<?php
while ($objResult = mysql_fetch_array($objQuery))
{
    $company    = $objResult["company"];
    $arm_load   = $objResult["arm-load"];
    $vale1      = $objResult["vale-1"];
    $vale2      = $objResult["vale-2"];
    $controll_1 = $objResult["controll-1"];
    $controll_2 = $objResult["controll-2"];
    ?>


<?php
}
?>
<!--Status Arm Up Aad Down -->
    <?php if ($arm_load == 1)
{
    $image_arm = "../image_system/ArmDown-1.gif";
}
elseif ($arm_load == 2)
{
    $image_arm = "../image_system/ArmUp-1.gif";
}

?>
<!--Status Vale1 On Aad Off -->
<?php if ($vale1 == 0)
{
    $image_vale1 = "../image_system/MOV21-1.gif";
}
elseif ($vale1 == 1)
{
    $image_vale1 = "../image_system/MOV11-1.gif";
}
elseif ($vale1 == 2)
{
    $image_vale1 = "../image_system/MOV31-1.gif";
}
?>

<!--Status Vale2 Off = 1 , On = 1, Fail = 2 -->
<?php if ($vale2 == 0)
{
    $image_vale2 = "../image_system/MOV21-1.gif";
}
elseif ($vale2 == 1)
{
    $image_vale2 = "../image_system/MOV11-1.gif";
}
elseif ($vale2 == 2)
{
    $image_vale2 = "../image_system/MOV31-1.gif";
}
?>

<!--Status Controll1 Off = 0, On = 1, Faill = 2  -->
<?php if ($controll_1 == 0)
{
    $image_controll_1 = "../image_system/ControllerOff-1.gif";
}
elseif ($controll_1 == 1)
{
    $image_controll_1 = "../image_system/ControllerOn-1.gif";
}
elseif ($controll_1 == 2)
{
    $image_controll_1 = "../image_system/ControllerFail-1.gif";
}
?>

<!--Status Controll1 Off = 0, On = 1, Faill = 2  -->
<?php if ($controll_2 == 0)
{
    $image_controll_2 = "../image_system/ControllerOff-1.gif";
}
elseif ($controll_2 == 1)
{
    $image_controll_2 = "../image_system/ControllerOn-1.gif";
}
elseif ($controll_2 == 2)
{
    $image_controll_2 = "../image_system/ControllerFail-1.gif";
}
?>

 <div class="card bgimg">
      <h5 class="card-header bg-primary text-white"><i class="fa fa-database" aria-hidden="true"></i> ระบบจ่ายเอทานอล
      </h5>
      <div class="card-body ">
        <div class="" align="center">
          <!--
          <img src="../image_system/ArmUp-1.gif" class="armup" style="" width="" alt="">
          -->

          <img src="<?php echo $image_arm ?>" class="armdown" style="" width="" alt="">
          <img src="../image_system/TruckLoad00-1.gif" class="main" style="" alt="">
          <img src="../image_system/Car-02.gif" class="car" style="" width="" alt="">
          <img src="<?php echo $image_vale1 ?>" class="mov-1" style="" width="" alt="">
          <img src="<?php echo $image_vale2 ?>" class="mov-2" style="" width="" alt="">
          <img src="<?php echo $image_controll_1 ?>" class="controll-1" style="" width="" alt="">
          <img src="<?php echo $image_controll_2 ?>" class="controll-2" style="" width="" alt="">
        </div>
        <p></p>
      </div>
      <!--Box 1 Data Vale-->
      <div class="box1">
        <div class="row tex-data" align="">
          <div class="col-md-12">
            Volume&nbsp;<span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-12">
            Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> L
          </div>
        </div>
      </div>
      <!--Box 2 Data Vale-->
      <div class="box2">
        <div class="row tex-data" align="">
          <div class="col-md-6">
            Batch&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span>
          </div>
          <div class="col-md-6">
            Flow&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> L/M
          </div>
          <div class="col-md-6">
            Preset&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Temp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> °C
          </div>
          <div class="col-md-6">
            Remain <span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Volume&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Recipe&nbsp;&nbsp;<span class="badge badge-light span">0</span>
          </div>
          <div class="col-md-6">
            Meter Total&nbsp;<span class="badge badge-light span">0</span> L
          </div>
        </div>
      </div>
      <!--Box 3 Data Vale-->
      <div class="box3">
        <div class="row tex-data" align="">
          <div class="col-md-6">
            Batch&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span>
          </div>
          <div class="col-md-6">
            Flow&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> L/M
          </div>
          <div class="col-md-6">
            Preset&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Temp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> °C
          </div>
          <div class="col-md-6">
            Remain <span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Volume&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> L
          </div>
          <div class="col-md-6">
            Recipe&nbsp;&nbsp;<span class="badge badge-light span">0</span>
          </div>
          <div class="col-md-6">
            Meter Total&nbsp;<span class="badge badge-light span">0</span> L
          </div>
        </div>
      </div>
      <!--Box 4 Data Vale-->
      <div class="box4">
          <div class="row tex-data" align="">
            <div class="col-md-12">
              Company <span class="badge badge-light "><?=$company?></span>
            </div>
            <div class="col-md-3">
              Card <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-3">
              Car <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-12">
              Volume <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-6">
              Start <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-6">
              Card <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-6">
              Injet <span class="badge badge-light ">0</span>
            </div>
            <div class="col-md-6">
              Stop <span class="badge badge-light ">0</span>
            </div>
          </div>
          <p><hr></p>

          <div align="center">
          <button type="button" class="btn btn-success btn-sm"><small><b>Grounding Overfill</b></small></button>
          <button type="button" class="btn btn-success btn-sm"><small><b>ESD Loading Station</b></small></button>
          </div>
        </div>
    </div>
