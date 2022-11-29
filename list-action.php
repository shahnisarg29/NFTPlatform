<?php
namespace NFT;

use \NFT\Member;
require_once (__DIR__ . "/class/Member.php");
$member = new Member();
if (! empty($_POST["list"])) {
    session_start();
    $token_id = $_POST["token_id"];
    $currencytype = filter_var($_POST["currency"], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST["price"], FILTER_SANITIZE_STRING);
    if($currencytype == "usd"){
        $member->listNFT($token_id, $price);
    }
    else{
        $price = $price * $member->get_eth_prices();
        $member->listNFT($token_id, $price);
    }

    header("Location: ./user_listednfts.php");
    exit();
}

?>
