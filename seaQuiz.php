<?php
// use session to store nickname and overall points
session_start();

// Update overall points by adding current points from the last quiz and reset current points for the next game
$_SESSION["overallPoint"] = ($_SESSION["overallPoint"] ?? 0) + ($_SESSION["currentPoint"] ?? 0);
$_SESSION["currentPoint"] = 0;

// Retrieve the nickname and overall points from the session
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;

// Initialize the answers array in the session
$_SESSION["answers"] = [];


// Generate random questions for the quiz
$questions = range(1, 6);

shuffle($questions);

$randomQuestions = array_slice($questions, 0, 3);

// Read the quiz data from the file
$quizData = file("data/seaQuiz.txt");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Sea World Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="margin-top:10px">

    <div class="container">

        <h2>Sea World Quiz</h2>

        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="post" action="result.php">

            <!-- Loop for 3 random questions displaying -->
            <div class="question">
                <?php
                for ($i = 0; $i < count($randomQuestions); $i++) {
                    // Display the question number and the corresponding image
                    echo "<label>Question " . ($i + 1) . "</label> <br>";
                    echo "<img src='img/" . $randomQuestions[$i] . ".png' width='200'>";
                    foreach ($quizData as $line) {
                        $question = explode(",", trim($line));
                        // Check if the question number matches the random question number
                        if ($question[0] == $randomQuestions[$i]) {
                            // Display the question text and store the answer in the session
                            echo "<p style='font-size: 16px; margin: 4px 0 6px; line-height: 1.1;'>"
                                . $question[1] . "</p>";
                            $_SESSION["answers"][] = $question[2];
                        }
                    }
                    echo "<div class='radio-group'>
                        <label>
                            <input type='radio' name='q" . ($i + 1) . "' value='True' required>
                            True
                        </label>

                        <label>
                            <input type='radio' name='q" . ($i + 1) . "' value='False'>
                            False
                        </label>
                    </div>";
                }
                ?>

                <button type="submit">
                    Submit
                </button>

        </form>


    </div>

</body>

</html>