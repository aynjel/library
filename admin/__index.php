<?php

require('../autoload.php');

$library = new Library();

$response = $library->find([
    'library_req_id', '=', 10
]);

H::debug($response->results());