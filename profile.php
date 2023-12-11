<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ACC | Profil</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="profile">

      <h1 class="heading">Detail Profil</h1>

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

      <div class="details">

         <div class="user">
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <p>Siswa</p>
            <a href="update.php" class="inline-btn">Perbarui profil</a>
         </div>

         <div class="box-container">

            <div class="box">
               <div class="flex">
                  <i class="fas fa-bookmark"></i>
                  <div>
                     <h3><?= $total_bookmarked; ?></h3>
                     <span>Daftar Putar Tersimpan</span>
                  </div>
               </div>
               <a href="bookmark.php" class="inline-btn">Lihat yang Tersimpan</a>
            </div>

            <div class="box">
               <div class="flex">
                  <i class="fas fa-heart"></i>
                  <div>
                     <h3><?= $total_likes; ?></h3>
                     <span>Materi yang Disukai</span>
                  </div>
               </div>
               <a href="likes.php" class="inline-btn">Lihat yang Disukai</a>
            </div>

            <div class="box">
               <div class="flex">
                  <i class="fas fa-comment"></i>
                  <div>
                     <h3><?= $total_comments; ?></h3>
                     <span>Komentar Video</span>
                  </div>
               </div>
               <a href="comments.php" class="inline-btn">Lihat Komentar</a>
            </div>

         </div>

      </div>

   </section>

   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>

</body>

</html>