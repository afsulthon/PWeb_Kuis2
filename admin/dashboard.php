<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Dasbor</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../images/logo_acc_admin.svg" type="image/x-icon">
</head>

<body>
   <?php include '../components/admin_header.php'; ?>

   <section class="dashboard">
      <h1 class="heading">Dasbor</h1>

      <div class="box-container">
         <div class="box">
            <h3>Selamat Datang!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="profile.php" class="btn">Lihat Profil</a>
         </div>
         <div class="box">
            <h3><?= $total_contents; ?> konten</h3>
            <p>Konten Anda</p>
            <a href="add_content.php" class="btn">Tambah Konten Baru</a>
         </div>
         <div class="box">
            <h3><?= $total_playlists; ?> daftar putar</h3>
            <p>Daftar Putar Anda</p>
            <a href="add_playlist.php" class="btn">Tambah Daftar Putar Baru</a>
         </div>
         <div class="box">
            <h3><?= $total_likes; ?> suka</h3>
            <p>Total Suka</p>
            <a href="contents.php" class="btn">Lihat Konten</a>
         </div>
         <div class="box">
            <h3><?= $total_comments; ?> komentar</h3>
            <p>Total Komentar</p>
            <a href="comments.php" class="btn">Lihat Komentar</a>
         </div>
         <div class="box">
            <h3><?= $fetch_profile['name']; ?></h3>
            <p>Kontrol Akun</p>
            <a href="../components/admin_logout.php" onclick="return confirm('Anda yakin ingin keluar?');" class="delete-btn">Keluar</a>
         </div>
      </div>
   </section>

   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>
</body>

</html>