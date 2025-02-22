<?php
    include "connect.php";
    $inputs=explode("\n",$_POST["input"]);
    $response=[];
    foreach($inputs as $gtin){
        if($gtin!==""){
            $status=$pdo->query("SELECT * FROM `product` WHERE `status`='1' AND `gtin`=".$pdo->quote($gtin))->fetch();
            if(isset($status["gtin"])){
                $response[]=[
                    "gtin"=>$gtin,
                    "status"=>"valid"
                ];
            }else{
                $response[]=[
                    "gtin"=>$gtin,
                    "status"=>"Invalid"
                ];
            }
        }
    }
    echo json_encode($response)
?>