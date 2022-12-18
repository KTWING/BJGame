<?php

namespace BJ;

require_once('BJCard.php');

class BJDeck
{
    /** @var array<int,BJCard> */
    public array $cards;

    public function __construct()
    {
        foreach (['C', 'H', 'S', 'D'] as $suit) {
            foreach (range(1, 13) as $number) {
                $this->cards[] = new BJCard($suit, $number);
            }
        }
        shuffle($this->cards);
    }
}
