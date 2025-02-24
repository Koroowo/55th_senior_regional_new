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
        $companys=$pdo->query("SELECT * FROM `company` WHERE `status`='1'")->fetchAll();
    ?>
    <div class="d-flex justify-content-between w-100">
        <div class="btn-group my-3 mx-5">
            <button class="btn" onclick="location.href='company.php'">會員公司</button>
            <button class="btn btn-primary">產品列表</button>
            
        </div>
        <form class="my-3 mx-5" action="searchproduct.php" method="POST">
            <input type="text" name="gtin" placeholder="查詢產品GTIN:" required>
            <button class="btn btn-success">送出</button>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        <h2 class="m-0">產品列表</h2>
    </div> 
    <div class="mx-auto my-3 overflow-auto" style="max-height:600px;">
        <div class="content mx-auto">
        <?php
            if($_SESSION["login"]==true){
                $products=$pdo->query("SELECT * FROM `product` ORDER BY `status` DESC")->fetchAll();
            }else{
                $products=$pdo->query("SELECT * FROM `product` WHERE `status`='1'")->fetchAll();
            }
            foreach($products as $product){
                if($product["img"]!=""){
                    if($product["status"]=="1" && $_SESSION["login"]==true){
                        echo "<div class='product_card my-3 mx-auto' id='".$product["id"]."'>
                            <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                            <img src='data:".$product["mime"].";base64,".$product["img"]."' class='productimg' alt=''>
                            <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                            <p class='m-0'>GTIN:".$product["gtin"]."</p>
                            <p class='m-0'>描述:".$product["description"]."</p>
                            <button class='btn btn-danger w-100' onclick='disable(".$product["id"].")'>隱藏</button>
                        </div>";
                    }else if($product["status"]=="0" && $_SESSION["login"]==true){
                        echo "<div class='product_card my-3 mx-auto hide' id='".$product["id"]."'>
                            <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                            <img src='data:".$product["mime"].";base64,".$product["img"]."' class='productimg' alt=''>
                            <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                            <p class='m-0'>GTIN:".$product["gtin"]."</p>
                            <p class='m-0'>描述:".$product["description"]."</p>
                        </div>";
                    }else{
                        echo "<div class='product_card my-3 mx-auto' id='".$product["id"]."'>
                            <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                            <img src='data:".$product["mime"].";base64,".$product["img"]."' class='productimg' alt=''>
                            <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                            <p class='m-0'>GTIN:".$product["gtin"]."</p>
                            <p class='m-0'>描述:".$product["description"]."</p>
                        </div>";
                    }
                }else{
                    if($product["status"]=="1" && $_SESSION["login"]==true){
                        echo "<div class='product_card my-3 mx-auto' id='".$product["id"]."'>
                            <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                            <img src='img/default_img.png' class='productimg' alt=''>
                            <p class='m-0'>公司名稱:".$product["company_name"]."</p>
                            <p class='m-0'>GTIN:".$product["gtin"]."</p>
                            <p class='m-0'>描述:".$product["description"]."</p>
                            <button class='btn btn-danger w-100' onclick='disable(".$product["id"].")'>隱藏</button>
                        </div>";
                    }else if($product["status"]=="0" && $_SESSION["login"]==true){
                        echo "<div class='product_card my-3 mx-auto hide' id='".$product["id"]."'>
                            <h4 class='m-0'>產品名稱:".$product["name"]."</h4>
                            <img src='img/default_img.png' class='productimg' alt=''>
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
    document.querySelectorAll(".product_card").forEach(function(card){
        card.querySelector("h4").addEventListener("click",function(){
            let id=card.id;
            $.ajax({
                url:"set.php",
                method:"POST",
                data:{id:id,is:"product"}
            }).done(function(){
                location.href='productdetail.php';
            })
        })
    })
    function disable(id){
        $.ajax({
            url:"del.php",
            method:"POST",
            data:{id:id,is:"disable",from:"product"}
        }).done(function(){
            location.href="products.php";
        })
    }
</script>