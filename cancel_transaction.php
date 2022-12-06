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
    $payment_id = $_GET["trans_id"];
    $row = $member->getPayment($payment_id)[0];
    $payment_type = $row["payment_type"];
    $client_id = $row["client_id"];
    $flag = true;
    if($payment_type == "USD"){
        $amount = $row["amount"];
    }
    else{
        $amount = $row["eth_count"];
    }

    // Check if the Balance is 15 Minutes Old
    $check_15 = $member->check15CancelPayment($payment_id);
    if(empty($check_15)){
        echo "<script>alert('You cannot Cancel the Transaction Now')</script>";
    }
    else{
        $buyer = $member->getMemberById($client_id)[0];
        if($payment_type == "USD"){
            if($buyer["balance"] < $amount){
                echo "<script>alert('You cannot Cancel the Transaction Now')</script>";
            }
            else{
                $member->updateDollar($client_id, $amount * -1);
                $member->cancelPaymentUpdate($payment_id);
            }
        }
        else{
            if($buyer["eth_count"] < $amount){
                echo "<script>alert('You cannot Cancel the Transaction Now')</script>";
            }
            else{
                $member->updateEth($client_id, $amount * -1);
                $member->cancelPaymentUpdate($payment_id);
            }
        }
    }
    header("Location: ./wallet.php");
    
    
}
else{
    header("Location: ./index.php");
}

?>