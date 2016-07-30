<?php

function base_url()
{
    return "./";
}

// DEBUG
$student = "Tester McTesterson";
$currentdeck = 0;
$decks = json_encode(
    '[
        {
          "id": 0,
          "name": "Jazz FlashCards Stack 1",
          "scores": [0, 0, 0, 0, 0, 0]
        },
        {
          "id": 1,
          "name": "Blues FlashCards Stack 1",
          "scores": [1, 2, 3, 4, 5, 1]
        },
        {
          "id": 2,
          "name": "Jazz FlashCards Stack 2",
          "scores": [2, 3, 4, 5, 1, 2]
        },
        {
          "id": 3,
          "name": "Jazz FlashCards Stack 2",
          "scores": [3, 4, 5, 1, 2, 3]
        },
        {
          "id": 4,
          "name": "Folk Music Stack 1",
          "scores": [4, 5, 2, 3, 4, 5]
        },
        {
          "id": 5,
          "name": "Folk Music Stack 2",
          "scores": [5, 1, 2, 3, 4, 5]
        },
        {
          "id": 6,
          "name": "Jazz FlashCards Stack 2",
          "scores": [1, 1, 2, 3, 4, 5]
        },
        {
          "id": 7,
          "name": "Understanding Music Stack 1",
          "scores": [1, 2, 2, 3, 4, 5]
        },
        {
          "id": 8,
          "name": "Jazz FlashCards Stack 3",
          "scores": [1, 2, 3, 3, 4, 5]
        },
        {
          "id": 9,
          "name": "Understanding Music Stack 2",
          "scores": [5, 5, 5, 5, 5, 5]
        }
    ]');
// /DEBUG

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <title>AmPopMusic.com - <!-- TODO: PUT DECK TITLE HERE --></title>
    <style>
        <?php
            $intro_bg = "img/backgrounds/intro_background.png";
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

        .intro-container {
            width: 768px;
            height: 510px;
            margin: 0;
            padding: 15px;
            background: url("<?php echo(base_url() . $intro_bg);?>") no-repeat top center;
            background-size: 100%;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $intro_bg);?>', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo(base_url() . $intro_bg);?>', sizingMethod='scale')";
        }

        .intro-main {
            display: block;
            width: 100%;
            height: 100%;
            float: left;
        }

        .student-name {
            position: absolute;
            top: 109px;
            left: 384px;
            font-family: arial, sans-serif;
            font-size: 11px;
            font-weight: 600;
        }

        .scores-container {
            position: absolute;
            top: 125px;
            left: 340px;
            width: 400px;
            height: 275px;
            overflow-y: scroll;
        }

        .deck {
            width: 100%;
            height: 40px;
        }

        .deck-name {
            display: block;
            width: 46%;
            padding-top: 12px;
            float: left;
            overflow-x: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-size: 12px;
            text-align: center;
        }

        .current-deck .deck-name {
            text-decoration: underline;
        }

        .score-text {
            position: relative;
            display: inline-block;
            left: 20px;
            width: 195px;
            font-size: 11px;
            text-align: center;
        }

        .score-bar {
            position: relative;
            left: 20px;
            width: 195px;
            height: 20px;
            background: transparent;
            border-radius: 0;
            overflow: hidden;
        }

        .score-bar > .score {
            display: inline-block;
            height: 100%;
            margin: 0;
            padding: 0;
            float: left;
            color: #fff;
            -webkit-transition: width 1s;
            -moz-transition: width 1s;
            -o-transition: width 1s;
            -ms-transition: width 1s;
            transition: width 1s;
            text-align: center;
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
            background: rgb(0, 189, 123); /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* For Firefox 3.6 to 15 */
            background: linear-gradient(rgb(0, 189, 123), rgb(0, 140, 85)); /* Standard syntax */
        }

        .score-bar > .score.fives {
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
    <div class="intro-container">
        <div class="intro-main">
            <span class="student-name"></span>
            <div class="scores-container">
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    // --- SETUP

    $(document).ready(function () {
        // CLICK ACTIONS

        initializeScores();
    });

    // --- FLASHCARD LOGIC

    var student = "",
        decks = [],
        currentDeck = 0;

    function initializeScores() {
        getDecks();
        getStudent();
    }

    function getDecks() {
        decks = JSON.parse(<?php echo($decks)?>);
        currentDeck = <?php echo($currentdeck)?>;
        loadScores();
        renderDecks();
    }

    function loadScores() {
        for (var i in decks) {
            decks[i].zeros = 0;
            decks[i].ones = 0;
            decks[i].twos = 0;
            decks[i].threes = 0;
            decks[i].fours = 0;
            decks[i].fives = 0;

            for (var j in decks[i].scores) {
                if (decks[i].scores[j] === 0) decks[i].zeros++;
                else if (decks[i].scores[j] === 1) decks[i].ones++;
                else if (decks[i].scores[j] === 2) decks[i].twos++;
                else if (decks[i].scores[j] === 3) decks[i].threes++;
                else if (decks[i].scores[j] === 4) decks[i].fours++;
                else if (decks[i].scores[j] === 5) decks[i].fives++;
            }

            decks[i].score = (((decks[i].fives * 4) + (decks[i].fours * 3) + (decks[i].threes * 2) + (decks[i].twos)) / (4 * decks[i].scores.length)) * 100;
        }
    }

    function getStudent() {
        student = "<?php echo $student?>";
        $('.student-name').html(student);
    }

    function renderDecks() {
        for (var i in decks) {
            if (decks[i].id == currentDeck) {
                $('.scores-container').prepend(
                    '<div class="deck current-deck">' +
                    '<div class="deck-name">' + decks[i].name + '</div>' +
                    '<span class="score-text">Score: ' + decks[i].score + '</span>' +
                    '<div class="score-bar">' +
                    '<div class="score ones" style="width: ' + (decks[i].ones / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score twos" style="width: ' + (decks[i].twos / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score threes" style="width: ' + (decks[i].threes / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score fours" style="width: ' + (decks[i].fours / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score fives" style="width: ' + (decks[i].fives / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score zeros" style="width: ' + (decks[i].zeros / decks[i].scores.length * 100) + '%"></div>' +
                    '</div>' +
                    '</div>'
                );
            } else {
                $('.scores-container').append(
                    '<div class="deck">' +
                    '<div class="deck-name">' + decks[i].name + '</div>' +
                    '<span class="score-text">Score: ' + decks[i].score.toString().substring(0, 5) + '%</span>' +
                    '<div class="score-bar">' +
                    '<div class="score ones" style="width: ' + (decks[i].ones / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score twos" style="width: ' + (decks[i].twos / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score threes" style="width: ' + (decks[i].threes / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score fours" style="width: ' + (decks[i].fours / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score fives" style="width: ' + (decks[i].fives / decks[i].scores.length * 100) + '%"></div>' +
                    '<div class="score zeros" style="width: ' + (decks[i].zeros / decks[i].scores.length * 100) + '%"></div>' +
                    '</div>' +
                    '</div>'
                );
            }
        }
    }

</script>
</html>