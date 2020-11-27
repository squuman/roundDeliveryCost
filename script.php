<?php

require __DIR__ .'/vendor/autoload.php';

$client = new \RetailCrm\ApiClient(
    'url',
    'key',
    \RetailCrm\ApiClient::V5
);

$_GET['id'] = 13557;
logger('request.log',$_REQUEST);
$order = ($client->request->ordersGet($_GET['id'],'id',''))['order'];
$orderEdit = $client->request->ordersEdit([
    'id' => $_GET['id'],
    'delivery' => [
        'cost' => round($order['delivery']['cost'])
    ]
],'id',$order['site']);
logger('orderEdit.log',$orderEdit);

function logger($filename = 'rcrm.log',$data = null) {
    if (!is_dir(__DIR__ .'/logs'))
        mkdir(__DIR__ .'/logs');
    $fd = fopen(__DIR__ . '/' . $filename,'a');
    fwrite($fd,print_r($data,true) . "\n");
    fclose($fd);
}