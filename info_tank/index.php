<body>
  <?php include('../menu.php'); ?>

  <!--Query Show Database Table Card  -->
  <?php 
  $strSQL = "SELECT *  FROM Tank ";

  if($_GET["search"] != '')
  {
    $check_date = str_replace("-" ,"", $_GET['search']);
    $strSQL .= " where StartDate LIKE '%".$check_date."%'    ";

  }else{

    $strSQL .= "where date ";
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
  $strSQL.=" group by Tank LIMIT $Page_Start , $Per_Page";
  $objQuery  = mysql_query($strSQL);
  $strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
  ?> 

  <div class="container">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-database" aria-hidden="true"></i> ข้อมูลเอทานอล
        ในถังเก็บ
      </h5>
      <div class="card-body">   
        <div class="row">
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
            <div class="col-md-3">
              <div class="card text-center">
                <div class="card-header">
                  <h4 class="card-title"><?php echo $objResult['Tank']  ?></h4>
                </div>
                <div class="card-body">
                 <img src="../image/icon/07-info-tank.png" width="100px">
                  
                </div>
                <div class="card-footer text-muted">
                  <a href="view_info_tank.php?tank=<?php echo $objResult['Tank'] ?>" class="btn btn-primary">ดูข้อมูล</a>
                </div>
              </div>
              <p></p>
            </div>

            <?php 
          }
          ?>
        </div>
      </div>
    </div>
<p></p>
  </div>
  <!-- js & Jquery --> 
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

</body>
</html>