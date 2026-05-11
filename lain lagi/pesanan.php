<?php
include 'koneksi.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_menu = $_POST['id_menu'];
    $_SESSION['qyt'][$id_menu] = $id_menu;
}
// if (!isset($_SESSION['username'])) {
//     header("Location: loginregist.php");
//     exit();
// }
$makanan = $koneksi -> query("SELECT * FROM menu where id_kategori = 1");
$minuman = $koneksi -> query("SELECT * FROM menu where id_kategori = 2");
$snack = $koneksi -> query("SELECT * FROM menu where id_kategori = 3");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_menu = $_POST['id_menu'];
    if(isset($_SESSION['cart'][$id_menu])){
        $_SESSION['cart'][$id_menu]++;
    }else{
        $_SESSION['cart'][$id_menu] = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
    .menu-box{
        padding: 20px;
        margin: 20px;
        display: auto;
    }
    .menu-box-kategori{
        display: flex;
        flex-wrap: wrap;
    }
    .card{
        margin: 10px;
    }
    .card:hover{
    transform: scale(1.04);
    transition: 0.2s;
}
    .floating-cart{
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: orange;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    z-index: 999;
}
.floating-cart:hover{
    transform: scale(1.1);
    transition: 0.2s;
}
</style>
</head>
<body>
<div class="menu-box">
    <!-- Menu dengan kategori makanan -->
    <h3>Makanan</h3>
    <div class="menu-box-kategori">
    <?php while($pesan = mysqli_fetch_assoc($makanan)){ ?>
    <div class="card shadow-sm text-center"
onclick="tambah(
<?= $pesan['id_menu'] ?>,
'<?= $pesan['nama_menu'] ?>',
<?= $pesan['harga'] ?>
)"
style="cursor:pointer;">
    <div class="card" style="width: 13rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text">
          <?= $pesan['nama_menu']; ?>  <br>
           Rp. <?= $pesan['harga']; ?> 
        </p>
    </div>
    </div>
    </div>
    </div>
    <?php } ?>
    </div>
    <!-- Menu dengan kategori minuman -->
     <h3>Minuman</h3>
    <div class="menu-box-kategori">
    <?php while($pesan = mysqli_fetch_assoc($minuman)){ ?>
    <div class="card shadow-sm text-center"
onclick="tambah(
<?= $pesan['id_menu'] ?>,
'<?= $pesan['nama_menu'] ?>',
<?= $pesan['harga'] ?>
)"
style="cursor:pointer;">
<div class="card shadow-sm text-center"
style="cursor:pointer;">
    <div class="card" style="width: 13rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text">
          <?= $pesan['nama_menu']; ?>  <br>
           Rp. <?= $pesan['harga']; ?> 
        </p>
    </div>
    </div>
    </div>
    </div>
    <?php }    ?>
    </div>
    <!-- Menu dengan kategori snack -->
     <h3>snack</h3>
     <div class="menu-box-kategori">
    <?php while($pesan = mysqli_fetch_assoc($snack)){ ?>
   <div class="card shadow-sm text-center"
onclick="tambah(
<?= $pesan['id_menu'] ?>,
'<?= $pesan['nama_menu'] ?>',
<?= $pesan['harga'] ?>
)"
style="cursor:pointer;">
    <div class="card" style="width: 13rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text">
          <?= $pesan['nama_menu']; ?>  <br>
           Rp. <?= $pesan['harga']; ?> 
        </p>
    </div>
    </div>
    </div>
     </div>
    <?php } ?>
     </div>
     <label for="open-cart" class="floating-cart">
    <div>
        <i class="bi bi-cart4"></i>
    </div>  
</label>
</div>


</body>
</html>