<?php 
function get_eth_prices(){
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

$array = array(
    "data" => get_eth_prices()
);

echo json_encode($array);
?>