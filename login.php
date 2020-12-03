<?php include "init.php"; ?>
<?php if(isset($_SESSION['id'])): ?>
  <?php header("location:profile.php"); ?>
  <?php endif; ?>
<?php 
if(isset($_POST['login'])){

 $data = [
       'email'           => $_POST['email'],
     'password'       => $_POST['password'],
          'email_error'    => '',
            'password_error' => ''

 ];

 if(empty($data['email'])){
  $data['email_error'] = "Email is required";
 }

 if(empty($data['password'])){
  $data['password_error'] = "Password is required";
 }


 if(empty($data['email_error']) && empty($data['password_error'])){

  if($source->Query("SELECT * FROM users WHERE email = ?", [$data['email']])){
    if($source->CountRows() > 0){
     $row = $source->Single();

          $id = $row->id;


     $db_password = $row->password;
     $name = $row->name;
     if(password_verify($data['password'], $db_password)){

      $_SESSION['login_success'] = "Hi ".$name . " You are successfully login";
      $_SESSION['id'] = $id;
      $_SESSION['name'] = $name;

      header("location:profile.php");

     } else {
      $data['password_error'] = "Please enter correct password";
     }
    } else {
      $data['email_error'] = "Please enter correct email";
    }
  echo "$name";
  

  }
 }

}


 ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
<style>

</style>
 <meta charset="UTF-8">
 <title>Singup Form</title>
 <link rel="stylesheet" href="assets/css/style.css">
 <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400" rel="stylesheet"> 
 <script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <link href="bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div class="container">
 
 <div class="container text-center margin">
  <div class="form">
   <div class="form-section">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="group">
        <?php 
        
        if(isset($_SESSION['account_created'])):?>
          <div class="success">
            <?php echo $_SESSION['account_created']; ?>
          </div>
        <?php endif; ?>
        <?php unset($_SESSION['account_created']); ?>

         
      </div>
     <div class="col-sm-12">
     
   <div>
   <h3 class="heading hd text-center">User Login</h3>

   <div style="padding:40px;" class="well">
   
   <div class="group">
      <input type="email" name="email" class="control" placeholder="Enter Email.." value="<?php if(!empty($data['email'])): echo $data['email']; endif;?>">
      <div class="error">
        <?php if(!empty($data['email_error'])): ?>
          <?php echo $data['email_error']; ?>
        <?php endif; ?>
      </div>
     </div>
     <div class="group">
      <input type="password" name="password" class="control" placeholder="Create Password..." value="<?php if(!empty($data['password'])): echo $data['password']; endif;?>">
      <div class="error">
        <?php if(!empty($data['password_error'])): ?>
          <?php echo $data['password_error']; ?>
        <?php endif; ?>
      </div>
     </div>
 
     <div class="group m20">
      <input type="submit" name="login" class="btn bb" value="Login &rarr;">
     </div>
     <div class="group m20">
      <a href="index.php" class="link">Create new account ?</a>
     </div>
   </div>
   </div>
    </form>
   </div>
  </div>
 </div>
     </div>


 </div>

</body>
</html>
