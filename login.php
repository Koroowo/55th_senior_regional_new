<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="bootstrap.js"></script>
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
    <div class="mx-auto w-50 mt-5">
        <div class="d-flex justify-content-center">
            <img src="img/logo.png" style="height:50px;" alt="">
        </div>
        <form action="loginback.php" method="POST">
            <div class="d-flex my-3 justify-content-center">
                <h4 class="m-0">帳號: </h4>
                <input class="form-control w-50" type="text" name="name" required>
            </div>
            <div class="d-flex my-3 justify-content-center">
                <h4 class="m-0">密碼: </h4>
                <input class="form-control w-50" type="password" name="password" required>
            </div>
            <div class="d-flex my-3 justify-content-center">
                <button class="btn btn-success mx-3">送出</button>
                <button type="button" class="btn btn-warning mx-3" onclick="reset();">清除</button>
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
        document.querySelectorAll(".form-control").forEach(function(){
            this.value="";
        })
    }   
</script>