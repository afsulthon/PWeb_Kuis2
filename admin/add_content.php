<?php
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

if (isset($_POST['submit'])) {

   $id = unique_id();
   $status = $_POST['status'];
   $status = filter_var($status);
   $title = $_POST['title'];
   $title = filter_var($title);
   $description = $_POST['description'];
   $description = filter_var($description);
   $playlist = $_POST['playlist'];
   $playlist = filter_var($playlist);

   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id() . '.' . $thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/' . $rename_thumb;

   $video = $_FILES['video']['name'];
   $video = filter_var($video);
   $video_ext = pathinfo($video, PATHINFO_EXTENSION);
   $rename_video = unique_id() . '.' . $video_ext;
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../uploaded_files/' . $rename_video;

   if ($thumb_size > 2000000) {
      $message[] = 'Ukuran gambar terlalu besar!';
   } else {
      $add_playlist = $conn->prepare("INSERT INTO `content`(id, tutor_id, playlist_id, title, description, video, thumb, status) VALUES(?,?,?,?,?,?,?,?)");
      $add_playlist->execute([$id, $tutor_id, $playlist, $title, $description, $rename_video, $rename_thumb, $status]);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      move_uploaded_file($video_tmp_name, $video_folder);
      $message[] = 'Konten berhasil diunggah!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Tambah Konten</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../images/logo_acc_admin.svg" type="image/x-icon">
</head>

<body>
   <?php include '../components/admin_header.php'; ?>

   <section class="video-form">
      <h1 class="heading">Unggah</h1>

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

      <form action="" method="post" enctype="multipart/form-data">
         <p>Status</p>
         <select name="status" class="box" required>
            <option value="" selected disabled>Pilih di sini</option>
            <option value="active">Aktif</option>
            <option value="deactive">Nonaktif</option>
         </select>
         <p>Judul</p>
         <input type="text" name="title" maxlength="100" required placeholder="Ketik di sini" class="box">
         <p>Deskripsi</p>
         <textarea name="description" class="box" required placeholder="Ketik di sini" maxlength="1000" cols="30" rows="10"></textarea>
         <p>Daftar Putar</p>
         <select name="playlist" class="box" required>
            <option value="" disabled selected>Pilih di sini</option>
            <?php
            $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
            $select_playlists->execute([$tutor_id]);
            if ($select_playlists->rowCount() > 0) {
               while ($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <option value="<?= $fetch_playlist['id']; ?>"><?= $fetch_playlist['title']; ?></option>
               <?php
               }
               ?>
            <?php
            } else {
               echo '<option value="" disabled>Belum ada daftar putar yang dibuat!</option>';
            }
            ?>
         </select>
         <p>Pilih Thumbnail</p>
         <input type="file" name="thumb" accept="image/*" required class="box">
         <p>Pilih Video</p>
         <input type="file" name="video" accept="video/*" required class="box">
         <input type="submit" value="Unggah" name="submit" class="btn">
      </form>
   </section>

   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>
</body>

</html>