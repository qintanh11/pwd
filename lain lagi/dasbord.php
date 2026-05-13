<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginregist.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dasboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<style>
body {
    background-color: #f0f4f0; /* Hijau pucat biar adem */
    font-family: 'Poppins', sans-serif;
    color: #333;
}


.navbar , nav{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    margin: 0;
    background: #4b3621 !important; /* Cokelat Kayu Tua */
    border-bottom: 3px solid #f1c40f;
}
.navbar-brand {
    font-weight: bold;
    -webkit-text-stroke: 1px white;
    text-transform: uppercase;
    letter-spacing: 2px;
    -webkit-text-stroke: 0px !important; /* Bersihkan stroke lama */
    color: white !important;
    font-family: 'Poppins', sans-serif;
    font-weight: 800 !important;
    color: #f1c40f !important;
    text-shadow: 2px 2px 0px #000;
}
.menu{
    position: fixed;
    top: 50px;
    left: 0;
    width: 220px;
    height: 100vh;
    padding-top: 20px;
    background: #3d2b1f; /* Lebih gelap dari navbar */
    border-right: 2px solid #2d5a27;
}

.menu ul{
    list-style: none;
    padding: 0;
}

.btn-menu{
    width: 100%;
    padding: 15px;
    border: none;
    background: transparent;
    color: white;
    text-align: left;
    cursor: pointer;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    transition: 0.3s;
}
.btn-menu:hover{
    background: #2d5a27 !important; /* Berubah jadi hijau saat hover */
    padding-left: 25px;
}
.konten{
    margin-left: 220px;
    margin-right: 300px;
}

.floating-cart{
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: 0.3s;
    background: #f1c40f !important;
    color: #4b3621 !important;
    border: 2px solid #4b3621;
}
.btn-primary {
    background: #2d5a27;
    border: none;
}

.btn-primary:hover {
    background: #1e3d1a;
}

.btn-success {
    background: #f1c40f;
    border: none;
    color: #4b3621;
    font-weight: bold;
}

.btn-success:hover {
    background: #d4ac0d;
    color: #000;
}
.floating-cart:hover{
    transform: scale(1.1);
    background: #0b5ed7;
}
#home:checked ~ .konten .home{
    display: block;
}

#home:checked ~ .konten .pesanan,
#home:checked ~ .konten .riwayat{
    display: none;
}
#pesanan:checked ~ .konten .pesanan{
    display: block;
}

#pesanan:checked ~ .konten .home,
#pesanan:checked ~ .konten .riwayat{
    display: none;
}
#riwayat:checked ~ .konten .riwayat{
    display: block;
}

#riwayat:checked ~ .konten .pesanan,
#riwayat:checked ~ .konten .home{
    display: none;
}
#cart:checked ~ .cart{
    display: none;
}
/* content default */
.konten{
    margin-left: 220px;
    padding: 20px 20px 20px;
    transition: 0.3s;
}

</style>
</head>
<body>
<input type="radio" id="home" name="menu" checked>
<input type="radio" id="pesanan" name="menu">
<input type="radio" id="riwayat" name="menu">
<input type="checkbox" id="cart" name="keranjang"checked>
<nav class="navbar nav fixed-top">
<div class="navbar">    

  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://i.pinimg.com/736x/31/50/7a/31507a21a55ff88f5525b141cbfd2027.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Kicuan mania
    </a>
  </div>
</div>

</nav>
<div class="menu">
    <ul>
        <li><label for="home" class="btn-menu">Home</label></li>
        <li><label for="pesanan" class="btn-menu">Pesanan</label></li>
        <li><label for="riwayat" class="btn-menu">Riwayat</label></li>
        <li><label class="btn-menu"><a href="logout.php" style="color: white; text-decoration: none; ">Log Out</a></label></li>
    </ul>
</div>
<div class="konten">
<div class="home">
<?php include 'home.php'; ?>
</div>
<div class="pesanan">
<?php include 'pesanan.php'; ?>
<label for="cart" class="floating-cart">
    <i class="bi bi-cart4"></i>
</label>
</div>    
<div class="riwayat">
<?php include 'riwayat.php'?>
</div>
</div>
<div class="cart">
<?php include 'keranjang.php'; ?>
</div>

<script>

let cart = [];

function tambah(id,nama,harga){
    let item = cart.find(i => i.id == id);
    if(item){
        item.qty++;
    }else{
        cart.push({
            id:id,
            nama:nama,
            harga:harga,
            qty:1
        });
    }
    render();
}

function kurang(id){
    let item = cart.find(i => i.id == id);
    if(item){
        item.qty--;
        if(item.qty <= 0){
            cart = cart.filter(i => i.id != id);
        }
    }
    render();
}

function render(){

    let html = "";
    let total = 0;
    let jumlah = 0;

    if(cart.length == 0){
        html = `<p class="text-muted">
        Belum ada pesanan
        </p>`;
    }else{

        cart.forEach(item => {
            total += item.harga * item.qty;
            jumlah += item.qty;
        html += `
            <div class="border-bottom pb-2 mb-2">
                <b>${item.nama}</b><br>
                ${item.qty} x Rp ${item.harga}
                <div class="mt-1">
                    <button
                    class="btn btn-sm btn-danger"
                    onclick="kurang(${item.id})">
                        -
                    </button>
                    <span class="mx-2">
                        ${item.qty}
                    </span>
                    <button
                    class="btn btn-sm btn-success"
                    onclick="tambah(${item.id}, '${item.nama}', ${item.harga} )">
                        +
                    </button>
                </div>
            </div>
            `;
        });
    }

    document.getElementById("list-cart")
    .innerHTML = html;

    document.getElementById("totalItem")
    .innerText = jumlah + " items";

    document.getElementById("totalHarga")
    .innerText = "Rp " + total.toLocaleString();
}

function kirimCart(){
    if(cart.length == 0){
        alert("Keranjang kosong!");
        return false;
    }
    document.getElementById("cartInput").value =
    JSON.stringify(cart);
    return true;
}
</script>
</body> 
</html>
