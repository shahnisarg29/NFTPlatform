<?php 
namespace NFT;
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add NFT Items</title>

    <!-- CSS only -->
    <link href="./view/css/form.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial;
            color: #333;
            font-size: 0.95em;
            background-image: url("./view/images/bg.jpeg");
        }
    </style>
</head>

<body>
    <?php

    use \NFT\Member;
    session_start();
    require_once('session.php');
    require_once __DIR__ . './class/Member.php';
    $member = new Member();
    $memberResult = $member->getMemberById($_SESSION["userId"]);
    $displayName = ucwords($memberResult[0]["first_name"]);
    require_once("./header.php"); ?>
    <div>
        <form action="./add-nft-action.php" method="post" id="frmAddNFT" onSubmit="return validate();">
            <div class="login-form-container">

                <div class="form-head">Add NFT</div>
                <?php
                if (isset($_SESSION["errorMessage"])) {
                ?>
                    <div class="error-message"><?php echo $_SESSION["errorMessage"]; ?></div>
                <?php
                    unset($_SESSION["errorMessage"]);
                }
                ?>
                <div class="field-column">
                    <div>
                        <label for="nftname">Token Name</label><span id="nft_info" class="error-info"></span>
                    </div>
                    <div>
                        <input name="nftname" id="nftname" type="text" class="form-control" placeholder="Enter NFT Name">
                    </div>
                </div>
                <div class="field-column">
                    <div>
                        <label for="sca">Smart Contract Address</label><span id="nft_info" class="error-info"></span>
                    </div>
                    <div>
                        <input name="sca" id="smart_contract_address" type="text" class="form-control" placeholder="Enter Smart Contract Address">
                    </div>
                </div>
               

                <div class="field-column">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currency" id="inlineRadio1" value="eth">
                        <label class="form-check-label" for="inlineRadio1">Eth Ξ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="currency" id="inlineRadio2" value="usd">
                        <label class="form-check-label" for="inlineRadio2">Dollar $</label>
                    </div>
                </div>

                <div class="field-column">
                    <div>
                        <label for="price">Price</label><span id="nft_info" class="error-info"></span>
                    </div>
                    <div>
                        <input name="price" id="price" type="text" class="form-control" placeholder="Enter Price">
                    </div>
                </div>

                <div class=field-column>
                    <div class="text-center">
                        <input type="submit" name="add" value="Add" class="btn btn-primary"></span>
                    </div>
                </div>


            </div>
        </form>
    </div>
    <script>
        function validate() {
            var $valid = true;
            document.getElementById("user_info").innerHTML = "";
            document.getElementById("password_info").innerHTML = "";

            var userName = document.getElementById("user_name").value;
            var password = document.getElementById("password").value;
            if (userName == "") {
                document.getElementById("user_info").innerHTML = "required";
                $valid = false;
            }
            if (password == "") {
                document.getElementById("password_info").innerHTML = "required";
                $valid = false;
            }
            return $valid;
        }
    </script>
</body>

</html>