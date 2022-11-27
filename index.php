<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once __DIR__ . '/dashboard.php';
} else {
    require_once __DIR__ . '/login-form.php';
}
?>