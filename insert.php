<?php include "init.php"; ?>
<?php if(!isset($_SESSION['id'])): ?>
    <?php header("location:login.php"); ?>
    <?php endif; ?>


<?php require("db.php");
header('Content-Type: application/json');
$json = [];
try
{
if(isset($_SESSION['name']) && (!empty($_SESSION['name']))) {


	if(isset($_POST['comments']) && (!empty($_POST['comments']))) {
	mysqli_query($con, "INSERT INTO comments(name , post_id , comments)
	VALUES('".$_SESSION['name']."' , '".$_POST['post_id']."' ,'".$_POST['comments']."')");
		$json = ['success' => TRUE, 'message' => 'Insert Data successfully'];
}
}else{
	$json = ['error' => TRUE, 'message' => 'Not Insert Data..'];
}
}
catch(Exception $ex){
$json = ['error' => TRUE, 'message' => $ex->getMessage()];
	
}
echo json_encode($json);
?>
