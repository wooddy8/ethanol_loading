<body>
  <?php include('../menu.php');

  date_default_timezone_set("Asia/Bangkok");

  ?>


  <!--Insert Data user_login -->
  <?php if ($_POST['submit']) {

    $user = $_POST['user'];
    $password = md5($_POST['password']);
    $name_lastname = $_POST['name_lastname'];
    $group_allow = $_POST['group_allow'];
    $user_record = '0';
    $datetime_stamp_record = date('Y-m-d H:i:s');

    $strSQL = "INSERT INTO user_login (user,password,name_lastname,group_allow,user_record,datetime_stamp_record) VALUES ('$user','$password','$name_lastname','$group_allow','$user_record','$datetime_stamp_record')";
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

  <!-- Edit Date user_login -->
  <?php 
  if($_POST['edit_submit'])
  {


   $id_user= $_POST['id_user'];


   $strSQL = "UPDATE user_login SET ";
   $strSQL .="user = '".$_POST['user']."' ";
   $strSQL .=",password = '".md5($_POST['password'])."' ";
   $strSQL .=",name_lastname = '".$_POST["name_lastname"]."' ";
   $strSQL .=",group_allow = '".$_POST["group_allow"]."' ";
   $strSQL .=",user_record = '0' ";
   $strSQL .=",datetime_stamp_record = '".date('Y-m-d H:i:s')."' ";
   $strSQL .=" WHERE id_user = '".$id_user."' ";
   $objQuery = mysql_query($strSQL)or die(mysql_error());

   if($objQuery)
   {
    $msg = '<div class="alert alert-success">
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

<!--Query Show Database Table user_login  -->
<?php 
$strSQL = "SELECT *  FROM user_login ";

if($_GET["search"] != '')
{
  $check_date = str_replace("-" ,"", $_GET['search']);
  $strSQL .= " where name_lastname LIKE '%".$check_date."%'    ";

}else{

  $strSQL .= " where id_user ";
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
  $strSQL.=" order by name_lastname DESC LIMIT $Page_Start , $Per_Page";
  $objQuery  = mysql_query($strSQL);
  $strNewOrder = $strOrder == 'ASC' ? 'DESC' : 'ASC';
  ?> 

  <div class="container">
    <p></p>
    <div class="card">

      <h5 class="card-header bg-primary text-white"><i class="fa fa-users" aria-hidden="true"></i> ข้อมูลผู้ใช้งาน
        <button class="btn btn-light" style="float: right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
      </h5>
      <div class="card-body">
        <h4>ค้นหาข้อมูล  </h4>
        
        <form class=""  method="GET" action="">
          <div class="input-group md-form form-sm form-2 pl-0">
            <input class="form-control my-0 py-1 red-border" type="text" placeholder="ชื่อผู้ใช้งาน" aria-label="Search" name="search">
            <div class="input-group-append">
              <button class="btn-circle" type="submit" name="submit" value="ค้นหา"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
        
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ชื่อ - นามสกุล</th>
              <th scope="col" width="150">User</th>
              <!--
              <th scope="col">Password</th>
            -->
            <th scope="col">Group</th>
            <th scope="col">Authorize</th>
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
          <div class="modal fade" id="edit<?php echo $objResult['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้งาน</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
                    <div class="row">
                      <!-- GET Id_user -->
                      <input type="hidden" name="id_user" value="<?php echo $objResult['id_user'] ?>">
                      <div class="form-group col-md-12">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>ชื่อ - นามสกุล :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="name_lastname" class="form-control" required  placeholder="ระบุชื่อ - นามสกุล"  value="<?php echo $objResult['name_lastname'] ?>">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>User :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="user" class="form-control" required  placeholder="user"  value="<?php echo $objResult['user'] ?>">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>Password :</strong></label>
                        <div class="col-sm-12">
                          <input type="text" name="password" class="form-control" required  placeholder="password"  value="<?php echo $objResult['password'] ?>">
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="inputPassword3" class="col-sm-12 control-label"><strong>กลุ่มสิทธิใช้งาน :</strong></label>
                        <div class="col-sm-12">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio1" value="0" <?php if($objResult['group_allow']=="0"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio1">ไม่มีสิทธิใช้งาน</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio1" value="1" <?php if($objResult['group_allow']=="1"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio1">Operate</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="2" <?php if($objResult['group_allow']=="2"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio2">สรรพามิตร</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="3" <?php if($objResult['group_allow']=="3"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio2">บัญชี</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="4" <?php if($objResult['group_allow']=="4"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio2">การตลาด</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="5" <?php if($objResult['group_allow']=="5"){ echo "checked=checked";}  ?>>
                            <label class="form-check-label" for="inlineRadio2">Admin</label>
                          </div>
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
            <td width="300"><?php echo $objResult['name_lastname'] ?></td>
            <td width="300"><?php echo $objResult['user'] ?></td>
                <!--
                <td width="50"><?php echo $objResult['password'] ?></td>
              -->
              <td width="250">
                <?php if ($objResult['group_allow'] == 0){
                  echo "ไม่มีสิทธิใช้งาน";
                  $Authorize = "ไม่มีสิทธิใช้งาน";
                }elseif ($objResult['group_allow'] == 1){
                  echo "Operate";
                  $Authorize = '
                  <span class="badge badge-primary">view</span> 
                  ';
                }elseif ($objResult['group_allow'] == 2){
                  echo "เจ้าหน้าที่สรรพสามิตร";
                  $Authorize = '
                  <span class="badge badge-primary">view</span> 
                  ';
                }elseif ($objResult['group_allow'] == 3){
                  echo "เจ้าหน้าที่บัญชี";
                  $Authorize = '
                  <span class="badge badge-primary">view</span> 
                  <span class="badge badge-warning">edit</span>
                  <span class="badge badge-danger">remove</span>
                  ';
                }elseif ($objResult['group_allow'] == 4){
                  echo "เจ้าหน้าที่การตลาด";
                  $Authorize = '
                  <span class="badge badge-primary">view</span> 
                  <span class="badge badge-warning">edit</span>
                  <span class="badge badge-danger">remove</span>
                  ';
                }elseif ($objResult['group_allow'] == 5){
                  echo "Admin";
                  $Authorize = '<span class="badge badge-secondary">menagement</span>';
                }

                ?>
              </td>
              <td width="250">
                <?php echo $Authorize ?>
              </td>
              <td width="150">
                <a  href='#edit<?php echo $objResult['id_user'] ?>'  role='button' data-toggle='modal'><button class="btn btn-warning"><i class="fa fa-edit" title="edit"></i></button></a>
                <a  href='#remove<?php echo $objResult['Card'] ?>'  role='button' data-toggle='modal'><button class="btn btn-danger"><i class="fa fa-trash" title="delete"></i></button></a>
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
          echo " <a href ='$_SERVER[SCRIPT_NAME]?user_login=".$_GET['user_login']."&sort=$strSort&order=$strOrder&Page=$Prev_Page'><button class='btn btn-default'><b><</b></button></a> ";
        }

        for($i=1; $i<=$Num_Pages; $i++){
          if($i >= $Page-2 && $i <= $Page +2&&  $i != $Page)
          {
            echo " <a href ='$_SERVER[SCRIPT_NAME]?user_login=".$_GET['user_login']."&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
          }else if ($i == $Page)
          {
            echo "<button class='btn btn-primary'>$i</button>";
          }
          else if ($i == $Num_Pages || $i == $Num_Pages -1)
          {
            echo " <a href ='$_SERVER[SCRIPT_NAME]?user_login=".$_GET['user_login']."&sort=$strSort&order=$strOrder&Page=$i'><button class='btn btn-default'>$i</button></a> ";
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
              <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ใช้งาน</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="form-horizontal">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="inputPassword3" class="col-sm-12 control-label"><strong>ชื่อ - นามสกุล :</strong></label>
                    <div class="col-sm-12">
                      <input type="text" name="name_lastname" class="form-control" required  placeholder="ระบุชื่อ - นามสกุล"  value="">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword3" class="col-sm-12 control-label"><strong>User :</strong></label>
                    <div class="col-sm-12">
                      <input type="text" name="user" class="form-control" required  placeholder="user"  value="">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword3" class="col-sm-12 control-label"><strong>Password :</strong></label>
                    <div class="col-sm-12">
                      <input type="password" name="password" class="form-control" required  placeholder="password"  value="">
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputPassword3" class="col-sm-12 control-label"><strong>กลุ่มสิทธิใช้งาน :</strong></label>
                    <div class="col-sm-12">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio1" value="0">
                        <label class="form-check-label" for="inlineRadio1">ไม่มีสิทธิใช้งาน</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Operate</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">สรรพามิตร</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="3">
                        <label class="form-check-label" for="inlineRadio2">บัญชี</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="4">
                        <label class="form-check-label" for="inlineRadio2">การตลาด</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="group_allow" id="inlineRadio2" value="5">
                        <label class="form-check-label" for="inlineRadio2">Admin</label>
                      </div>
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