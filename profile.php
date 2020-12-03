<?php include "init.php"; ?>
<?php if(!isset($_SESSION['id'])): ?>
    <?php header("location:login.php"); ?>
    <?php endif; ?>
    <?php 
    ; ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Profile</title>
     <link rel="stylesheet" href="profile.css">
     <link rel="stylesheet" href="style.css">
     <script src='https://kit.fontawesome.com/a076d05399.js'></script>
 </head>
 <body>
     <div class="contain">
         <?php if(isset($_SESSION['login_success'])): ?>
            <div class="success">
                <?php echo $_SESSION['login_success']; ?>
            </div>
         <?php endif; ?>
         <?php unset($_SESSION['login_success']); ?>
      <h2 style="color:blue;">Welcome <?php echo "<span>".$_SESSION['name']."</span>" ?> to the Facelook</h2><hr>
         <a class="ttt" href="logout.php">logout</a>
     </div>
 </body>
 </html>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome </title>

    <style type="text/css">
   
    </style>
</head>

</html>
<?php
 
  $db = mysqli_connect("localhost", "root", "", "login");

 
  $msg = "";

  if (isset($_POST['upload'])) {
  
  	$image = $_FILES['image']['name'];
  
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  
  	$target = "images/".basename($image);
      $name = $_SESSION['name'];
  	$sql = "INSERT INTO post (username,image, image_text) VALUES ('$name','$image','$image_text')";
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          $msg = "Image uploaded successfully";
         
  	}else{
  		$msg = "Failed to upload image";
      }
     
  }
  
  $result = mysqli_query($db, "SELECT * FROM post");
  
?>







<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

<body>

<div>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data" >
  <input type="file" name="image">
  <textarea 	id="text" 	cols="40" 	rows="1" class="tip"	name="image_text" 	placeholder="What's on your mind"></textarea>
  	<input type="hidden" name="size" value="1000000">
      <button type="submit" name="upload" class="h">POST</button>
  
  </form>

</div>
<?php 
  $comments = mysqli_query($db, "SELECT * FROM comments"); ?>


<?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      echo "<h4>". $row['username'] . "</h4>";
      echo  "<p>" . $row['image_text']."</p>";
      echo "<img src='images/".$row['image']."' />";

$postId = $row['id'];



echo '<a class="t" href="like.php?postId='.$postId.'"><i class="far fa-thumbs-up"></i></a>';
echo '<a class="tt" href="indexx.php?postId='.$postId.'"><i class="far fa-comment"></i></a>';

}
?>


  <script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>