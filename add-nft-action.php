<?php 

namespace NFT;

use \NFT\Member;
require_once (__DIR__ . "/class/Member.php");
$member = new Member();
if(!empty($_POST["add"])){
    session_start();
    $clientid = $_SESSION["userId"];
    $name = filter_var($_POST["nftname"], FILTER_SANITIZE_STRING);
    $sca = filter_var($_POST["sca"], FILTER_SANITIZE_STRING);
    $currencytype = filter_var($_POST["currency"], FILTER_SANITIZE_STRING);
    if($currencytype == "eth"){
        $price = (filter_var($_POST["price"], FILTER_SANITIZE_STRING)) * $member->get_eth_prices();
        $member->addNFT($clientid, $name, $sca, $price, $currencytype);
    }
    else{
        $price = filter_var($_POST["price"], FILTER_SANITIZE_STRING);
        $member->addNFT($clientid, $name, $sca, $price, $currencytype);
    }

    header("Location: ./user_unlistednfts.php");
    exit();

}

?>