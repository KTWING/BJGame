<?php

namespace BJ\Tests;

use PHPUnit\Framework\TestCase;
use BJ\BJCard;

require_once(__DIR__ . '/../../lib/BJ/BJCard.php');

class BJCardTest extends TestCase
{
    public function testGetSuit()
    {
        $card1 = new BJCard('H', 3);
        $this->assertSame('H', $card1->getSuit());
        $card1 = new BJCard('S', 9);
        $this->assertSame('S', $card1->getSuit());
    }

    public function testGetNumber()
    {
        $card1 = new BJCard('H', 3);
        $this->assertSame(3, $card1->getNumber());
        $card1 = new BJCard('S', 9);
        $this->assertSame(9, $card1->getNumber());
    }
}
