<?php
namespace NFT;

use \NFT\Member;
require_once (__DIR__ . "/class/Member.php");
    $member = new Member();
if (! empty($_POST["submitbtn"])) {
    session_start();
    $userid = $_SESSION["userId"];
    $currencytype = filter_var($_POST["currencytype"], FILTER_SANITIZE_STRING);
    $amount = filter_var($_POST["amount"], FILTER_SANITIZE_STRING);
    if($currencytype == "selectdollar"){
        $account = filter_var($_POST["bank"], FILTER_SANITIZE_STRING);
        $payment_id = $member->dollarAdd($userid, $amount, $account);
        $updated_rows = $member->updateDollar($userid, $amount);
    }
    else{
        $account = filter_var($_POST["eth"], FILTER_SANITIZE_STRING);
        $payment_id = $member->ethAdd($userid, $amount, $account);
        $updated_rows = $member->updateEth($userid, $amount);
    }
    
    


    header("Location: ./wallet.php");
    exit();
}

?>
