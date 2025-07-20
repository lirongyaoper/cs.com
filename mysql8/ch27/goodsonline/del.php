<?php

        session_start(); 
        include("conn.php");
		$cid=$_GET['id'];
		$sql = "DELETE FROM `caidan` WHERE cid = '$cid'";
		$result = mysqli_query($con,$sql);
        $rows = mysqli_affected_rows($con);
        if($rows >=1){
            alert("删除成功");
        }else{
            alert("删除失败");
        }
        // 跳转到主页
        href("menu.php");
        function alert($title){
            echo "<script type='text/javascript'>alert('$title');</script>";
        }
        function href($url){
            echo "<script type='text/javascript'>window.location.href='$url'</script>";
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="include/main.css" media="screen" />
<title>网上商城</title>
</head>
<h1 align="center">网上商城</h1>
<div id="contain">
  <div align="center">

  </div>
<body>
</body>
</html>
