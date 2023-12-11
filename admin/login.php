<?php

include '../components/connect.php';

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = filter_var($email);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass);

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? AND password = ? LIMIT 1");
   $select_tutor->execute([$email, $pass]);
   $row = $select_tutor->fetch(PDO::FETCH_ASSOC);

   if ($select_tutor->rowCount() > 0) {
      setcookie('tutor_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
      header('location:dashboard.php');
   } else {
      $message[] = 'Email atau kata sandi salah!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../images/logo_acc_admin.svg" type="image/x-icon">
</head>

<body style="padding-left: 0;">
   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message form">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <section class="form-container">
      <form action="" method="post" enctype="multipart/form-data" class="login">
         <h3>Selamat Datang!</h3>
         <p class="desc">Masuk untuk mengakses halaman admin</p>
         <p>Masukkan Email</p>
         <input type="email" name="email" placeholder="Ketik di sini" maxlength="50" required class="box">
         <p>Kata Sandi</p>
         <input type="password" name="pass" placeholder="Ketik di sini" maxlength="20" required class="box">
         <p class="link">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
         <p class="link">atau <a href="../login.php">masuk sebagai siswa</a></p>
         <br>
         <input type="submit" name="submit" value="Masuk" class="btn">
      </form>
   </section>

   <script>
      let darkMode = localStorage.getItem('dark-mode');
      let body = document.body;

      const enabelDarkMode = () => {
         body.classList.add('dark');
         localStorage.setItem('dark-mode', 'enabled');
      }

      const disableDarkMode = () => {
         body.classList.remove('dark');
         localStorage.setItem('dark-mode', 'disabled');
      }

      if (darkMode === 'enabled') {
         enabelDarkMode();
      } else {
         disableDarkMode();
      }
   </script>
</body>

</html>