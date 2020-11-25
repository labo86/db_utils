<?php
declare(strict_types=1);

namespace labo86\db_utils;


use Exception;

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
}