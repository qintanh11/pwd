<?php  
include 'koneksi.php';
session_start();

$query=$koneksi -> query("select*from menu inner join kategori on menu.id_kategori = kategori.id_kategori");

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
    <link rel="stylesheet" href="style.css">
</head>
<body>  
<nav>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">riwayat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">?</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">?</a>
  </li>
  <a class="d-flex align-items-center ms-auto m-0" href="checkout.php">
    <i class="bi bi-cart4"></i>
  </a>
</ul>

</nav>    
<div class="container">
    <div class="menu">
        <form action="checkout.php">
        <div class="row">

        <?php while($tambah_pesan = mysqli_fetch_assoc($query)){ ?>
            <div class="col-6">
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $tambah_pesan['nama_menu']; ?></h5>
                <p class="card-text"><?= $tambah_pesan['kategori']; ?></p>
                <?php 
                $qyt['id_menu'] = isset($_SESSION['qyt']['id_menu']);

                ?>

                <?php 
                $id_makan= $tambah_pesan['id_menu'];
                $jumlah_pesan= isset($_SESSION['keranjang']['id_makan']);
                if(isset($_SESSION['keranjang'][$tambah_pesan['id_menu']])) {
                $jumlah[$tambah_pesan['id_menu']] = $_SESSION['keranjang'][$tambah_pesan['id_menu']]; }
                else{ $jumlah[$tambah_pesan['id_menu']]=0;} 
                ?>          
                <div class="input-group">
              <p onclick="tambah_qyt(<?= $tambah_pesan['id_menu']; ?>)">
                <i class="bi bi-plus"></i></p>
              
              
                <p id="jumlah" >tambah menu</p>
              <p><i class="bi bi-dash"></i></p>
                </div>
                
            </div>
            </div>
          </div>
        </div>
      </div>
        <?php } ?>
            
        </div>
    </form>
    </div>
</div>
</body>
</html>

<script>
  function tambah_qyt(id){
let item=cart.find(qyt=>qyt.id===Number(id));
if(item){
    item.qty++;
}else{
    cart.push({id,qty:1});
  }
}
html += `
<div class="d-flex justify-content-between mb-2 border-bottom pb-2">
<div>
<b>${item.id}</b><br>
<small>${item.qty}</small>
</div>



</div>
`;
</script>