<?php
session_start();
include("db.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM invitations
        WHERE receiver_email='$email'
        ORDER BY id DESC";

$query = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<title>Davetlerim</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.box{
    background:white;
    padding:30px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:40px;
}

.card-box{
    border:1px solid #ddd;
    border-radius:10px;
    padding:20px;
    margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="box">

<h3>
Davetlerim
</h3>

<?php

if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){

?>

<div class="card-box">

<p>
<b>Gönderen:</b>
<?php echo $row['sender_email']; ?>
</p>

<p>
<b>Ders:</b>
<?php echo $row['course_name']; ?>
</p>

<p>
<b>Durum:</b>
<?php echo $row['status']; ?>
</p>

<button class="btn btn-success btn-sm">
Kabul Et
</button>

<button class="btn btn-danger btn-sm ms-2">
Reddet
</button>

</div>

<?php

    }

}else{

    echo "
    <div class='alert alert-warning'>
    Henüz davet bulunmuyor.
    </div>
    ";

}
?>

</div>

</div>

</body>
</html>