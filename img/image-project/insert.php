<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>

	<form method="post" action="" enctype="multipart/form-data">
		Name : <input type="text" name="name"> <br><br>
		<input type="file" name="file"> <br><br>
		<input type="submit" name="btn" value="upload">
	</form>



</body>

</html>
<?php
include("config.php");
if (isset($_POST['btn'])) {

	$name = $_POST['name'];
	$file = $_FILES['file'];
	//print_r($file);
	$fname = $file['name'];
	$ftemp = $file['tmp_name'];
	//print_r($fname);
	$filext = explode('.', $fname);
	$filecheck = strtolower(end($filext));
	$fileextstored = array('png', 'jpg', 'jpeg');
	if (in_array($filecheck, $fileextstored)) {
		$destfile = 'upload/' . $fname;
		move_uploaded_file($ftemp, $destfile);
		$sql = "INSERT INTO images(name, image) VALUES('$name', '$destfile')";
		if ($conn->query($sql) === TRUE) {
			echo "inserted";
		} else {

			echo "Error" . $conn->error;
		}
	} else {


		echo " select image";
	}



	$display =  "SELECT * FROM images";
	$result = $conn->query($display);
	if ($result->num_rows > 0) {
		echo "<table border = '1' align = 'center'>
	<tr>
	<td> ID </td>
	<td> Name </td>
	<td> Image </td>
	</tr>";

		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td><img src=" . $row['image'] . "></td>";

			echo "</tr>";
		}
		echo "</table>";
	}
}



?>