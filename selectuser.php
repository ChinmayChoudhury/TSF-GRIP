<?php
session_start();
require 'db.php';

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/seluser.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Muli:wght@300&display=swap" rel="stylesheet">
	<title>Select Account</title>
</head>
<body>
	<?php require 'nav.php';?>
	<div class="main">	
		<span id="maintit">Select a customer</span>
		<?php
			if(isset($_SESSION['error'])){
				echo "<p style='color:red'>".$_SESSION['error']."</p>";
				unset($_SESSION['error']);				
			}
		?>
	</div>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Balance</th>
					<th>Action</th>
				</tr>
			</thead>
		
		<?php
			$stmt = $pdo->prepare("SELECT * FROM customers");
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row['id']."</td>"."<td>".$row['name']."</td>"
				."<td>".$row['email']."</td>"."<td>".$row['currbal']."</td>"."<td>"."<a href='/transfer.php?sid=".$row['id']."'>Select user</a>"."</td>";
				echo "</tr>";
			}
			?>
			</table>
	</div>

	<?php require 'foot.php';?>
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	// $("#sel").css({"border-bottom": "3px solid #ffd56b"});
    	document.getElementById("sel").style.borderBottom = '3px solid #ffd56b' ;
    </script>
</body>
</html>