<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<head>
<title>
</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body><h1 align="center">网上商城</h1></body>
<p align="center">
<?php
//连接数据库
require_once("conn.php");
//账号
$userid=$_POST['userid'];
//密码
$pssw=$_POST['pssw'];
//查询数据库
$qry=mysqli_query($con,"SELECT * FROM admin WHERE user='$userid'");
$row=mysqli_fetch_array($qry,MYSQLI_ASSOC);
//验证用户
if($userid==$row['user'] && $pssw==$row['pwd']&&$userid!=null&&$pssw!=null)
    {	
		session_start();
		$_SESSION["login"] =$userid;
        header("Location: menu.php");
    }
else{
		echo "无效的账号或密码!";
		header('refresh:1; url= index.php');
	}
//}
?>
</p>
</body>
</html>
