<?php
// 创建数据库连接
		$con = mysqli_connect("localhost", "root", "")or die("无法连接到数据库");
		mysqli_select_db($con,"goods") or die(mysqli_error($con));
        mysqli_query($con,'set NAMES utf8');
?>