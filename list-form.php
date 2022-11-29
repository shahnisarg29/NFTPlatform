<?php 
namespace NFT;

use \NFT\Member;
session_start();

require_once('session.php');
require_once __DIR__ . './class/Member.php';


if(isset($_GET["token"])){
    $token_id = $_GET["token"];
}
else{
    header("Location: ./index.php");
}


$member = new Member();
$memberResult = $member->getMemberById($_SESSION["userId"]);
$displayName = ucwords($memberResult[0]["first_name"]);


echo '<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List NFT Items</title>

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
    <script>
        window.addEventListener("load", function(){
            var xhr = null;
            getXmlHttpRequestObject = function(){
                if(!xhr){               
            // Create a new XMLHttpRequest object 
                    xhr = new XMLHttpRequest();
                }
                return xhr;
            };
            updateLiveData = function(){
                var now = new Date();
                var url = "ethAPI.php";
                xhr = getXmlHttpRequestObject();
                xhr.onreadystatechange = evenHandler;
                xhr.open("GET", url, true);
                xhr.send(null);
            };

            updateLiveData();

            function evenHandler(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    dataDiv = document.getElementById("rate");
                    val = JSON.parse(xhr.responseText);
                    dataDiv.value = "Ξ1 = $".concat(val.data);
                    setTimeout(updateLiveData(), 5000);
                }
            }
        });
    </script>
</head>

<body>';

require_once("./header.php");

echo '<div>
<form action="./list-action.php" method="post" id="frmAddNFT">
    <div class="login-form-container">
        <div class="form-head">List NFT</div>';

        if (isset($_SESSION["errorMessage"])) {
            echo '<div class="error-message">';
            echo $_SESSION["errorMessage"];
            echo '<div>';
            unset($_SESSION["errorMessage"]);
        }

        echo '<div class="field-column">
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
            <label for="rate">Live Rate</label><span id="nft_info" class="error-info"></span>
        </div>
        <div>
            <input name="rate" id="rate" type="text" class="form-control" value="" readonly>
        </div>
    </div>

    <div class="field-column" hidden>
        <div>
            <input name="token_id" id="token_id" type="text" class="form-control" value="'.$token_id.'" hidden>
        </div>
    </div>

    <div class="field-column">
        <div>
            <label for="price">Price</label><span id="nft_info" class="error-info"></span>
        </div>
        <div>
            <input name="price" id="price" type="text" class="form-control" placeholder="Enter New Price">
        </div>
    </div>

    <div class=field-column>
        <div class="text-center">
            <input type="submit" name="list" value="List" class="btn btn-primary"></span>
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

</html>';
?>

                