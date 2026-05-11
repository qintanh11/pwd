<?php
session_start();
if(!isset($_SESSION['id_user'])){
    header("location:login.php");
}
include 'koneksi.php';

$tgl_pesanan = $_POST['tanggal'];

$data = mysqli_query($koneksi, "SELECT pesanan.*, user.username
                                FROM pesanan
                                LEFT JOIN user ON pesanan.id_user=user.id_user
                                WHERE tgl_pesanan='$tgl_pesanan'
                                ORDER BY id_pesanan DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Detail Transaksi</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h4>Detail Transaksi</h4>
            <p class="text-muted">Tanggal Transaksi: <?= $tgl_pesanan ?></p>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Struk</th>
                </tr>

                <?php while($d=mysqli_fetch_array($data)){?>

                <tr>
                    <td><?= $d['id_pesanan'] ?></td>
                    <td><?= $d['username'] ?></td>
                    <td>Rp <?= number_format($d['total']) ?></td>
                    <td>Rp <?= number_format($d['bayar']) ?></td>
                    <td>Rp <?= number_format($d['bayar'] - $d['total']) ?></td>
                    <td>
                        <form action="struk.php" method="get">
                            <input type="hidden" name="id" value="<?= $d['id_pesanan'] ?>">
                            <button type="submit" class="btn btn-sm btn-primary">Detail Transaksi</button>
                        </form>                   
                     </td>
                </tr>

                <?php } ?>

            </table>
            <a href="dasbord.php" class="btn btn-success">Kembali</a>
        </div>
    </div>
</body>
</html>