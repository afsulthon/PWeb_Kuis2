<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id']))
   $user_id = $_COOKIE['user_id'];
else
   $user_id = '';

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

$select_titles = $conn->prepare("SELECT title, id FROM playlist");
$select_titles->execute();
$titles = $select_titles->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aktual Cendekia Course</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <?php
   if ($user_id == '') {
   ?>
      <div class="home-banner">
         <div class="content">
            <div class="content-wrapper">
               <h1>Ingin Masuk PTN Impian?</h1>
               <h3>Di sini kita gak cuman belajar materi aja, tapi juga belajar cara untuk berpikir. Banyak alumni dari kamu yang udah masuk kampus impian!</h3>
               <button class="btn" onclick="window.location.href='register.php'">Daftar Sekarang!</button>
            </div>
            <img src="https://www.zenius.net/_next/image/?url=https%3A%2F%2Fcms-static.zenius.net%2Fprod%2FImage_6_cc1af1b4fb.png&w=1920&q=75" height="300px">
         </div>
      </div>
   <?php
   } else if ($user_id != '') {
   ?>
      <div class="home-banner">
         <div class="content">
            <div class="content-wrapper">
               <h1>Perjalananmu Dimulai Sekarang</h1>
               <h3>Mari jelajahi materi yang ada di sini dan mulai belajar!</h3>
               <button class="btn" onclick="window.location.href='courses.php'">Mulai Belajar!</button>
            </div>
            <img src="https://www.zenius.net/_next/image/?url=https%3A%2F%2Fcms-static.zenius.net%2Fprod%2FImage_6_cc1af1b4fb.png&w=1920&q=75" height="300px">
         </div>
      </div>
   <?php
   }
   ?>

   <section class="quick-select">
      <h1 class="heading">Jelajahi Materi yang <span>#BikinCerdasBeneran</span></h1>

      <div class="box-container">

         <?php
         if ($user_id != '') {
         ?>
            <div class="box">
               <h3 class="title">Suka dan Komentar</h3>
               <p>Jumlah suka: <span><?= $total_likes; ?></span></p>
               <a href="likes.php" class="inline-btn">Lihat Suka</a>
               <p>Jumlah komentar: <span><?= $total_comments; ?></span></p>
               <a href="comments.php" class="inline-btn">Lihat Komentar</a>
               <p>Daftar putar tersimpan: <span><?= $total_bookmarked; ?></span></p>
               <a href="bookmark.php" class="inline-btn">Lihat Bookmark</a>
            </div>
         <?php
         }
         ?>

         <div class="box">
            <h3 class="title">Topik Populer</h3>
            <div class="flex">
               <?php foreach ($titles as $title) : ?>
                  <a href="playlist.php?get_id=<?= $title['id']; ?>"><span><?= $title['title'] ?></span></a>
               <?php endforeach; ?>
            </div>
         </div>
      </div>
   </section>

   <section class="courses">
      <h1 class="heading">Kelas Terbaru</h1>

      <div class="box-container">

         <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
         $select_courses->execute(['active']);
         if ($select_courses->rowCount() > 0) {
            while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
               $course_id = $fetch_course['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_course['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
         ?>
               <div class="box">
                  <div class="tutor">
                     <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                     <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_course['date']; ?></span>
                     </div>
                  </div>
                  <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
                  <h3 class="title"><?= $fetch_course['title']; ?></h3>
                  <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">Lihat Daftar Putar</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Belum ada materi yang ditambahkan</p>';
         }
         ?>
      </div>

      <div class="more-btn">
         <a href="courses.php" class="inline-option-btn">Lihat lebih banyak</a>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>

</html>