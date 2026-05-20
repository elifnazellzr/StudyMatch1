<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM users
WHERE email='$email'";

$query = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($query);

$courseCount = mysqli_query($conn,
"SELECT * FROM courses
WHERE user_email='$email'");

$totalCourses = mysqli_num_rows($courseCount);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Profilim</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.profile-box{
    background:white;
    padding:40px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:50px;
}

.profile-img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #1db954;
}

.title{
    color:#1db954;
}

.info-box{
    background:#f8f9fa;
    border-radius:10px;
    padding:20px;
    margin-top:25px;
    text-align:left;
}

.info-text{
    margin-bottom:10px;
    font-size:17px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="profile-box text-center">

<img src="images/profil.png"
class="profile-img mb-4">

<h3 class="title">
<?php echo $user['name']; ?>
</h3>

<div class="info-box">

<p class="info-text">
<b>Öğrenci Numarası:</b>
<?php echo $user['student_number']; ?>
</p>

<p class="info-text">
<b>Bölüm:</b>
<?php echo $user['department']; ?>
</p>

<p class="info-text">
<b>Üniversite:</b>
<?php echo $user['university']; ?>
</p>

<p class="info-text">
<b>Email:</b>
<?php echo $user['email']; ?>
</p>

<p class="info-text">
<b>Rol:</b>
<?php echo $user['role']; ?>
</p>

<p class="info-text">
<b>Toplam Ders:</b>
<?php echo $totalCourses; ?>
</p>

<p class="info-text">
<b>Tarih:</b>
<?php echo date("d.m.Y"); ?>
</p>

<p class="info-text">
<b>Saat:</b>
<?php echo date("H:i"); ?>
</p>

</div>

<div class="mt-4">

<span class="badge bg-success">
Aktif Kullanıcı
</span>

<span class="badge bg-primary ms-2">
StudyMatch Üyesi
</span>

</div>

</div>

</div>

</div>

</div>

</body>
</html>