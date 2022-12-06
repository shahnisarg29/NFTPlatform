<?php
// Check User Has Enough Balance in Specified Currency of Seller to Buy that NFT
// Get NFT 
// 
namespace NFT;

use \NFT\Member;
session_start();

require_once('session.php');
require_once __DIR__ . './class/Member.php';
$member = new Member();

if(isset($_GET["trans_id"])){
    $transaction_id = $_GET["trans_id"];
    $row = $member->getNFTTransaction($transaction_id)[0];
    $payment_type = $row["commission_payment_in"];
    $buyer_eth = $row["buyer_eth_address"];
    $seller_eth = $row["seller_eth_address"];
    $amount = $row["amount"];
    $token_id = $row["nft_token_id"];

    // Check if the Balance is 15 Minutes Old
    $check_15 = $member->check15CancelTransaction($transaction_id);
    if(empty($check_15)){
        echo "<script>alert('You cannot Cancel the Transaction Now')</script>";
    }
    else{
        $seller_id = $member->getMemberByEth($seller_eth)[0];
        $buyer_id = $member->getMemberByEth($buyer_eth)[0];
        if($payment_type == "usd"){
            // Credit Balance in buyer
            $member->updateDollar($buyer_id["client_id"], $amount);
            // Debit Balance in seller
            $member->updateDollar($seller_id["client_id"], $amount*-1);
            // Set Status as Cancelled
            $member->cancelTransactionUpdate($transaction_id);
            $member->updateNFTOwner($token_id, $seller_id["client_id"]);
        }
        else{
            // Credit Balance in buyer
            $member->updateEth($buyer_id["client_id"], $amount);
            // Debit Balance in seller
            $member->updateEth($seller_id["client_id"], $amount*-1);
            $member->cancelTransactionUpdate($transaction_id);
            $member->updateNFTOwner($token_id, $seller_id["client_id"]);
        }
    }
    header("Location: ./myitems.php");
    
    
}
else{
    header("Location: ./index.php");
}

?>