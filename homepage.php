<?php  
session_start();

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
        <form action="checkout.php" method="post">
        <div class="row">
        <?php for($i=0;$i<10;$i++){ 
            $jumlah[$i] = 0;
            } ?>
        <?php for($i=0;$i<10;$i++){ ?>
            <div class="col-6">
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <?php 
                if(isset($_SESSION['keranjang'][$i])) {
                $jumlah[$i] = $_SESSION['keranjang'][$i]; } ?>
                
               
                <div class="input-group">
                <input type="button" class="btn btn-primary" onclick="kurangi(<?php echo $i; ?>)" placeholder="-"></input>
                <input type="number" class="form-control text-center" min="0" value="<?php echo $jumlah[$i]; ?>" id="qty-<?php echo $i; ?>">
                <input type="button" class="btn btn-primary" onclick="tambah(<?php echo $i; ?>)" placeholder="+"></input>
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
    function updateSession(id, qty) {
    // Kirim data ke file PHP lain untuk disimpan di SESSION
    fetch('checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&qty=${qty}`
    });
}

function tambah(id) {
    let input = document.getElementById('qty-' + id);
    input.value = parseInt(input.value) + 1;
    updateSession(id, input.value); // Simpan ke session
}

function kurangi(id) {
    let input = document.getElementById('qty-' + id);
    if (input.value > 0) {
        input.value = parseInt(input.value) - 1;
        updateSession(id, input.value); // Simpan ke session
    }
    // ... sisa logika kurangi kamu ...
}
</script>