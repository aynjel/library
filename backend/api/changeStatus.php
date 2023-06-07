<?php

require('../../autoload.php');

$status = Input::get('status');
$id = Input::get('id');

$request = new LibraryRequest();
if($request->updateRequest($id, [$status, $id])){
    echo 'success';
}
