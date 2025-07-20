<html>
<head>
   <title>User found</title>
</head>
<body>
   <h2>User found from mysql database.</h2>
<?php
	$gender = $_POST['gender'];
	if(!$gender){
	    echo "Error: There is no data passed.";
		exit;
	}
	if(!get_magic_quotes_gpc()){
		$gender = addslashes($gender);
	}
		@ $db = mysqli_connect('localhost','root','753951');
		mysqli_select_db($db,'adatabase');
		if(mysqli_connect_errno()){
	 	 echo "Error: Could not connect to mysql database.";
	 	 exit;
		}
		$q = "SELECT * FROM user WHERE gender = '".$gender."'";
		$result = mysqli_query($db,$q);
		$rownum = mysqli_num_rows($result);
		for($i=0; $i<$rownum; $i++){
		   $row = mysqli_fetch_assoc($result);
		   echo "Id:".$row['id']."<br />";
		   echo "Name:".$row['name']."<br />";
		   echo "Age:".$row['age']."<br />";
		   echo "Gender:".$row['gender']."<br />";
		   echo "Info:".$row['info']."<br />";
		}
		mysqli_free_result($result);
		mysqli_close($db);
?>
</body>
</html>
