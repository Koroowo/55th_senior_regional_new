<?php
    include "connect.php";
    $is=$_GET["is"];
    $id=$_SESSION["product"];
    if($is=="replace"){
        if($_FILES["img"]["error"]!=4){
            $base64=base64_encode(file_get_contents($_FILES["img"]["tmp_name"]));
            $mime=mime_content_type($_FILES["img"]["tmp_name"]);
            $pdo->query("UPDATE `product` SET `img`='$base64',`mime`='$mime' WHERE `id`='$id'");
        }else{
            echo "<script>alert('請輸入圖片');</script>";
        }
    }else{
        $pdo->query("UPDATE `product` SET `img`='',`mime`='' WHERE `id`='$id'");
    }
    header("location:productdetail.php");
?>