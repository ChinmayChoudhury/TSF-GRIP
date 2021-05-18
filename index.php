<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Muli:wght@300&display=swap" rel="stylesheet">
</head>
<body>
	<?php require_once 'nav.php';?>
	<div class="main">	
		<span id="maintit">Welcome to TSF bank</span>
		<div class="row mt-5">
			<div class="col-lg text-center p-3" id="crt">
				<span class="divtit">Create Customer</span>
				<p class="desc text-justify">Select to create a customer. You will be able to choose this customer in future.</p>
				<a href="/createuser.php">
                    <button type="submit" style="border-radius:25px;" class="btn pill">
                    	&nbsp;Create Customer&nbsp;
                	</button>
                </a>
			</div>
			<div class="col-lg offset-1 text-center p-3" id="selcust">
				<span class="divtit">Select Customer</span>
				<p class="desc text-justify">Select from the available list of customers to access their account.</p>
				<a href="selectuser.php">
                    <button type="submit" style="border-radius:25px;" class="btn pill">
                    	&nbsp;Select Customer&nbsp;
                	</button>
                </a>
			</div>
			<div class="col-lg offset-1 text-center p-3" id="transhist">
				<span class="divtit">Transfer History</span>
				<p class="desc text-justify">See previously done transfers' information here.</p>
				<a href="transhistory.php">
                    <button type="submit" style="border-radius:25px;" class="btn pill">
                    	&nbsp;Transfer History&nbsp;
                	</button>
                </a>
			</div>
		</div>
	</div>
	<?php require 'foot.php';?>
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	// $("#sel").css({"border-bottom": "3px solid #ffd56b"});
    	document.getElementById("home").style.borderBottom = '3px solid #ffd56b' ;
    </script>
</body>
</html>