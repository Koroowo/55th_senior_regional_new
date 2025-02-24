<?php
    include "../connect.php";
    header("Content-type: application/json");
    header("Content-Disposition:attachment;filename=products.json");
    $company_id=$_SESSION["company"];
    $products=$pdo->query("SELECT * FROM `product` WHERE `company`='$company_id'")->fetchAll(PDO::FETCH_ASSOC);
    $json_data=json_encode([
        "products" => $products
    ],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    echo $json_data;
?>