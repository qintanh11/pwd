<?php
include 'koneksi.php';
session_start();
if(isset($_SESSION['error'])){
    unset($_SESSION['error']);
    header("Location: login.php");
}
if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $data = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$user' && password='$pass'");
    if(mysqli_num_rows($data)>0){
        $d = mysqli_fetch_array($data);
        $_SESSION['id_user']=$d['id_user'];
        $_SESSION['username']=$d['username'];
        header("location:dasbord.php");
    } else {
        $_SESSION['error'] = "kasir tidak terdaftar";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>login</title>

<style>
body{
    background: #F8F9FA;
    font-family: Arial, sans-serif;
}

.card{
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

h4{
    font-size: 35px;
    font-weight: bold;
}

h4 span{
    color: grey;
}

.form-control{
    border-radius: 12px;
    padding: 12px;
}

.form-control:focus{
    border-color: grey;
    box-shadow: 0 0 5px ;
}

.btn-primary{
    background: grey;
    border: none;
    border-radius: 12px;
    padding: 10px;
    font-weight: bold;
}

.btn-primary:hover{
    background: grey;
}
</style>

</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="card p-4 mx-auto" style="max-width:400px">
        <h4 class="text-center">ki<span>CUAN</span>mania</h4>

        <?php if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger" style="max-width:400px; padding:8px; font-size:14px;" role="alert">
        <?php echo $_SESSION['error']; ?>
        </div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button name="login" class="btn btn-primary w-100">Login</button>
        </form>
        </div>
    </div>
</body>
</html>