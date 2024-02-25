<?php

@include 'config.php';



session_start();
$_SESSION["verseny"] = true;
if(isset($_SESSION['user_name'])){
   header('location:kezdolap.php');
}
if(isset($_SESSION['admin_name'])){
   header('location:kezdolap.php');
}
if(isset($_POST['submit'])){
   sleep(1);
   if(isset($_POST['name'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
   } else {
   }
   if(isset($_POST['email'])){
      $email = mysqli_real_escape_string($conn, $_POST['email']);
   } else {
   }
   
   $pass = md5($_POST['password']);
   // $cpass = md5($_POST['cpassword']);
   if(isset($_POST['user_type'])){
      $user_type = $_POST['user_type'];
   } else {
   }
   

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:kezdolap.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:kezdolap.php');

      }
     
   }else{
      $error[] = 'Hibás email és/vagy jelszó!';
   }

};

?>

<!DOCTYPE html>
<html lang="hu">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MAITE - bejelentkezés</title>
   <link rel="stylesheet" href="css/login_styles.css">

</head>
<body>
   
<div class="form-container">

   <form action="index.php" method="post">
      <h3>MAITE - bejelentkezés</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Írd ide az email-ed">
      <input type="password" name="password" required placeholder="Írd ide a jelszavadat">
      <input type="submit" name="submit" value="Belépés" class="form-btn">
      <p>Ha nincs fiókod <a href="regisztracio.php">regisztrálj most</a></p>
   </form>

</div>

</body>
</html>