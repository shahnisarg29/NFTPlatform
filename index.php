<?php
session_start();
if(!empty($_SESSION["userId"])) {
    if(!empty($_SESSION["manager"])){
        require_once __DIR__ . '/manager_view.php';
    }
    else{
        require_once __DIR__ . '/dashboard.php';
    }
    
} else {
    require_once __DIR__ . '/login-form.php';
}
?>