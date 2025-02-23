<?php
    include "connect.php";
    $company_id=$_POST["id"];
    if($_POST["is"]=="disable"){
        $pdo->query("UPDATE `company` SET `status`='0' WHERE `id`='$company_id'");
        $pdo->query("UPDATE `product` SET `status`='0' WHERE `company`='$company_id'");
    }else{
        $pdo->query("DELETE FROM `company` WHERE `id`='$company_id'");
        $pdo->query("DELETE FROM `product` WHERE `company`='$company_id'");
    }
?>