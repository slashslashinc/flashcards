<?php

class Flashcards
{
    function Flashcards($title, $cards)
    {
        $this->title = $title;
        $this->cards = $cards;
        $this->scores = calculate_scores($cards);
    }
}

class Card
{
    function Card($a, $b, $graphic, $audio)
    {
        $this->a = $a;
        $this->b = $b;
        $this->graphic = $graphic;
        $this->audio = $audio;
        $this->score = 0;
    }
}

function calculate_scores($cards)
{
    $cardCount = 0;
    $unscored = 0;
    $ones = 0;
    $twos = 0;
    $threes = 0;
    $fours = 0;
    $fives = 0;
    $scores = [];

    foreach ($cards as $card) {
        $cardCount++;

        if ($card->score == 1) {
            $unscored++;
        } elseif ($card->score == 1) {
            $ones++;
        } elseif ($card->score == 2) {
            $twos++;
        } elseif ($card->score == 3) {
            $threes++;
        } elseif ($card->score == 4) {
            $fours++;
        } elseif ($card->score == 5) {
            $fives++;
        }
    }

    array_push($scores, [0, ($unscored / $cardCount)]);
    array_push($scores, [1, ($ones / $cardCount)]);
    array_push($scores, [2, ($twos / $cardCount)]);
    array_push($scores, [3, ($threes / $cardCount)]);
    array_push($scores, [4, ($fours / $cardCount)]);
    array_push($scores, [5, ($fives / $cardCount)]);

    return $scores;
}

function init_cards()
{
    $cards = [];

    for ($i = 1; $i <= 10; $i++) {
        array_push($cards, new Card(
            "This is question " . $i . ".",
            "This is answer " . $i . ".",
            "string_to_graphic",
            "string_to_audio"));
    }

    return $cards;
}

function base_url()
{
    return "./";
}

$flashcards = new Flashcards("Flashcards Demo", init_cards());

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <title>AmPopMusic.com - <?php echo($flashcards->title); ?></title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <style>
        <?php
            $width = 768;
            $height = 510;
            $padding = 15;
            $flashcards_bg = "img/backgrounds/main_background.png";

            $clipboard_width = 264;
            $clipboard_height = 375;
            $clipboard_bg = "img/clipboard.png";

            $retake_width = 215;
            $retake_height = 268;
            $retake_bg = "img/retake.png";

            $stack_width = 246;
            $stack_height = 202;
            $stack_bg = "img/stack.png";
        ?>

        .flashcards,
        .flashcards * {
            box-sizing: border-box;
        }

        .flashcards {
            margin: 0;
            overflow: scroll;
        }

        .flashcards-container {
            width: <?php echo($width); ?>px;
            height: <?php echo($height); ?>px;
            margin: 0;
            padding: <?php echo($padding); ?>px;
            background: url("<?php echo(base_url() . $flashcards_bg);?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $flashcards_bg);?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $flashcards_bg);?>', sizingMethod='scale')";
        }

        .flashcards-main {
            display: block;
            width: 100%;
            height: 100%;
            float: left;
        }

        .flashcards-clipboard {
            position: absolute;
            top: <?php echo(($height/2) - ($clipboard_height/2) - $padding); ?>px;
            left: <?php echo(($width/2) - ($clipboard_width/2) + $padding); ?>px;
            width: <?php echo($clipboard_width); ?>px;
            height: <?php echo($clipboard_height); ?>px;
            margin: 0;
            padding: 0;
            background: url("<?php echo(base_url() . $clipboard_bg); ?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $clipboard_bg); ?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $clipboard_bg); ?>', sizingMethod='scale')";
        }

        .flashcards-retake {
            position: absolute;
            top: <?php echo(($height/2) - ($retake_height/2) + ($padding * 2)); ?>px;
            left: 45px;
            width: <?php echo($retake_width); ?>px;
            height: <?php echo($retake_height); ?>px;
            margin: 0;
            padding: 0;
            background: url("<?php echo(base_url() . $retake_bg); ?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $retake_bg); ?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $retake_bg); ?>', sizingMethod='scale')";
        }

        .flashcards-stack {
            position: absolute;
            top: <?php echo(($height/2) - ($stack_height/2)); ?>px;
            right: 65px;
            width: <?php echo($stack_width); ?>px;
            height: <?php echo($stack_height); ?>px;
            margin: 0;
            padding: 0;
            background: url("<?php echo(base_url() . $stack_bg); ?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $stack_bg); ?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $stack_bg); ?>', sizingMethod='scale')";
        }
    </style>
</head>
<body>
<div class="flashcards">
    <div class="flashcards-container">
        <div class="flashcards-main">
            <div class="flashcards-clipboard"></div>
            <div class="flashcards-retake"></div>
            <div class="flashcards-stack"></div>
        </div>
    </div>
</div>
</body>
</html>