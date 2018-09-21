<?php
ini_set('display_errors', E_ALL);
$GLOBALS['THRIFT_ROOT'] = './thrift';
require_once( $GLOBALS['THRIFT_ROOT'] . '/Exception/TException.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/Exception/TTransportException.php' ); 
require_once( $GLOBALS['THRIFT_ROOT'] . '/Type/TType.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/Type/TMessageType.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/Thrift.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/transport/TSocket.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/transport/TBufferedTransport.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/protocol/TBinaryProtocol.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/gen-php/Hbase/Types.php' );
require_once( $GLOBALS['THRIFT_ROOT'] . '/gen-php/Hbase/Hbase.php' );
use Hbase\HbaseClient;
$socket = new TSocket('192.168.1.29', '9090');
 
$socket->setSendTimeout(10000); // Ten seconds (too long for production, but this is just a demo ;)
$socket->setRecvTimeout(20000); // Twenty seconds
$transport = new TBufferedTransport($socket);
$protocol = new TBinaryProtocol($transport);
$client = new HbaseClient($protocol);
 
$transport->open();
 
//获取表列表
$tables = $client->getTableNames();
sort($tables);
foreach ($tables as $name) {
 
    echo( "  found: {$name}\n" );
} 
$transport->close();
?>

