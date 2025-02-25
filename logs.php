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
            <button class="btn" onclick="location.href='login.php'">管理</button>
        </div>
    </div>
    <?php
        $logs=$pdo->query("SELECT * FROM `logs` ORDER BY `time` DESC")->fetchAll();
    ?>
    <div class="btn-group my-3 mx-5">
        <button class="btn" onclick="location.href='company.php'">會員公司</button>
        <button class="btn" onclick="location.href='products.php'">產品列表</button>
        <button class="btn btn-primary">管理紀錄</button>
    </div>
    <div class="d-flex justify-content-center">
        <h2 class="m-0">管理紀錄列表</h2>
    </div> 
    <div class="w-75 mx-auto my-3 overflow-auto" style="max-height:600px;">
        <table class="table table-striped table-light my-3 table-hover">
            <thead>
                <th class="col-4">動作</th>
                <th class="col-2">成功/失敗</th>
                <th class="col-1">時間</th>
            </thead>
            <?php
                foreach($logs as $log){
            ?>
            <tr>
                <td><?=$log["action"]?></td>
                <td><?=$log["status"]?></td>
                <td><?=$log["time"]?></td>
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