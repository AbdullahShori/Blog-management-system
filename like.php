<?php include "init.php"; ?>
<?php if(!isset($_SESSION['id'])): ?>
    <?php header("location:login.php"); ?>
    <?php endif; ?>


<?php require("db.php");?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="reset.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<title>Comment Box</title>
<style>
	.likes {
		display: flex;
    width: 400px;
    background-color: cornflowerblue;
    align-items: center;
    justify-content: space-around;
	}
</style>
</head>
<body style="background-color: white">
<div id="demo"></div>
<form name="form"  id="like" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
            <button type="submit" name="submit" class="button" style="outline: none;border:none;">Like Post</button></br>
        </form>
<?php  $postId=$_GET['postId']; ?>
<?php 
	// $postId = $_GET['id'];
	$postId = $_GET['postId'];
	require("displayLikes.php");
	?>

<script>

$(document).ready(function(){
  $('#like').submit(function() {

  	$.ajax({
  		type : 'POST',
  		url : "likePost.php",
  		data : {
			post_id : '<?php echo $postId; ?>'
  		},
  		dataType : 'json',
  		success : function(result){
  		if(result.success) {
  			$('#demo').html('<div style=color:green>'+ result.message +'</div>');
  			window.location.href="";
  		}else{
  			$('#demo').html('<div style=color:red>**'+result.message+'</div>');
  		}
  	}
  });
  return false;
});
});
</script>

</body>



















