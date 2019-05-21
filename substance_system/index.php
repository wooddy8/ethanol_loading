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
      top: 20px;
      left: 0px;
      right: 0px;
    }


    .P1 {
      position: absolute;
      bottom: 0px;
      top: 169px;
      left: 750px;
      right: 0px;
      width: 40px;

    }

    .P2 {
      position: absolute;
      bottom: 0px;
      top: 250px;
      left: 750px;
      right: 0px;
      width: 40px;

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

			var url = 'getdata_substance_system.php';
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