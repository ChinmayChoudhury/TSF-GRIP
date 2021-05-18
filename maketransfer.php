<?php
session_start();
if(isset($_POST['submit'])){
	// print_r($_POST);
	$rid = $_POST['reciever'];    //reciever's id
	if(!is_numeric($rid) || $rid<1){
		$_SESSION['error'] = "Invalid reciever";
		header("Location: transfer.php"); return;
	}
	
	$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :idvar");
	$stmt->execute(array(":idvar"=>$_GET['sid']));
	$urow = $stmt->fetch(PDO::FETCH_ASSOC);

}

?>
hello