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

    public function getMemberByEth($eth)
    {
        $query = "SELECT DISTINCT * FROM traders WHERE ethereum_address = ?";
        $paramType = "s";
        $paramArray = array($eth);
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
        $query = "SELECT token_id,name, current_mp, list_in FROM nft_items WHERE owner_id = ? AND list = 0";
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

    public function getNFT($token_id){
        $query = "SELECT * FROM nft_items WHERE token_id = ?";
        $paramType = "i";
        $paramArray = array($token_id);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function getNFTTransaction($transaction_id){
        $query = "SELECT * FROM nft_transaction WHERE transaction_id = ?";
        $paramType = "i";
        $paramArray = array($transaction_id);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function getListedUserItems($clientid){
        $query = "SELECT name, current_mp, list_in FROM nft_items WHERE owner_id = ? AND list = 1";
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

    public function listedItems($clientid){
        $query = "SELECT token_id, name, current_mp, list_in FROM nft_items WHERE list = 1 AND owner_id <> ?";
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

    public function nft_transaction($commission, $commissionType, $nft_address, $token_id, $sellerid, $buyerid, $amount, $commission_payment_in){
        $query = "INSERT INTO nft_transaction (commission,commission_type,nft_address,nft_token_id, seller_eth_address,buyer_eth_address, amount, commission_payment_in) VALUES (?,?,?,?,?,?,?,?)";
        $paramType = "dssissds";
        $paramArray = array($commission, $commissionType, $nft_address, $token_id, $sellerid, $buyerid, $amount, $commission_payment_in);
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

    public function cancelPaymentUpdate($payment_id){
        $query = "UPDATE payment_transaction SET status = 'cancelled' WHERE payment_id = ?";
        $paramType = "i";
        $paramArray = array($payment_id);
        $memberResult = $this->ds->update($query, $paramType, $paramArray);
        if($memberResult > 0) {
            return true;
        }
        return false;
    }

    public function cancelTransactionUpdate($transaction_id){
        $query = "UPDATE nft_transaction SET transaction_status = 'cancelled' WHERE transaction_id = ?";
        $paramType = "i";
        $paramArray = array($transaction_id);
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

    public function listNFT($token_id, $price, $listin){
        $query = "UPDATE nft_items SET list = 1, current_mp = ?, list_in = ? WHERE token_id = ?";
        $paramType = "dsi";
        $paramArray = array($price, $listin, $token_id);
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

    public function addNFT($clientid, $name, $sca, $price, $listin){
        $query = "INSERT INTO nft_items (smart_contract_address,name,current_mp,owner_id, list_in) VALUES (?,?,?,?,?)";
        $paramType = "ssdis";
        $paramArray = array($sca, $name, $price, $clientid, $listin);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            return true;
        }
        return false;
    }


    public function updateNFTOwner($token_id, $buyer){
        $query = "UPDATE nft_items SET list = 0, owner_id = ? WHERE token_id = ?";
        $paramType = "ii";
        $paramArray = array($buyer, $token_id);
        $memberResult = $this->ds->update($query, $paramType, $paramArray);
        if($memberResult > 0) {
            return true;
        }
        return false;
    }

    public function updateTraderBalance($traderid, $amount, $currencytype){
        if($currencytype == "eth"){
            $this->updateEth($traderid, $amount);
        }
        else{
            $this->updateDollar($traderid, $amount);
        }
    }

    public function userNFTTransactionHistory($eth_address){
        $query = "SELECT * FROM nft_transaction WHERE seller_eth_address = ? OR buyer_eth_address = ?";
        $paramType = "ss";
        $paramArray = array($eth_address, $eth_address);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function getPayment($payment_id){
        $query = "SELECT * FROM payment_transaction WHERE payment_id = ?";
        $paramType = "i";
        $paramArray = array($payment_id);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function check15CancelPayment($payment_id){
        $query = "SELECT * FROM payment_transaction WHERE payment_id= ? and status='success' and TIMESTAMPDIFF(minute, current_timestamp(), transaction_date) < 15";
        $paramType = "i";
        $paramArray = array($payment_id);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
    }

    public function check15CancelTransaction($transaction_id){
        $query = "SELECT * FROM nft_transaction WHERE transaction_id= ? and transaction_status='success' and TIMESTAMPDIFF(minute, current_timestamp(), transaction_date) < 15";
        $paramType = "i";
        $paramArray = array($transaction_id);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)){
            return $memberResult;
        }
        else{
            return null;
        }
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
