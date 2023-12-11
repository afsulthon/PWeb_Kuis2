<header class="header">

   <section class="flex">
      <div class="icons">
         <div id="menu-btn" class="fa-solid fa-bars"></div>
      </div>

      <a href="home.php" class="logo"><i class="fa-solid fa-graduation-cap icon"></i>Aktual Cendekia Course</a>

      <form action="search_course.php" method="post" class="search-form">
         <input type="text" name="search_course" placeholder="Belajar apa hari ini?" required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
      </form>

      <div class="icons">
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span>Siswa</span>
            <a href="profile.php" class="btn">Lihat Profil</a>
            <a href="components/user_logout.php" onclick="return confirm('Kamu yakin ingin keluar?');" class="delete-btn">Keluar</a>
         <?php
         } else {
         ?>
            <h3>Buat akun atau masuk</h3>
            <div class="flex-btn">
               <a href="register.php" class="option-btn">Daftar</a>
               <a href="login.php" class="option-btn">Masuk</a>
            </div>
         <?php
         }
         ?>
      </div>
   </section>
</header>


<div class="side-bar">
   <div class="close-side-bar">
      <i class="fa-solid fa-times"></i>
   </div>

   <div class="profile">
      <?php
      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->execute([$user_id]);
      if ($select_profile->rowCount() > 0) {
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>Siswa</span>
         <a href="profile.php" class="btn">Lihat Profil</a>
      <?php
      } else {
      ?>
         <h3>Buat akun atau masuk</h3>
         <div class="flex-btn" style="padding-top: .5rem;">
            <a href="register.php" class="option-btn">Daftar</a>
            <a href="login.php" class="option-btn">Masuk</a>
         </div>
      <?php
      }
      ?>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Beranda</span></a>
      <a href="courses.php"><i class="fas fa-book"></i><span>Kursus</span></a>
      <a href="teachers.php"><i class="fas fa-chalkboard-teacher"></i><span>Pengajar</span></a>
      <a href="contact.php"><i class="fas fa-envelope"></i><span>Kontak</span></a>
      <a href="about.php"><i class="fas fa-info-circle"></i><span>Tentang</span></a>
   </nav>
</div>