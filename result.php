<?php
session_start();
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;
// Handle button click
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Decide which page to go
    switch ($_POST["action"]) {

        case "math":
            header("Location: mathQuiz.php");
            exit();

        case "sea":
            header("Location: seaQuiz.php");
            exit();

        case "leaderboard":
            header("Location: leaderboard.php");
            exit();

        case "exit":
            header("Location: exit.php");
            exit();
    }
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
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <p>Num of Correct Answers: <?php echo $_SESSION["numCorrect"] ?? 0; ?></p>
    <p>Num of Incorrect Answers: <?php echo $_SESSION["numIncorrect"] ?? 0; ?></p>
    <p>Current Points: <?php echo $_SESSION["currentPoint"] ?? 0; ?></p>
    <p>Overall Points: <?php echo $_SESSION["overallPoint"] ?? 0; ?></p>
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