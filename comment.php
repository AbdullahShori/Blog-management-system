
    <?php 
    ; ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Profile</title>
     <link rel="stylesheet" href="style.css">
 </head>
 <body>
     <div class="contain">
         <?php if(isset($_SESSION['login_success'])): ?>
            <div class="success">
                <?php echo $_SESSION['login_success']; ?>
            </div>
         <?php endif; ?>
         <?php unset($_SESSION['login_success']); ?>
         <hr>
         
     </div>
 </body>
 </html>





<?php
 
  $db = mysqli_connect("localhost", "root", "", "login");


  if (isset($_POST['uploadcomment'])) {
  
  	
  
  	$image_texte = mysqli_real_escape_string($db, $_POST['image_texte']);

  

      $name = $_SESSION['name'];
  	$sql = "INSERT INTO comment (username, post_id, image_texte) VALUES ('$name','$image_texte')";
  	mysqli_query($db, $sql);

  	
     
  }
  
  $comments = mysqli_query($db, "SELECT * FROM comment");
  
?>

<form method="POST" action="profile.php"  enctype="multipart/form-data">
  <textarea  id="text" 	cols="40" rows="1" class="tip" name="image_texte" 	placeholder="Comments"></textarea>
  	
      <button type="submit" name="uploadcomment" class="h">POST</button>
      </form>

      <?php
    while ($com = mysqli_fetch_array($comments)) {
      echo "<div id='img_div'>";
      echo "<h4>". $com['image_texte'] . "</h4>";
      echo "</div>";
    
    }
?>
<?php include "comment.php"; ?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  enctype="multipart/form-data">
  <textarea  id="text" 	cols="40" rows="1" class="tip" name="image_texte" 	placeholder="Comments"></textarea>
  	
      <button type="submit" name="uploadcomment" class="h">POST</button>
      </form>

      <?php
    while ($com = mysqli_fetch_array($comments)) {
      echo "<div id='img_div'>";
      echo "<h4>". $com['image_texte'] . "</h4>";
      echo "</div>";
    
    }
      //Like




  ?>
  <script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>







