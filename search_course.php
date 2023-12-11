<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ACC | Cari Kelas</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>
   <section class="courses">

      <h1 class="heading">Hasil Pencarian</h1>

      <div class="box-container">

         <?php
         if (isset($_POST['search_course']) or isset($_POST['search_course_btn'])) {
            $search_course = $_POST['search_course'];
            $select_courses = $conn->prepare("SELECT * FROM `content` WHERE title LIKE '%{$search_course}%' AND status = ?");
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
               echo '<p class="empty">Kelas tidak ditemukan!</p>';
            }
         } else {
            echo '<p class="empty">Mohon cari sesuatu!</p>';
         }
         ?>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>
</body>

</html>