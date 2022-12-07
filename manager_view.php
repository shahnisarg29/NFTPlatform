<?php
namespace NFT;

use \NFT\Member;
require_once('session.php');
require_once __DIR__ . './class/Member.php';
$member = new Member();
$memberResult = $member->getMemberById($_SESSION["userId"]);
$displayName = ucwords($memberResult[0]["first_name"]);
$eth_address = $memberResult[0]["ethereum_address"];

$userNFTS = $member->getAllTransactions();

echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="assets/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="assets/css/datatables/datatables.min.css">
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
    <div class="card-header text-center" style="font-family: Sans-Serif; text-transform:uppercase; font-size:1.5rem">
        
        <a href="daily_transaction.php" class="btn btn-primary">Daily Transaction</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="weekly_transaction.php" class="btn btn-primary">Weekly Transaction</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="monthly_transaction.php" class="btn btn-primary">Monthly Transaction</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
    </div>
</div>
</div>

<div class="container-fluid" style="padding-top: 50px;">
<div class="row">
                            <div class="col-xl-12">
                                <!-- Sorting -->
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>NFT Transaction History</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="table-responsive">
                                            <table id="sorting-table" class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction Date</th>
                                                        <th>NFT Token</th>
                                                        <th>Buyer Ethereum Address</th>
                                                        <th>Seller Ethereum Address</th>
                                                        <th>Amount</th>
                                                        <th><span style="width:100px;">Status</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                ';
                                                foreach($userNFTS as $t){
                                                    $statusColor = ($t["transaction_status"] == "success") ? "success" : "danger";
                                                    $prefix = ($t["commission_payment_in"] == "eth") ? "Ξ" : "$";
                                                    $date = date_create_from_format('Y-m-d H:i:s', $t["transaction_date"]);
                                                    echo '<tr>
                                                    <td><span class="text-primary">'.date_format($date, "d M Y, g:i A").'</span></td>
                                                    <td>'.$t["nft_token_id"].'</td>
                                                    <td>'.$t["buyer_eth_address"].'</td>
                                                    <td>'.$t["seller_eth_address"].'</td>
                                                    <td>'.$prefix.$t["amount"].'</td>
                                                    <td><span style="width:100px;"><span class="badge-text badge-text-small '.$statusColor.'">'.ucwords($t["transaction_status"]).'</span></span></td>
                                                    <td class="td-actions">
                                                            <a href="cancel__nft_transaction.php?trans_id='. $t["transaction_id"] .'"><i class="la la-close delete"></i></a>
                                                    </td>
                                                </tr>';
                                                }
                                                 echo '
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Sorting -->
                                <!-- Export -->
                                <!-- End Export -->
                            </div>
                        </div>
</div>


        <script src="assets/vendors/js/base/jquery.min.js"></script>
        <script src="assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="assets/vendors/js/datatables/datatables.min.js"></script>
        <script src="assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/vendors/js/datatables/jszip.min.js"></script>
        <script src="assets/vendors/js/datatables/buttons.html5.min.js"></script>
        <script src="assets/vendors/js/datatables/pdfmake.min.js"></script>
        <script src="assets/vendors/js/datatables/vfs_fonts.js"></script>
        <script src="assets/vendors/js/datatables/buttons.print.min.js"></script>
        <script src="assets/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        <script src="assets/js/components/tables/tables.js"></script>
</body>

</html>';
?>    