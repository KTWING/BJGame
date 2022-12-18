<?php

namespace BJ;

require_once('BJDeck.php');
require_once('BJPlayer1.php');
require_once('BJDealer.php');
require_once('BJNpcPlayer.php');
require_once('BJConsole.php');

class BJGame
{
    public function start(): void
    {
        $deck = new BJDeck();
        $player1 = new BJPlayer1();
        $player1->player1Hand = $player1->drawCards($deck, 2);
        $dealer = new BJDealer();
        $dealer->dealerHand = $dealer->drawCards($deck, 2);
        $consoleBJ = new BJConsole();
        echo '何人でブラックジャックゲームをプレイしますか？(1/2/3)' . PHP_EOL;
        $playerNumber = (string)trim(fgets(STDIN));
        if ($playerNumber === '1') {
            $consoleBJ->soloPlayConsole($player1, $dealer, $deck);
        } elseif ($playerNumber === '2') {
            $npcPlayer1 = new BJNpcPlayer();
            $npcPlayer1->npcPlayerHand = $npcPlayer1->drawCards($deck, 2);
            $npcs = [$npcPlayer1];
            $consoleBJ->multiPlayConsole($player1, $npcs, $dealer, $deck);
        } elseif ($playerNumber === '3') {
            $npcPlayer1 = new BJNpcPlayer();
            $npcPlayer1->npcPlayerHand = $npcPlayer1->drawCards($deck, 2);
            $npcPlayer2 = new BJNpcPlayer();
            $npcPlayer2->npcPlayerHand = $npcPlayer2->drawCards($deck, 2);
            $npcs = [$npcPlayer1, $npcPlayer2];
            $consoleBJ->multiPlayConsole($player1, $npcs, $dealer, $deck);
        } else {
            echo 'プレイヤー人数は1/2/3で選択して下さい' . PHP_EOL;
        }
    }
}
