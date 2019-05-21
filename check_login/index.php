<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<!--Made with love by Mutiullah Samim -->

  <!--Bootsrap 4 CDN
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
-->
<link href="./css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!--Custom Css -->
<link href="./css/custom_login.css" rel="stylesheet" id="bootstrap-css">
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>

<?php
	session_start();
	include("../connect_db/connect.php");
	$password = md5(mysql_real_escape_string($_POST['txtPassword']));
	$strSQL = "SELECT * FROM user_login WHERE user = '".mysql_real_escape_string($_POST['txtUsername'])."' and password = '".$password."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{

			echo "<script>alert('!User & password ของคุณไม่ถูกต้อง' );history.back();</script>"; exit();
	}else{

			echo $_SESSION["id_user"] = $objResult["id_user"];
			$_SESSION["name_lastname"] = $objResult["name_lastname"];
			$_SESSION["user"] = $objResult["user"];
			$_SESSION["group_allow"] = $objResult["group_allow"];

			session_write_close();
		

		if($objResult["group_allow"]=="0"){
			echo "<script>alert('!User & password ของคุณไม่มีสิทธิการเข้าถึงข้อมูล' );history.back();</script>"; exit();
		}else if($objResult["group_allow"]>="1"){
			header("Location: ../home ");
		}
	}


?>

</body>
</html>

