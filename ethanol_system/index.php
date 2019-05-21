<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ethanal Loading</title>

  <style type="text/css">
    .bgimg {
      background-image: url('../image_system/bg.jpg');

      width: 1320px;
      height: 800px;
      margin: auto;
    }

    .main {
      position: relative;
      bottom: 0px;
      top: -20px;
      left: 0px;
      right: 0px;
    }

    .car {
      position: absolute;
      bottom: 0px;
      top: 190px;
      left: 1043px;
      right: 0px;
      width: 260px;

    }

    .armup {
      position: absolute;
      bottom: 0px;
      top: 50px;
      left: 896px;
      right: 0px;
      width: 220px;

    }

    .armdown {
      position: absolute;
      bottom: 0px;
      top: 44px;
      left: 896px;
      right: 0px;
      width: 220px;

    }

    .mov-1 {
      position: absolute;
      bottom: 0px;
      top: 232px;
      left: 410px;
      right: 0px;
      width: 40px;

    }

    .mov-2 {
      position: absolute;
      bottom: 0px;
      top: 458px;
      left: 410px;
      right: 0px;
      width: 40px;

    }

    .controll-1 {
      position: absolute;
      bottom: 0px;
      top: 180px;
      left: 740px;
      right: 0px;
      width: 50px;

    }

    .controll-2 {
      position: absolute;
      bottom: 0px;
      top: 410px;
      left: 740px;
      right: 0px;
      width: 50px;

    }

    .box1 {
      position: absolute;
      bottom: -100px;
      top: 510px;
      left: 140px;
      width: 150px;
      height: 60px;
      border: 3px solid beige;
      border-radius: 10px;
      background-color: bisque;
    }


    .box2 {
      position: absolute;
      bottom: -100px;
      top: 325px;
      left: 360px;
      width: 350px;
      height: 100px;
      border: 3px solid beige;
      border-radius: 10px;
      background-color: bisque;
    }

    .box3 {
      position: absolute;
      bottom: -100px;
      top: 560px;
      left: 360px;
      width: 350px;
      height: 100px;
      border: 3px solid beige;
      border-radius: 10px;
      background-color: bisque;
    }
    .box4 {
      position: absolute;
      bottom: -100px;
      top: 320px;
      left: 1020px;
      width: 280px;
      height: 170px;
      border: 3px solid beige;
      border-radius: 10px;
      background-color: bisque;
    }

    .tex-data {
      font-size: 11px;
      padding-top: 10px;
      padding-left: 20px;
    }

    .span {
      width: 40px;
    }
  </style>

  <script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  }

		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

			var url = 'getdata_ethanol_system.php';
			var pmeters = 'mySort='+Sort;
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);


			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }

			}

	   }
	</script>
</head>

<body Onload="bodyOnload();">
  <?php include '../menu.php';?>

  <div class="container-fluid">
    <p></p>
    <form name="frmMain" action="" method="post">
    <script language="JavaScript">

function bodyOnload()
{
  doCallAjax('CustomerID')
  setTimeout("doLoop();",2000);
}

function doLoop()
{
  bodyOnload();
}
</script>
<span id="mySpan"></span>


    <!-- js & Jquery -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>

</body>

</html>