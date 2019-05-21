<body>
  <?php include('../menu.php'); ?>


  <!--Insert Data Tank -->
  <?php if ($_POST['submit']) {

    $Record = $_POST['Record'];
    $Date = $_POST['Date'];
    $Time = $_POST['Time'];
    $Tank = $_POST['Tank'];
    $Level = $_POST['Level'];
    $Volume = $_POST['Volume'];
    $Temp = $_POST['Temp'];

    $filed_date = "Date";
    $filed_time = "Time";

    //Sort Data//
    if ($Date_check = strtotime($Date)){
      $Date_add =date('Ymd', $Date_check); 
    } 

    //Sort time//
    if ($Time_check = strtotime($Time)){
      echo $Time_add =date('Hi', $Time_check); 
    } 

    $strSQL = "INSERT INTO tank (Record,".$filed_date.",".$filed_time.",Tank,Level,Volume,Temp) VALUES ('$Record','$Date_add','$Time_add','$Tank','$Level','$Volume','$Temp')";
    $objQuery = mysql_query($strSQL) or die(mysql_error());

    if($objQuery)
    {
      $msg = '<div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>เพิ่มข้อมูลเรียบร้อย </strong>          
      </div>';

                //echo $redirect = '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=ma_detail.php?ma='.$ma_register.'">';



    }
    else
    {
      echo "Error Save [".$strSQL."]";
    }
  } 
  ?>

  <!-- Edit Date Tank -->
  <?php 
  if($_POST['edit_submit'])
  {

    $Date = $_POST['Date'];
    $Time = $_POST['Time'];

        //Sort Data//
    if ($Date_check = strtotime($Date)){
      $Date_add =date('Ymd', $Date_check); 
    } 

    //Sort time//
    if ($Time_check = strtotime($Time)){
     $Time_add =date('Hi', $Time_check); 
   } 

   $Record = $_POST['Record'];


   $strSQL = "UPDATE tank SET ";
   $strSQL .="Date = '".$Date_add."' ";
   $strSQL .=",Time = '".$Time_add."' ";
   $strSQL .=",Level = '".$_POST["Level"]."' ";
   $strSQL .=",Volume= '".$_POST["Volume"]."' ";
   $strSQL .=",Temp = '".$_POST["Temp"]."' ";
   $strSQL .=" WHERE Record = '".$Record."' ";
   $objQuery = mysql_query($strSQL)or die(mysql_error());

   if($objQuery)
   {
    echo $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>แก้ไขข้อมูลเรียบร้อย</strong>          
    </div>';
  }
  else
  {
    echo "Error Save [".$strSQL."]";
  }

} 
?>

<!--Query Show Database Table Tank  -->
<?php 
$strSQL = "SELECT *  FROM tank ";

if($_GET["search"] != '')
{
  $check_date = str_replace("-" ,"", $_GET['search']);
  $strSQL .= " where Date LIKE '%".$check_date."%'    ";

}else{

  $strSQL .= " where Tank = '".$_GET['tank']."' ";
}

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$Num_Rows = mysql_num_rows($objQuery);
$total = mysql_num_rows($objQuery);

$Per_Page = 100;   

