<?php
session_start();
$data_kasir = [
    ["username" => "qintan", "password" => "118"],
    ["username" => "dena", "password" => "121"],
    ["username" => "qina", "password" => "118121"]
];

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_berhasil = false;

    foreach($data_kasir as $kasir){
        if($username == $kasir['username'] && $password == $kasir['password']){
            $_SESSION['status'] = "login";
            $_SESSION['username'] = $username;
            $login_berhasil = true;
            header("location:homepage.php");
            exit();
        }
    }
        $error = "Username atau password salah!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card" style="width: 30rem; border-radius: 15px">
  <div class="card-body">
    <h1 class="card-title">Walcome back!</h1>
    <h2 class="card-subtitle mb-2 text-body-secondary">Log in</h2>

    <?php if(isset($error)){ ?>
        <div class="alert alert-danger py-1 mb-2"><?php echo $error; ?></div>
    <?php } ?>

    <form action="" method="POST">
    <div class="mb-3">
        <label for="usn" class="form-label">Username :</label>
        <input type="text" name="username" class="form-control" id="usn" placeholder="Username" required>
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password :</label>
        <input type="password" name="password" class="form-control" id="pass" placeholder="Password" required>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary" type="submit" name="login">Log in</button>
    </div>
    </form>
  </div>
        </div>
    </div>
</body>
</html>