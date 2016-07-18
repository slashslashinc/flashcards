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
            $flashcards_font = "fonts/ebrimabd.ttf";
        ?>

        @font-face {
            font-family: FlashcardsFont;
            src: url(<?php echo(base_url() . $flashcards_font); ?>);
        }

        .flashcards,
        .flashcards * {
            box-sizing: border-box;
            font-family: FlashcardsFont, "Helvetica Neue", Helvetica, Arial, sans-serif;
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

        .retest-stack-button:hover,
        .entire-stack-button:hover,
        .finished-button:hover,
        .flip-button:hover,
        .score-buttons:hover {
            cursor: pointer;
        }

        .retest-stack-button:hover > .hover-anim,
        .entire-stack-button:hover > .hover-anim,
        .flip-button:hover > .hover-anim,
        .finished-button:hover > .hover-anim {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .retest-stack-button {
            position: absolute;
            top: 384px;
            left: 79px;
            width: 125px;
            height: 33px;
            background: transparent;
        }

        .retest-stack-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 11px;
        }

        .entire-stack-button {
            position: absolute;
            top: 384px;
            left: 578px;
            width: 125px;
            height: 33px;
            background: transparent;
        }

        .entire-stack-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 11px;
        }

        .flip-button {
            position: absolute;
            top: 359px;
            left: 519px;
            width: 42px;
            height: 41px;
            background: transparent;
        }

        .flip-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: transparent;
        }

        .finished-button {
            position: absolute;
            top: 463px;
            left: 654px;
            width: 96px;
            height: 25px;
            background: transparent;
        }

        .finished-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
        }

        .score-buttons {
            position: relative;
            top: 428px;
            left: 213px;
            width: 312px;
            height: 28px;
            background-color: transparent;
        }

        .score-buttons .button {
            position: relative;
            display: inline-block;
            width: 71px;
            height: 25px;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
        }

        .score-buttons .button:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .score-buttons .button.two {
            left: -14px;
        }

        .score-buttons .button.two:hover:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 100%;
            top: 0;
            left: 0;
            background: rgb(254, 0, 0);
            border-right: rgba(0, 0, 0, 0.3);
            border-radius: 0 45px 45px 0;
        }

        .score-buttons .button.three {
            left: -31px;
        }

        .score-buttons .button.three:hover:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 100%;
            top: 0;
            left: 0;
            background: rgb(242, 159, 0);
            border-right: rgba(0, 0, 0, 0.3);
            border-radius: 0 45px 45px 0;
        }

        .score-buttons .button.four {
            left: -45px;
        }

        .score-buttons .button.four:hover:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 100%;
            top: 0;
            left: 0;
            background: rgb(254, 242, 0);
            border-right: rgba(0, 0, 0, 0.3);
            border-radius: 0 45px 45px 0;
        }

        .score-buttons .button.five {
            left: 241px;
            top: -29px;
        }

        .score-buttons .button.five:hover:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 100%;
            top: 0;
            left: 0;
            background: rgb(0, 189, 123);
            border-right: rgba(0, 0, 0, 0.3);
            border-radius: 0 45px 45px 0;
        }
    </style>
</head>
<body>
<div class="flashcards">
    <div class="flashcards-container">
        <div class="flashcards-main">
            <div class="retest-stack-deck">
                <div class="hover-anim"></div>
            </div>
            <div class="retest-stack-button">
                <div class="hover-anim"></div>
            </div>
            <div class="entire-stack-button">
                <div class="hover-anim"></div>
            </div>
            <div class="score-buttons">
                <div class="button one"></div>
                <div class="button two"></div>
                <div class="button three"></div>
                <div class="button four"></div>
                <div class="button five"></div>
            </div>
            <div class="flip-button">
                <div class="hover-anim"></div>
            </div>
            <div class="finished-button">
                <div class="hover-anim"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>