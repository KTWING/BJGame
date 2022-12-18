<?php

// 実行コマンド
// php AnswerTV.php 1 30 5 25 2 30 1 15
const SPLIT_LENGTH = 2;

function getInput()
{
    $argument = array_slice($_SERVER['argv'], 1);
    return array_chunk($argument, SPLIT_LENGTH);
}

function groupChannelViewingPeriods(array $inputs): array
{
    $channelViewingPeriods = [];
    foreach ($inputs as $input) {
        $chan = $input[0];
        $min = $input[1];
        $mins = [$min];

        if (array_key_exists($chan, $channelViewingPeriods)) {
            $mins = array_merge($channelViewingPeriods[$chan], $mins);
        }
        $channelViewingPeriods[$chan] = $mins;
    }
    return $channelViewingPeriods;
}

function calculateTotalHours(array $channelViewingPeriods): float
{
    $viewingTimes = [];
    foreach ($channelViewingPeriods as $period) {
        $viewingTimes = array_merge($viewingTimes, $period);
    }
    $totalMin = array_sum($viewingTimes);
    // $totalMin = array_sum(array_merge(...$channelViewingPeriods));で一発で求めれる　　...これは各バリュー配列を展開して繋げている
    return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void
{
    $totalHours = calculateTotalHours($channelViewingPeriods);
    echo $totalHours . PHP_EOL;
    foreach ($channelViewingPeriods as $chan => $mins) {
        echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
    }
}

$inputs = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);
