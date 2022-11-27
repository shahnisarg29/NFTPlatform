<?php 

namespace NFT;

use \NFT\Member;
session_start();
require_once('session.php');
require_once __DIR__ . './class/Member.php';
$member = new Member();
$memberResult = $member->getMemberById($_SESSION["userId"]);
$displayName = ucwords($memberResult[0]["first_name"]);
$fullName = ucwords($memberResult[0]["first_name"]) . " " .  ucwords($memberResult[0]["last_name"]);
$ethBalance = $memberResult[0]["eth_count"];
$usdBalance = $memberResult[0]["balance"];
$customerType = ucwords($memberResult[0]["client_category"]);
$totalNFTS = $member->userTotalNFTS($_SESSION["userId"]);

echo '<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
    body {
        font-family: Arial;
        color: #333;
        font-size: 0.95em;
        background-image: url("./view/images/bg.jpeg");
    }
        .avatar-ctn {
            background-color: orange;
            text-align: center;
        }

        .avatar {
            width: 65%;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>

</head>
<body>';

require_once('./header.php');

echo '<div class="container mt-4">
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="avatar-ctn">
                <img src="./view/images/avatar.png" class="avatar" alt="user profile picture" />
            </div>
            <div class="card-body">
                <h5 class="card-title">'. $fullName . '</h5>
                <p class="card-text">Total NFT Owned : ' . $totalNFTS[0]["count"] .  '</p>
                <p class="card-text">USD Balance : $'. $usdBalance .'</p>
                <p class="card-text">Ethereum Balance : Ξ'. $ethBalance .'</p>
                <input class="btn btn-secondary" type="button" value="' . $customerType . '" disabled>
                <a href="transactionhistory.php" class="btn btn-info">Show Transaction History</a>
            </div>
        </div>
    </div>

    <div class="col-8">
                <div class="card text-center">
                    <div class="card-header">
                        <b>Wallet</b>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Add Currency</h5>
                            <form action="wallet-action.php" method="POST">
                                <div class="dollars">
                                    <input type="radio" class="Positive" name="currencytype" value="selectdollar" onClick="getResults(this)" checked>Dollar $&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" class="Show" name="currencytype" value="selecteth" onclick="getResults(this)">Ethereum Ξ
                                </div><br>

                                <div class="dollars"><label> Add Amount bellow </label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                    <br />
                                </div>

                                <div class="selectdollar">
                                    <div class="dollars"><label> Enter Bank Account </label>
                                        <input type="number" class="form-control" id="bank" name="bank">
                                        <br />
                                        <div class="submission_P">
                                            <input type="submit" class="btn btn-success" name="submitbtn" value="Confirm">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="selecteth" style="display: none";>
                                    <div class="dollars"><label>Ethereum Smart Contract Address </label>
                                        <input type="text" class="form-control text-center" name="eth" value="'. $memberResult[0]["ethereum_address"] .'" readonly>
                                        <br />
                                        <div class="submission_P">
                                            <input type="submit" class="btn btn-success" name="submitbtn" value="Confirm">
                                        </div>
                                    </div>
                                </div>
                                <br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</body>

<script>
function getResults(elem) {
    if (elem.checked == true) {
        if (elem.value == "selectdollar") {
            $(".selectdollar").show()
            $(".selecteth").hide();
        }
        else if(elem.value == "selecteth") {
            $(".selectdollar").hide()
            $(".selecteth").show();
        }
    }

};         
</script>
</html>';
?>