<pre>
<?php

use client\core\Account;
use client\core\Orders;
use GuzzleHttp\Exception\GuzzleException;

require 'vendor/autoload.php';

ini_set("display_errors", "On");
ini_set("memory_limit", PHP_INT_MAX . 'MB');
error_reporting(E_ALL);

$orders = new Orders();

try {
    print_r($orders->getAll([
        'pair' => 'BTC_USDT'
    ]));
} catch (GuzzleException $e) {
    print_r($e);
}
?>
</pre>
