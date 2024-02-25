<?php

@include 'config.php';
// v4 uuid generálás
function uuidv4()
{
    return sprintf('%04x%04x%04x-%04x%04x%04x-%04x%04x%04x-%04x%04x%04x-%04x%04x%04x',
   //  return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x-%04x-%04x%04x%04x-%04x%04x%04x-%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}


//unix idő
$unixido = time();

if(isset($_POST['submit'])){
   sleep(1);
//változók a post requestből, és uuid és unix idő
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $register_code = mysqli_real_escape_string($conn, $_POST['reg_code']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = 'user';
   $karakterszamok = 15000;
   // $user_uuid = uuidv4();
   $user_uuid = uuidv4();
   $regisztracio_ido = $unixido;

   $all_code = "SELECT * FROM regisztracio WHERE register_codes='$register_code'";
   $all_code_store = mysqli_query($conn, $all_code);

   //hanyadik user
   $sql2 = "SELECT MAX(id) as max_id FROM user_form";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_assoc($result2);
   $id = $row2['max_id']+1;

   $select = "SELECT * FROM user_form WHERE email = '$email' OR user_uuid = '$user_uuid' OR name = '$name'";
   $result = mysqli_query($conn, $select);


   $sql2 = "SELECT MAX(id) as max_id FROM user_form";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_assoc($result2);
   $uid = $row2['max_id']+1;


//létezik e az email vagy uuid
   if (mysqli_num_rows($all_code_store) > 0) {


      if(mysqli_num_rows($result) > 0){

         $error[] = 'A felhasználó már létezik a rendszerben!';

      }else{

         if($pass != $cpass){
            $error[] = 'A jelszavak nem eggyeznek!';
         }else{
            //a feltöltendő MAITE Coinok száma szám e, ha igen beilleszti az adatbázisba
            if(is_numeric($karakterszamok)){
               $uuid = strval($user_uuid);
               $insert = "INSERT INTO user_form(id, name, email, password, user_type, karakterszam, user_uuid, letrehozas_datuma) VALUES('$uid', '$name','$email','$pass','$user_type', '$karakterszamok', '$user_uuid', '$regisztracio_ido')";
               mysqli_query($conn, $insert);
               $error[] = 'Regisztráció sikeres';
               
               // header('location:index.php');
               // $_SESSION["regisztracio"] = true;
           } else {
               $error[] = 'A MAITE Coinok száma nem "szám".';
           }


         }
      }
   } else {
      $error[] = 'A megadott regisztrációs kód érvénytelen.';
   }

};


?>

<!DOCTYPE html>
<html lang="hu">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MAITE - regisztráció</title>
   <link rel="stylesheet" href="css/login_styles.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Új fiók regisztrálása</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Név" >
      <input type="email" name="email" required placeholder="E-mail" >
      <input type="password" name="password" required placeholder="Jelszó">
      <input type="password" name="cpassword" required placeholder="Jelszó újra">
      <input type="text" name="reg_code" required placeholder="Regisztrációs kód">
      <input type="submit" name="submit" value="Regisztáció" class="form-btn">
      <p>Már van fiókod? <a href="index.php">Jelentkezz be</a></p>
   </form>

</div>

</body>
</html>