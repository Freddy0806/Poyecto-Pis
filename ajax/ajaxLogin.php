<?php
    require "../productos/ctrLogin.php";
    $log = new Ctrlogin();
    $resp = $log->login();
    if($resp["resp"]){
        header("location:../productos.php");
    }else{
        echo json_encode($resp);
    }

    exit();