if (!isset($_GET['Page'])) {
  $Page = 1;
} else {
  $Page = $_GET['Page'];
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;

$Page_Start = (($Per_Page * $Page) - $Per_Page);
if ($Num_Rows <= $Per_Page) {
  $Num_Pages = 1;
} elseif (($Num_Rows % $Per_Page) == 0) {
  $Num_Pages = ($Num_Rows / $Per_Page) ;
} else {
  $Num_Pages = ($Num_Rows / $Per_Page) + 1;
  $Num_Pages = (int) $Num_Pages;
}

$s="0";
$s0 = '<i class="fa fa-sort" aria-hidden="true"></i>';
$sASC = '<i class="fa fa-sort-asc" aria-hidden="true"></i>';
$sDESC = '<i class="fa fa-sort-desc" aria-hidden="true"></i>';
/*
  $strSort = $_GET["sort"];
  if($strSort == "")
  {
    $strSort = "job_no"; 
  }
  if($strSort == "")
  {
    $strSort = "company_id";
  }
  if($strSort == "")
  {
    $strSort = "project_name";
  }
  if($strSort == "")
  {
    $strSort = "customer_name";
  }
  if($strSort == "")
  {
    $strSort = "start_date";
  }
  if($strSort == "")
  {
    $strSort = "job_status";
  }
  if($strSort == "")
  {
    $strSort = "sale_person";
  }
  $strOrder = $_GET["order"];
  if($strOrder == "")
  {
    $strOrder = "DESC";
  }
*/
  $strSQL.=" order by Date DESC LIMIT $Page_Start , $Per_Page";
  $objQuery  = mysql_query($strSQL);
  $strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
  ?> 

  <div class="container-fluid">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-truck" aria-hidden="true"></i> ข้อมูล
        เอทานอล ถังเก็บ <?php echo $_GET['tank'] ?>
        <?php if ($_SESSION['group_allow'] == 3 or $_SESSION['group_allow'] == 4 or $_SESSION['group_allow'] == 5) {

          ?>
          <button class="btn btn-light" style="float: right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
          <?php
        }
        ?>  
      </h5>
      <div class="card-body">
        <h4>ค้นหาข้อมูล  </h4>
        
        <form class=""  method="GET" action="">
          <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 red-border" type="date" placeholder="Search" aria-label="Search" name="search">
            <div class="input-group-append">
              <button class="btn-circle" type="submit" name="submit" value="ค้นหา"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
        
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">หมายเลข</th>
              <th scope="col" width="150">วันที่</th>
              <th scope="col" width="150">เวลา</th>
              <th scope="col">ระดับ</th>
              <th scope="col">ปริมาตร</th>
              <th scope="col">อุณหภูมิ</th>
              <?php if ($_SESSION['group_allow'] == 3 or $_SESSION['group_allow'] == 4 or $_SESSION['group_allow'] == 5) {

                ?>
                <th scope="col">Action</th>
                <?php
              }
              ?>
            </tr>
          </thead>
          <?php 
          $i= 1;
          while($objResult = mysql_fetch_array($objQuery))
          {

            ?>

            <!-- Check User Allow -->
            <?php 
            $strSQL_card = "SELECT * FROM card where Card = '".$objResult['Card']."' ";
            $objQuery_card = mysql_query($strSQL_card) or die ("Error Query [".$strSQL_card."]");
            $objResult_card = mysql_fetch_array($objQuery_card);
            $Card_number = $objResult_card['CardID'];
            $Company = $objResult_card['Company'];
            ?>

            <!--Sort date start -->
            <?php
            if ($date_start = strtotime($objResult['Date'])){
              $show_date_start =date('d/m/Y', $date_start); 
              $value_date_start =date('Y-m-d', $date_start); 
            }  
            ?> 

            <!--Sort time start -->
            <?php
            if ($time_start = strtotime($objResult['Time'])){
              $show_time_start =date('H:i', $time_start); 
            }  
            ?> 



            <!-- modal form edit Card -->
            <div class="modal fade" id="edit<?php echo $objResult['Record'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล เอทานอลถังเก็บ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>หมายเลข :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Record" class="form-control" required  placeholder="หมายเลข" readonly="" value="<?php echo $objResult['Record'] ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>ถังเก็บ :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Tank" class="form-control" required  placeholder="ทะเบียนรถ" readonly="" value="<?php echo $_GET['tank'] ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่ :</strong></label>
                          <div class="col-sm-12">
                            <input type="date" name="Date" class="form-control" required  placeholder=""  value="<?php echo $value_date_start ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลา :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Time" class="form-control" required  placeholder="เวลา"  value="<?php echo $objResult['Time'] ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>ระดับ (m) :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Level" class="form-control" required  placeholder="รัดับ"  value="<?php echo $objResult['Level'] ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาตร (m³) :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Volume" class="form-control" required  placeholder="ปริมาตร"  value="<?php echo $objResult['Volume'] ?>">
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPassword3" class="col-sm-12 control-label"><strong>อุณหภูมิ (°C) :</strong></label>
                          <div class="col-sm-12">
                            <input type="text" name="Temp" class="form-control" required  placeholder="อุณหภูมิ"  value="<?php echo $objResult['Temp'] ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <input type="submit" class="btn btn-primary" name="edit_submit" value="Save">
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- end modal form  add Card-->  
            <tr>
              <th scope="row"><a href="view_info_payment.php?Record=<?php echo $objResult['Record'] ?>"><?php echo $objResult['Record'] ?></a></th>
              <td width="100">
                  <?php echo $show_date_start ?>
                </td>
                <td><?php echo $objResult['Time'],' น.' ?></td>
                <td><?php echo $objResult['Level'] ?> m</td>
                <td><?php echo $objResult['Volume'] ?> m³</td>
                <td><?php echo $objResult['Temp'] ?> °C</td>
                <?php if ($_SESSION['group_allow'] == 3 or $_SESSION['group_allow'] == 4 or $_SESSION['group_allow'] == 5) {

                  ?>
                  <td width="150">
                    <a  href='#edit<?php echo $objResult['Record'] ?>'  role='button' data-toggle='modal'><button class="btn btn-warning"><i class="fa fa-edit" title="edit"></i></button></a>
                    <a  href='#remove<?php echo $objResult['Card'] ?>'  role='button' data-toggle='modal'><button class="btn btn-danger"><i class="fa fa-trash" title="delete"></i></button></a>
                  </td>
                  <?php
                  }
                  ?>
                </tr>
                <?php
                $i++;
              }
              ?>
            </table>
            <p><b>Total : <?php echo $total; ?> Record</b></p>
            <?php
            if ($Prev_Page) {
              echo " <a href ='$_SERVER[SCRIPT_NAME]?tank=".$_GET['tank']."&sort=$strSort&order=$strOrder&Page=$Prev_Page'><button class='btn btn-default'><b><</b></button></a> ";
            }

            for($i=1; $i<=$Num_Pages; $i++){
              if($i >= $Page-2 && $i <= $Page +2&&  $i != $Page)
              {
                echo " <a href ='$_SERVER[SCRIPT_NAME]?tank=".$_GET['tank']."&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
              }else if ($i == $Page)
              {
                echo "<button class='btn btn-primary'>$i</button>";
              }
              else if ($i == $Num_Pages || $i == $Num_Pages -1)
              {
                echo " <a href ='$_SERVER[SCRIPT_NAME]?tank=".$_GET['tank']."&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
              }
              else if ($i == $Page+3)
              {
               echo "<button class='btn btn-default'>...</button> ";
             }
           }

           if ($Page!=$Num_Pages) {
            echo " <a href ='$_SERVER[SCRIPT_NAME]?Action=view_job&sort=$strSort&order=$strOrder&Page=$Next_Page'><button class='btn btn-default'><b>></b></button></a> ";        
          }

          ?>

          <!-- modal form add Card -->
          <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลการจ่ายเอทานอล</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>หมายเลข :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Record" class="form-control" required  placeholder="หมายเลข"  value="">
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>ถังเก็บ :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Tank" class="form-control" required  placeholder="ทะเบียนรถ" readonly="" value="<?php echo $_GET['tank'] ?>">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่ :</strong></label>
                        <div class="col-sm-12">
                          <input type="date" name="Date" class="form-control" required  placeholder=""  value="">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลา :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Time" class="form-control" required  placeholder="เวลา"  value="">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>ระดับ (m) :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Level" class="form-control" required  placeholder="รัดับ"  value="">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาตร (m³) :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Volume" class="form-control" required  placeholder="ปริมาตร"  value="">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>อุณหภูมิ (°C) :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="Temp" class="form-control" required  placeholder="อุณหภูมิ"  value="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="submit" value="Save">
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- end modal form info_payment-->    
        </div>
      </div>

    </div>
    <!-- js & Jquery --> 
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>

  </body>
  </html>