<?php

namespace BJ;

class BJConsole
{
    public const NUMBER_TRAMP = [
        '1' => 'A',
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        '11' => 'J',
        '12' => 'Q',
        '13' => 'K',
    ];

    public const NUMBER_SCORE = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        '11' => 10,
        '12' => 10,
        '13' => 10,
    ];

    public function soloPlayConsole(BJPlayer1 $player1, BJDealer $dealer, BJDeck $deck): void
    {
        $this->firstConsole($player1);
        $this->dealerFirstConsole($dealer);
        $currentPlayer1Score = $this->playerAdditionalDraw($player1, $deck);
        if ($currentPlayer1Score > 21) {
            echo 'あなたの得点は21点を超えました。あなたの負けです!' . PHP_EOL;
            return;
        }
        $currentDealerScore = $this->dealerAdditionalDraw($dealer, $deck, $currentPlayer1Score);
        if ($currentDealerScore > 21) {
            echo 'ディーラーの得点が21点を超えました。あなたの勝ちです!' . PHP_EOL;
            return;
        }
        $this->judgementResult($currentPlayer1Score, $currentDealerScore);
        echo 'ブラックジャックを終了します。' . PHP_EOL;
        return;
    }

    /**
     * @param array<int,BJNpcPlayer> $npcs
     */
    public function multiPlayConsole(BJPlayer1 $player1, array $npcs, BJDealer $dealer, BJDeck $deck): void
    {
        $this->firstConsole($player1);
        $this->dealerFirstConsole($dealer);

        $currentPlayer1Score = $this->playerAdditionalDraw($player1, $deck);
        if ($currentPlayer1Score > 21) {
            echo 'あなたの得点は21を超えてしまいました。' . PHP_EOL;
        }
        $npcNumber = 1;
        $currentNpcScore = [];
        foreach ($npcs as $npc) {
            $npcSuit1 = $this->suitTranslateString($npc->npcPlayerHand[0]->getSuit());
            $npcNumber1 = self::NUMBER_TRAMP[$npc->npcPlayerHand[0]->getNumber()];
            echo 'NPC' . $npcNumber . 'の引いたカードは' . $npcSuit1 . 'の' . $npcNumber1 . 'です。' . PHP_EOL;
            $npcSuit2 = $this->suitTranslateString($npc->npcPlayerHand[1]->getSuit());
            $npcNumber2 = self::NUMBER_TRAMP[$npc->npcPlayerHand[1]->getNumber()];
            echo 'NPC' . $npcNumber . 'の引いたカードは' . $npcSuit2 . 'の' . $npcNumber2 . 'です。' . PHP_EOL;

            $npcScore1 = $this->checkA(self::NUMBER_SCORE[$npc->npcPlayerHand[0]->getNumber()], 0);
            $npcScore2 = $this->checkA(self::NUMBER_SCORE[$npc->npcPlayerHand[1]->getNumber()], $npcScore1);
            $currentNpcScore[] = $npcScore1 + $npcScore2;
            echo 'NPC' . $npcNumber . 'の現在の得点は' . $currentNpcScore[$npcNumber - 1] . 'です' . PHP_EOL;

            while ($currentNpcScore[$npcNumber - 1] < 17) {
                $npc->npcPlayerHand[] = $npc->drawCards($deck, 1)[0];
                $npcAddSuit = $this->suitTranslateString(end($npc->npcPlayerHand)->getSuit());
                $npcAddNumber = self::NUMBER_TRAMP[end($npc->npcPlayerHand)->getNumber()];
                echo 'NPC' . $npcNumber . 'の引いたカードは' . $npcAddSuit . 'の' . $npcAddNumber . 'です。' . PHP_EOL;
                $yourDrawCard = self::NUMBER_SCORE[end($npc->npcPlayerHand)->getNumber()];
                $currentNpcScore[$npcNumber - 1] += $this->checkA($yourDrawCard, $currentNpcScore[$npcNumber - 1]);
                echo 'NPC' . $npcNumber . 'の得点は' . $currentNpcScore[$npcNumber - 1] . 'です' . PHP_EOL;
                if ($currentNpcScore[$npcNumber - 1] > 21) {
                    echo 'NPC' . $npcNumber . 'の得点は21を超えてしまいました。' . PHP_EOL;
                }
            }
            $npcNumber += 1;
        }
        $dealerSuit2 = $this->suitTranslateString($dealer->dealerHand[1]->getSuit());
        $dealerNumber2 = self::NUMBER_TRAMP[$dealer->dealerHand[1]->getNumber()];
        echo 'ディーラーの引いた2枚目のカードは' . $dealerSuit2 . 'の' . $dealerNumber2 . 'です。' . PHP_EOL;
        $dealerScore1 = $this->checkA(self::NUMBER_SCORE[$dealer->dealerHand[0]->getNumber()], 0);
        $dealerScore2 = $this->checkA(self::NUMBER_SCORE[$dealer->dealerHand[1]->getNumber()], $dealerScore1);
        $currentDealerScore = $dealerScore1 + $dealerScore2;
        echo 'ディーラーの現在の得点は' . $currentDealerScore . 'です' . PHP_EOL;
        while ($currentDealerScore < 17) {
            $dealer->dealerHand[] = $dealer->drawCards($deck, 1)[0];
            $dealerAddSuit = $this->suitTranslateString(end($dealer->dealerHand)->getSuit());
            $dealerAddNumber = self::NUMBER_TRAMP[end($dealer->dealerHand)->getNumber()];
            echo 'ディーラーの引いたカードは' . $dealerAddSuit . 'の' . $dealerAddNumber . 'です。' . PHP_EOL;
            $dealerDrawCard = self::NUMBER_SCORE[end($dealer->dealerHand)->getNumber()];
            $currentDealerScore += $this->checkA($dealerDrawCard, $currentDealerScore);
            if ($currentDealerScore > 21) {
                echo 'ディーラーの得点は21を超えてしまいました。' . PHP_EOL;
            }
        }
        echo 'あなたの得点は' . $currentPlayer1Score . 'です。' . PHP_EOL;
        echo 'NPC1の得点は' . $currentNpcScore[0] . 'です。' . PHP_EOL;
        if (count($currentNpcScore) === 2) {
            echo 'NPC2の得点は' . $currentNpcScore[1] . 'です。' . PHP_EOL;
        }
        echo 'ディーラーの得点は' . $currentDealerScore . 'です' . PHP_EOL;

        $this->judgementResultMultiPlay($currentPlayer1Score, $currentNpcScore, $currentDealerScore);
    }

    private function firstConsole(BJPlayer1 $player1): void
    {
        echo 'ブラックジャックを開始します' . PHP_EOL;

        $player1Suit1 = $this->suitTranslateString($player1->player1Hand[0]->getSuit());
        $player1Number1 = self::NUMBER_TRAMP[$player1->player1Hand[0]->getNumber()];
        echo 'あなたの引いたカードは' . $player1Suit1 . 'の' . $player1Number1 . 'です。' . PHP_EOL;

        $player1Suit2 = $this->suitTranslateString($player1->player1Hand[1]->getSuit());
        $player1Number2 = self::NUMBER_TRAMP[$player1->player1Hand[1]->getNumber()];
        echo 'あなたの引いたカードは' . $player1Suit2 . 'の' . $player1Number2 . 'です。' . PHP_EOL;
    }

    private function dealerFirstConsole(BJDealer $dealer): void
    {
        $dealer1Suit1 = $this->suitTranslateString($dealer->dealerHand[0]->getSuit());
        $dealer1Number1 = self::NUMBER_TRAMP[$dealer->dealerHand[0]->getNumber()];
        echo 'ディーラーの引いたカードは' . $dealer1Suit1 . 'の' . $dealer1Number1 . 'です。' . PHP_EOL;
        echo 'ディーラーの引いた2枚目のカードは分かりません。' . PHP_EOL;
    }

    private function playerAdditionalDraw(BJPlayer1 $player1, BJDeck $deck): int
    {
        $replyDraw = 'Y';
        $player1Score1 = $this->checkA(self::NUMBER_SCORE[$player1->player1Hand[0]->getNumber()], 0);
        $player1Score2 = $this->checkA(self::NUMBER_SCORE[$player1->player1Hand[1]->getNumber()], $player1Score1);
        $currentPlayer1Score = $player1Score1 + $player1Score2;
        while ($replyDraw === 'Y') {
            echo 'あなたの現在の得点は' . $currentPlayer1Score . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            $replyDraw = (string)trim(fgets(STDIN));
            if ($replyDraw === 'Y') {
                $player1->player1Hand[] = $player1->drawCards($deck, 1)[0];
                $player1AddSuit = $this->suitTranslateString(end($player1->player1Hand)->getSuit());
                $player1AddNumber = self::NUMBER_TRAMP[end($player1->player1Hand)->getNumber()];
                echo 'あなたの引いたカードは' . $player1AddSuit . 'の' . $player1AddNumber . 'です。' . PHP_EOL;
                $yourAddDraw = self::NUMBER_SCORE[end($player1->player1Hand)->getNumber()];
                $currentPlayer1Score += $this->checkA($yourAddDraw, $currentPlayer1Score);
                if ($currentPlayer1Score > 21) {
                    return $currentPlayer1Score;
                }
            }
        }
        return $currentPlayer1Score;
    }

    private function dealerAdditionalDraw(BJDealer $dealer, BJDeck $deck, int $currentPlayer1Score): int
    {
        $dealerSuit2 = $this->suitTranslateString($dealer->dealerHand[1]->getSuit());
        $dealerNumber2 = self::NUMBER_TRAMP[$dealer->dealerHand[1]->getNumber()];
        echo 'ディーラーの引いた2枚目のカードは' . $dealerSuit2 . 'の' . $dealerNumber2 . 'です。' . PHP_EOL;
        $dealerScore1 = $this->checkA(self::NUMBER_SCORE[$dealer->dealerHand[0]->getNumber()], 0);
        $dealerScore2 = $this->checkA(self::NUMBER_SCORE[$dealer->dealerHand[1]->getNumber()], $dealerScore1);
        $currentDealerScore = $dealerScore1 + $dealerScore2;
        echo 'ディーラーの現在の得点は' . $currentDealerScore . 'です' . PHP_EOL;
        while ($currentDealerScore < 17) {
            $dealer->dealerHand[] = $dealer->drawCards($deck, 1)[0];
            $dealerAddSuit = $this->suitTranslateString(end($dealer->dealerHand)->getSuit());
            $dealerAddNumber = self::NUMBER_TRAMP[end($dealer->dealerHand)->getNumber()];
            echo 'ディーラーの引いたカードは' . $dealerAddSuit . 'の' . $dealerAddNumber . 'です。' . PHP_EOL;
            $dealerAddDraw = self::NUMBER_SCORE[end($dealer->dealerHand)->getNumber()];
            $currentDealerScore += $this->checkA($dealerAddDraw, $currentDealerScore);
            echo 'あなたの得点は' . $currentPlayer1Score . 'です' . PHP_EOL;
            echo 'ディーラーの得点は' . $currentDealerScore . 'です' . PHP_EOL;
            if ($currentDealerScore > 21) {
                return $currentDealerScore;
            }
        }
        return $currentDealerScore;
    }

    public function suitTranslateString(string $suit): string
    {
        if ($suit === 'C') {
            return 'クラブ';
        } elseif ($suit === 'H') {
            return 'ハート';
        } elseif ($suit === 'S') {
            return 'スペード';
        } elseif ($suit === 'D') {
            return 'ダイヤ';
        } else {
            return 'suitTranslateString関数で適切な引数を受け取れていません';
        }
    }

    private function judgementResult(int $player1Score, int $dealerScore): void
    {
        if ((21 - $player1Score) < (21 - $dealerScore)) {
            echo 'あなたの勝ちです！' . PHP_EOL;
            return;
        } elseif ((21 - $player1Score) > (21 - $dealerScore)) {
            echo 'あなたの負けです！' . PHP_EOL;
            return;
        } elseif ((21 - $player1Score) === (21 - $dealerScore)) {
            echo 'この勝負は引き分けです' . PHP_EOL;
            return;
        }
    }

    /**
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @param array<int,int> $currentNpcScore
     */
    private function judgementResultMultiPlay(
        int $currentPlayer1Score,
        array $currentNpcScore,
        int $currentDealerScore
    ): void {
        if ($currentPlayer1Score > 21) {
            $currentPlayer1Score = 0;
        }

        $npcPlayerNumberWalk = 0;
        foreach ($currentNpcScore as $currentEachNpcScore) {
            if ($currentEachNpcScore > 21) {
                $currentNpcScore[$npcPlayerNumberWalk] = 0;
            }
            $npcPlayerNumberWalk += 1;
        }

        if ($currentDealerScore > 21) {
            $currentDealerScore = 0;
        }

        $currentScores = [];
        $currentScores[] = $currentPlayer1Score;
        foreach ($currentNpcScore as $currentEachNpcScore) {
            $currentScores[] = $currentEachNpcScore;
        }
        $currentScores[] = $currentDealerScore;
        if (count($currentScores) === 3) {
            $player1Diff = 21 - $currentPlayer1Score;
            $npc1Diff = 21 - $currentNpcScore[0];
            $dealerDiff = 21 - $currentDealerScore;
            $diffs = [$player1Diff, $npc1Diff, $dealerDiff];
            $mins = array_keys($diffs, min($diffs));
            $resultMap = [
                '0' => 'あなた',
                '1' => 'NPC1',
                '2' => 'ディーラー'
            ];
            foreach ($mins as $min) {
                echo $resultMap[$min] . 'の勝ちです' . PHP_EOL;
            }
        } elseif (count($currentScores) === 4) {
            $player1Diff = 21 - $currentPlayer1Score;
            $npc1Diff = 21 - $currentNpcScore[0];
            $npc2Diff = 21 - $currentNpcScore[1];
            $dealerDiff = 21 - $currentDealerScore;
            $diffs = [$player1Diff, $npc1Diff, $npc2Diff, $dealerDiff];
            $mins = array_keys($diffs, min($diffs));
            $resultMap = [
                '0' => 'あなた',
                '1' => 'NPC1',
                '2' => 'NPC2',
                '3' => 'ディーラー'
            ];
            foreach ($mins as $min) {
                echo $resultMap[$min] . 'の勝ちです' . PHP_EOL;
            }
        }
    }

    public function checkA(int $drawCard, int $nowTotalScore): int
    {
        if ($drawCard === 1 && $nowTotalScore + 11 <= 21) {
            return 11;
        } else {
            return $drawCard;
        }
    }
}
