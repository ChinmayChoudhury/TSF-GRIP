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
	<title>Transfer History</title>
</head>
<body>
	<?php require 'nav.php';?>
	<div class="main">	
		<span id="maintit">Transfers</span>
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
					<th>Trans Id</th>
					<th>Sender</th>
					<th>Reciever</th>
					<th>Amount transfered</th>
					<th>Date</th>
				</tr>
			</thead>
		
		<?php
			$sql = "select t1.trans_id, t1.amnt, t1.name as sender, t2.name as reciever,t1.tr_dt as dt from (select * FROM transfers,customers WHERE customers.id=transfers.sender) as t1, (SELECT * from transfers, customers WHERE customers.id = transfers.reciever) as t2 where t1.trans_id = t2.trans_id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			// print_r($stmt->fetch(PDO::FETCH_ASSOC));
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row['trans_id']."</td>"."<td>".$row['sender']."</td>"
				."<td>".$row['reciever']."</td>"."<td>".$row['amnt']."</td>"."<td>".$row['dt']."</td>";
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
    	document.getElementById("his").style.borderBottom = '3px solid #ffd56b' ;
    </script>
</body>
</html>