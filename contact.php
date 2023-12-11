<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name);
   $email = $_POST['email'];
   $email = filter_var($email);
   $number = $_POST['number'];
   $number = filter_var($number);
   $msg = $_POST['msg'];
   $msg = filter_var($msg);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if ($select_contact->rowCount() > 0) {
      $message[] = 'Pesan sudah dikirim!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'Pesan berhasil dikirim!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ACC | Kontak</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="contact">
      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '
            <div class="message">
               <span>' . $message . '</span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
      ?>

      <div class="row">
         <div class="image">
            <img src="images/contact-img.svg" alt="">
         </div>

         <form action="" method="post">
            <h3>Hubungi Kami</h3>
            <input type="text" placeholder="Masukkan nama" required maxlength="100" name="name" class="box">
            <input type="email" placeholder="Masukkan email" required maxlength="100" name="email" class="box">
            <input type="number" min="0" max="9999999999" placeholder="Masukkan nomor telepon" required maxlength="10" name="number" class="box">
            <textarea name="msg" class="box" placeholder="Masukkan pesan" required cols="30" rows="10" maxlength="1000"></textarea>
            <input type="submit" value="Kirim" class="inline-btn" name="submit">
         </form>
      </div>

      <div class="box-container">
         <div class="box">
            <i class="fas fa-phone"></i>
            <h3>Nomor Telepon</h3>
            <a href="tel:6281234567890">0812-3456-7890</a>
            <a href="tel:6281223334444">0812-2333-4444</a>
         </div>

         <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>Alamat Email</h3>
            <a href="mailto:admin@acc.id">admin@acc.id</a>
            <a href="mailto:cs@acc.id">cs@acc.id</a>
         </div>

         <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Alamat Kantor Pusat</h3>
            <a href="https://maps.app.goo.gl/sc1WuDxPTmaPb5xKA">Graha Aktiva, Jalan Teknik Kimia, Keputih, Sukolilo, Surabaya 60111</a>
         </div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>