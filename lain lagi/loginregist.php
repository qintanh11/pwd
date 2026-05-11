<?php
include 'koneksi.php';
session_start();
if(isset($_SESSION['alert'])){
    unset($_SESSION['alert']);
    header("Location: loginregist.php");
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: dasboard.php");
        exit();
    } else {
        $_SESSION['alert'] = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
        padding: 2px;
    }
    .container{
        width: 900px;
        min-height: 520px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        display: flex;
        overflow: hidden;
        position: relative;
    }
    #toggle{
        display: none;
    }
    .left{
        width: 52%;
        padding: 60px 50px;
        transition:  0.4s;
    }
    .left h2{
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 25px;
    }
    .input-vox{
        width: 100%;
        margin-bottom: 18px ;
    }
    .input-box label{
        font-size: 15px;
        font-weight: 600;
    }
    .input-box input{
        width: 100%;
        padding: 12px;
        margin-top: 16px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #bbb;
    }
    .btn{
        width: 100%;
        padding: 14px;
        background: black;
        color: white;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    .btn::after{
        background: #312f2f ;
    }
    .toggle-text{
        margin-top: 15px;
        font-size: 15px;
    }
    .toggle-text label{
        color: blue;
        cursor: pointer;
        font-weight: bold;
    }
    .right{
        width: 48%;
        background: black;
        color: white;
        padding: 90px 50px;
        clip-path: polygon(34% 0, 100% 0, 100% 100%, 0 100%);
    }
    .right-container{
        margin-left: 1000px;
        margin-top: 40px;
    }
    .right h1{
        font-size: 40px;
        font-weight: 1.3;
    }
    .right p{
        margin-top: 15px;
        opacity: 0.85;
    }
    .register-form{
        display: none;
    }
    #toggle:checked ~ .container .left .login-form{
        display: none;
    }
    #toggle:checked ~ .container .left .register-form{
        display: block;
    }

    @media (max-width: 750px) {
        .right-container{
            margin-left: 40px;
        }
    }    
</style>

</head>
<body>
<input type="checkbox" id="toggle">
<div class="container">
<div class="left">
    <div class="login-form">
        <h2>Login</h2>
        <div class="input-box">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan email">
        </div>
        <div class="input-box">
            <label for="pass">Password</label>
            <input type="password" placeholder="Masukkan password">
        </div>
        <button class="btn">Log in</button>
        <p class="toggle-text">
            belum punya akun? <label for="toggle">Daftar</label>
        </p>
    </div>
    <div class="register-form">
        <h2>Register</h2>
        <div class="input-box">
            <label for="usr">Username</label>
            <input type="text" placeholder="Masukkan username">
        </div>
        <div class="input-box">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan email">
        </div>
        <div class="input-box">
            <label for="pass">Password</label>
            <input type="password" placeholder="Masukkan password">
        </div>
        <button class="btn">Daftar</button>
        <p class="toggle-text">
            sudah punya akun? <label for="toggle">Login</label>
        </p>
    </div>
        <div class="right">
            <div class="right-container">
                <h1>WELCOME <br>
                    BACK!</h1>
                    <p></p>
            </div>
        </div>
</div>
</div>
</body>
</html>