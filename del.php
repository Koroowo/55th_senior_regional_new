<?php
    include "connect.php";
    $id=$_POST["id"];
    if($_POST["is"]=="disable"&&$_POST["from"]=="company"){
        $pdo->query("UPDATE `company` SET `status`='0' WHERE `id`='$id'");
        $pdo->query("UPDATE `product` SET `status`='0' WHERE `company`='$id'");
    }else if($_POST["is"]=="disable" && $_POST["from"]=="product"){
        $pdo->query("UPDATE `product` SET `status`='0' WHERE `id`='$id'");
    }else{
        $pdo->query("DELETE FROM `company` WHERE `id`='$id'");
        $pdo->query("DELETE FROM `product` WHERE `company`='$id'");
    }
?>