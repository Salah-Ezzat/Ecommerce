<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'veterinary');

$conn= new mysqli(HOST, USER, PASS, DBNAME);
$conn->set_charset('UTF8');