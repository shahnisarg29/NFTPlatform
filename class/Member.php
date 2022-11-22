<?php
namespace Phppot;

use \Phppot\DataSource;

class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function getMemberById($memberId)
    {
        $query = "select * FROM traders WHERE client_id = ?";
        $paramType = "i";
        $paramArray = array($memberId);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        
        return $memberResult;
    }
    
    public function processLogin($username, $password) {
        $query = "select * FROM traders WHERE email = ?";
        $paramType = "s";
        $paramArray = array($username);
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
        $query = "INSERT INTO traders (first_name, last_name, email, password, phone_num, cell_num, ethereum_address, street, city, state, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssssss";
        $paramArray = array($firstname, $lastname, $email, password_hash($pass, PASSWORD_DEFAULT), $phone, $cell, $eth_address, $street, $city, $state, $zip);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            $_SESSION["userId"] = $memberResult;
            return true;
        }
        return false;
    }
}
