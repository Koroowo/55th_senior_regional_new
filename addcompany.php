<?php
    include "connect.php";
    $name=$_POST["name"];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $owner=$_POST["owner"];
    $pdo->query("INSERT INTO `company`(`name`, `address`, `phone`, `email`, `owner`, `status`) VALUES ('$name','$address','$phone','$email','$owner','1')");
?>