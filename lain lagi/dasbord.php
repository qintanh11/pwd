<?php
include 'koneksi.php';
session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: loginregist.php");
//     exit();
// }
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
.navbar{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    margin: 0;
}
.menu{
    position: fixed;
    top: 50px;
    left: 0;

    width: 220px;
    height: 100vh;

    background: #2c3e50;
    padding-top: 20px;
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
}
.btn-menu:hover{
    background: #34495e;
}
.konten{
    margin-left: 220px;
    margin-right: 300px;
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
#open-cart:checked ~ .konten .keranjang{
    display: block;
}
/* saat cart aktif */
#open-cart:checked ~ .cart-keranjang{
    right: 0;
}

/* content default */
.konten{
    margin-left: 220px;
    padding: 20px 20px 20px;
    transition: 0.3s;
}

/* saat cart aktif */
#open-cart:checked ~ .konten{
    margin-right: 20px;
}
</style>
</head>
<body>
<input type="radio" id="home" name="menu" checked>
<input type="radio" id="pesanan" name="menu">
<input type="radio" id="riwayat" name="menu">
<input type="checkbox" id="open-cart">
<div class="navbar">    
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Bootstrap
    </a>
  </div>
</nav>
</div>
<div class="menu">
    <ul>
        <li><label for="home" class="btn-menu">Home</label></li>
        <li><label for="pesanan" class="btn-menu">Pesanan</label></li>
        <li><label for="riwayat" class="btn-menu">Riwayat</label></li>
    </ul>
</div>
<div class="konten">
<div class="home">
<?php include 'home.php'; ?>
</div>
<div class="pesanan">
<?php include 'pesanan.php'; ?>
</div>    
<div class="riwayat">
<?php include 'riwayat.php'?>
</div>
<div class="keranjang">
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

    document.getElementById("keranjang")
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
