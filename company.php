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
        $companys=$pdo->query("SELECT * FROM `company` WHERE `status`='1'")->fetchAll();
    ?>
    <div class="w-75 mx-auto my-3 overflow-auto" style="max-height:500px;">
        <h2 class="m-0 text-center">公司列表</h2>
        <table class="table table-striped table-light my-3 table-hover">
            <thead>
                <th class="col-4">公司名稱</th>
                <th class="col-2">擁有者姓名</th>
                <th class="col-1">基本資料</th>
                <th class="col-1">產品資料</th>
                <?php
                    if($_SESSION["login"]==true){
                        echo "<th class='col-3'>操作</th>";
                    }
                ?>
            </thead>
            <?php
                foreach($companys as $company){
            ?>
            <tr>
                <td><?=$company["name"]?></td>
                <td><?=$company["owner"]?></td>
                <td><button class="btn btn-primary">查看</button></td>
                <td><button class="btn btn-primary">查看</button></td>
                <?php
                    if($_SESSION["login"]==true){
                        echo "<td>
                            <button class='btn btn-warning' onclick='edit();' id='".$company["id"]."'>修改</button>
                            <button class='btn btn-danger' onclick='del();' id='".$company["id"]."'>停用</button>
                            <button class='btn btn-danger' onclick='del();' id='".$company["id"]."'>刪除</button>
                        </td>";
                    }
                ?>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <div class="w-75 mx-auto overflow-auto" style="margin-bottom:100px; max-height:500px;">
        <h2 class="m-0 text-center">已停用的會員公司</h2>
        <table class="table table-striped table-light my-3">
            <thead>
                <th>公司名稱</th>
                <th>擁有者姓名</th>
            </thead>
            <?php
                $companys=$pdo->query("SELECT * FROM `company` WHERE `status`='0'")->fetchAll();
                foreach($companys as $company){
            ?>
            <tr>
                <td><?=$company["name"]?></td>
                <td><?=$company["owner"]?></td>
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