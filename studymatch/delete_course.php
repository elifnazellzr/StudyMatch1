<?php
include("db.php");

$id = $_GET['id'];

$sql = "DELETE FROM courses
WHERE course_id='$id'";

mysqli_query($conn,$sql);

header("Location: my_courses.php");
?>