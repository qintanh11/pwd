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
    padding: 20px;
    overflow-y: auto;
    background: #ffffff;
    border-left: 4px solid #2d5a27;
}
#list-cart b {
    color: #2d5a27;
}
.ul{
    padding-bottom: 20px ;
}
#totalItem {
    background: #f1c40f;
    padding: 2px 10px;
    border-radius: 20px;
    font-weight: bold;
    color: #4b3621;
}
</style>
</head>
<body>
<div class="cart-sidebar">
<ul class="list-group list-group-flush">
    <div id="list-cart">

<p class="text-muted">
Belum ada pesanan
</p>

</div>

<hr>

<div class="d-flex justify-content-between">

<span id="totalItem">
0 items
</span>

<b id="totalHarga">
Rp 0
</b>

</div>

<form action="checkout.php"
method="post"
onsubmit="return kirimCart()">

<input type="hidden"
name="cart"
id="cartInput">

<button type="submit"
class="btn btn-primary w-100 mt-3">

Pesan

</button>

</form>
</ul>

</div>
</body>
</html>

