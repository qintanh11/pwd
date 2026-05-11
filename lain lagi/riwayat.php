<?php
include 'koneksi.php';
if(!isset($_SESSION['id_user'])){
    header("location:login.php");
    exit();
}
$data= mysqli_query($koneksi, "SELECT tgl_pesanan, SUM(total) as total_harian
                                FROM pesanan 
                                GROUP BY tgl_pesanan 
                                ORDER BY tgl_pesanan DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Riwayat</title>
    <style>
    .container{
        padding: 20px;
        margin: 20px;
        display: auto;
    }
 
    .card:hover{
    transform: scale(1.04);
    transition: 0.2s;
    }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow">
            <table class = "table table-bordered table-hover">
                <tr>
                    <th>Tanggal</th>
                    <th>Total Pendapatan</th>
                    <th>Riwayat Detail</th>
                </tr>

                <?php while($d=mysqli_fetch_array($data)){ ?>

                <tr>
                    <td><?= $d['tgl_pesanan'] ?></td>
                    <td>Rp <?= number_format($d['total_harian']) ?></td>
                    <td>
                        <form action="detail.php" method="post">
                            <input type="hidden" name="tanggal" value="<?= $d['tgl_pesanan'] ?>">
                            <button type="submit" class="btn btn-sm btn-primary">Detail Transaksi</button>
                        </form>
                    </td>
                </tr>

                <?php } ?>
                
            </table>
        </div>
    </div>
</body>
</html>