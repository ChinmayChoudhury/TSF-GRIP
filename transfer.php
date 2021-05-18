<?php
session_start();
require 'db.php';
if(isset($_GET['sid'])){
	$_SESSION['sid'] = $_GET['sid'];    //sender's id saved in session to be used again
}
if(!isset($_SESSION['sid']) || strlen($_SESSION['sid'])<1){
	$_SESSION['error'] = "Please select a valid user before initialising a transfer.";
	header("Location: selectuser.php"); return;
}
if(isset($_POST['exit'])){
	header("Location: selectuser.php"); return;
}
if(isset($_POST['submit'])){
	// print_r($_POST);
	$rid = $_POST['reciever'];    	//reciever's id
	$amnt = $_POST['amnt'];			//amount to transfer
	//check if reciever is valid, reciever id should be number greater than 0
	if(!is_numeric($rid) || $rid<1){
		$_SESSION['error'] = "Invalid reciever";
		header("Location: transfer.php?sid=".$_SESSION['sid']); return;
	}


	//check if amount is valid, amount should be a number greater than 0
	if(!is_numeric($amnt) || $amnt<1){
		$_SESSION['error'] = "Invalid amount, only number >0 is allowed.";
		header("Location: transfer.php?sid=".$_SESSION['sid']); return;	
	}
	$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :idvar");
	$stmt->execute(array(":idvar"=>$_GET['sid']));
	$urow = $stmt->fetch(PDO::FETCH_ASSOC);
	//check if current balance is greater than amount to transfer
	if($urow['currbal']<$amnt){
		$_SESSION['error'] = "Amount exceeds current balance.";
		header("Location: transfer.php?sid=".$_SESSION['sid']); return;
	}
	//update sender's balance
	$newbal = $urow['currbal'] - $amnt;
	$updstmt = $pdo->prepare("UPDATE customers SET currbal=:newbalvar WHERE id=:idvar");
	$updstmt->execute(array(":newbalvar"=>$newbal,":idvar"=>$_SESSION['sid']));

	//update reciever's balance
	$updstmt = $pdo->prepare("UPDATE customers SET currbal=currbal+:amntvar WHERE id=:idvar");
	$updstmt->execute(array(":amntvar"=>$amnt,":idvar"=>$rid));

	//insert log into transfer table
	$trnstmt = $pdo->prepare("INSERT INTO `transfers`( `sender`, `reciever`, `tr_dt`, `amnt`) VALUES (:sendervar, :recievervar, NOW(),:amntvar)");
	$trnstmt->execute(
		array(
			":sendervar"=>$_SESSION['sid'],
			":recievervar"=>$rid,
			":amntvar"=>$amnt
		)
	);
	//show a success message
	$_SESSION['success'] = "Money transfered successfully!";
	header("Location: transfer.php"); return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/transfer.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Muli:wght@300&display=swap" rel="stylesheet">
	<title>Transfer</title>
</head>
<body>
	<?php require_once 'nav.php';?>
	<div class="main">	
		<span id="maintit">Transfer Money</span>
		<?php
			if(isset($_SESSION['error'])){
				echo "<p style='color:red'>".$_SESSION['error']."</p>";
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
				echo "<p style='color:green'>".$_SESSION['success']."</p>";
				unset($_SESSION['success']);
			}
		?>
		<div class="row mt-5">
			<div class="col-lg-5 m-auto text-center p-4" id="conbox">
				<span class="divtit">Current User</span>
				<?php
					$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :idvar");
					$stmt->execute(array(":idvar"=>$_SESSION['sid']));
					$urow1 = $stmt->fetch(PDO::FETCH_ASSOC);
				?>
				<p>
					<b>User: </b><?=$urow1['name']?>&nbsp;&nbsp;&nbsp;
					<b>Email: </b><?=$urow1['email']?>&nbsp;&nbsp;&nbsp;
					<b>Current Balance: </b><?=$urow1['currbal']?>
				</p>
				<p class="desc text-center">Select the customer you want to send money to and provide the amount to transfer</p>
				<span class="divtit">Transfer Details</span>
				<form id="tranform" class="form-group mx-4" method="post">
						<label for="amnt">Amount</label>
						<input type="text" name="amnt" style="border-radius:25px;" id="amnt" class="form-control">
						<br>
						<label for="selectt">Select user:</label>

						<select style="border-radius:25px;" class="form-control" id="selectt" name="reciever">
							<option value="0">--SELECT A CUSTOMER--</option>
							<?php
								$stmt2 = $pdo->prepare("SELECT id,name FROM customers");
								$stmt2->execute();
								while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
									if($row['id']==$urow['id']){
										continue;
									}
									echo "<option value='".$row['id']."'>".$row['name']."</option>";
								}
							?>
						</select>
						
				</form>

				<!-- <a href="/createuser.php"> -->
                    <button type="submit" name="submit" style="border-radius:25px;" class="btn btn-success pill" form="tranform">
                    	&nbsp;Transfer&nbsp;
                	</button>
                <!-- </a> -->
                	<button type="submit" name="exit" style="border-radius:25px;" class="btn btn-success pill" form="tranform">
                    	&nbsp;Exit&nbsp;
                	</button>
			</div>
		</div>
	</div>
	<?php require 'foot.php';?>
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>