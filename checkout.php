<?php 
session_start();
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $_SESSION['keranjang'][$id] = $qty; // Simpan ke dalam array session
}
include 'koneksi.php';
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
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-start gap-2">
    <a class="navbar-brand" href="homepage.php">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="mb-0" >Pesanan</h4>
  </div>
</nav>
<div class="container">
<?php
echo "<h1>Ringkasan Pesanan</h1>";

if(isset($_SESSION['keranjang'])) {
    foreach($_SESSION['keranjang'] as $id => $jumlah) {
        if($jumlah > 0) {
            echo "Menu ID: $id - Jumlah: $jumlah <br>";
        }
    }
}
?>

</div>    
</body>
</html>