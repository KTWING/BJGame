<?php

namespace BJ;

require_once('BJPlayer.php');

class BJNpcPlayer extends BJPlayer
{
    /** @var array<int,BJCard> */
    public array $npcPlayerHand;
}
