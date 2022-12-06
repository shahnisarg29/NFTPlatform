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

if(isset($_GET["token_id"])){
    $token_id = $_GET["token_id"];
    $balance = $_GET["balance"];
    $eth_count = $_GET["ethereum_count"];
    $nft = $member->getNFT($token_id);
    $seller_id = $nft[0]["owner_id"];
    $sca = $nft[0]["smart_contract_address"];
    $list_in = $nft[0]["list_in"];
    $current_mp = $nft[0]["current_mp"];
    $buyer_id = $_SESSION["userId"];
    $buyer = $member->getMemberById($buyer_id);
    $buyer_eth_addr = $buyer[0]["ethereum_address"];

    if($list_in == "usd"){
        if($balance < $current_mp){
            echo "<script>alert('You do not have sufficient balance')</script>";
        }
        else{
            // Get Old Owner Id, trader gold or silver, calculate commission 
            $seller = $member->getMemberById($seller_id);
            $commissionType = $seller[0]["client_category"];
            $seller_eth_addr = $seller[0]["ethereum_address"];
            // Calculate Commission 
            if($commissionType == "gold"){
                // 10 Percent Commission
                $commission = $current_mp*0.1;
                $seller_credit = $current_mp - $commission;
            }
            else{
                // 15 Percent Commission
                $commission = $current_mp*0.15;
                $seller_credit = $current_mp - $commission;
            }

            // Update NFT_items Table (setting owner_id and list)
            $member->updateNFTOwner($token_id, $buyer_id);
            // Update traders table (changing the balance)
            // Debit Buyer Balance
            $member->updateTraderBalance($buyer_id, ($current_mp*-1), $list_in);
            $member->updateTraderBalance($seller_id, $seller_credit, $list_in);
            // Insert NFT transaction (new transaction)
            $member->nft_transaction($commission, $commissionType, $sca, $token_id, $seller_eth_addr, $buyer_eth_addr, $current_mp, $list_in);
        }
    }
    else{
        if($eth_count < $current_mp){
            echo "<script>alert('You do not have sufficient balance')</script>";
        }
        else{
            // Get Old Owner Id, trader gold or silver, calculate commission 
            $seller = $member->getMemberById($seller_id);
            $commissionType = $seller[0]["client_category"];
            $seller_eth_addr = $seller[0]["ethereum_address"];
            // Calculate Commission 
            if($commissionType == "gold"){
                // 10 Percent Commission
                $commission = $current_mp*0.1;
                $seller_credit = $current_mp - $commission;
            }
            else{
                // 15 Percent Commission
                $commission = $current_mp*0.15;
                $seller_credit = $current_mp - $commission;
            }
            // Update NFT_items Table
            // Update NFT_items Table (setting owner_id and list)
            $member->updateNFTOwner($token_id, $buyer_id);
            // Update traders table (changing the balance)
            // Debit Buyer Balance
            $member->updateTraderBalance($buyer_id, ($current_mp*-1), $list_in);
            $member->updateTraderBalance($seller_id, $seller_credit, $list_in);
            // Insert NFT transaction (new transaction)
            $member->nft_transaction($commission, $commissionType, $sca, $token_id, $seller_eth_addr, $buyer_eth_addr, $current_mp, $list_in);
        }
    }

    header("Location: ./user_unlistednfts.php");
    
}
else{
    header("Location: ./index.php");
}




?>