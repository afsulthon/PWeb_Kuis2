<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/' . $rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);

   if ($select_user->rowCount() > 0) {
      $message[] = 'email already taken!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm passowrd not matched!';
      } else {
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);

         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);

         if ($verify_user->rowCount() > 0) {
            setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
            header('location:home.php');
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ACC | Buat Akun</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="form-container">
      <form class="register" action="" method="post" enctype="multipart/form-data">
         <h3>Buat Akun Baru</h3>
         <p class="desc">Ayo buat akun baru, dan mulai perjalananmu sekarang!</p>
         <div class="flex">
            <div class="col">
               <p>Masukkan nama kamu</p>
               <input type="text" name="name" placeholder="Ketik di sini" maxlength="50" required class="box">
               <p>Masukkan email kamu</p>
               <input type="email" name="email" placeholder="Ketik di sini" maxlength="20" required class="box">
            </div>
            <div class="col">
               <p>Masukkan kata sandi</p>
               <input type="password" name="pass" placeholder="Ketik di sini" maxlength="20" required class="box">
               <p>Ulangi kata sandi</p>
               <input type="password" name="cpass" placeholder="Ketik di sini" maxlength="20" required class="box">
            </div>
         </div>
         <p>Pilih foto kamu</p>
         <input class="box" type="file" name="image" accept="image/*" required>
         <p class="link">Sudah punya akun? <a href="login.php">Masuk</a></p>
         <p class="link">atau <a href="admin/register.php">daftar sebagai tutor</a></p>
         <br>
         <input type="submit" name="submit" value="Daftar" class="btn">
      </form>

   </section>












   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>