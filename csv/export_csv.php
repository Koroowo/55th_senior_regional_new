<?php
    include "../connect.php";
    header("Content-type: text/csv");
    header("Content-Disposition: attachment;filename=products.csv");
    $company_id=$_SESSION["company"];
    $products=$pdo->query("SELECT * FROM `product` WHERE `company`='$company_id'")->fetchAll(PDO::FETCH_ASSOC);
    $output=fopen('php://output','w');
    fputcsv($output,array_keys($products[0]));
    foreach($products as $product){
        fputcsv($output,$product);
    }
?>