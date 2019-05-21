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

$strSQL   = "SELECT * FROM tank_system where id_tank_system = 1 ";
$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
?>
<?php
while ($objResult = mysql_fetch_array($objQuery))
{
    $vale1 = $objResult["valve_1"];
    $vale2 = $objResult["valve_2"];
    $vale3 = $objResult["valve_3"];
    $vale4 = $objResult["valve_4"];
    ?>


<?php
}
?>

<!--Status Vale1 On Aad Off -->
<?php if ($vale1 == 0)
{
    $image_vale1 = "../image_system/P1_Stop-1.gif";
}
elseif ($vale1 == 1)
{
    $image_vale1 = "../image_system/P1_Run-1.gif";
}
elseif ($vale1 == 2)
{
    $image_vale1 = "../image_system/MOV31-1.gif";
}
?>

<!--Status Vale2 Off = 1 , On = 1, Fail = 2 -->
<?php if ($vale2 == 0)
{
    $image_vale2 = "../image_system/P1_Stop-1.gif";
}
elseif ($vale2 == 1)
{
    $image_vale2 = "../image_system/P1_Run-1.gif";
}
elseif ($vale2 == 2)
{
    $image_vale2 = "../image_system/MOV31-1.gif";
}
?>

<!--Status Vale3 Off = 1 , On = 1, Fail = 2 -->
<?php if ($vale3 == 0)
{
    $image_vale3 = "../image_system/P1_Stop-1.gif";
}
elseif ($vale3 == 1)
{
    $image_vale3 = "../image_system/P1_Run-1.gif";
}
elseif ($vale3 == 2)
{
    $image_vale3 = "../image_system/MOV31-1.gif";
}
?>

<!--Status Vale4 Off = 1 , On = 1, Fail = 2 -->
<?php if ($vale4 == 0)
{
    $image_vale4 = "../image_system/P1_Stop-1.gif";
}
elseif ($vale4 == 1)
{
    $image_vale4 = "../image_system/P1_Run-1.gif";
}
elseif ($vale4 == 2)
{
    $image_vale4 = "../image_system/MOV31-1.gif";
}
?>


 <div class="card bgimg">
      <h5 class="card-header bg-primary text-white"><i class="fa fa-database" aria-hidden="true"></i> ระบบถังเก็บเอทานอล
      </h5>
      <div class="card-body ">
        <div class="" align="center">
          <!--
          <img src="../image_system/ArmUp-1.gif" class="armup" style="" width="" alt="">
          -->

          <img src="../image_system/StorageTank-1.gif" class="main" style="" alt="">
          <img src="<?php echo $image_vale1 ?>" class="P1" style="" width="" alt="">
          <img src="<?php echo $image_vale2 ?>" class="P2" style="" width="" alt="">
          <img src="<?php echo $image_vale3 ?>" class="P3" style="" width="" alt="">
          <img src="<?php echo $image_vale4 ?>" class="P4" style="" width="" alt="">
          <img src="../image_system/levelA.gif" class="levelA-T1" style="" width="" alt="">
          <img src="../image_system/levelA.gif" class="levelA-T2" style="" width="" alt="">
          <img src="../image_system/levelA.gif" class="levelA-T3" style="" width="" alt="">
        </div>
        <p></p>
      </div>
      <!--Box 1 Data Vale-->
      <div class="box1">
        <div class="row tex-data" align="">
        <div class="col-md-12">
            Level&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> M
          </div>
          <div class="col-md-12">
            Volume&nbsp;<span class="badge badge-light span">0</span> M3
          </div>
          <div class="col-md-12">
            Temp&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> C
          </div>
        </div>
      </div>
      <!--Box 2 Data Vale-->
      <div class="box2">
        <div class="row tex-data" align="">
        <div class="col-md-12">
            Level&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> M
          </div>
          <div class="col-md-12">
            Volume&nbsp;<span class="badge badge-light span">0</span> M3
          </div>
          <div class="col-md-12">
            Temp&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> C
          </div>
        </div>
      </div>
      <!--Box 3 Data Vale-->
      <div class="box3">
        <div class="row tex-data" align="">
        <div class="col-md-12">
            Level&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light span">0</span> M
          </div>
          <div class="col-md-12">
            Volume&nbsp;<span class="badge badge-light span">0</span> M3
          </div>
          <div class="col-md-12">
            Temp&nbsp;&nbsp;&nbsp;&nbsp;<span
              class="badge badge-light span">0</span> C
          </div>
        </div>
      </div>
    </div>
