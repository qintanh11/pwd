<?php
session_start();
if(!isset($_SESSION['id_user'])){ header("location:login.php"); }

include 'koneksi.php';

$data = mysqli_query($koneksi,"
SELECT pesanan.*, user.username
FROM pesanan
LEFT JOIN user ON pesanan.id_user=user.id_user
ORDER BY id_pesanan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
<div class="card p-4">

<h4>Riwayat Transaksi</h4>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Tanggal</th>
<th>Kasir</th>
<th>Total</th>
<th>Bayar</th>
<th>Aksi</th>
</tr>

<?php while($d=mysqli_fetch_array($data)){ ?>
<tr>
<td><?= $d['id_pesanan'] ?></td>
<td><?= $d['tgl_pesanan'] ?></td>
<td><?= $d['username'] ?></td>
<td>Rp <?= number_format($d['total']) ?></td>
<td>Rp <?= number_format($d['bayar']) ?></td>
<td>
<a href="struk.php?id=<?= $d['id_pesanan'] ?>" class="btn btn-sm btn-primary">Struk</a>
</td>
</tr>
<?php } ?>

</table>

<a href="homepage.php" class="btn btn-success">Kembali</a>

</div>
</div>

</body>
</html>