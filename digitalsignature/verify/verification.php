<?php

error_reporting(E_ERROR | E_PARSE);
include '../sign/dat/dbh.php';
include '../sign/dat/signature.php';

#verify--------------------
$key = null;

$extract = explode('###', file_get_contents('../data.txt')); # File opening and distribution of data 

$extData = $extract[0];

$extId = $extract[1]; # ID extracted from file
$extEnhash = $extract[2]; # encrypted hash text extracted from the file


$sql = "SELECT idcertificate, md5_key, hash_value, expires FROM certif WHERE idcertificate =('$extId')"; # SQL command to get all the necessary data
$result = mysqli_query($connect, $sql); # DB connection

$hashedData = hash('sha256', $extData);

while($row = mysqli_fetch_assoc($result)){
    $key = $row["md5_key"];
    $hash = $row["hash_value"];
    $expire = $row["expires"];
};
if($key != null){
    if(openssl_decrypt($extEnhash, 'blowfish', $key, $options = 0) == $hash and $hash == $hashedData){
        echo "<p>File has not been modified.</p>";
        echo "<p>Certificate is valid until $expire</p>";
    }else{
       echo "<p>File has been modified.</p>";
    }
    }else{
    echo "<p>File cannot be verified.</p>";
}
unlink("../../data.txt")
?>