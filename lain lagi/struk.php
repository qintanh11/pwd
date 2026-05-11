<?php
session_start();
if(!isset($_SESSION['id_user'])){ 
    header("location:login.php");
    exit(); }

include 'koneksi.php';

$id = $_GET['id'];

$pesanan = mysqli_fetch_array(mysqli_query($koneksi,"
SELECT * FROM pesanan WHERE id_pesanan='$id'
"));

$detail = mysqli_query($koneksi,"
SELECT transaksi.*, menu.nama_menu, menu.harga
FROM transaksi
JOIN menu ON transaksi.id_menu = menu.id_menu
WHERE transaksi.id_pesanan='$id'
");

$total = 0;
$data = [];

while($d=mysqli_fetch_array($detail)){
    $total += $d['harga']*$d['qty'];
    $data[]=$d;
}

$bayar = $pesanan['bayar'];
$kembali = $bayar - $total;
?>

<!DOCTYPE html>
<html>
<head>
<title>Struk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.btn-primary {
    background: #2d5a27;
    border: none;
}

.btn-primary:hover {
    background: #1e3d1a;
}

.btn-success {
    background: #f1c40f;
    border: none;
    color: #4b3621;
    font-weight: bold;
}

.btn-success:hover {
    background: #d4ac0d;
    color: #000;
}
</style>
</head>

<body>

<div class="container mt-5">
<div class="card p-4 mx-auto" style="max-width:400px">

<h5 class="text-center">STRUK</h5>
<hr>

<p>ID: <?= $id ?><br>
Tanggal: <?= $pesanan['tgl_pesanan'] ?></p>

<table class="table table-sm">
<tr><th>Menu</th><th>Qty</th><th>Sub</th></tr>

<?php foreach($data as $d){ ?>
<tr>
<td><?= $d['nama_menu'] ?></td>
<td><?= $d['qty'] ?></td>
<td>Rp <?= number_format($d['harga']*$d['qty']) ?></td>
</tr>
<?php } ?>

</table>

<hr>

<p>
Total: Rp <?= number_format($total) ?><br>
Bayar: Rp <?= number_format($bayar) ?><br>
Kembalian: Rp <?= number_format($kembali) ?>
</p>

<button onclick="window.print()" class="btn btn-success w-100">Print</button>
<a href="dasbord.php" class="btn btn-primary w-100 mt-2">Kasir</a>

</div>
</div>

</body>
</html>