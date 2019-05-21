<body>
  <?php include('../menu.php'); ?>

  <!--Query Show Database Table Card  -->
  <?php 
  $strSQL = "SELECT *  FROM loading ";

  if($_GET["search"] != '')
  {
    $check_date = str_replace("-" ,"", $_GET['search']);
    $strSQL .= " where StartDate LIKE '%".$check_date."%'    ";

  }else{

    $strSQL .= " where StartDate ";
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
  $strSQL.=" order by StartDate DESC LIMIT $Page_Start , $Per_Page";
  $objQuery  = mysql_query($strSQL);
  $strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
  ?> 

  <div class="container">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-truck" aria-hidden="true"></i> ข้อมูลการจ่าย
        เอทานอล
        <button class="btn btn-light" style="float: right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
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
              <th scope="col">วัน/เวลา</th>
              <th scope="col" width="150">บริษัทลูกค้า</th>
              <th scope="col">ทะเบียนรถ</th>
              <th scope="col">มิเตอร์หลังจ่าย</th>
              <th scope="col">ปริมาณ (ลิตร)</th>
              <th scope="col">Action</th>
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
            if ($date_start = strtotime($objResult['StartDate'])){
              $show_date_start =date('d/m/Y', $date_start); 
              $value_date_start =date('Y-m-d', $date_start); 
            }  
            ?> 

            <!--Sort time start -->
            <?php
            if ($time_start = strtotime($objResult['StartTime'])){
              $show_time_start =date('H:i', $time_start); 
            }  
            ?> 

            <!--Sort date end -->
            <?php
            if ($date_end = strtotime($objResult['StopDate'])){
              $show_date_end =date('d/m/Y', $date_end); 
              $value_date_end =date('Y-m-d', $date_end);
            }  
            ?> 

            <!--Sort time end -->
            <?php
            if ($time_end = strtotime($objResult['StopTime'])){
              $show_time_end =date('H:i', $time_end); 
            }  
            ?> 


            <!-- modal form edit Card -->
            <div class="modal fade" id="edit<?php echo $objResult['Record'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูการจ่ายเอทานอล</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่เริ่มจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="date" name="customer_name" class="form-control" required  placeholder=""  value="<?php echo $value_date_start ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลาเริ่มจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="เวลา"  value="<?php echo $show_time_start ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่จ่ายเสร็จ :</strong></label>
                      <div class="col-sm-12">
                        <input type="date" name="country" class="form-control" required  placeholder="ทะเบียนรถ"  value="<?php echo $value_date_end ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลาจ่ายเสร็จ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="เวลา"  value="<?php echo $show_time_end ?>">
                      </div>

                    </div>

                    <div class="form-group col-md-12">
                                          <hr>
                      <div class="col-sm-12">
                        <h5>Batch Controller</h5>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>หมายเลขบัตร :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="หมายเลขบัตร"  value="<?php echo $Card_number ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>บริษัทลูกค้า :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="บริษัทลูกค้า"  value="<?php echo $Company ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณที่ขออนุญาติจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['Preset'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์ก่อนจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['StartTotal'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์หลังจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['StopTotal'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณที่จ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['GV'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณสารแปลงสภาพ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['AddGV'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>อุณหภูมิ (C) :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['AvrTemp'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>จำนวนครั้งที่จ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['BatchCount'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder=""  value="">
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
            <!-- end modal form  add Card-->  
            <tr>
              <th scope="row"><a href="view_info_payment.php?Record=<?php echo $objResult['Record'] ?>"><?php echo $objResult['Record'] ?></a></th>
              <td>
                <dl class="row">
                  <dt class="col-sm-3"><i class="fa fa-calendar"></i> วันที่</dt>
                  <dd class="col-sm-9"><?php echo $show_date_start,' - ',$show_date_end ?></dd>

                  <dt class="col-sm-3"><i class="fa fa-clock"></i> เวลา</dt>
                  <dd class="col-sm-9"><?php echo $show_time_start,' - ',$show_time_end,' น.' ?></dd>
                </td>
                <td><?php echo $objResult['Company'] ?></td>
                <td><?php echo $objResult['Car'] ?></td>
                <td><?php echo $objResult['StopTotal'] ?></td>
                <td><?php echo $objResult['GV'] ?></td>
                <td width="150">
                  <a  href='#edit<?php echo $objResult['Record'] ?>'  role='button' data-toggle='modal'><button class="btn btn-warning"><i class="fa fa-edit" title="edit"></i></button></a>
                  <a  href='#remove<?php echo $objResult['Card'] ?>'  role='button' data-toggle='modal'><button class="btn btn-danger"><i class="fa fa-trash" title="delete"></i></button></a>
                  <p></p>
                  <small><i class="fa fa-clock" aria-hidden="true"></i> 00-00-0000 </p></small>
                </td>
              </tr>
              <?php
              $i++;
            }
            ?>
          </table>
          <p><b>Total : <?php echo $total; ?> Record</b></p>
          <?php
          if ($Prev_Page) {
            echo " <a href ='$_SERVER[SCRIPT_NAME]?Action=view_job&sort=$strSort&order=$strOrder&Page=$Prev_Page'><button class='btn btn-default'><b><</b></button></a> ";
          }

          for($i=1; $i<=$Num_Pages; $i++){
            if($i >= $Page-2 && $i <= $Page +2&&  $i != $Page)
            {
              echo " <a href ='$_SERVER[SCRIPT_NAME]?Action=view_job&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
            }else if ($i == $Page)
            {
              echo "<button class='btn btn-primary'>$i</button>";
            }
            else if ($i == $Num_Pages || $i == $Num_Pages -1)
            {
              echo " <a href ='$_SERVER[SCRIPT_NAME]?Action=view_job&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
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
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่เริ่มจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="date" name="customer_name" class="form-control" required  placeholder=""  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลาเริ่มจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="เวลา"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>วันที่จ่ายเสร็จ :</strong></label>
                      <div class="col-sm-12">
                        <input type="date" name="country" class="form-control" required  placeholder="ทะเบียนรถ"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>เวลาจ่ายเสร็จ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="เวลา"  value="">
                      </div>

                    </div>

                    <div class="form-group col-md-12">
                                          <hr>
                      <div class="col-sm-12">
                        <h5>Batch Controller</h5>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>หมายเลขบัตร :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="หมายเลขบัตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>บริษัทลูกค้า :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="บริษัทลูกค้า"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณที่ขออนุญาติจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์ก่อนจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์หลังจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณที่จ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>ปริมาณสารแปลงสภาพ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>อุณหภูมิ (C) :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder=""  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>จำนวนครั้งที่จ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword3" class="col-sm-12 control-label"><strong>มิเตอร์ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="จำนวนลิตร"  value="">
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