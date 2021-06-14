<?php
define('CLIENT_SECRET', 'my_shared_secret');

function verify_webhook($data, $hmac_header){
    $calculated_hmac = base64_encode(hash_hmac('sha256', $data, CLIENT_SECRET, true));
    return ($hmac_header == $calculated_hmac);
}

$hmac_header = $_SERVER['X-NINJAVAN-HMAC-SHA256'];
$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header);
error_log('Webhook verified: '.var_export($verified, true)); //check error.log to see result
?>