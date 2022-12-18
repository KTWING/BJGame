<?php
// 【クイズ】テレビの視聴時間

// ◯お題
// あなたはテレビが好きすぎて、プログラミングの学習が捗らないことに悩んでいました。
// テレビをやめれば学習時間が増えることは分かっているのですけど、テレビをすぐに辞めることができないでいます。
// そこで、一日のテレビの視聴分数を記録することから始めようと思い、プログラムを書くことにしました。
// テレビを見るたびにチャンネルごとの視聴分数をメモしておき、一日の終わりに記録します。テレビの合計視聴時間と、チャンネルごとの視聴分数と視聴回数を出力してください。

// ◯インプット
// 入力は以下の形式で与えられます。

// テレビのチャンネル 視聴分数 テレビのチャンネル 視聴分数 ...

// ただし、同じチャンネルを複数回見た時は、それぞれ分けて記録すること。

// チャンネル：数値を指定すること。1〜12の範囲とする（1ch〜12ch）
// 視聴分数：分数を指定すること。1〜1440の範囲とする

// ◯アウトプット
// テレビの合計視聴時間
// テレビのチャンネル 視聴分数 視聴回数
// テレビのチャンネル 視聴分数 視聴回数
// ...

// ただし、閲覧したチャンネルだけ出力するものとする。

// 視聴時間：時間数を出力すること。小数点一桁までで、端数は四捨五入すること

// ◯インプット例

// 1 30 5 25 2 30 1 15

// ◯アウトプット例

// 1.7
// 1 45 2
// 2 30 1
// 5 25 1


// 実行コマンド
// php AnswerTV.php 1 30 5 25 2 30 1 15

// タスクバラし
// ①入力値を取得する
// ②データ構造を整える
// [ch => [min, min ], ch => [min], ch => [min, min, min], ...  ]
// ③各種値の計算を行う
// ④表示させる

$input = fgets(STDIN);

$inputSeparates = explode(' ', $input);

$totalMinutes = 0;
$totalMinutes1 = 0;
$totalCounts1 = 0;
$totalMinutes2 = 0;
$totalCounts2 = 0;
$totalMinutes3 = 0;
$totalCounts3 = 0;
$totalMinutes4 = 0;
$totalCounts4 = 0;
$totalMinutes5 = 0;
$totalCounts5 = 0;
$totalMinutes6 = 0;
$totalCounts6 = 0;
$totalMinutes7 = 0;
$totalCounts7 = 0;
$totalMinutes8 = 0;
$totalCounts8 = 0;
$totalMinutes9 = 0;
$totalCounts9 = 0;
$totalMinutes10 = 0;
$totalCounts10 = 0;
$totalMinutes11 = 0;
$totalCounts11 = 0;
$totalMinutes12 = 0;
$totalCounts12 = 0;


foreach ($inputSeparates as $key => $inputSeparate) {
    if ($key % 2 === 1) {
        $totalMinutes += $inputSeparate;
    }

    if ($key % 2 === 0) {
        if ($inputSeparate == 1) {
            $totalMinutes1 += $inputSeparates[$key + 1];
            $totalCounts1 += 1;
        } elseif ($inputSeparate == 2) {
            $totalMinutes2 += $inputSeparates[$key + 1];
            $totalCounts2 += 1;
        } elseif ($inputSeparate == 3) {
            $totalMinutes3 += $inputSeparates[$key + 1];
            $totalCounts3 += 1;
        } elseif ($inputSeparate == 4) {
            $totalMinutes4 += $inputSeparates[$key + 1];
            $totalCounts4 += 1;
        } elseif ($inputSeparate == 5) {
            $totalMinutes5 += $inputSeparates[$key + 1];
            $totalCounts5 += 1;
        } elseif ($inputSeparate == 6) {
            $totalMinutes6 += $inputSeparates[$key + 1];
            $totalCounts6 += 1;
        } elseif ($inputSeparate == 7) {
            $totalMinutes7 += $inputSeparates[$key + 1];
            $totalCounts7 += 1;
        } elseif ($inputSeparate == 8) {
            $totalMinutes8 += $inputSeparates[$key + 1];
            $totalCounts8 += 1;
        } elseif ($inputSeparate == 9) {
            $totalMinutes9 += $inputSeparates[$key + 1];
            $totalCounts9 += 1;
        } elseif ($inputSeparate == 10) {
            $totalMinutes10 += $inputSeparates[$key + 1];
            $totalCounts10 += 1;
        } elseif ($inputSeparate == 11) {
            $totalMinutes11 += $inputSeparates[$key + 1];
            $totalCounts11 += 1;
        } elseif ($inputSeparate == 12) {
            $totalMinutes12 += $inputSeparates[$key + 1];
            $totalCounts12 += 1;
        }
    }
}

$totalHours = round(($totalMinutes / 60), 1);
echo $totalHours . PHP_EOL;
echo '1 ' . $totalMinutes1 . ' ' . $totalCounts1 . PHP_EOL;
echo '2 ' . $totalMinutes2 . ' ' . $totalCounts2 . PHP_EOL;
echo '3 ' . $totalMinutes3 . ' ' . $totalCounts1 . PHP_EOL;
echo '4 ' . $totalMinutes4 . ' ' . $totalCounts2 . PHP_EOL;
echo '5 ' . $totalMinutes5 . ' ' . $totalCounts1 . PHP_EOL;
echo '6 ' . $totalMinutes6 . ' ' . $totalCounts2 . PHP_EOL;
echo '7 ' . $totalMinutes7 . ' ' . $totalCounts1 . PHP_EOL;
echo '8 ' . $totalMinutes8 . ' ' . $totalCounts2 . PHP_EOL;
echo '9 ' . $totalMinutes9 . ' ' . $totalCounts1 . PHP_EOL;
echo '10 ' . $totalMinutes10 . ' ' . $totalCounts2 . PHP_EOL;
echo '11 ' . $totalMinutes11 . ' ' . $totalCounts1 . PHP_EOL;
echo '12 ' . $totalMinutes12 . ' ' . $totalCounts2 . PHP_EOL;
