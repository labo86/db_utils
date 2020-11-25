<?php
declare(strict_types=1);

use labo86\db_utils\Util;
use labo86\db_utils\PDO;

include_once "phar://" . __DIR__ . "/db_utils/vendor/autoload.php";

$db_name = "name";
$host = "localhost";
$username = "user";
$password = "password";
$db = PDO::OpenMysql($db_name, $host, $username, $password);

PDO::selectAll($db, 'SELECT * FROM TABLE WHERE value = :value', ['value' => 'hola']);

echo Util::UUID();