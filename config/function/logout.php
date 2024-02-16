<?php
    session_start();

    if($_SESSION['user']['role_id'] == 1){
      unset($_SESSION['user']);
      header('Location: ../../login.php');
    }else{
        unset($_SESSION['user']);
        header('Location: ../../index.php');
    }
    exit();
