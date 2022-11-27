<?php
namespace NFT;

use \NFT\Member;
session_start();
require_once('session.php');
require_once __DIR__ . './class/Member.php';
$member = new Member();
$memberResult = $member->getMemberById($_SESSION["userId"]);
$displayName = ucwords($memberResult[0]["first_name"]);
$conversionRate = $member->get_eth_prices();

echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial;
            color: #333;
            font-size: 0.95em;
            background-image: url("./view/images/bg.jpeg");
        }
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
    <title>NFT</title>
</head>

<body>';

require_once('./header.php');

echo '<div class="container-fluid" style="padding-top: 50px;">
<div class="card">
    <div class="card-header text-center " style="font-family: Sans-Serif; text-transform:uppercase; font-size:1.5rem">
        LISTED NFTs
    </div>
    <br>';

$items = $member->getListedUserItems($_SESSION["userId"]);
    if($items != null) {
        foreach($items as $item){
            echo '<div class="card w-50">
                        <div class="card-body">
                            <h5 class="card-title">' . $item["name"] . '</h5>
                            <p class="card-text">Market Price : $ ' .$item["current_mp"]. '</p>
                            <p class="card-text">Market Price : Ξ ' .number_format($item["current_mp"]/$conversionRate,  2, ".", ""). '</p>
                            <a href="#" class="btn btn-primary">List</a>
                        </div>
                    </div>
                    <br>';
        }
    } else {
        $displayText = "You do not own NFT's. Want to Buy Some ? <span><a href='#'>Click Here</a></span>";
        echo $displayText;
    }
            
echo ' </div>
    </div>
</body>
</html>';
?>