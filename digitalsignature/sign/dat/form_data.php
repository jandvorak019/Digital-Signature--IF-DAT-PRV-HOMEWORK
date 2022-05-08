<?php
include 'dbh.php';
include 'signature.php';

$first = $_POST['firstname'];
$last = $_POST['surname'];
$date = $_POST['expire'];

$insert = "INSERT INTO subjects (firstname, surname) VALUES ('$first', '$last');INSERT INTO certif (expires, idcertificate, md5_key, hash_value) VALUES ('$date', '$id', '$key', '$hashed_file');";
mysqli_multi_query($connect, $insert);

header("Location: ../index.php");