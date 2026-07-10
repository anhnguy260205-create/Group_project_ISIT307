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
$overallPoint = $_SESSION["overallPoint"] ?? 0;

// Read the leaderBoard.txt file 
$leaderBoard = file("data/leaderBoard.txt");
$found = false;
$newData = "";
foreach ($leaderBoard as $row) {
    $line = explode(",", trim($row));

    if ($nickname == $line[0]) {
        $line[1] += $overallPoint;
        $found = true;
    }
    $newData .= $line[0] . "," . $line[1] . "\n";
}
if (!$found) {
    $newData .= $nickname . "," . $overallPoint . "\n";
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
        <p>Overall Points: <?php echo $overallPoint ?? 0; ?></p>
        <form method="post">
            <button type="submit" name="action" value="start_new" class="button">Start New Game</button>
        </form>

    </div>

</body>

</html>