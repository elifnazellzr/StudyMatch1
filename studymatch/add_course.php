<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

if(isset($_POST['add_course'])){

    $course = $_POST['course'];
    $course_code = $_POST['course_code'];
    $section = $_POST['section'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $classroom = $_POST['classroom'];
    $education_type = $_POST['education_type'];
    $description = $_POST['description'];

    $email = $_SESSION['email'];

    $sql = "INSERT INTO courses
    (user_email,course_name,course_code,section_name,
    course_day,course_time,classroom,education_type,description)

    VALUES

    ('$email','$course','$course_code','$section',
    '$day','$time','$classroom','$education_type','$description')";

    $query = mysqli_query($conn,$sql);

    if($query){
        $success = "Ders başarıyla eklendi!";
    }else{
        $error = "Bir hata oluştu!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ders Ekle</title>

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

.green-btn{
    background:#1db954;
    border:none;
    height:50px;
    font-size:18px;
}

.green-btn:hover{
    background:#18a64a;
}

textarea{
    resize:none;
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

<a href="my_courses.php" class="menu-link">
Derslerim
</a>

<a href="add_course.php"
class="menu-link active-link">
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

<div class="col-md-7">

<div class="course-box">

<h3 class="mb-4">
Ders Ekle
</h3>

<?php
if(isset($success)){
    echo "<div class='alert alert-success'>$success</div>";
}

if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<label class="mb-2">
Ders Adı
</label>

<input type="text"
name="course"
class="form-control mb-3"
placeholder="Örn: Web Programlama"
required>

<label class="mb-2">
Ders Kodu
</label>

<input type="text"
name="course_code"
class="form-control mb-3"
placeholder="Örn: BIL204"
required>

<label class="mb-2">
Section
</label>

<input type="text"
name="section"
class="form-control mb-3"
placeholder="Örn: A"
required>

<label class="mb-2">
Ders Günü
</label>

<select name="day"
class="form-control mb-3"
required>

<option value="">Gün Seçiniz</option>
<option>Pazartesi</option>
<option>Salı</option>
<option>Çarşamba</option>
<option>Perşembe</option>
<option>Cuma</option>

</select>

<label class="mb-2">
Ders Saati
</label>

<input type="text"
name="time"
class="form-control mb-3"
placeholder="Örn: 13:00 - 15:00"
required>

<label class="mb-2">
Sınıf
</label>

<input type="text"
name="classroom"
class="form-control mb-3"
placeholder="Örn: D203"
required>

<label class="mb-2">
Öğretim Türü
</label>

<select name="education_type"
class="form-control mb-3"
required>

<option value="">Seçiniz</option>
<option>1. Öğretim</option>
<option>2. Öğretim</option>

</select>

<label class="mb-2">
Açıklama
</label>

<textarea
name="description"
class="form-control mb-4"
rows="4"
placeholder="Ders hakkında kısa açıklama"></textarea>

<button type="submit"
name="add_course"
class="btn btn-success w-100 green-btn">

Dersi Kaydet

</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>