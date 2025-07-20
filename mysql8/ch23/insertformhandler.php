<html>
<head>
   <title>User adding</title>
</head>
<body>
   <h2>adding new user.</h2>
<?php
    $username = $_POST['username'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$info = $_POST['info'];
	if(!$username and !$gender and !$age and !$info){
	    echo "Error: There is no data passed.";
		exit;
	}
    if(!$username or !$gender or !$age or !$info){
	    echo "Error: Some data did not be passed.";
		exit;
	}
	if(!get_magic_quotes_gpc()){
	    $username = addslashes($username);
		$gender = addslashes($gender);
		$age = addslashes($age);
		$info = addslashes($info);
	}
		@ $db = mysqli_connect('localhost','root','753951');
		mysqli_select_db($db,'adatabase');
		if(mysqli_connect_errno()){
	 	 echo "Error: Could not connect to mysql database.";
	 	 exit;
		}
		$q = "INSERT INTO user( name, age, gender, info) VALUES ('$username',$age,'$gender', '$info')";
		if( !mysqli_query($db,$q)){
		   echo "no new user has been added to database.";
		}else{
		   echo "New user has been added to database.";
		};
		mysqli_close($db);
?>
</body>
</html>
