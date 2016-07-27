<?php

function base_url()
{
    return "./";
}

// DEBUG
$flashcardset = json_encode(
    '[
        {
            "id":"4",
            "prompt_side":"What country are we in?",
            "answer_side":"USA",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"3",
            "prompt_side":"What year is it?",
            "answer_side":"2016",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"1",
            "prompt_side":"What is my name?",
            "answer_side":"Mike Jones!",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"2",
            "prompt_side":"What time is it?",
            "answer_side":"11:04am",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"5",
            "prompt_side":"Is this a good question?",
            "answer_side":"No it is not",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"6",
            "prompt_side":"Hello?",
            "answer_side":"Is it me you are looking for?",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"7",
            "prompt_side":"What is 1 + 1?",
            "answer_side":"1 + 1 = 2",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        },
        {
            "id":"8",
            "prompt_side":"Is this the last question?",
            "answer_side":"Hopefully",
            "professor_id":"2",
            "is_deck":"0",
            "flashcard_deck_id":"2",
            "deck_title":"",
            "date_created":null,
            "date_last_modified":null,
            "status":"active"
        }
    ]');

$flashcardinfo = json_encode(
    '{
        "id":"2",
        "prompt_side":null,
        "answer_side":null,
        "professor_id":"2",
        "is_deck":"1",
        "flashcard_deck_id":null,
        "deck_title":"General Questions",
        "date_created":null,
        "date_last_modified":null,
        "status":"active"
    }');

$flashcardprof = "Dr. Professorson";
// /DEBUG

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <title>AmPopMusic.com - [PUT DECK TITLE HERE]</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <style>
        <?php
            $flashcards_bg = "img/backgrounds/main_background.png";
            $flashcards_font = "fonts/ebrimabd.ttf";
            $card_bg = "img/entities/card.png";
        ?>

        @font-face {
            font-family: FlashcardsFont;
            src: url(<?php echo(base_url() . $flashcards_font); ?>);
        }

        @-webkit-keyframes fadeinout {
            50% {
                opacity: 1;
            }
        }

        @keyframes fadeinout {
            50% {
                opacity: 1;
            }
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
            width: 768px;
            height: 510px;
            margin: 0;
            padding: 15px;
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

        .flashcards-counter {
            position: absolute;
            top: 130px;
            left: 145px;
            font-size: 22px;
        }

        .flashcards-counter-text {
            text-shadow: 1px 1px 3px #575757;
        }

        .card-container {
            position: absolute;
            top: 88px;
            left: 276px;
            -webkit-perspective: 1000;
            -moz-perspective: 1000;
            -o-perspective: 1000;
            perspective: 1000;
        }

        .card-container,
        .card > .side-a,
        .card > .side-b {
            width: 236px;
            height: 327px;
        }

        .card {
            -moz-transform: perspective(1000px);
            -moz-transform-style: preserve-3d;
            position: relative;
        }

        .card > .side-a,
        .card > .side-b {
            position: absolute;
            top: 0;
            left: 0;
            padding: 62px 32px;
            text-align: center;
            color: #ffffff;

            background: url("<?php echo(base_url() . $card_bg);?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $card_bg);?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $card_bg);?>', sizingMethod='scale')";

            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -o-backface-visibility: hidden;
            backface-visibility: hidden;

            -webkit-transition: 0.6s;
            -moz-transition: 0.6s;
            -o-transition: 0.6s;
            -ms-transition: 0.6s;
            transition: 0.6s;

            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            -o-transform-style: preserve-3d;
            -ms-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }

        .card > .side-a {
            z-index: 2;
        }

        .card > .side-b {
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            -o-transform: rotateY(-180deg);
            -ms-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
        }

        .card.flipped > .side-a {
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }

        .card.flipped > .side-b {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
            -o-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }

        .retest-stack-deck {
            position: absolute;
            top: 197px;
            left: 71px;
            width: 140px;
            height: 160px;
            background: transparent;
        }

        .retest-stack-deck > .highlight-anim {
            position: relative;
            width: 99px;
            height: 100px;
            top: 23px;
            left: 21px;
            background: transparent;
            border-radius: 50%;
            opacity: 0;
        }

        .retest-stack-deck > .highlight-anim.animated {
            -webkit-animation: fadeinout 2s linear forwards;
            animation: fadeinout 2s linear forwards;
        }

        .entire-stack-deck {
            position: absolute;
            top: 197px;
            left: 568px;
            width: 140px;
            height: 160px;
            background: transparent;
        }

        .entire-stack-deck > .highlight-anim {
            position: relative;
            width: 99px;
            height: 109px;
            top: 25px;
            left: 21px;
            background: transparent;
            border-radius: 50%;
            opacity: 0;
        }

        .entire-stack-deck > .highlight-anim.animated {
            -webkit-animation: fadeinout 2s linear forwards;
            animation: fadeinout 2s linear forwards;
        }

        .entire-stack-deck > .deck-name {
            position: absolute;
            top: 35px;
            left: 25px;
            width: 90px;
            text-align: center;
            text-shadow: 1px 1px 3px #575757;
        }

        .entire-stack-deck > .professor {
            position: absolute;
            top: 75px;
            left: 25px;
            width: 90px;
            font-size: 12px;
            text-align: center;
            text-shadow: 1px 1px 3px #575757;
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

        .retest-stack-count {
            position: relative;
            top: 25px;
            left: 9px;
            text-align: center;
            max-width: 26px;
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
            top: 383px;
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

        .score-buttons .button.disabled {
            cursor: not-allowed;
        }

        .score-buttons .button.disabled:hover {
            background-color: transparent;
        }

        .score-buttons .button.disabled:hover:before {
            content: none;
        }

        .score-bar {
            position: relative;
            top: 97px;
            left: 512px;
            width: 213px;
            height: 45px;
            background: transparent;
            border-radius: 3px 3px 5px 5px;
            overflow: hidden;
        }

        .score-bar > .score {
            display: inline-block;
            height: 100%;
            margin: 0;
            padding: 0;
            float: left;
            -webkit-transition: width 1s;
            -moz-transition: width 1s;
            -o-transition: width 1s;
            -ms-transition: width 1s;
            transition: width 1s;
        }

        .score-bar > .score.zeros {
            background: lightgray; /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(lightgray, gray); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(lightgray, gray); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(lightgray, gray); /* For Firefox 3.6 to 15 */
            background: linear-gradient(lightgray, gray); /* Standard syntax */
        }

        .score-bar > .score.ones {
            background: rgb(254, 0, 0); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(254, 0, 0), rgb(180, 0, 0)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(254, 0, 0), rgb(180, 0, 0)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(254, 0, 0), rgb(180, 0, 0)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(254, 0, 0), rgb(180, 0, 0)); /* Standard syntax */
        }

        .score-bar > .score.twos {
            background: rgb(242, 159, 0); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(242, 159, 0), rgb(180, 105, 0)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(242, 159, 0), rgb(180, 105, 0)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(242, 159, 0), rgb(180, 105, 0)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(242, 159, 0), rgb(180, 105, 0)); /* Standard syntax */
        }

        .score-bar > .score.threes {
            background: rgb(254, 242, 0); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(254, 242, 0), rgb(180, 168, 0)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(254, 242, 0), rgb(180, 168, 0)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(254, 242, 0), rgb(180, 168, 0)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(254, 242, 0), rgb(180, 168, 0)); /* Standard syntax */
        }

        .score-bar > .score.fours {
            background-color: rgb(0, 189, 123);
            background: rgb(0, 189, 123); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* Standard syntax */
        }

        .score-bar > .score.fives {
            background-color: rgb(0, 0, 254);
            background: rgb(0, 0, 254); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(0, 0, 254), rgb(0, 0, 180)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(0, 0, 254), rgb(0, 0, 180)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(0, 0, 254), rgb(0, 0, 180)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(0, 0, 254), rgb(0, 0, 180)); /* Standard syntax */
        }
    </style>
