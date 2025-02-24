<?php
    include "connect.php";
    $gtin=$_POST["gtin"];
    if($_SESSION["login"]==true){
        $product=$pdo->query("SELECT * FROM `product` WHERE `gtin`='$gtin'")->fetch();
    }else{
        $product=$pdo->query("SELECT * FROM `product` WHERE `gtin`='$gtin' AND `status`='1'")->fetch();
    }
    if($product){
        $_SESSION["product"]=$product["id"];
        header("location:productdetail.php");
    }else{
        echo "<script>alert('查無此產品');history.back();</script>";
    }
?>