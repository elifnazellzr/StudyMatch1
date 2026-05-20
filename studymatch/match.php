<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

$email = $_SESSION['email'];

if(isset($_POST['send_message'])){

    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $insert = "INSERT INTO messages
    (sender_email,receiver_email,message)
    VALUES
    ('$email','$receiver','$message')";

    mysqli_query($conn,$insert);

    $success = "Mesaj gönderildi.";

}

$sql = "SELECT * FROM courses
        WHERE course_name IN (

        SELECT course_name
        FROM courses
        WHERE user_email='$email'

        )

        AND user_email != '$email'";

$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Eşleşmeler</title>

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

.match-box{
    background:white;
    padding:40px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:40px;
}

.match-card{
    border:1px solid #ddd;
    border-radius:10px;
    padding:20px;
    margin-top:20px;
}

.title-green{
    color:#1db954;
}

.action-btn{
    margin-top:10px;
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

<a href="add_course.php" class="menu-link">
Ders Ekle
</a>

<a href="match.php"
class="menu-link active-link">
Eşleşmeler
</a>
<a href="profile.php" class="menu-link">
Profilim
</a>

<?php

$messageCountQuery = mysqli_query(
$conn,
"SELECT * FROM messages
WHERE receiver_email='$email'
AND is_read=0"
);

$messageCount = mysqli_num_rows($messageCountQuery);

?>

<a href="messages.php"
class="menu-link">

Mesajlarım

<?php
if($messageCount > 0){
?>

<span class="badge bg-danger">
<?php echo $messageCount; ?>
</span>

<?php
}
?>

</a>

<a href="invitations.php"
class="menu-link">

Davetlerim


</a>

<a href="logout.php" class="menu-link">
Çıkış Yap
</a>

</div>

</div>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="match-box">

<h3 class="mb-4">
Eşleşen Öğrenciler
</h3>

<?php
if(isset($success)){
    echo "<div class='alert alert-success'>$success</div>";
}
?>

<?php

if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){

?>

<div class="match-card">

<h5 class="title-green">
Ortak Ders
</h5>

<p>
<?php echo $row['course_name']; ?>
</p>

<h5 class="title-green">
Öğrenci
</h5>

<p>
<?php echo $row['user_email']; ?>
</p>

<form method="POST" class="mt-3">

<input type="hidden"
name="receiver"
value="<?php echo $row['user_email']; ?>">

<textarea
name="message"
class="form-control mb-2"
placeholder="Mesaj yaz..."
required></textarea>

<button type="submit"
name="send_message"
class="btn btn-primary btn-sm">

Mesaj Gönder

</button>

<button type="button"
class="btn btn-success btn-sm ms-2"
onclick="alert('Çalışma daveti gönderildi.')">

Davet Gönder

</button>

</form>

</div>

<?php

    }

}else{

    echo "
    <div class='alert alert-warning'>
    Henüz eşleşme bulunamadı.
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