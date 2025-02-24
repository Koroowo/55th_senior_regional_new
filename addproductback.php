<?php
    include "connect.php";
    $company_id=$_SESSION["company"];
    $company_name=$_SESSION["company_name"];
    $name=$_POST["name"];
    $name_en=$_POST["name_en"];
    $description=$_POST["description"];
    $description_en=$_POST["description_en"];
    $gtin=$_POST["gtin"];
    $dupgtin=count($pdo->query("SELECT * FROM `product` WHERE `gtin`='$gtin'")->fetchAll());
    if(!preg_match("/^[0-9]{13}$/",$gtin)){
        echo "<script>alert('GTIN必須為13位數字');location.href='addproduct.php'</script>";
        exit();
    }else if($dupgtin >0){
        echo "<script>alert('GTIN不可重複');location.href='addproduct.php'</script>";
        exit();
    }
    $pdo->query("INSERT INTO `product`(`company`, `company_name`, `name`, `name_en`, `description`, `description_en`, `gtin`,`img`,`mime`,`status`) VALUES ('$company_id','$company_name','$name','$name_en','$description','$description_en','$gtin','','','1')");
    header("location:companydetail.php");
?>