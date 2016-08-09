<?php

function base_url()
{
    return "./";
}

// DEBUG
$student = "Tester McTesterson";
$currentdeck = 70;
$cards = json_encode('
[{
	"id": "67",
	"flashcard_deck_id": "66",
	"deck_title": "test",
	"scores": "3"
}, {
	"id": "68",
	"flashcard_deck_id": "66",
	"deck_title": "test",
	"scores": "4"
}, {
	"id": "69",
	"flashcard_deck_id": "66",
	"deck_title": "test",
	"scores": "5"
}, {
	"id": "71",
	"flashcard_deck_id": "70",
	"deck_title": "this",
	"scores": "0"
}, {
	"id": "73",
	"flashcard_deck_id": "72",
	"deck_title": "sowhat",
	"scores": "0"
}]
    ');
// /DEBUG

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="manifest" href="manifest.json">
    <title></title>
    <style>
        <?php
            $intro_bg = "img/backgrounds/intro_background.png";
            $flashcards_font = "fonts/ebrimabd.ttf";
        ?>

        @font-face {
            font-family: FlashcardsFont;
            src: url(<?php echo(base_url() . $flashcards_font); ?>);
        }

        body {
            margin-right: 0;
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

        .flashcard-stack-button:hover > .hover-anim,
        .leave-stack-button:hover > .hover-anim {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .leave-stack-button {
            position: absolute;
            top: 462px;
            left: 343px;
            width: 156px;
            height: 26px;
            background: transparent;
        }

        .leave-stack-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            border-top-left-radius: 9px;
            border-bottom-left-radius: 8px;
        }

        .flashcard-stack-button {
            position: absolute;
            top: 462px;
            left: 588px;
            width: 155px;
            height: 26px;
            background: transparent;
        }

        .flashcard-stack-button > .hover-anim {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            border-top-right-radius: 9px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>
<body>
<div class="flashcards">
    <div class="intro-container">
        <div class="intro-main">
            <span class="student-name"></span>
            <div class="scores-container"></div>
            <div class="leave-stack-button">
                <div class="hover-anim"></div>
            </div>
            <div class="flashcard-stack-button">
                <div class="hover-anim"></div>
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

        $('.leave-stack-button').on('click', function () {
            $('#mask_popup').hide();
            $('#popup_info').remove();
        });

        $('.flashcard-stack-button').on('click', function () {
            location.href = '<?php echo base_url()?>flashcards/show/' + currentDeckId;
        });

        initializeScores();
    });

    // --- FLASHCARD LOGIC

    var student = "",
        decks = [],
        currentDeckId = 0;

    function initializeScores() {
        getDecks();
        getStudent();
    }

    function getDecks() {
        var cards = JSON.parse(<?php echo($cards)?>);
        for (var i in cards) {
            if (!decks[cards[i]['flashcard_deck_id']]) {
                decks[cards[i]['flashcard_deck_id']] = {
                    id: cards[i]['flashcard_deck_id'],
                    name: cards[i]['deck_title'],
                    scores: []
                };
            }
            decks[cards[i]['flashcard_deck_id']].scores.push(cards[i].scores);
        }

        // TODO: Replace debug $currentdeck with actual value for target deck id
        currentDeckId = <?php echo($currentdeck)?>;
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
                if (decks[i].scores[j] == 0) decks[i].zeros++;
                else if (decks[i].scores[j] == 1) decks[i].ones++;
                else if (decks[i].scores[j] == 2) decks[i].twos++;
                else if (decks[i].scores[j] == 3) decks[i].threes++;
                else if (decks[i].scores[j] == 4) decks[i].fours++;
                else if (decks[i].scores[j] == 5) decks[i].fives++;
            }

            decks[i].score = (((decks[i].fives * 4) + (decks[i].fours * 3) + (decks[i].threes * 2) + (decks[i].twos)) / (4 * decks[i].scores.length)) * 100;
        }
    }

    function getStudent() {
        // TODO: Replace debug $student with actual value for student name
        student = "<?php echo $student?>";
        $('.student-name').html(student);
    }

    function renderDecks() {
        for (var i in decks) {
            if (decks[i].id == currentDeckId) {
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
                $('title').html('AmPopMusic.com - ' + decks[i].name);
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