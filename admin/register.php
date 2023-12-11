<?php

include '../components/connect.php';

if (isset($_POST['submit'])) {

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name);
   $profession = $_POST['profession'];
   $profession = filter_var($profession);
   $email = $_POST['email'];
   $email = filter_var($email);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass);

   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/' . $rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);

   if ($select_tutor->rowCount() > 0) {
      $message[] = 'Alamat email sudah terdaftar!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Kata sandi tidak cocok!';
      } else {
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $profession, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'Akun berhasil dibuat. Silakan masuk!';
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
   <title>Admin | Daftar</title>
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
      <form class="register" action="" method="post" enctype="multipart/form-data">
         <h3>Daftar Tutor Baru</h3>
         <p class="desc">Ayo berkontribusi memajukan pendidikan Indonesia bersama kami!</p>
         <div class="flex">
            <div class="col">
               <p>Masukkan nama Anda</p>
               <input type="text" name="name" placeholder="Ketik di sini" maxlength="50" required class="box">
               <p>Pilih profesi Anda</p>
               <select name="profession" class="box" required>
                  <option value="" disabled selected>Pilih di sini</option>
                  <option value="Developer">Developer</option>
                  <option value="Guru">Guru</option>
                  <option value="Insinyur">Insinyur</option>
                  <option value="Dokter">Dokter</option>
                  <option value="Biolog">Biolog</option>
                  <option value="Fisikawan">Fisikawan</option>
                  <option value="Desainer">Desainer</option>
                  <option value="Musisi">Musisi</option>
                  <option value="Pengacara">Pengacara</option>
                  <option value="Akuntan">Akuntan</option>
                  <option value="Jurnalis">Jurnalis</option>
                  <option value="Fotografer">Fotografer</option>
                  <option value="Lainnya">Lainnya</option>
               </select>
               <p>Masukkan email Anda</p>
               <input type="email" name="email" placeholder="Ketik di sini" maxlength="20" required class="box">
            </div>
            <div class="col">
               <p>Masukkan kata sandi</p>
               <input type="password" name="pass" placeholder="Ketik di sini" maxlength="20" required class="box">
               <p>Ulangi kata sandi</p>
               <input type="password" name="cpass" placeholder="Ketik di sini" maxlength="20" required class="box">
               <p>Pilih foto Anda</p>
               <input type="file" name="image" accept="image/*" required class="box">
            </div>
         </div>
         <p class="link">Sudah punya akun? <a href="login.php">Masuk</a></p>
         <br>
         <input type="submit" name="submit" value="Daftar" class="btn">
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