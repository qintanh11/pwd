<?php
include 'koneksi.php';
session_start();
$query=$koneksi -> query("select*from riwayat inner join transaksi on riwayat.id_transaksi = transaksi.id_transaksi");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
</head>
<body>
    <table>
<ul class="list-group list-group-flush">
<?php while($riwayat = mysqli_fetch_assoc($query)){ ?>
<tr>
    <td><a href="struk.php">
    <li class="list-group-item" id="pesanan<?= $i; ?>">
    <label for="pesanan<?= $i; ?>"> <?= $riwayat['id_riwayat']; ?></label>
    </li>
    </a></td>
    <td align="center">
        <?= $riwayat['tanggal']; ?>
    </td>
    <td>
        <?= $riwayat['total_harga']; ?>
    </td>

</tr>
<?php } ?>
</ul>
</table>
</body>
</html>