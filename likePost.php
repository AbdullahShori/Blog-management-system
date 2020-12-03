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

	if(isset($_POST['post_id'])) {
		$postID = $_POST['post_id'];
		$userID = $_SESSION['id'];
		$res = mysqli_query($con , "SELECT * FROM `likes` WHERE user_id='$userID' && post_id='$postID'");
		if($res->num_rows === 0){
			mysqli_query($con, "INSERT INTO likes(post_id , user_id , name)
			VALUES('".$_POST['post_id']."', '".$_SESSION['id']."' ,'".$_SESSION['name']."')");
				$json = ['success' => TRUE, 'message' => 'Liked post successfully'];
		}
		else {
			$json = ['success' => TRUE, 'message' => 'Liked post already'];
		}


	
}
}else{
	$json = ['error' => TRUE, 'message' => 'Liked post successfully..'];
}
}
catch(Exception $ex){
$json = ['error' => TRUE, 'message' => $ex->getMessage()];
	
}
echo json_encode($json);
?>
