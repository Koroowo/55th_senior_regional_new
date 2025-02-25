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
    <div class="btn-group my-3 mx-5">
        <button class="btn btn-primary">會員公司</button>
        <button class="btn" onclick="location.href='products.php'">產品列表</button>
        <?php
            if($_SESSION["login"]==true){
        ?>
        <button class="btn" onclick="location.href='logs.php'">管理紀錄</button>
        <?php
        }
        ?>
    </div>
    <div class="d-flex justify-content-center">
        <h2 class="m-0">會員公司列表</h2>
        <?php
            if($_SESSION["login"]==true){
        ?>
        <button class="btn btn-success" onclick="add()">新增會員公司</button>
        <?php
        }
        ?>
    </div> 
    <div class="w-75 mx-auto my-3 overflow-auto" style="max-height:600px;">
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
                <td><button class="btn btn-primary" onclick="view(<?=$company['id']?>);">查看</button></td>
                <td><button class="btn btn-primary set" data-name="<?=$company["name"]?>" data-id="<?=$company["id"]?>">查看</button></td>
                <?php
                    if($_SESSION["login"]==true){
                        echo "<td>
                            <button class='btn btn-warning' onclick='edit(".$company["id"].");'>修改</button>
                            <button class='btn btn-danger' onclick='disable(".$company["id"].");'>停用</button>
                            <button class='btn btn-danger' onclick='del(".$company["id"].");'>刪除</button>
                        </td>";
                    }
                ?>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <?php
        if($_SESSION["login"]==true){
    ?>
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
    <?php
        }
    ?>
    <div class="modal_bg" id="modal">
        <div class="modal_div" id="modal_div">
            <button class="btn btn-danger modal_exit" onclick="exit();">X</button>
            <form id="submitform">
                <div class="d-flex justify-content-center mt-2">
                    <h4 class="m-0">公司名稱: </h4>
                    <input type="text" name="name" id="name" class="form-control w-50" >
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h4 class="m-0">公司地址: </h4>
                    <input type="text" name="address" id="address" class="form-control w-50" >
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h4 class="m-0">公司電話號碼: </h4>
                    <input type="text" name="phone" id="phone" class="form-control w-50" >
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h4 class="m-0">公司電子郵件地址: </h4>
                    <input type="text" name="email" id="email" class="form-control w-50" >
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h4 class="m-0">擁有者姓名: </h4>
                    <input type="text" name="owner" id="owner" class="form-control w-50" >
                </div>
                <div class="justify-content-center mt-2" id="btns">
                    <button class="btn btn-success mx-2" id="send">送出</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer p-3 text-white">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    document.querySelectorAll(".set").forEach(function(btn){
        btn.addEventListener("click",function(){
            let id=btn.dataset.id;
            let name=btn.dataset.name
            $.ajax({
                url:"set.php",
                method:"POST",
                data:{id:id,name:name,is:"company"}
            }).done(function(){
                location.href="companydetail.php";
            })
        })
    })
    let action="";
    function edit(id){
        action="edit";
        $.ajax({
            url:"fetchcompany.php",
            method:"POST",
            data:{id:id}
        }).done(function(response){
            document.querySelectorAll(".form-control").forEach(function(inputs){
                inputs.disabled=false;
            })
            document.getElementById("name").value=response["name"];
            document.getElementById("address").value=response["address"];
            document.getElementById("phone").value=response["phone"];
            document.getElementById("email").value=response["email"];
            document.getElementById("owner").value=response["owner"];
            document.getElementById("modal").style.display="block";
            document.getElementById("btns").style.display="flex";
        })
    }
    function view(id){
        $.ajax({
            url:"fetchcompany.php",
            method:"POST",
            data:{id:id}
        }).done(function(response){
            document.querySelectorAll(".form-control").forEach(function(inputs){
                inputs.disabled=true;
            })
            document.getElementById("name").value=response["name"];
            document.getElementById("address").value=response["address"];
            document.getElementById("phone").value=response["phone"];
            document.getElementById("email").value=response["email"];
            document.getElementById("owner").value=response["owner"];
            document.getElementById("modal").style.display="block";
            document.getElementById("btns").style.display="none";
        })
    }
    function add(){
        action="add"
        document.querySelectorAll(".form-control").forEach(function(inputs){
            inputs.value="";
            inputs.disabled=false;
        })
        document.getElementById("modal").style.display="block";
        document.getElementById("btns").style.display="flex";
    }
    document.getElementById("send").addEventListener("click",function(){
        if(action=="add"){
            $.ajax({
                url:"addcompany.php",
                method:"POST",
                data:$("#submitform").serialize()
            }).done(function(){
                location.reload();
            })
        }else{
            $.ajax({
                url:"editcompany.php",
                method:"POST",
                data:$("#submitform").serialize()
            }).done(function(){
                location.reload();
            })
        }
    })
    function exit(){
        document.getElementById("modal").style.display="none";
    }
    // disable and del all go into del.php and check if it is disable or delete
    function disable(id){
        $.ajax({
            url:"del.php",
            method:"POST",
            data:{id:id,is:"disable",from:"company"}
        }).done(function(){
            location.href="company.php";
        })
    }
    function del(id){
        if(window.confirm("是否刪除此會員公司?")){
            $.ajax({
                url:"del.php",
                method:"POST",
                data:{id:id,is:"delete",from:"company"}
            }).done(function(){
                location.href="company.php";
            })
        }
    }
</script>