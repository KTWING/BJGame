<?php

namespace BJ;

require_once('BJDeck.php');

class BJPlayer
{
    /**
     * @return array<int,BJCard>
     */
    public function drawCards(BJDeck $deck, int $drawNumbers): array
    {
        $drawCards = array_slice($deck->cards, 0, $drawNumbers);
        array_splice($deck->cards, 0, $drawNumbers);
        return $drawCards;
    }
}
