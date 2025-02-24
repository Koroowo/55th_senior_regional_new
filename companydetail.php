<?php
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="jquery.js"></script>
</head>
<body>
    <div class="top_banner">
        <div class="d-flex text-center" role="button" onclick="location.href='index.php'">
            <img src="img/logo.png" style="height:65px;" alt="">
            <h1 class="mt-2 mx-3 font-weight-bold">臺灣人工智慧公會</h1>
        </div>
        <div class="d-flex">
            <button class="btn" onclick="location.href='gtin_verify.php'">GTIN 批次驗證頁面</button>
            <button class="btn" onclick="location.href='searchpage.php'">產品查詢頁面</button>
            <button class="btn" onclick="location.href='login.php'">管理</button>
        </div>
    </div>
    <div class="detail_container mt-3 mx-auto">
        <button class="modal_exit btn btn-danger" onclick="location.href='company.php'">返回</button>
        <div class="mx-auto text-start">
        <?php
            $company_id=$_SESSION["company"];
            $company=$pdo->query("SELECT * FROM `company` WHERE `id`='$company_id'")->fetch();
            echo "<h2 class='m-0'>公司名稱: ".$company['name']."</h2>
                <p class='m-0'>公司地址: ".$company["address"]."</p>
                <p class='m-0'>公司電話號碼: ".$company["phone"]."</p>
                <p class='m-0'>公司電子郵件地址: ".$company["email"]."</p>
                <p class='m-0'>擁有者姓名: ".$company["owner"]."</p>
            ";
        ?>
        </div>
        <?php
            if($_SESSION["login"]){ 
        ?>
            <div class="d-flex justify-content-center">
            </div>
            <div class="d-flex">
                <form action="import_json.php" method="POST" enctype="multipart/form-data">
                        <div class="d-flex flex-column mx-2">
                        <input type="file" name="json" accept=".json" required>
                        <button class="btn btn-info">輸入產品JSON</button>
                    </div>
                </form>
                <form action="import_csv.php" method="POST" enctype="multipart/form-data">
                        <div class="d-flex flex-column mx-2">
                        <input type="file" name="csv" accept=".csv" required>
                        <button class="btn btn-info">輸入產品CSV</button>
                    </div>
                </form>
            </div>
        <?php
            }
        ?>
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary mx-2" onclick="location.href='json/export_json.php'">輸出產品JSON</button> 
            <button class="btn btn-outline-primary mx-2" onclick="location.href='csv/export_csv.php'">輸出產品CSV</button> 
        </div> 
    </div>
    <div class="d-flex justify-content-center mx-auto my-3">
        <h2 class="m-0">與該公司相關的產品</h2>
        <?php
            if($_SESSION["login"]==true){
        ?>
        <button class="btn btn-success mx-4" onclick="location.href='addproduct.php'">新增產品</button>
        <?php
        }
        ?>
    </div>
    <div style="height=300px;margin-bottom:100px;" class="grid mx-auto">
        <?php
            if($_SESSION["login"]==true){
                $rows=$pdo->query("SELECT * FROM `product` WHERE `company`='$company_id'")->fetchAll();
            }else{
                $rows=$pdo->query("SELECT * FROM `product` WHERE `company`='$company_id' AND `status`='1'")->fetchAll();
            }
            foreach($rows as $row){
                if($row["img"]!=""){
                    echo "<div class='product_card my-3 mx-auto' id='".$row["id"]."'>
                        <h4 class='m-0'>產品名稱:".$row["name"]."</h4>
                        <img src='data:".$row["mime"].";base64,".$row["img"]."' class='productimg' alt=''>
                        <p class='m-0'>公司名稱:".$row["company_name"]."</p>
                        <p class='m-0'>GTIN:".$row["gtin"]."</p>
                        <p class='m-0'>描述:".$row["description"]."</p>
                    </div>";
                }else{
                    echo "<div class='product_card my-3 mx-auto' id='".$row["id"]."'>
                        <h4 class='m-0'>產品名稱:".$row["name"]."</h4>
                        <img src='img/default_img.png' class='productimg' alt=''>
                        <p class='m-0'>公司名稱:".$row["company_name"]."</p>
                        <p class='m-0'>GTIN:".$row["gtin"]."</p>
                        <p class='m-0'>描述:".$row["description"]."</p>
                    </div>";
                }
            }
        ?>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    document.querySelectorAll(".product_card").forEach(function(card){
        card.querySelector("h4").addEventListener("click",function(){
            $.ajax({
                url:"set.php",
                method:"POST",
                data:{id:card.id,is:"product"}
            }).done(function(){
                location.href='productdetail.php';
            })
        })
    })
</script>