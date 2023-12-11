<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = filter_var($email);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
      header('location:home.php');
   } else {
      $message[] = 'incorrect email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ACC | Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="form-container">
      <form class="login" action="" method="post" enctype="multipart/form-data">
         <h3>Selamat Datang!</h3>
         <p class="desc">Ayo masuk dan mulai perjalananmu!</p>
         <p>Masukkan Email</p>
         <input type="email" name="email" placeholder="Ketik di sini" maxlength="50" required class="box">
         <p>Kata Sandi</p>
         <input type="password" name="pass" placeholder="Ketik di sini" maxlength="20" required class="box">
         <p class="link">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
         <p class="link">atau <a href="admin/login.php">masuk sebagai tutor</a></p>
         <br>
         <input type="submit" name="submit" value="Masuk" class="btn">
      </form>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>