<?php
include("db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $student_number = $_POST['student_number'];
    $department = $_POST['department'];
    $university = $_POST['university'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users
    (name,student_number,department,university,email,password)

    VALUES

    ('$name','$student_number','$department',
    '$university','$email','$password')";

    $query = mysqli_query($conn,$sql);

    if($query){

        echo "<script>
        alert('Kayıt başarılı! Giriş yapabilirsiniz.');
        window.location='login.php';
        </script>";

    }else{

        $error = 'Bir hata oluştu!';

    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Kayıt Ol</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.logo{
    width:220px;
}

.register-box{
    background:white;
    padding:40px;
    border-radius:10px;
    border:1px solid #ddd;
}

.form-control{
    height:50px;
}

.register-btn{
    background:#1db954;
    border:none;
    height:50px;
    font-size:18px;
}

.register-btn:hover{
    background:#18a64a;
}

textarea{
    resize:none;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-6 mt-5">

<div class="text-center mb-4">

<img src="images/logo.jpg"
class="logo">

</div>

<div class="register-box">

<h3 class="text-center mb-4">
Kayıt Ol
</h3>

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<label class="mb-2">
Ad Soyad
</label>

<input type="text"
name="name"
class="form-control mb-3"
placeholder="Ad Soyad"
required>

<label class="mb-2">
Öğrenci Numarası
</label>

<input type="text"
name="student_number"
class="form-control mb-3"
placeholder="Örn: 20242452038"
required>

<label class="mb-2">
Bölüm
</label>

<select
name="department"
class="form-control mb-3"
required>

<option value="" selected disabled>
Bölüm Seçiniz
</option>

<option>
Yazılım Geliştirme
</option>

<option>
Bilgisayar Programcılığı
</option>

<option>
Yönetim Bilişim Sistemleri
</option>

<option>
Grafik Tasarım
</option>

<option>
Siber Güvenlik
</option>

</select>

<label class="mb-2">
Üniversite
</label>

<input type="text"
name="university"
class="form-control mb-3"
placeholder="Üniversite Adı"
required>

<label class="mb-2">
Email
</label>

<input type="email"
name="email"
class="form-control mb-3"
placeholder="Email"
required>

<label class="mb-2">
Şifre
</label>

<input type="password"
name="password"
class="form-control mb-4"
placeholder="Şifre"
required>

<button type="submit"
name="register"
class="btn btn-success w-100 register-btn">

Kayıt Ol

</button>

<div class="mt-4 text-center">

<a href="login.php">
Zaten hesabın var mı?
</a>

</div>

</form>

</div>

</div>

</div>

</div>

</body>
</html> 