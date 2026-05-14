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
    /* background: url("poto_kicau.jpeg"); */
    font-family: Arial, sans-serif;
    background-size: cover;       /* bikin full */
    background-position: center;   /* posisi tengah */
    background-repeat: no-repeat;  /* tidak diulang */
}

.card{
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    background: rgba(255, 255, 255, 0.9);
    border-top: 5px solid #2d5a27;
}

h4{
    font-size: 35px;
    font-weight: bold;
    color: #4b3621;
}

h4 span{
    color: grey;
    color: #f1c40f; 
    text-shadow: 1px 1px 1px #000;
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
    background: #2d5a27;
    border: none;
    border-radius: 12px;
    padding: 10px;
    font-weight: bold;
}

.btn-primary:hover{
    background: grey;
}
.video-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
}
/* INTRO SCREEN */
#intro {
    position: fixed;
    width: 100%;
    height: 100%;
    background: url("https://i.pinimg.com/736x/d7/dd/b8/d7ddb842996bc660c24e916a98c0751c.jpg");
     background-size: cover;       /* ini yang bikin full */
    background-position: center;   /* posisi tengah */
    background-repeat: no-repeat;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: transform 1s ease;
    z-index: 10;
}

/* ANIMASI NAIK KE ATAS */
#intro.hide {
    transform: translateY(-100%);
}
</style>

</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100" onclick="playSound()">
<!-- <div id="intro" onclick="start()">
    <div class="card">
  <div class="card-body">
    klik dimana aja untuk masuk kak :>
  </div>
    </div>
</div>
<video autoplay muted loop class="video-bg">
    <source src="pideo-kicau.mp4" type="video/mp4">
</video>
    <audio id="bgSound">
    <source src="dj-kicau-mania.mp3" type="audio/mpeg">
</audio>

<script>
function playSound(){
    document.getElementById("bgSound").play();
}

function start(){
    document.getElementById("intro").classList.add("hide");
}
</script> -->


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