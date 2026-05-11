<?php
session_start();
if(!isset($_SESSION['id_user'])){ header("location:login.php"); }

include 'koneksi.php';

$data = mysqli_query($koneksi,"
SELECT menu.*, kategori.nama_kategori 
FROM menu 
JOIN kategori ON menu.id_kategori = kategori.id_kategori
");

$kategori=[];
while($d=mysqli_fetch_array($data)){
    $kategori[$d['nama_kategori']][]=$d;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Kasir</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid">
<div class="row">

<!-- ================= MENU ================= -->
<div class="col-md-9 p-4">

<h4 class="mb-3">Menu</h4>

<?php foreach($kategori as $kat=>$items){ ?>
<h5 class="mt-4 text-capitalize"><?= $kat ?></h5>

<div class="row">
<?php foreach($items as $d){ ?>
<div class="col-md-3 mb-3">

<div class="card shadow-sm text-center"
onclick="tambah(<?= $d['id_menu'] ?>,'<?= $d['nama_menu'] ?>',<?= $d['harga'] ?>)"
style="cursor:pointer;">

<div class="card-body">

<img src="gambar/<?= $d['foto'] ?>" width="90" class="mb-2">

<h6><?= $d['nama_menu'] ?></h6>
<p class="text-primary mb-0">Rp <?= number_format($d['harga']) ?></p>

</div>
</div>

</div>
<?php } ?>
</div>
<?php } ?>

</div>

<!-- ================= CART ================= -->
<div class="col-md-3 bg-white p-3 border-start">

<h5>Order</h5>
<hr>

<div id="keranjang">
<p class="text-muted">Belum ada pesanan</p>
</div>

<hr>

<div class="d-flex justify-content-between">
<span id="totalItem">0 items</span>
<b id="totalHarga">Rp 0</b>
</div>

<form action="checkout.php" method="POST" onsubmit="return kirimCart()">
<input type="hidden" name="cart" id="cartInput">

<button class="btn btn-success w-100 mt-3">
    Order Sekarang
</button>
</form>

<a href="riwayat.php" class="btn btn-dark w-100 mt-2">Riwayat</a>
<a href="logout.php" class="btn btn-danger w-100 mt-2">Logout</a>

</div>

</div>
</div>

<!-- ================= JS ================= -->
<script>
let cart=[];

function tambah(id,nama,harga){
let item=cart.find(i=>i.id===Number(id));

if(item){
    item.qty++;
}else{
    cart.push({id,nama,harga,qty:1});
}

render();
}

function kurang(id){
let item=cart.find(i=>i.id==id);

if(item){
    item.qty--;
    if(item.qty<=0){
        cart=cart.filter(i=>i.id!=id);
    }
   
}

render();
}


function render(){
let html="";
let total=0;
let jumlah=0;

if(cart.length==0){
    html=`<p class="text-muted">Belum ada pesanan</p>`;
}else{

cart.forEach(item=>{
total += item.harga * item.qty;
jumlah += item.qty;

html += `
<div class="d-flex justify-content-between mb-2 border-bottom pb-2">

<div>
<b>${item.nama}</b><br>
<small>${item.qty} x Rp ${item.harga}</small>
</div>

<div>
<button class="btn btn-sm btn-danger" onclick="kurang(${item.id})">-</button>
<span class="mx-2">${item.qty}</span>
<button class="btn btn-sm btn-success" onclick="tambah(${item.id},'${item.nama}',${item.harga})">+</button>
</div>

</div>
`;
});

}

document.getElementById("keranjang").innerHTML=html;
document.getElementById("totalItem").innerText=jumlah+" items";
document.getElementById("totalHarga").innerText="Rp "+total.toLocaleString();

document.getElementById("btn-pesan").disabled = cart.length === 0;
}

function kirimCart(){
if(cart.length==0){
    alert("Keranjang kosong!");
    return false;
}
document.getElementById("cartInput").value=JSON.stringify(cart);
return true;
}
render();
</script>

</body>
</html>
