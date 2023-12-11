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
   $title = $_POST['title'];
   $title = filter_var($title);
   $description = $_POST['description'];
   $description = filter_var($description);
   $status = $_POST['status'];
   $status = filter_var($status);

   $image = $_FILES['image']['name'];
   $image = filter_var($image);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/' . $rename;

   $add_playlist = $conn->prepare("INSERT INTO `playlist`(id, tutor_id, title, description, thumb, status) VALUES(?,?,?,?,?,?)");
   $add_playlist->execute([$id, $tutor_id, $title, $description, $rename, $status]);

   move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'Berhasil menambahkan daftar putar!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | Tambah Daftar Putar</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="shortcut icon" href="../images/logo_acc_admin.svg" type="image/x-icon">
</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="playlist-form">

      <h1 class="heading">Tambah Daftar Putar Kursus</h1>

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
         <p>Thumbnail</p>
         <input type="file" name="image" accept="image/*" required class="box">
         <input type="submit" value="Buat" name="submit" class="btn">
      </form>

   </section>

   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>
</body>

</html>