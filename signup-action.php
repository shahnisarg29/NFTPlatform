<?php
namespace Phppot;

use \Phppot\Member;
if (! empty($_POST["signup"])) {
    session_start();
    $firstname = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);
    $cellnumber = filter_var($_POST["cell_number"], FILTER_SANITIZE_STRING);
    $ethaddress = filter_var($_POST["eth_address"], FILTER_SANITIZE_STRING);
    $street = filter_var($_POST["street_address"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city_address"], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST["state_address"], FILTER_SANITIZE_STRING);
    $zip = filter_var($_POST["zip_code"], FILTER_SANITIZE_STRING);
    require_once (__DIR__ . "/class/Member.php");
    
    $member = new Member();
    $isLoggedIn = $member->processSignup($firstname, $lastname,$username, $password, $phonenumber, $cellnumber, $ethaddress, $street, $city, $state, $zip);
    if (! $isLoggedIn) {
        $_SESSION["errorMessage"] = "Cannot Register";
    }
    header("Location: ./index.php");
    exit();
}
