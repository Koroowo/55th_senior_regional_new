<?php
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
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
        <h2 class="m-0">LOGO</h2>
        <h2 class="m-0">臺灣人工智慧公會</h2>
        <div class="d-flex">
            <button class="btn" onclick="location.href='gtin_verify.php'">GTIN 批次驗證頁面</button>
            <button class="btn" onclick="location.href='searchpage.php'">產品查詢頁面</button>
            <button class="btn" onclick="location.href='login.php'">管理</button>
        </div>
    </div>
    <h2 class="m-0 text-center mt-5">GTIN 批次驗證頁面</h2>
    <div class="d-flex justify-content-center mx-auto mt-5 w-50">
        <div class="w-50 mx-auto">
            <textarea id="gtin_input" class="form-control"></textarea>
            <button class="btn btn-success" id="send">送出</button>
        </div>
        <div class="w-50 mx-auto">
            <h4 class="m-0 text-success text-center" id="valid"></h4>
            <div id="gtin_box" class="w-50 mx-auto">

            </div>
        </div>
    </div>
    <footer class="footer">
        <p class="m-0">TWAIA, Taiwan Artificial Intelligence Association</p>
    </footer>
</body>
</html>
<script>
    document.getElementById("send").addEventListener("click",function(){
        let input=document.getElementById("gtin_input").value;
        $.ajax({
            url:"gtin_verifyback.php",
            method:"POST",
            data:{input:input},
            dataType:"JSON"
        }).done(function(response){
            let text="";
            let x=0;
            for(i=0;i<response.length;i++){
                text+="<div class='d-flex'><p class='m-0 mx-3'>"+response[i].gtin+"</p><p class='m-0 mx-3'>"+response[i].status+"</p></div>"
                if(response[i].status=="valid"){
                    x++;
                }
            }
            if(x==response.length && response.length!=0){
                document.getElementById("valid").innerHTML="&check; All valid";
            }else{
                document.getElementById("valid").innerHTML="";
            }
            document.getElementById("gtin_box").innerHTML=text;
        })
    })
</script>