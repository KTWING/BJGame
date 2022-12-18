<?php

namespace BJ;

require_once('BJGame.php');

class BJMain
{
    public function main(): void
    {
        $game = new BJGame();
        $game->start();
    }
}

$main = new BJMain();
$main->main();
