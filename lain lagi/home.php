<?php
include 'koneksi.php';
$query = $koneksi -> query("select*from menu inner join kategori on menu.id_kategori = kategori.id_kategori");
$user = $koneksi->query("SELECT * FROM user WHERE username = '".$_SESSION['username']."'");
$user = $user->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="container">

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
      HAII !! <br>
    </h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">
      <?= $_SESSION['username']; ?>
    </h6>
    <p class="card-text">
      Pelayanan terbaik untuk pelanggan <br>
      dengan senyuman yang ramah dan cepat <br>
      untuk memenuhi kebutuhan Anda.
    </p>

  </div>
</div>

</div>
</body>
</html>