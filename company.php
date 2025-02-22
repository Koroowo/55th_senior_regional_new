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
    <?php
        $companys=$pdo->query("SELECT * FROM `company`")->fetchAll();
    ?>
    <div class="w-75 mx-auto">
        <table class="table table-striped table-light my-3 table-hover">
            <thead>
                <th>公司名稱</th>
                <th>公司地址</th>
                <th>公司電話號碼</th>
                <th>公司電子郵件地址</th>
                <th>擁有者姓名</th>
                <?php
                    if($_SESSION["login"]==true){
                        echo "<th>操作</th>";
                    }
                ?>
            </thead>
            <?php
                foreach($companys as $company){
            ?>
            <tr>
                <td><?=$company["name"]?></td>
                <td><?=$company["address"]?></td>
                <td><?=$company["phone"]?></td>
                <td><?=$company["email"]?></td>
                <td><?=$company["owner"]?></td>
                <?php
                    if($_SESSION["login"]==true){
                        echo "<td></td>";
                    }
                ?>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>