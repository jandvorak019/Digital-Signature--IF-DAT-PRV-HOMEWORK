<?php

error_reporting(E_ERROR | E_PARSE);
include 'dbh.php';

#generating ID
$id = random_int(10000, 99999);

#key gen
$key = md5(uniqid(rand()));

#hashing content
$file_content = file_get_contents("../../data.txt");
$hashed_file = hash('sha256', $file_content);

#encrypting hash using $key
$encryptedHash = openssl_encrypt($hashed_file, 'blowfish', $key, $options=0);

#appending id and encrypted hash to original file
$signed = $file_content.'###'.$id.'###'.$encryptedHash;

$stream = fopen('../../data.txt', 'w');
fwrite($stream, $signed);
fclose($stream);
?>