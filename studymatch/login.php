<?php
session_start();
include("db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $query = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($query);

    if($count > 0){

        $user = mysqli_fetch_assoc($query);

        $_SESSION['email'] = $email;
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php");

    }else{

        $error = "Email veya şifre hatalı!";

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
    width:220px;
}

.login-box{
    background:white;
    padding:40px;
    border-radius:10px;
    border:1px solid #ddd;
}

.form-control{
    height:50px;
}

.sign-btn{
    background:#1db954;
    border:none;
    height:50px;
    font-size:18px;
}

.sign-btn:hover{
    background:#18a64a;
}

.forgot-link{
    text-decoration:none;
    color:#1db954;
    font-size:14px;
}

.forgot-link:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5 mt-5">

<div class="text-center mb-4">

<img src="images/logo.jpg"
class="logo">

</div>

<div class="login-box">

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<label class="mb-2">
Email
</label>

<input type="email"
name="email"
class="form-control mb-4"
required>

<label class="mb-2">
Password
</label>

<input type="password"
name="password"
class="form-control mb-4"
required>

<button type="submit"
name="login"
class="btn btn-success w-100 sign-btn">

Giriş Yap

</button>

<div class="mt-4 text-center">

<a href="#"
class="forgot-link"
onclick="alert('Şifre sıfırlama bağlantısı email adresinize gönderildi.')">

Şifremi Unuttum


</a>

</div>

</form>

</div>

</div>

</div>

</div>

</body>
</html>