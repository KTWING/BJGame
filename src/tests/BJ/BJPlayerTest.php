<?php

namespace BJ\Tests;

use BJ\BJDeck;
use PHPUnit\Framework\TestCase;
use BJ\BJPlayer;

require_once(__DIR__ . '/../../lib/BJ/BJPlayer.php');
require_once(__DIR__ . '/../../lib/BJ/BJDeck.php');

class BJPlayerTest extends TestCase
{
    public function testDrawCards()
    {
        $deck = new BJDeck();
        $player1 = new BJPlayer();
        $this->assertSame(2, count($player1->drawCards($deck, 2)));
        $this->assertSame(1, count($player1->drawCards($deck, 1)));
    }
}
