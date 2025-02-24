<?php
include "../connect.php";
$file = $_FILES['csv']['tmp_name'];
if (($handle = fopen($file, "r")) !== false) {
    $header = fgetcsv($handle);
    
    while (($data = fgetcsv($handle)) !== false) {
        $row = array_combine($header, $data);
        extract($row);
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
                header("location:../companydetail.php");
            }else{
                "<script>alert('CSV資料錯誤');location.href='../companydetail.php'</script>";
                exit();
            }
        }else{
            echo "<script>alert('CSV資料錯誤');location.href='../companydetail.php'</script>";
            exit();
        }    
    }
    fclose($handle);
} else {
    echo "Error opening the file.";
}
?>
