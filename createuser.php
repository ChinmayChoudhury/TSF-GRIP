<?php
session_start();
require 'db.php';
if (isset($_POST['exit'])) {
	header("Location:/");return;
}

if (isset($_POST['submit'])) {
	$nm = $_POST['name'];
	$em = $_POST['email'];
	$bl = $_POST['bal'];
	//check if fields are filled
	// if(is_numeric($bl)){
	// 	echo " <h1>number !!!<h1>";
	// }
	if(strlen($nm)<1 || strlen($em)<1 || strlen($nm)<1 ||!is_numeric($bl)){
		$_SESSION['error']= "Please fill fields correctly";
		header("Location:createuser.php"); return;
	}
	//if invalid email return
	if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
		$_SESSION['error'] = "Invalid email";
		header("Location:createuser.php"); return;
	}
	$stmt = $pdo->prepare("INSERT INTO `customers`(`name`, `email`, `currbal`) VALUES (:namevar, :emailvar,:balvar)");
	$stmt->execute(array(":namevar"=>$nm,":emailvar"=>$em,":balvar"=>$bl));
	$_SESSION['success'] = "Account/user created successfully.";
	header("Location:createuser.php"); return;

}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/transfer.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Muli:wght@300&display=swap" rel="stylesheet">
	<title>Create user</title>
</head>
<body>
	<?php require_once 'nav.php';?>
	<div class="main">	
		<span id="maintit">Create Account</span>
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
				<span class="divtit">New Customer Details</span>
				
				<p class="desc text-center">Provide details to create a new customer</p>
				<form id="tranform" class="form-group mx-4" method="post">
						<label for="name">Name:</label>
						<input style="border-radius:25px;" type="text" name="name" id="name" class="form-control">
						<br>
						<label for="email">Email:</label>
						<input style="border-radius:25px;" type="text" name="email" id="email" class="form-control">
						<br>
						<label for="bal">Balance:</label>
						<input style="border-radius:25px;" type="text" name="bal" id="bal" class="form-control">
						<br>

						
				</form>

				<!-- <a href="/createuser.php"> -->
                    <button type="submit" name="submit" style="border-radius:25px;" class="btn btn-success pill" form="tranform">
                    	&nbsp;Add Customer&nbsp;
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
    <script type="text/javascript">
    	// $("#sel").css({"border-bottom": "3px solid #ffd56b"});
    	document.getElementById("crtt").style.borderBottom = '3px solid #ffd56b' ;
    </script>
</body>
</html>