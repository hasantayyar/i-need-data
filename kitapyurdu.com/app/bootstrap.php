<?php
try {
     $m = new Mongo(); // connect
     $db = $m->selectDB("kitapyurdu");
} catch(MongoConnectionException $e) {
     echo 'db error';
     exit();
} 

