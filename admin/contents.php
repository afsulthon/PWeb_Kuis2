<?php
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

if (isset($_POST['delete_video'])) {
   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id);
   $verify_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
   $verify_video->execute([$delete_id]);
   if ($verify_video->rowCount() > 0) {
      $delete_video_thumb = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
      $delete_video_thumb->execute([$delete_id]);
      $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/' . $fetch_thumb['thumb']);
      $delete_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
      $delete_video->execute([$delete_id]);
      $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_files/' . $fetch_video['video']);
      $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
      $delete_likes->execute([$delete_id]);
      $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
      $delete_comments->execute([$delete_id]);
      $delete_content = $conn->prepare("DELETE FROM `content` WHERE id = ?");
      $delete_content->execute([$delete_id]);
      $message[] = 'Video berhasil dihapus!';
   } else {
      $message[] = 'Video tidak ditemukan!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Konten Anda</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../images/logo_acc_admin.svg" type="image/x-icon">
</head>

<body>
   <?php include '../components/admin_header.php'; ?>

   <section class="contents">
      <h1 class="heading">Konten Anda</h1>
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

      <div class="box-container">
         <div class="box" style="text-align: center;">
            <h3 class="title" style="margin-bottom: .5rem;">Buat Konten Baru</h3>
            <a href="add_content.php" class="btn">Tambahkan Konten</a>
         </div>

         <?php
         $select_videos = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ? ORDER BY date DESC");
         $select_videos->execute([$tutor_id]);
         if ($select_videos->rowCount() > 0) {
            while ($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) {
               $video_id = $fecth_videos['id'];
         ?>
               <div class="box">
                  <div class="flex">
                     <div><i class="fas fa-dot-circle" style="<?php if ($fecth_videos['status'] == 'active') {
                                                                  echo 'color:limegreen';
                                                               } else {
                                                                  echo 'color:red';
                                                               } ?>"></i><span style="<?php if ($fecth_videos['status'] == 'active') {
                                                                                          echo 'color:limegreen';
                                                                                       } else {
                                                                                          echo 'color:red';
                                                                                       } ?>"><?= $fecth_videos['status']; ?></span></div>
                     <div><i class="fas fa-calendar"></i><span><?= $fecth_videos['date']; ?></span></div>
                  </div>
                  <img src="../uploaded_files/<?= $fecth_videos['thumb']; ?>" class="thumb" alt="">
                  <h3 class="title"><?= $fecth_videos['title']; ?></h3>
                  <form action="" method="post" class="flex-btn">
                     <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                     <a href="update_content.php?get_id=<?= $video_id; ?>" class="option-btn">Perbarui</a>
                     <input type="submit" value="Hapus" class="delete-btn" onclick="return confirm('Hapus video ini?');" name="delete_video">
                  </form>
                  <a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">Lihat Konten</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Belum ada konten yang ditambahkan!</p>';
         }
         ?>
      </div>
   </section>

   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>
</body>

</html>