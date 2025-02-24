<?php
    include "connect.php";
    $_SESSION["login"]=false;
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
    <h2 class="m-0 text-center mt-5">產品查詢頁面</h2>
    <div class="w-50 mx-auto d-flex justify-content-center mt-5">
        <form action="searchproduct.php" method="POST">
            <input type="text" name="gtin" placeholder="查詢產品GTIN:" required>
            <button class="btn btn-success">送出</button>
        </form>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
