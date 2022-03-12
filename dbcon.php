<?php

require __DIR__.'/vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;



$factory = (new Factory )
    ->withServiceAccount('click-eat-7c731-firebase-adminsdk-wymay-532b243a18.json')
    ->withDatabaseUri('https://click-eat-7c731-default-rtdb.firebaseio.com/');
   
$database = $factory->createDatabase();
$auth = $factory->createAuth();
// $storage = $factory->createStorage();

$projectId = "click-eat-7c731";
try {
    $storage = new StorageClient([
        'keyFilePath' => 'click-eat-7c731-firebase-adminsdk-wymay-532b243a18.json',
        'projectId' => $projectId
    ]);
    $bucketName = "click-eat-7c731.appspot.com";
    $bucket = $storage->bucket($bucketName);
   
} catch(Exception $e) {
    echo $e->getMessage();
}

?>