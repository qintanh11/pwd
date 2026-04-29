<?php 
session_start();
include 'koneksi.php';

// ambil data dari menu yang dipilih
if(isset($_GET['id_menu'])) {
    $id = $_GET['id_menu'];
    $qty = $_GET['qty'];

    // simpan ke session
    $_SESSION['keranjang'][$id] = $qty;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check out</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-start gap-2">
    <a class="navbar-brand" href="homepage.php">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="mb-0">Pesanan</h4>
  </div>
</nav>

<div class="container" style="margin-top:80px;">

<h2>Ringkasan Pesanan</h2>

<?php
if(isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {

    foreach($_SESSION['keranjang'] as $id => $jumlah) {
        if($jumlah > 0) {

            // ambil data dari database
            $data = mysqli_query($koneksi, "SELECT * FROM menu WHERE id='$id'");
            $d = mysqli_fetch_array($data);
?>

            <div class="card mb-3" style="max-width: 540px;">
              <div class="row g-0">
                
                <div class="col-md-4">
                  <img src="img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start" alt="">
                </div>

                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $d['nama_menu']; ?></h5>
                    <p class="card-text">Harga: Rp <?php echo $d['harga']; ?></p>
                    <p class="card-text">Jumlah: <?php echo $jumlah; ?></p>
                  </div>
                </div>

              </div>
            </div>

<?php
        }
    }

} else {
?>
    <div class="card text-center mt-4 shadow-sm">
      <div class="card-body">
        <i class="bi bi-cart-x"></i>
        <h5 class="card-title mt-3">Keranjang Kosong</h5>
        <p class="card-text">Silakan pilih menu terlebih dahulu</p>
        <a href="homepage.php" class="btn btn-primary">Pilih Menu</a>
      </div>
    </div>

<?php
}
?>

</div>
</body>
</html>