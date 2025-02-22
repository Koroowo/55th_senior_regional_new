<?php
    include "connect.php";
    $user=$_POST["name"];
    $password=$_POST["password"];
    if($user=="admin" && $password=="abcd1234"){
        $_SESSION["login"]=true;
        header("location:company.php");
    }else{
        ?><script>alert("帳號/密碼錯誤"); history.back();</script><?php
    }
?>