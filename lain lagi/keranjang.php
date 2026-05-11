<?php
include 'koneksi.php';


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
.cart-sidebar{
    position: fixed;

    top: 56px; /* tinggi navbar */
    right: 0;

    width: 300px;
    height: calc(100vh - 56px);

    background: white;
    border-left: 1px solid #ddd;

    padding: 20px;

    overflow-y: auto;
}
.ul{
    padding-bottom: 20px ;
}
</style>
</head>
<body>
<div class="cart-sidebar">
<ul class="list-group list-group-flush">
    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){ 

    foreach($_SESSION['cart'] as $id => $qty){  ?>
        
        <li class="list-group-item">
            <?php
        echo "ID Menu : ".$id;
        echo " Quantity : ".$qty;
        echo "<br>";
        $_SESSION['cart'][$id] = $qty;
        $_SESSION['id_menu'] = $id;

    }
?>
        
        </li>
    <?php   } else{ ?>
        <div id="keranjang">
            <p class="text-muted">Belum ada pesanan</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <span id="totalItem">0 items</span>
            <b id="totalHarga">Rp 0</b>
        </div>
    <?php } ?>
    <form action="checkout.php" method="post" ">
        <button type="submit" class="btn btn-primary w-100 mt-3" id="btn-pesan">Pesan</button>
    <input type="hidden" name="cart" id="cartInput">
    </form>
</ul>

</div>
</body>
</html>

