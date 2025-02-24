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
    <div class="d-flex justify-content-around mx-5 mt-3">
        <form action="searchproduct.php" method="POST">
            <input type="text" name="gtin" placeholder="查詢產品GTIN:" required>
            <button class="btn btn-success">送出</button>
        </form>
        <div class="btn-group">
            <?php
                if(isset($_GET["en"])){
            ?>
                <button class="btn" onclick="location.href='productdetail.php'">中文</button>
                <button class="btn btn-primary" onclick="location.href='productdetail.php?en=true'">ENG</button>
            <?php
                }else{
            ?>
                <button class="btn btn-primary" onclick="location.href='productdetail.php'">中文</button>
                <button class="btn" onclick="location.href='productdetail.php?en=true'">ENG</button>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="detail_container mt-3 mx-auto">
        <button class="modal_exit btn btn-danger" onclick="location.href='products.php'">返回</button>
        <div class="mx-auto text-start">
            <?php
            $product_id=$_SESSION["product"];
            $product=$pdo->query("SELECT * FROM `product` WHERE `id`='$product_id'")->fetch();
            if($product["img"]!=""){
                if(isset($_GET["en"])){
                    echo "<h2 class='m-0'>name in English 產品名稱(英文): ".$product["name_en"]."</h2>
                        <img class='productimg' src='data:".$product["mime"].";base64,".$product["img"]."'>
                        <p class='m-0'>公司名稱: ".$product["company_name"]."</p>
                        <p class='m-0'>GTIN (Global Trade Item Number) GTIN（全球貿易項目編號）: ".$product["gtin"]."</p>
                        <p class='m-0'>description in English 產品描述（英文，可以是多行文本）: ".$product["description_en"]."</p>
                    ";
                }else{
                    echo "<h2 class='m-0'>name 產品名稱(中文): ".$product['name']."</h2>
                    <img class='productimg' src='data:".$product["mime"].";base64,".$product["img"]."'>
                        <p class='m-0'>公司名稱: ".$product["company_name"]."</p>
                        <p class='m-0'>GTIN (Global Trade Item Number) GTIN（全球貿易項目編號）: ".$product["gtin"]."</p>
                        <p class='m-0'>description 產品描述（中文，可以是多行文本）: ".$product["description"]."</p>
                    ";
                }
            }else{
                if(isset($_GET["en"])){
                    echo "<h2 class='m-0'>name in English 產品名稱(英文): ".$product["name_en"]."</h2>
                        <img class='productimg' src='img/default_img.png'>
                        <p class='m-0'>公司名稱: ".$product["company_name"]."</p>
                        <p class='m-0'>GTIN (Global Trade Item Number) GTIN（全球貿易項目編號）: ".$product["gtin"]."</p>
                        <p class='m-0'>description in English 產品描述（英文，可以是多行文本）: ".$product["description_en"]."</p>
                    ";
                }else{
                    echo "<h2 class='m-0'>name 產品名稱(中文): ".$product['name']."</h2>
                        <img class='productimg' src='img/default_img.png'>
                        <p class='m-0'>公司名稱: ".$product["company_name"]."</p>
                        <p class='m-0'>GTIN (Global Trade Item Number) GTIN（全球貿易項目編號）: ".$product["gtin"]."</p>
                        <p class='m-0'>description 產品描述（中文，可以是多行文本）: ".$product["description"]."</p>
                    ";
                }
            }
            if($_SESSION["login"]==true){
            ?>
            <form action="img.php?is=replace" method="POST" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <input type="file" name="img" accept="image/jpeg,image/png" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success">新增/修改圖片</button>
                    <button type="button" class="btn btn-danger" onclick="delimg()">刪除圖片</button>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    function delimg(){
        if(window.confirm("是否刪除產品圖片?")){
            $.ajax({
                url:"img.php?is=del",
                method:"POST",
                data:{}
            }).done(function(){
                location.href='productdetail.php';
            })
        }
    }
</script>