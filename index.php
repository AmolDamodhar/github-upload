<?php
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);
	$connect = mysqli_connect("localhost", "root", "", "employee_file1");
 
	if(isset($_POST["submit"])){
		if($_FILES['file']['name'])
		{
			$filename = explode('.',$_FILES['file']['name']);
			if($filename[1]=='csv')
			{
				$handle = fopen($_FILES['file']['tmp_name'],"r");
				while($data = fgetcsv($handle))
				{
					$item1=mysqli_real_escape_string($connect, $data[0]);
					$item2=mysqli_real_escape_string($connect, $data[1]);
					$item3=mysqli_real_escape_string($connect, $data[2]);
					$item4=mysqli_real_escape_string($connect, $data[3]);
					$item5=mysqli_real_escape_string($connect, $data[4]);
					$item6=mysqli_real_escape_string($connect, $data[5]);
					$sql="INSERT INTO `employee`(`id`, `fname`, `lname`, `dob`, `manger_id`, `dat_of_joining`) VALUES ('$item1','$item2','$item3','$item4','$item5','$item6)";
				
					mysqli_query($connect, $sql);
				}	
				fclose($handle);
 
				print "Import done";
				$sql = "SELECT id,fname,lname,dob,manager_id,date_of_joining FROM employee";
				$result = mysqli_query($connect,$sql);
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_array($result)) {
				echo "id:" . $row["id"]. "<br>". $row["fname"]. $row["lname"]. $row["dob"].$row["manger_id"]. $row["dat_of_joining"];
			}
			} else {
					echo "0 results";
				}
		}
	}
}
?>
 
<!DOCTYPE html>
<html>
	<head>
		<title>Update Mysql Database through Upload CSV File using PHP</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<br />
		<div class="container">
		<h2 align="center">Update Mysql Database through Upload CSV File using PHP</a></h2>
	<br />
	<form method="post" enctype="multipart/form-data">
		<p><label>Please Select File(Only CSV Formate)</label>
		<input type="file" name="emp.csv" /></p>
		<br />
		<input type="submit" name="upload" class="btn btn-info" value="upload" />
	</form>
		<br />
 
	<h3 align="center">Employee Database</h3>
	<br />
	<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Age</th>
			<th>Manager Name</th>
		</tr>
	</body>
</html>