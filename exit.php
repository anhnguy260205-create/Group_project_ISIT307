<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["action"] ?? "") == "start_new") {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Update overall points by adding current points from the last quiz and reset current points for the next game
$_SESSION["overallPoint"] = ($_SESSION["overallPoint"] ?? 0) + ($_SESSION["currentPoint"] ?? 0);
$_SESSION["currentPoint"] = 0;
$_SESSION["answers"] = [];

// Retrieve the nickname and overall points from the session
$nickname = $_SESSION["nickname"] ?? "";

// Read the leaderBoard.txt file 
$leaderBoard = file("data/leaderBoard.txt");
$found = false;
$newData = "";
$cumulativePoint = 0;
// Loop through the leaderboard to find the current user's nickname and update their score
foreach ($leaderBoard as $row) {
    $line = explode(",", trim($row));

    // Check if the nickname in the leaderboard matches the current user's nickname
    if ($nickname == $line[0]) {
        $line[1] += $_SESSION["overallPoint"];
        $cumulativePoint = $line[1];
        $found = true;
        $_SESSION["overallPoint"] = 0;
    }
    $newData .= $line[0] . "," . $line[1] . "\n";
}
// If the nickname was not found in the leaderboard, add a new entry for the user
if (!$found) {
    $newData .= $nickname . "," . $_SESSION["overallPoint"] . "\n";
    $cumulativePoint = $_SESSION["overallPoint"];
    $_SESSION["overallPoint"] = 0;
}
file_put_contents("data/leaderBoard.txt", $newData);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Exit</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h2>Exit</h2>

        <?php
        // Display error message if any
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <p>NickName: <?php echo $nickname ?? ""; ?></p>
        <p>Overall Points of previous and current games: <?php echo $cumulativePoint ?? 0; ?></p>
        <form method="post">
            <button type="submit" name="action" value="start_new" class="button">Start New Game</button>
        </form>

    </div>

</body>

</html>