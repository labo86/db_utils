<?php
declare(strict_types=1);

namespace labo86\db_utils;

use Exception;
use PDOStatement;

class PDO
{

    public static function OpenMysql(string $db_name, string $host, string $username, string $password) : \PDO {
        $dns = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $host, $db_name);
        $pdo = new \PDO($dns, $username, $password);
        return $pdo;
    }

    public static function OpenSqlite(string $filename) : \PDO {
        $dns = sprintf('sqlite:%s', $filename);
        $pdo = new \PDO($dns);
        return $pdo;
    }

    /**
     * @param PDOStatement $stmt
     * @param mixed ...$args
     * @return PDOStatement
     * @throws Exception
     */
    public static function execute(PDOStatement $stmt, array $args = []) : PDOStatement
    {

        if ($stmt->execute($args))
            return $stmt;

        $error = [
            'message' => 'error in query execution',
            'pdo_error' => $stmt->errorInfo(),
            'query' => $stmt->queryString,
            'args' => $args
        ];
        throw Util::logError($error);
    }

    /**
     * @param PDOStatement $stmt
     * @param array $args
     * @return array
     * @throws Exception
     */
    public static function fetchAll(PDOStatement $stmt, array $args = []): array
    {
        self::execute($stmt, $args);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param PDOStatement $stmt
     * @param array $args
     * @return array
     * @throws Exception
     */
    public static function fetchRow(PDOStatement $stmt, array $args = []): array
    {
        self::execute($stmt, $args);

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $row;
        } else {
            $error = [
                'message' => 'error at fetching row',
                'query' => $stmt->queryString,
                'args' => $args
            ];
            throw Util::logError($error);
        }
    }

    /**
     * @param \PDO $pdo
     * @param string $query
     * @return PDOStatement
     * @throws Exception
     */
    public static function prepare(\PDO $pdo, string $query): PDOStatement
    {
        $stmt = $pdo->prepare($query);
        if ($stmt === FALSE) {

            $error = [
                'message' => 'error at at preparing query',
                'pdo_error' => $pdo->errorInfo(),
                'query' => $query
            ];
            throw Util::logError($error);

        }
        return $stmt;
    }

    /**
     * @param \PDO $pdo
     * @param string $query
     * @param array $args
     * @return array
     * @throws Exception
     */
    public static function selectRow(\PDO $pdo, string $query, array $args = []): array
    {
        $stmt = self::prepare($pdo, $query);
        return self::fetchRow($stmt, $args);
    }

    /**
     * @param \PDO $pdo
     * @param string $query
     * @param array $args
     * @return array
     * @throws Exception
     */
    public static function selectAll(\PDO $pdo, string $query, array $args = []): array
    {
        $stmt = self::prepare($pdo, $query);
        return self::fetchAll($stmt, $args);
    }

    /**
     * @param \PDO $pdo
     * @param string $query
     * @param array $args
     * @return void
     * @throws Exception
     */
    public static function updateAll(\PDO $pdo, string $query, array $args = []) {

        $stmt = self::prepare($pdo, $query);
        self::execute($stmt, $args);
    }

    /**
     * @param \PDO $pdo
     * @param string $query
     * @param array $args
     * @throws Exception
     */
    public static function updateRow(\PDO $pdo, string $query, array $args = []) {
        $stmt = self::prepare($pdo, $query);
        self::execute($stmt, $args);
        $rowCount = $stmt->rowCount();
        if ( $rowCount < 0 ) {
            $error = [
                'message' => 'error at updating row',
                'query' => $stmt->queryString,
                'args' => $args,
                'row_count' => $rowCount
            ];
            throw Util::logError($error);
        }

    }



}