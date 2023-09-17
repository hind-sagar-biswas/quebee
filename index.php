<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use Hindbiswas\QueBee\Query;

$cols = [
    'id', 'name', 'email'
];
$cols_qr = Query::select($cols)->from('users')->build();

$aliased_cols = [
    'id' => 'user_id', 'user' => 'name', 'email' => 'email'
];
$aliased_cols_qr = Query::select($aliased_cols)->from('users')->build();


var_dump($cols_qr);
var_dump($aliased_cols_qr);