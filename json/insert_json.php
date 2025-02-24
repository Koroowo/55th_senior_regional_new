<?php
    include "../connect.php";
    if($_FILES["json"]["type"]!="application/json"){
        echo "<script>alert('請輸入JSON資料');location.href='admincompanydetail.php'</script>";
    }
    $datajson=json_decode(file_get_contents($_FILES["json"]["tmp_name"]),true);
    if($datajson && $datajson["products"]){
        foreach($datajson["products"] as $product){
            extract($product);
            // extract makes you dont need to define every element one by one.
            // $company=$product["company"];
            // $company_name=$product["company_name"];
            // $name=$product["name"];
            // $name_en=$product["name_en"];
            // $description=$product["description"];
            // $description_en=$product["description_en"];
            // $gtin=$product["gtin"];
            // $img=$product["img"];
            // $mime=$product["mime"];
            // $status=$product["status"];
            // gtin need validation
            $dupgtin=count($pdo->query("SELECT * FROM `product` WHERE `gtin`='$gtin'")->fetchAll());
            if($dupgtin>0){
                echo "<script>alert('GTIN不可重複');location.href='../companydetail.php'</script>";
                exit();
            }
            $company_validate=$pdo->query("SELECT * FROM `company` WHERE `id`='$company'")->fetch();
            $company_name_validate=$pdo->query("SELECT * FROM `company` WHERE `name`='$company_name' AND `id`='$company'")->fetch();
            if($company_validate&& $company_name_validate && isset($status)){
                if($status==1||$status==0){
                    $pdo->query("INSERT INTO `product`(`company`, `company_name`, `name`, `name_en`, `description`, `description_en`, `gtin`, `img`, `mime`, `status`) VALUES ('$company','$company_name','$name','$name_en','$description','$description_en','$gtin','$img','$mime','$status')");
                }else{
                    echo "<script>alert('JSON資料錯誤');location.href='../companydetail.php'</script>";
                    exit();
                }
            }else{
                echo "<script>alert('JSON資料錯誤');location.href='../companydetail.php'</script>";
                exit();
            }
            header("location:../companydetail.php");
        }
    }else{
        echo "<script>alert('JSON資料為空/格式錯誤');location.href='../companydetail.php'</script>";
    }
?>