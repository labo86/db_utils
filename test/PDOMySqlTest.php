<?php
declare(strict_types=1);

namespace test\labo86\db_utils;


use Exception;
use labo86\db_utils\PDO;
use PHPUnit\Framework\TestCase;
class PDOMySqlTest extends TestCase
{

    public function getPDO() {
        $pdo = PDO::OpenMysql("", "localhost", "phpunit_test_user", "phpunit_test_password");
        PDO::updateAll($pdo, "DROP DATABASE IF EXISTS phpunit_test_db; CREATE DATABASE phpunit_test_db CHARACTER SET utf8 COLLATE utf8_general_ci; USE phpunit_test_db");

        return $pdo;
    }

    /**
     * @throws Exception
     */
    public function testSelectRowFail()
    {
        $this->expectException(Exception::class);
        $pdo = $this->getPDO();
        PDO::updateAll($pdo, "CREATE TABLE test (id INTEGER)");
        PDO::selectRow($pdo, "SELECT id FROM test");

    }

    /**
     * @throws Exception
     */
    public function testSelectRowOk()
    {
        $pdo = $this->getPDO();
        PDO::updateAll($pdo, "CREATE TABLE test (id INTEGER)");
        PDO::updateRow($pdo, "INSERT INTO test VALUES(1)");
        $row = PDO::selectRow($pdo, "SELECT id FROM test");
        $this->assertEquals(['id' => 1], $row);
    }

    /**
     * @throws Exception
     */
    public function testSelectAllEmpty()
    {
        $pdo = $this->getPDO();
        PDO::updateAll($pdo, "CREATE TABLE test (id INTEGER)");
        $result = PDO::selectAll($pdo, "SELECT id FROM test");
        $this->assertEquals([], $result);
    }

    /**
     * @throws Exception
     */
    public function testSelectAllBasic()
    {
        $pdo = $this->getPDO();
        PDO::updateAll($pdo, "CREATE TABLE test (id INTEGER)");
        PDO::updateRow($pdo, "INSERT INTO test VALUES(1)");
        PDO::updateRow($pdo, "INSERT INTO test VALUES(2)");
        PDO::updateRow($pdo, "INSERT INTO test VALUES(3)");
        $result = PDO::selectAll($pdo, "SELECT id FROM test");
        $this->assertEquals([['id' => 1], ['id' => 2], ['id' => 3]], $result);
    }

    /**
     * @throws Exception
     */
    public function testExecuteFail()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("error in query execution");
        $pdo = $this->getPDO();
        PDO::updateRow($pdo, "adfadfasdf");

    }

    /**
     * @throws Exception
     */
    public function testExecuteUpdate() {
        $table = <<<EOF
CREATE TABLE tournament_data (
tournament_id VARCHAR(36),
name TEXT,
data TEXT,
state TEXT,
current_round INTEGER,
PRIMARY KEY (tournament_id)
)
EOF;
        $pdo = $this->getPDO();
        PDO::updateAll($pdo, $table);
        $tournament_id = 'id';
        $data ="1"; //"{\n    \"id\": \"test_5f501882e7abc\",\n    \"name\": \"hola\",\n    \"current_round\": -1,\n    \"state\": \"LOBBY\",\n    \"challenger_list\": [],\n    \"round_list\": []\n}";

        PDO::updateRow($pdo,"INSERT INTO tournament_data (tournament_id) VALUES (:tournament_id)", ['tournament_id' => $tournament_id]);
        PDO::updateRow($pdo,
            "UPDATE tournament_data SET data = :data, current_round = :current_round WHERE tournament_id = :tournament_id",
            [':data' => $data, ':current_round' => -1, ':tournament_id' =>$tournament_id]);
        $row = PDO::selectRow($pdo, 'SELECT data, current_round, tournament_id FROM tournament_data WHERE tournament_id = :tournament_id', [':tournament_id' => $tournament_id]);
        $this->assertEquals(['data' => $data, 'current_round' => -1, 'tournament_id' => 'id'], $row);

    }
}
