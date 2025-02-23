<?php
    include "connect.php";
    header("Content-Type:application/json");
    $company_id=$_POST["id"];
    $data=$pdo->query("SELECT * FROM `company` WHERE `id`='$company_id'")->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>