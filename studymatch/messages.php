<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

$email = $_SESSION['email'];

mysqli_query($conn,
"UPDATE messages
SET is_read=1
WHERE receiver_email='$email'");

$sql = "SELECT * FROM messages
WHERE receiver_email='$email'
ORDER BY id DESC";

$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Mesajlarım</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.message-box{
    background:white;
    padding:30px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:40px;
}

.message-card{
    border:1px solid #ddd;
    border-radius:10px;
    padding:20px;
    margin-top:20px;
}

.title{
    color:#1db954;
}

.back-btn{
    margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="message-box">

<h3 class="title mb-4">
Mesajlarım
</h3>

<?php

if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){

?>

<div class="message-card">

<p>
<b>Gönderen:</b>
<?php echo $row['sender_email']; ?>
</p>

<p>
<b>Mesaj:</b>
<?php echo $row['message']; ?>
</p>

<p>
<b>Tarih:</b>
<?php echo date("d.m.Y H:i"); ?>
</p>

</div>

<?php

    }

}else{

    echo "
    <div class='alert alert-warning'>
    Henüz mesaj bulunmuyor.
    </div>
    ";

}
?>

<div class="back-btn">

<a href="match.php"
class="btn btn-success">

Eşleşmelere Dön

</a>

</div>

</div>

</div>

</body>
</html>