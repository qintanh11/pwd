<?php
include 'koneksi.php';

$query = $koneksi->query("SELECT * FROM menu 
                          INNER JOIN kategori 
                          ON menu.id_kategori = kategori.id_kategori");

$user = $koneksi->query("SELECT * FROM user 
                        WHERE username='".$_SESSION['username']."'");
$user = $user->fetch_assoc();

$pendapatan = mysqli_query($koneksi,"SELECT SUM(total) as total_pendapatan
                                    FROM pesanan
                                    WHERE tgl_pesanan = CURDATE()");
$dp = mysqli_fetch_assoc($pendapatan);

$transaksi = mysqli_query($koneksi,"SELECT COUNT(*) as total_transaksi
                                    FROM pesanan
                                    WHERE tgl_pesanan = CURDATE()");
$dt = mysqli_fetch_assoc($transaksi);

$menu = mysqli_query($koneksi,"SELECT COUNT(*) as total_menu
                              FROM menu");
$dm = mysqli_fetch_assoc($menu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Home</title>
</head>
<body class="bg-light">
  <div class="container mt-4">
    <div class="card shadow border-0 mb-4" style="border-radius:15px;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h3 class="card-title fw-bold">Hallooo, <?= $user['username'] ?></h3>
              <p class="card-text text-muted mt-3">
                Selamat bekerja dan semoga harimu menyenangkan<br>
                Tetap semangat melayani pelanggan<br>
                Semoga hari ini penjualan semakin ramai dan penuh cuan
                <p class="text-muted mb-2 fw-bold"><?= date('d F Y') ?></p>
              </p>
            </div>
            <img src="gambar/<?= $user['foto'] ?>" class="rounded-circle shadow"
                  style="width:200px; height:200px; object-fit:cover;">
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="card text h-100 shadow">
          <div class="card-body">
            <h5 class="card-title">Pendapatan Hari Ini</h5>
            <p class="card-text fs-3 fw-bold">Rp <?= number_format($dp['total_pendapatan']) ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card text h-100 shadow">
          <div class="card-body">
            <h5 class="card-title">Total Transaksi Hari Ini</h5>
            <p class="card-text fs-3 fw-bold"> <?= $dt['total_transaksi'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card text h-100 shadow">
          <div class="card-body">
            <h5 class="card-title">Total Menu</h5>
            <p class="card-text fs-3 fw-bold"> <?= $dm['total_menu'] ?> </p>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
</html>