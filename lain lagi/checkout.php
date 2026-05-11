<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: loginregist.php");
//     exit();
// }
include 'koneksi.php';

// if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
//     die("Keranjang kosong");
// }

$total = 0;
$id=$_SESSION['id_menu'];
while($qty = $_SESSION['cart'][$id]){

    $menu = mysqli_query($koneksi,
        "SELECT * FROM menu WHERE id_menu='$id'"
    );

    $data = mysqli_fetch_assoc($menu);

    $subtotal = $data['harga'] * $qty;

    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
<div class="card p-4">

<h4>Checkout</h4>
<hr>

<form method="POST">

<table class="table">
<tr>
<th>Menu</th>
<th>Qty</th>
<th>Subtotal</th>
</tr>

<?php foreach($_SESSION['cart'] as $id => $qty){ 
    $menu = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu='$id'");
    $c = mysqli_fetch_assoc($menu);
?>
<tr>
<td><?= $c['nama'] ?></td>
<td><?= $qty ?></td>
<td>Rp <?= number_format($c['harga'] * $qty) ?></td>
</tr>

<input type="hidden" name="id_menu[]" value="<?= $c['id'] ?>">
<input type="hidden" name="qty[]" value="<?= $qty ?>">
<?php } ?>

</table>

<h5>Total: Rp <?= number_format($total) ?></h5>
<input type="hidden" name="total" value="<?= $total ?>">

<div class="mb-3">
<label>Uang Bayar</label>
<input type="number" name="bayar" id="bayar" class="form-control" oninput="hitung()" required>
</div>

<div class="mb-3">
<label>Kembalian</label>
<input type="text" id="kembali" class="form-control" readonly>
</div>

<button name="bayar_btn" class="btn btn-success w-100">Cetak Struk</button>

</form>

</div>
</div>

<script>
function hitung(){
let total = <?= $total ?>;
let bayar = document.getElementById("bayar").value;
let kembali = bayar - total;

if(bayar==""){
    document.getElementById("kembali").value="";
}else if(kembali<0){
    document.getElementById("kembali").value="Kurang!";
}else{
    document.getElementById("kembali").value="Rp "+kembali.toLocaleString();
}
}
</script>

</body>
</html>

<?php
if(isset($_POST['bayar_btn'])){
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $tgl = date("Y-m-d H:i:s");
    $user = $koneksi -> query("SELECT id_user FROM user WHERE username='".$_SESSION['username']."'")->fetch_assoc()['id_user'];

    if($bayar < $total){
        echo "<script>alert('Uang kurang!');history.back();</script>";
        exit;
    }

    // simpan pesanan
    mysqli_query($koneksi,"
    INSERT INTO pesanan (id_user,tgl_pesanan,total,bayar)
    VALUES ('$user','$tgl','$total','$bayar')
    ");

    $id_pesanan = mysqli_insert_id($koneksi);

    // simpan transaksi
    $id_menu = $_POST['id_menu'];
    $qty = $_POST['qty'];

    for($i=0;$i<count($id_menu);$i++){
        mysqli_query($koneksi,"
        INSERT INTO transaksi (id_pesanan,id_menu,qty)
        VALUES ('$id_pesanan','$id_menu[$i]','$qty[$i]')
        ");
    }

    echo "<script>window.location='struk.php?id=$id_pesanan';</script>";
}
?>