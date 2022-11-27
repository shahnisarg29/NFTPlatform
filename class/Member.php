<?php
namespace NFT;

use \NFT\DataSource;

class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    public function getMemberById($memberId)
    {
        $query = "SELECT * FROM traders WHERE client_id = ?";
        $paramType = "i";
        $paramArray = array($memberId);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        
        return $memberResult;
    }
    
    public function processLogin($username, $password, $manager) {
        $query = "SELECT * FROM traders WHERE email = ? AND user_role = ?";
        $paramType = "si";
        $paramArray = array($username, $manager);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            $hashedPassword = $memberResult[0]["password"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["userId"] = $memberResult[0]["client_id"];
                return true;
            }
        }
        return false;
    }

    public function processSignup($firstname, $lastname, $email, $pass, $phone, $cell, $eth_address, $street, $city, $state, $zip) {
        $query = "INSERT INTO traders (first_name, last_name, email, password, phone_num, cell_num, ethereum_address, street, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssssss";
        $paramArray = array($firstname, $lastname, $email, password_hash($pass, PASSWORD_DEFAULT), $phone, $cell, $eth_address, $street, $city, $state, $zip);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            $_SESSION["userId"] = $memberResult;
            return true;
        }
        return false;
    }

    public function getUnlistedUserItems($clientid){
        $query = "SELECT name, current_mp FROM nft_items WHERE owner_id = ? AND list = 0";
        $paramType = "i";
        $paramArray = array($clientid);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }
    public function getListedUserItems($clientid){
        $query = "SELECT name, current_mp FROM nft_items WHERE owner_id = ? AND list = 1";
        $paramType = "i";
        $paramArray = array($clientid);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function listedItems(){
        $query = "SELECT name, current_mp FROM nft_items WHERE list = 1";
        $memberResult = $this->ds->select($query);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    // Total Count of User Owned NFTS
    public function userTotalNFTS($clientid){
        $query = "SELECT COUNT(*) as count FROM nft_items WHERE owner_id = ?";
        $paramType = "i";
        $paramArray = array($clientid);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function dollarAdd($userid, $amount, $payment_add){
        $query = "INSERT INTO payment_transaction (client_id,payment_type,amount,payment_address,status,eth_count) VALUES (?,'USD',?,?,'success',NULL)";
        $paramType = "iis";
        $paramArray = array($userid, $amount, $payment_add);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            return true;
        }
        return false;
    }

    public function ethAdd($userid, $amount, $payment_add){
        $query = "INSERT INTO payment_transaction (client_id,payment_type,amount,payment_address,status,eth_count) VALUES (?,'ETH',NULL,?,'success',?)";
        $paramType = "isi";
        $paramArray = array($userid, $payment_add, $amount);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            return true;
        }
        return false;
    }

    public function updateDollar($userid, $amount){
        $query = "UPDATE traders SET balance = balance + ? where client_id = ?";
        $paramType = "ii";
        $paramArray = array($amount, $userid);
        $memberResult = $this->ds->update($query, $paramType, $paramArray);
        if($memberResult > 0) {
            return true;
        }
        return false;
    }

    public function updateEth($userid, $amount){
        $query = "UPDATE traders SET eth_count = eth_count + ? where client_id = ?";
        $paramType = "ii";
        $paramArray = array($amount, $userid);
        $memberResult = $this->ds->update($query, $paramType, $paramArray);
        if($memberResult > 0) {
            return true;
        }
        return false;
    }
    
    public function userPaymentHistory($clientid){
        $query = "SELECT * FROM payment_transaction WHERE client_id = ?";
        $paramType = "i";
        $paramArray = array($clientid);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function addNFT($clientid, $name, $sca, $price){
        $query = "INSERT INTO nft_items (smart_contract_address,name,current_mp,owner_id) VALUES (?,?,?,?)";
        $paramType = "ssdi";
        $paramArray = array($sca, $name, $price, $clientid);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            return true;
        }
        return false;
    }

    public function get_eth_prices(){
        $request = 'https://api.coinbase.com/v2/prices/ETH-USD/buy';
        $http = curl_init($request);
        curl_setopt($http, CURLOPT_HEADER, false);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
                      // make the request
        $response = curl_exec($http);
                      // get the status code
        $status_code = curl_getinfo($http, CURLINFO_HTTP_CODE);
                      // close the curl session
        curl_close($http);
                      // if the request worked then we have a string with JSON in it
        if ($status_code == 200) {
            $ans = json_decode($response);
            $data = "data";
            $amount = "amount";
            $a = $ans->$data->$amount;
                return $a;
        }
        else {
            return -1;
        }
    }
}
