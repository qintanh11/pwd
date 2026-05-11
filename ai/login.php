<?php
include 'koneksi.php';
session_start();

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $data = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$u' AND password='$p'");
    if(mysqli_num_rows($data)>0){
        $d = mysqli_fetch_array($data);
        $_SESSION['id_user']=$d['id_user'];
        $_SESSION['username']=$d['username'];
        header("location:homepage.php");
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 mx-auto" style="max-width:400px">

<h4 class="text-center">Login</h4>

<form method="POST">
<input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button name="login" class="btn btn-primary w-100">Login</button>
</form>

</div>
</div>

</body>
</html>