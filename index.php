<?php
session_start();

// Handle button click
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get nickname
    $nickname = trim($_POST["nickname"]);

    // Make sure nickname is not empty
    if ($nickname == "") {
        $error = "Please enter your nickname.";
    } else {

        // Save nickname into session
        $_SESSION["nickname"] = $nickname;

        // First game starts with 0 points
        if (!isset($_SESSION["overallPoint"])) {
            $_SESSION["overallPoint"] = 0;
        }

        // Decide which page to go
        switch ($_POST["action"]) {

            case "math":
                header("Location: mathQuiz.php");
                exit();

            case "sea":
                header("Location: seaQuiz.php");
                exit();

            case "leaderboard":
                $_SESSION["from"] = "index";
                header("Location: leaderboard.php");
                exit();

            case "exit":
                header("Location: exit.php");
                exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Learning Hub</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <h2>Learning Hub</h2>

    <?php
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="post">

        <label>Nickname</label><br>

        <input
            type="text"
            name="nickname"
            value="<?php echo isset($_SESSION["nickname"]) ? $_SESSION["nickname"] : ""; ?>"
        >

        <br>

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