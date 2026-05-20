<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: login.php");
}

$panel = "Öğrenci Paneli";

if(isset($_SESSION['role'])){

    if($_SESSION['role'] == 'admin'){
        $panel = "Admin Paneli";
    }

}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>StudyMatch</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.logo{
    width:180px;
}

.navbar-box{
    background:white;
    border-bottom:1px solid #ddd;
    padding:15px 40px;
}

.menu-link{
    text-decoration:none;
    color:black;
    margin-left:20px;
    font-weight:500;
}

.menu-link:hover{
    color:#1db954;
}

.main-box{
    background:white;
    border:1px solid #ddd;
    border-radius:10px;
    padding:40px;
    margin-top:40px;
}

.green-btn{
    background:#1db954;
    border:none;
    padding:12px 25px;
}

.green-btn:hover{
    background:#18a64a;
}

.panel-text{
    color:#1db954;
    font-weight:600;
    font-size:18px;
}

.info-box{
    background:#f8f9fa;
    border-radius:8px;
    padding:15px;
    margin-top:20px;
}
.switch{
    position:relative;
    display:inline-block;
    width:55px;
    height:28px;
}

.switch input{
    opacity:0;
    width:0;
    height:0;
}

.slider{
    position:absolute;
    cursor:pointer;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background:#ccc;
    transition:.4s;
    border-radius:34px;
}

.slider:before{
    position:absolute;
    content:"";
    height:20px;
    width:20px;
    left:4px;
    bottom:4px;
    background:white;
    transition:.4s;
    border-radius:50%;
}

input:checked + .slider{
    background:#1db954;
}

input:checked + .slider:before{
    transform:translateX(26px);
}

.dark-mode{
    background:#121212 !important;
    color:white;
}

.dark-mode .navbar-box,
.dark-mode .main-box{
    background:#1e1e1e;
    border-color:#333;
}

.dark-mode .menu-link{
    color:white;
}
.dark-mode p,
.dark-mode h1,
.dark-mode h2,
.dark-mode h3,
.dark-mode h4,
.dark-mode h5,
.dark-mode span,
.dark-mode b,
.dark-mode label{
    color:white !important;
}

.dark-mode .panel-text{
    color:#1db954 !important;
}

.dark-mode .info-box{
    background:#2b2b2b;
    color:white;
}

.dark-mode .alert{
    color:white;
}
</style>

</head>

<body>

<div class="navbar-box d-flex justify-content-between align-items-center">

<div>

<a href="index.php">

<img src="images/logo.jpg"
class="logo">

</a>

</div>

<div>

<a href="my_courses.php" class="menu-link">
Derslerim
</a>

<a href="add_course.php" class="menu-link">
Ders Ekle
</a>

<a href="match.php" class="menu-link">
Eşleşmeler
</a>
<a href="profile.php" class="menu-link">
Profilim
</a>

<a href="logout.php" class="menu-link">
Çıkış Yap
</a>
<label class="switch ms-3">
<input type="checkbox" onclick="darkMode()">
<span class="slider"></span>
</label>

</div>

</div>

<div class="container">

<div class="main-box">

<p class="panel-text">
<?php echo $panel; ?>
</p>

<h2 class="mb-4">
StudyMatch'e Hoş Geldiniz
</h2>

<p>
Hoş geldiniz,
<b>
<?php echo $_SESSION['name']; ?>
</b>

<span class="badge bg-success ms-2">
Aktif Kullanıcı
</span>

</p>

<div class="info-box">

<p>
<b>Kullanıcı Rolü:</b>
<?php echo $_SESSION['role']; ?>
</p>

<p>
<b>Tarih:</b>
<?php echo date("d.m.Y"); ?>
</p>

<p>
<b>Saat:</b>
<span id="clock"></span>
</p>

<p>
<b>Son Giriş:</b>
<span id="lastLogin"></span>
</p>

<p>
<b>Toplam Ders:</b> 12
</p>

<?php
if($_SESSION['role'] == 'admin'){
    echo "<div class='alert alert-warning mt-3'>
    Admin yetkisi aktif.
    </div>";
}
?>

<div class="alert alert-success mt-3">

Sistem başarıyla çalışıyor.

</div>

</div>

<p class="mt-4">

StudyMatch, aynı dersleri alan
öğrencilerin birbirlerini bulmasını
ve çalışma grupları oluşturmasını sağlar.

</p>


</a>

</div>

</div>

</div>

<footer class="text-center mt-5 mb-3 text-muted">

StudyMatch © 2026

</footer>
<script>

function darkMode(){

    document.body.classList.toggle("dark-mode");

}
</script>
<script>

function darkMode(){

    document.body.classList.toggle("dark-mode");

}

function updateClock(){

    let now = new Date();

    let hours = String(now.getHours()).padStart(2,'0');
    let minutes = String(now.getMinutes()).padStart(2,'0');
    let seconds = String(now.getSeconds()).padStart(2,'0');

    document.getElementById("clock").innerHTML =
    hours + ":" + minutes + ":" + seconds;

}

function updateLastLogin(){

    let now = new Date();

    let day = String(now.getDate()).padStart(2,'0');
    let month = String(now.getMonth()+1).padStart(2,'0');
    let year = now.getFullYear();

    let hours = String(now.getHours()).padStart(2,'0');
    let minutes = String(now.getMinutes()).padStart(2,'0');

    document.getElementById("lastLogin").innerHTML =
    day + "." + month + "." + year +
    " " + hours + ":" + minutes;

}

setInterval(updateClock,1000);

updateClock();
updateLastLogin();

</script>
</body>
</html>