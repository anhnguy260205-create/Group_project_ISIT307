<?php
session_start();
$nickname = $_SESSION["nickname"] ?? "";

// Retrieve the current points, number of correct answers, and number of incorrect answers from the session
$currentPoint = $_SESSION["currentPoint"] ?? 0;
$numCorrect = $_SESSION["numCorrect"] ?? 0;
$numIncorrect = $_SESSION["numIncorrect"] ?? 0;
$overallPoint = ($_SESSION["overallPoint"] ?? 0) + $currentPoint;


// Handle button click
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Navigation buttons on the result page should not run quiz scoring.
    if (isset($_POST["action"])) {
        // Decide which page to go
        switch ($_POST["action"]) {

            case "math":
                header("Location: mathQuiz.php");
                exit();

            case "sea":
                header("Location: seaQuiz.php");
                exit();

            case "leaderboard":
                $_SESSION["from"] = "result";
                header("Location: leaderboard.php");
                exit();

            case "exit":
                header("Location: exit.php");
                exit();
        }
    }

    // Quiz submission POST: compute this round score.
    $answers = $_SESSION["answers"] ?? [];
    $_SESSION["currentPoint"] = 0;
    $_SESSION["numCorrect"] = 0;
    $_SESSION["numIncorrect"] = 0;

    // Loop through the answers and calculate the score
    for ($i = 0; $i < count($answers); $i++) {
        $userAnswer = $_POST["q" . ($i + 1)] ?? null;
        if ($userAnswer !== null && (string) $userAnswer === (string) $answers[$i]) {
            $_SESSION["currentPoint"] += 3;
            $_SESSION["numCorrect"]++;
        } else {
            $_SESSION["currentPoint"] -= 2;
            $_SESSION["numIncorrect"]++;
        }
    }

    // Update overall points by adding current points from the last quiz and reset current points for the next game
    $currentPoint = $_SESSION["currentPoint"];
    $numCorrect = $_SESSION["numCorrect"];
    $numIncorrect = $_SESSION["numIncorrect"];
    $overallPoint = ($_SESSION["overallPoint"] ?? 0) + $currentPoint;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h2>Result</h2>

        <?php
        // Display error message if any
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <p>Num of Correct Answers: <?php echo $numCorrect ?? 0; ?></p>
        <p>Num of Incorrect Answers: <?php echo $numIncorrect ?? 0; ?></p>
        <p>Current Points: <?php echo $currentPoint ?? 0; ?></p>
        <p>Overall Points: <?php echo $overallPoint ?? 0; ?></p>
        <hr>

        <form method="post">

            <button type="submit" name="action" value="math">
                Math Quiz
            </button>

            <br>

            <button type="submit" name="action" value="sea">
                Sea Animal Quiz
            </button>

            <br>

            <button type="submit" name="action" value="leaderboard">
                Leaderboard
            </button>

            <br>

            <button type="submit" name="action" value="exit">
                Exit
            </button>

        </form>

    </div>

</body>

</html>