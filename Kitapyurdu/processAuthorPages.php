<?php
try {
     $m = new Mongo(); // connect
     $db = $m->selectDB("books");
} catch(MongoConnectionException $e) {
     echo 'db error';
     exit();
}

