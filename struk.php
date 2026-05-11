<?php
include 'koneksi.php';
session_start();
$_SESSION['riwayat'] = $_GET['id_riwayat'];
$riwayat = $_SESSION['riwayat'];
$query = $koneksi -> query("select*from riwayat 
inner join transaksi on riwayat.id_transaksi = transaksi.id_transaksi
inner join pesanan on transaksi.id_pesanan = pesanan.id_pesanan 
inner join menu on pesanan.id_menu = menu.id_menu
inner join kategori on menu.id_kategori = kategori.id_kategori 
where id_riwayat = '$riwayat' ");

$struk = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>
<tr>
    <td>no transaksi</td><td>:</td><td><?= $struk['id_transaksi']; ?></td>
</tr>
<tr>
    <td>tanggal</td><td>:</td><td><?= $struk['tanggal']; ?></td>
</tr>
<tr>
    <td></td>
</tr>

</table>
    
</body>
</html>