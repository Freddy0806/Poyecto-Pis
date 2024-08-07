<?php
    require "../productos/ctrLogin.php";
    $log = new Ctrlogin();
    $resp = $log->logout();
    if($resp["resp"]){
        header("location:../index.php");
    }else{
        echo json_encode($resp);
    }

    exit();

