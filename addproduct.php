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
    <div class="w-75 mx-auto mt-4">
        <form action="addproductback.php" method="POST">
            <div class="d-flex mx-auto w-100 mt-2">
                <h4 class="m-0 w-100">name 產品名稱(中文):</h4>
                <input type="text" class="form-control flex-grow-1" name="name" required>
            </div>
            <div class="d-flex mx-auto w-100 mt-2">
                <h4 class="m-0 w-100">name in English 產品名稱(英文):</h4>
                <input type="text" class="form-control flex-grow-1" name="name_en" required>
            </div>
            <div class="d-flex mx-auto w-100 mt-2">
                <h4 class="m-0 w-100">GTIN (Global Trade Item Number) GTIN（全球貿易項目編號）:</h4>
                <input type="text" class="form-control flex-grow-1" name="gtin" required>
            </div>
            <div class="d-flex mx-auto w-100 mt-2">
                <h4 class="m-0 w-100">description 產品描述（中文，可以是多行文本）:</h4>
                <textarea name="description" class="form-control flex-grow-1" required></textarea>
            </div>
            <div class="d-flex mx-auto w-100 mt-2">
                <h4 class="m-0 w-100">description in English 產品描述（英文，可以是多行文本）:</h4>
                <textarea name="description_en" class="form-control flex-grow-1" required></textarea>
            </div>
            <div class="d-flex mx-auto justify-content-center mt-2">
                <button class="btn btn-success mx-4">送出</button>
                <button type="button" class="btn btn-warning mx-4" onclick="reset();">清空</button>
                <button type="button" class="btn btn-danger mx-4" onclick="location.href='companydetail.php'">返回</button>
            </div>
        </form>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    function reset(){
        document.querySelectorAll(".form_control").forEach(function(){
            this.value="";
        })
    }
</script>