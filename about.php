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
   <title>ACC | Tentang</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/logo_acc.svg" type="image/x-icon">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="about">
      <div class="row">
         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>
         <div class="content">
            <h3>Mengapa Memilih Kami?</h3>
            <p>Aktual Cendekia Course adalah lembaga pendidikan yang berkomitmen untuk menyediakan pendidikan berkualitas tinggi dan membantu siswa mencapai potensi maksimal mereka. Kami memahami bahwa setiap siswa memiliki keunikan dan potensi sendiri, dan kami berusaha menciptakan lingkungan belajar yang mendukung, merangsang, dan memotivasi setiap individu.</p>
         </div>
      </div>

      <div class="box-container">
         <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <div>
               <h3>1000+</h3>
               <span>Kelas Online</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-user-graduate"></i>
            <div>
               <h3>25000+</h3>
               <span>Lulusan Terpelajar</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-chalkboard-user"></i>
            <div>
               <h3>5000+</h3>
               <span>Tutor Ahli</span>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-briefcase"></i>
            <div>
               <h3>100%</h3>
               <span>Penempatan Kerja</span>
            </div>
         </div>
      </div>
   </section>

   <section class="reviews">
      <h1 class="heading">Kata Mereka yang Pernah Belajar di ACC</h1>
      <div class="box-container">
         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-2.jpg" alt="">
               <div>
                  <h3>Duevano Fairuz</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-3.jpg" alt="">
               <div>
                  <h3>Ken Anargya</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-4.jpg" alt="">
               <div>
                  <h3>Akbar Putra</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-5.jpg" alt="">
               <div>
                  <h3>Abdullah Yasykur</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-6.jpg" alt="">
               <div>
                  <h3>Ahyun Irsyada</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
            <div class="user">
               <img src="images/pic-7.jpg" alt="">
               <div>
                  <h3>Ligar Arsa</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

      </div>

   </section>

   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>
</body>

</html>