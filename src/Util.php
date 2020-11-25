<?php
declare(strict_types=1);

namespace labo86\db_utils;


use Exception;
use Ramsey\Uuid\Uuid;

class Util
{
    /**
     * @param array $data
     * @return Exception
     */
    public static function logError(array $data) : Exception {
        error_log(print_r($data, true));
        return new Exception($data['message']);
    }

    public static function UUID() : string {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }
}