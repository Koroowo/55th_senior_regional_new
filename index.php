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
    <script src="bootstrap.js"></script>
    <style>
        .carousel-item-next {
        transform: translateX(-100%) !important;
        }
        .active.carousel-item-left {
        transform: translateX(100%) !important;
        }
    </style>
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
    <div class="carousel slide w-50 bg-light mx-auto mt-3" data-ride="carousel">
        <div class="carousel-inner">
            <div class='carousel-item active' data-interval='2500'>
                <div class='d-flex justify-content-center'>
                    <img src='img/default_img.png' class='mx-auto' alt=''>
                </div>
            </div>
            <div class='carousel-item' data-interval='2500'>
                <div class='d-flex justify-content-center'>
                    <img src='img/default_img.png' class='mx-auto' alt=''>
                </div>
            </div>
            <div class='carousel-item' data-interval='2500'>
                <div class='d-flex justify-content-center'>
                    <img src='img/default_img.png' class='mx-auto' alt=''>
                </div>
            </div>
        </div>
    </div>
    <h2 class="my-3 text-center">會員公司與產品</h2>
    <div class="content mx-auto">
        <?php
        $company=$pdo->query("SELECT * FROM `company` WHERE `status`='1'")->fetch();
        echo "<div class='company_card my-3 mx-auto' id='".$company["id"]."' data-name='".$company["name"]."'>
            <h4 class='m-0'>公司名稱: ".$company["name"]."</h4>
            <p class='m-0'>擁有者: ".$company["owner"]."</p>
        </div>";
        $products=$pdo->query("SELECT * FROM `product` WHERE `company`='".$company["id"]."' AND `status`='1' LIMIT 3")->fetchAll();
        foreach($products as $product){
            if($product["img"]!=""){
                echo "<div class='product_card my-3 mx-auto' id='".$product["id"]."'>
                    <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                    <img src='data:".$product["mime"].";base64,".$product["img"]."' class='productimg' alt=''>
                    <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                    <p class='m-0'>GTIN:".$product["gtin"]."</p>
                    <p class='m-0'>描述:".$product["description"]."</p>
                </div>";
            }else{
                echo "<div class='product_card my-3 mx-auto' id='".$product["id"]."'>
                    <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                    <img src='img/default_img.png' class='productimg' alt=''>
                    <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                    <p class='m-0'>GTIN:".$product["gtin"]."</p>
                    <p class='m-0'>描述:".$product["description"]."</p>
                </div>";
            }
        }
        ?>
    </div>
    <div class="d-flex justify-content-end mr-5 " style="margin-bottom:100px;">
        <button class="btn btn-info" id="show_more">顯示更多會員公司/產品</button>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    // 看時間夠不夠 不夠就不要加
    document.querySelectorAll(".company_card").forEach(function(card){
        card.addEventListener("click",function(){
            let id=card.id;
            let name=card.dataset.name;
            $.ajax({
                url:"set.php",
                method:"POST",
                data:{id:id,name:name,is:"company",login:false}
            }).done(function(){ 
                location.href='companydetail.php';
            })
        })
    })
    document.querySelectorAll(".product_card").forEach(function(card){
        card.querySelector("h4").addEventListener("click",function(){
            let id=card.id;
            $.ajax({
                url:"set.php",
                method:"POST",
                data:{id:id,is:"product",login:false}
            }).done(function(){
                location.href='productdetail.php';
            })
        })
    })
    document.getElementById("show_more").addEventListener("click",function(){
        $.ajax({
            url:"set.php",
            method:"POST",
            data:{login:false}
        }).done(function(){
            location.href='company.php';
        })
    })
</script>