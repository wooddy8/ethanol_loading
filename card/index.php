<body>
  <?php include('../menu.php'); ?>

  <!--Query Show Database Table Card  -->
  <?php 
  $strSQL = "SELECT *  FROM card ";

  if($_GET["search"] != '')
  {
    $strSQL .= " where CardID LIKE '%".$_GET['search']."%'    ";

  }else{

    $strSQL .= " where CardID ";
  }
  $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
  $Num_Rows = mysql_num_rows($objQuery);
  $total = mysql_num_rows($objQuery);

  $Per_Page = 50;   

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

  $strSQL_job .=" order  by CardID ASC LIMIT $Page_Start , $Per_Page";
  $objQuery_job  = mysql_query($strSQL_job);
  $strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
  ?> 

  <div class="container-fluid">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-credit-card" aria-hidden="true"></i> ข้อมูลบัตรเติมเอทานอล
        <?php if ($_SESSION['group_allow'] == 3 or $_SESSION['group_allow'] == 4 or $_SESSION['group_allow'] == 5) {

          ?>
          <button class="btn btn-light" style="float: right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
          <?php
        }
        ?>
      </h5>
      <div class="card-body">
        <h4>ค้นหาข้อมูล  </h4>

        <form class="classNameHere" method="GET" action="">
          <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 red-border" type="text" placeholder="ค้นหาหมายเลขบัตร" aria-label="Search" name="search">
            <div class="input-group-append">
              <button class="btn-circle" type="submit" name="submit" value="ค้นหา"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
          </div>
        </div>
      </form>


      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">หมายเลขบัตร</th>
            <th scope="col">บริษัท</th>
            <th scope="col">ทะเบียนรถ</th>
            <th scope="col">ปริมาณที่เติม (ลิตร)</th>
            <th scope="col">หัวจ่าย</th>
            <th scope="col">สารแปลงสภาพ</th>
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

          <!-- modal form edit Card -->
          <div class="modal fade" id="edit<?php echo $objResult['Card'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลบัตร</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="?card=<?php echo $objResult["card"] ?>" method="post" enctype="multipart/form-data" class="form-horizontal" name="form1" id="form1">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>หมายเลขบัตร :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="customer_name" class="form-control" required  placeholder="หมายเลขบัตร"  value="<?php echo $objResult['CardID'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>บริษัท :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="บริษัท"  value="<?php echo $objResult['Company'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>ทะเบียนรถ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="ทะเบียนรถ"  value="<?php echo $objResult['Car'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>ปริมาณที่เติม :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="country" class="form-control" required  placeholder="จำนวนลิตร"  value="<?php echo $objResult['Preset'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>หัวจ่าย :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="telephone" class="form-control" required  placeholder="หัวจ่าย"  value="<?php echo $objResult['REFNO'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-6 control-label"><strong>สารแปลงสภาพ :</strong></label>
                      <div class="col-sm-12">
                        <input type="text" name="fax" class="form-control" required  placeholder="สารแปลงสภาพ"  value="<?php echo $objResult['Batch'] ?>">
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
            <th scope="row" width="150"><?php echo $objResult['CardID'] ?></th>
            <td><?php echo $objResult['Company'] ?></td>
            <td><?php echo $objResult['Car'] ?></td>
            <td><?php echo $objResult['Preset'] ?></td>
            <td><?php echo $objResult['REFNO'] ?></td>
            <td><?php echo $objResult['Batch'] ?></td>
            <?php if ($_SESSION['group_allow'] == 3 or $_SESSION['group_allow'] == 4 or $_SESSION['group_allow'] == 5) {

              ?>
              <td width="150">
                <a  href='#edit<?php echo $objResult['Card'] ?>'  role='button' data-toggle='modal'><button class="btn btn-warning"><i class="fa fa-edit" title="edit"></i></button></a>
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
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลบัตร</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>หมายเลขบัตร :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="customer_name" class="form-control" required  placeholder="หมายเลขบัตร"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>บริษัท :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="country" class="form-control" required  placeholder="บริษัท"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>ทะเบียนรถ :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="country" class="form-control" required  placeholder="ทะเบียนรถ"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>ปริมาณที่เติม :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="country" class="form-control" required  placeholder="จำนวนลิตร"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>หัวจ่าย :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="telephone" class="form-control" required  placeholder="หัวจ่าย"  value="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label"><strong>สารแปลงสภาพ :</strong></label>
                <div class="col-sm-12">
                  <input type="text" name="fax" class="form-control" required  placeholder="สารแปลงสภาพ"  value="">
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
  </div>
</div>

</div>
<!-- js & Jquery --> 
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>

</body>
</html>