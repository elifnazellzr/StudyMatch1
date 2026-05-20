<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

$email = $_SESSION['email'];

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

$sql = "SELECT * FROM courses
WHERE user_email='$email'
AND course_name LIKE '%$search%'";

$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Derslerim</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.logo{
    width:160px;
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

.active-link{
    color:#1db954;
}

.course-box{
    background:white;
    padding:40px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:40px;
}

.course-card{
    border:1px solid #ddd;
    border-radius:10px;
    padding:25px;
    margin-top:20px;
}

.title-green{
    color:#1db954;
    font-weight:600;
}

.info-text{
    margin-bottom:8px;
}

.badge-box{
    margin-top:10px;
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

<a href="index.php" class="menu-link">
Ana Sayfa
</a>

<a href="my_courses.php"
class="menu-link active-link">
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


</div>

</div>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-9">

<div class="course-box">

<h3 class="mb-4">
Eklenen Dersler
</h3>
<form method="GET" class="mb-4">

<div class="input-group">

<input type="text"
name="search"
class="form-control"
placeholder="Ders Ara...">

<button class="btn btn-success">
Ara
</button>

</div>

</form>

<?php

if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){

?>

<div class="course-card">

<h4 class="title-green mb-3">
<?php echo $row['course_name']; ?>
</h4>

<p class="info-text">
<b>Ders Kodu:</b>
<?php echo $row['course_code']; ?>
</p>

<p class="info-text">
<b>Section:</b>
<?php echo $row['section_name']; ?>
</p>

<p class="info-text">
<b>Gün:</b>
<?php echo $row['course_day']; ?>
</p>

<p class="info-text">
<b>Saat:</b>
<?php echo $row['course_time']; ?>
</p>

<p class="info-text">
<b>Sınıf:</b>
<?php echo $row['classroom']; ?>
</p>

<p class="info-text">
<b>Öğretim Türü:</b>
<?php echo $row['education_type']; ?>
</p>

<p class="info-text">
<b>Açıklama:</b>
<?php echo $row['description']; ?>
</p>



<a href="delete_course.php?id=<?php echo $row['course_id']; ?>" class="btn btn-danger btn-sm">
Dersi Sil
</a>

<a href="edit_course.php?id=<?php echo $row['course_id']; ?>" class="btn btn-warning btn-sm ms-2">
Güncelle
</a>

</div>

<?php

    }

}else{

    echo "
    <div class='alert alert-warning'>
    Henüz ders eklenmedi.
    </div>
    ";

}
?>

</div>

</div>

</div>

</div>


</body>
</html>
</body>
</html>