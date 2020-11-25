<?php
declare(strict_types=1);

namespace test\labo86\db_utils;

use labo86\db_utils\Util;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    public function testUUID() {
        $uuid = Util::UUID();
        $this->assertEquals(36, strlen($uuid));
    }
}