</head>
<body>
<div class="flashcards">
    <div class="flashcards-container">
        <div class="flashcards-main">
            <div class="flashcards-counter">
                <span class="flashcards-counter-text"></span>
            </div>
            <div class="retest-stack-deck">
                <div class="highlight-anim"></div>
                <div class="retest-stack-count"></div>
            </div>
            <div class="retest-stack-button">
                <div class="hover-anim"></div>
            </div>
            <div class="card-container">
                <div class="card">
                    <div class="side-a">
                    <span class="side-a-text">
                        Choose Retest Stack to test cards with a score of 1-3, or Entire Stack to test every card.
                    </span>
                    </div>
                    <div class="side-b">
                    <span class="side-b-text">
                        Choose Retest Stack to test cards with a score of 1-3, or Entire Stack to test every card.
                    </span>
                    </div>
                </div>
            </div>
            <div class="score-bar">
                <div class="score ones"></div>
                <div class="score twos"></div>
                <div class="score threes"></div>
                <div class="score fours"></div>
                <div class="score fives"></div>
                <div class="score zeros"></div>
            </div>
            <div class="entire-stack-deck">
                <div class="highlight-anim"></div>
                <span class="deck-name"></span>
                <span class="professor"></span>
            </div>
            <div class="entire-stack-button">
                <div class="hover-anim"></div>
            </div>
            <div class="flip-button">
                <div class="hover-anim"></div>
            </div>
            <div class="score-buttons">
                <div class="button one disabled"></div>
                <div class="button two disabled"></div>
                <div class="button three disabled"></div>
                <div class="button four disabled"></div>
                <div class="button five disabled"></div>
            </div>
            <div class="finished-button">
                <div class="hover-anim"></div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    // --- SETUP

    $(document).ready(function () {
        // CLICK ACTIONS

        $('.flip-button').on('click', function () {
            $('.card').toggleClass('flipped');
        });

        $('.button').on('click', function () {
            if (this.classList[2] === undefined) {
                if (this.classList[1] == "one") scoreAnimation('.retest-stack-deck', 'rgb(254, 0, 0)', 1);
                if (this.classList[1] == "two") scoreAnimation('.retest-stack-deck', 'rgb(242, 159, 0)', 2);
                if (this.classList[1] == "three") scoreAnimation('.retest-stack-deck', 'rgb(254, 242, 0)', 3);
                if (this.classList[1] == "four") scoreAnimation('.entire-stack-deck', 'rgb(0, 189, 123)', 4);
                if (this.classList[1] == "five") scoreAnimation('.entire-stack-deck', 'rgb(0, 0, 254)', 5);
            }
        });

        $('.entire-stack-button').on('click', function () {
            currentCardCount = 0;
            getFlashcards();
            resetStack();
        });

        $('.retest-stack-button').on('click', function () {
            currentCardCount = 0;
            getRetestStack();
            setCounter(currentCardCount);
            resetStack();
        });

        // GAME SETUP

        initializeGame();
    });

    // --- ANIMATION HANDLERS

    var animTime = 500;

    function scoreAnimation(deck, color, score) {
        resetCard();
        setScore(currentCardId, score);
        currentCardCount++;
        $(deck + ' > .highlight-anim')
            .css('box-shadow', '0 0 30px ' + color)
            .toggleClass('animated');
        setTimeout(function () {
            loadCard(currentCardCount);
            setTimeout(function () {
                $(deck + ' > .highlight-anim').toggleClass('animated');
                setCounter(currentCardCount);
                getRetestStackCount();
            }, animTime);
        }, animTime);
    }

    function resetCard() {
        var $card = $('.card');

        $('.score-buttons .button').addClass("disabled");
        $card.fadeOut(animTime);
        setTimeout(function () {
            $card.removeClass('flipped');
            setTimeout(function () {
                $('.score-buttons .button').removeClass("disabled");
                $card.fadeIn(animTime);
            }, animTime);
        }, animTime);
    }

    function resetStack() {
        resetCard();
        setTimeout(function () {
            loadCard(currentCardCount);
        }, animTime);
    }

    // --- FLASHCARD LOGIC

    var cards = [],
        deck = [],
        scores = [],
        prof = "",
        currentCardId = 0,
        currentCardCount = 0;

    function initializeGame() {
        getFlashcards();
        getProf();
        getScores();
        loadDeck();
        loadScores();
        setCounter(currentCardCount);
        getRetestStackCount();
    }

    function loadCard(count) {
        if (currentCardCount < cards.length) {
            var card = cards[count];
            currentCardId = cards[count].id;
            console.log(currentCardId);
            $('.side-a-text').html(card['prompt_side']);
            $('.side-b-text').html(card['answer_side']);
        } else {
            $('.side-a-text').html("Deck Complete!");
            $('.side-b-text').html("Deck Complete!");
            $('.score-buttons .button').addClass("disabled");
        }
    }

    function loadDeck() {
        $('.deck-name').html(deck['deck_title']);
        $('.professor').html(prof);
    }

    function loadScores() {
        var zeros = 0,
            ones = 0,
            twos = 0,
            threes = 0,
            fours = 0,
            fives = 0;

        for (var i in scores) {
            if (scores[i][1] === 0) zeros++;
            else if (scores[i][1] === 1) ones++;
            else if (scores[i][1] === 2) twos++;
            else if (scores[i][1] === 3) threes++;
            else if (scores[i][1] === 4) fours++;
            else if (scores[i][1] === 5) fives++;
        }

        $('.zeros').css('width', (zeros / scores.length * 100) + "%");
        $('.ones').css('width', (ones / scores.length * 100) + "%");
        $('.twos').css('width', (twos / scores.length * 100) + "%");
        $('.threes').css('width', (threes / scores.length * 100) + "%");
        $('.fours').css('width', (fours / scores.length * 100) + "%");
        $('.fives').css('width', (fives / scores.length * 100) + "%");
    }

    function getFlashcards() {
        cards = JSON.parse(<?php echo($flashcardset)?>);
        deck = JSON.parse(<?php echo($flashcardinfo)?>);
    }

    function getProf() {
        prof = "<?php echo $flashcardprof?>";
    }

    function getScores() {
        scores = [];
        for (var i in cards) {
            if (cards[i].score === undefined) cards[i].score = 0;
            scores.push([cards[i].id, cards[i].score]);
        }
    }

    function getRetestStack() {
        var testCards = [];
        for (var i in cards) if (cards[i].score < 4 && cards[i].score > 0) testCards.push(cards[i]);
        cards = testCards;
        getRetestStackCount();
    }

    function getRetestStackCount() {
        var count = 0;
        for (var i in cards) if (cards[i].score < 4 && cards[i].score > 0) count++;
        $('.retest-stack-count').html(count);
    }

    function setScore(id, score) {
        var card = {},
            cardScore = [];
        for (var i in cards) if (cards[i].id == id) card = cards[i];
        for (var j in scores) if (scores[j][0] == id) cardScore = scores[j];
        card.score = score;
        cardScore[1] = score;
        console.log(cardScore);
        loadScores();

        // TODO: Add POST for score to keep track of student score for each card
    }

    function setCounter(count) {
        $('.flashcards-counter-text').html((count == cards.length ? count : count + 1) + "/" + cards.length);
    }

</script>
</html>