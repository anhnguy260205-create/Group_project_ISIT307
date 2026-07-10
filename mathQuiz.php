<?php

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

$pickRandom = array_slice($questions, 0, 3);

// Read the question in the matQuiz.txt
$quizData = file("data/mathQuiz.txt");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Math Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h2>Math Quiz</h2>

        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="post" action="result.php">
            <div class="question">
                <?php
                // Loop to take 3 questions
                for ($i = 0; $i < count($pickRandom); $i++) {
                    // Display questions
                    echo "<label>Question " . ($i + 1) . ":  </label>";

                    foreach ($quizData as $line) {
                        // split the line into question number, question text, and correct answer
                        $question = explode(",", trim($line));
                        // Check question matching with the random question 
                        if ($question[0] == $pickRandom[$i]) {
                            echo "<p style='margin: 10px 0;'>" . $question[1] . "</p>";
                            $_SESSION["answers"][] = $question[2]; // Store the correct answer in the session
                        }
                    }
                    echo "<input type='number' name='q" . ($i + 1) . "'><br><br>";
                }
                ?>

                <button type="submit">
                    Submit
                </button>
            </div>

        </form>

    </div>

</body>

</html>