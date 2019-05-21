<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<body>
  <?php include('../menu.php'); ?>

  <!--Query Show Database Table Card  -->
  <?php 
  $strSQL_loading = "SELECT * FROM loading 
  LEFT JOIN card ON (loading.Card = card.Card) where Record = '".$_GET['Record']."' ";
  $objQuery_loading = mysql_query($strSQL_loading) or die ("Error Query [".$strSQL_card."]");
  $objResult_loading = mysql_fetch_array($objQuery_loading);

  ?>

  <!--Sort date start -->
  <?php
  if ($date_start = strtotime($objResult_loading['StartDate'])){
    $show_date_start =date('d/m/Y', $date_start); 
  }  
  ?> 

  <!--Sort time start -->
  <?php
  if ($time_start = strtotime($objResult_loading['StartTime'])){
    $show_time_start =date('H:i', $time_start); 
  }  
  ?> 

  <!--Sort date end -->
  <?php
  if ($date_end = strtotime($objResult_loading['StopDate'])){
    $show_date_end =date('d/m/Y', $date_end); 
  }  
  ?> 

  <!--Sort time end -->
  <?php
  if ($time_end = strtotime($objResult_loading['StopTime'])){
    $show_time_end =date('H:i', $time_end); 
  }  
  ?> 

  <div class="container">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-truck" aria-hidden="true"></i> รายละเอียดการจ่ายเอทานอล
      </h5>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ข้อมูลเวลาการจ่าย</h5><hr>
                <dl class="row">
                  <dt class="col-sm-4"><i class="fa fa-info-circle" aria-hidden="true"></i> หมายเลข</dt>
                  <dd class="col-sm-8"><?php echo $objResult_loading['Record']; ?></dd>

                  <dt class="col-sm-4"><i class="fa fa-calendar" aria-hidden="true"></i> วันที่เริ่มจ่าย</dt>
                  <dd class="col-sm-8"><?php echo $show_date_start ?></dd>

                  <dt class="col-sm-4"><i class="fa fa-clock" aria-hidden="true"></i> เวลาเริ่มจ่าย</dt>
                  <dd class="col-sm-8"><?php echo $show_time_start ?></dd>

                  <dt class="col-sm-4"><i class="fa fa-calendar" aria-hidden="true"></i> วันที่จ่ายเสร็จ</dt>
                  <dd class="col-sm-8"><?php echo $show_date_end ?></dd>

                  <dt class="col-sm-4"><i class="fa fa-clock" aria-hidden="true"></i> เวลาจ่ายเสร็จ</dt>
                  <dd class="col-sm-8"><?php echo $show_time_end ?></dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ข้อมูล Batch Controller</h5><hr>
                <dl class="row">
                  <dt class="col-sm-6"><i class="fa fa-credit-card" aria-hidden="true"></i> หมายเลขบัตร</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['CardID'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-building" aria-hidden="true"></i> บริษัท ลูกค้า</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['Company'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-car" aria-hidden="true"></i> ทะเบียนรถ</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['Car'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> ปริมาณที่ขออนุญาติจ่าย</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['Preset'] ?> ลิตร</dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> มิเตอร์ก่อนจ่าย</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['StartTotal'] ?> ลิตร</dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> มิเตอร์หลังจ่าย</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['StopTotal'] ?> ลิตร</dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> ปริมาณที่จ่าย</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['GV'] ?> ลิตร</dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> ปริมาณสารแปลงสภาพ</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['AddGV'] ?> ลิตร
                  </dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> อุณหภูมิ</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['AvrTemp'] ?> °C</dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> จำนวนครั้งที่จ่าย</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['BatchCount'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> สารแปลงสภาพ</dt>
                  <dd class="col-sm-6">                    
                    <?php if($objResult_loading['Flag'] == "Y"){
                    echo "เติม";
                  }elseif ($objResult_loading['Flag'] == "N") {
                    echo "ไม่เติม";
                  } 
                  ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> Customer ID</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['CUSTID'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> Reference No.</dt>
                  <dd class="col-sm-6"><?php echo $objResult_loading['REFNO'] ?></dd>

                  <dt class="col-sm-6"><i class="fa fa-circle" aria-hidden="true"></i> มิเตอร์</dt>
                  <dd class="col-sm-6"></dd>

                </dl>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
  <!-- js & Jquery --> 
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

</body>
</html>