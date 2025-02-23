<?php
    include "connect.php";
    if(isset($_POST["login"])){
        $_SESSION["login"]=false;
    }
    $is=$_POST["is"];
    if($is=="company"){
        $_SESSION["company"]=$_POST["id"];
    }else{
        $_SESSION["product"]=$_POST["id"];
    }
?>