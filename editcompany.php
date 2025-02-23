<?php
    include "connect.php";
    $name=$_POST["name"];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $owner=$_POST["owner"];
    $company_id=$_SESSION["company"];
    $pdo->query("UPDATE `company` SET `name`='$name',`address`='$address',`phone`='$phone',`email`='$email',`owner`='$owner' WHERE `id`='$company_id'");
    $pdo->query("UPDATE `product` SET `company_name`='$name' WHERE `company`='$company_id'");
?>