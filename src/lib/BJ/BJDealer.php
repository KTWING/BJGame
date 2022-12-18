<?php

namespace BJ;

require_once('BJPlayer.php');

class BJDealer extends BJPlayer
{
    /** @var array<int,BJCard> */
    public array $dealerHand;
}
