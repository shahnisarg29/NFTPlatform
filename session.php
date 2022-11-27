<?php
namespace NFT;
use \NFT\Member;

if(empty($_SESSION["userId"])){
    header("Location: ./index.php");
}

?>