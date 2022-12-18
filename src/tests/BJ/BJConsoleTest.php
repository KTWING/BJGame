<?php

namespace BJ\Tests;

use BJ\BJConsole;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/BJ/BJConsole.php');

class BJConsoleTest extends TestCase
{
    public function testSuitTranslateString()
    {
        $testConsole = new BJConsole();
        $this->assertSame('クラブ', $testConsole->suitTranslateString('C'));
        $this->assertSame('suitTranslateString関数で適切な引数を受け取れていません', $testConsole->suitTranslateString('A'));
    }

    public function testCheckA()
    {
        $testConsole = new BJConsole();
        $this->assertSame(11, $testConsole->checkA(1, 6));
        $this->assertSame(1, $testConsole->checkA(1, 20));
        $this->assertSame(3, $testConsole->checkA(3, 6));
    }
}
