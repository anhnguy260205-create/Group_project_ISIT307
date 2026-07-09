<?php
session_start();
// Update overall points by adding current points from the last quiz and reset current points for the next game
$_SESSION["overallPoint"] = $_SESSION["overallPoint"] + $_SESSION["currentPoint"];
$_SESSION["currentPoint"] = 0;

// Retrieve the nickname and overall points from the session
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;

// Initialize the answers array in the session
$_SESSION["answers"] = [];
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
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="post" action="result.php">
        <div class="question">
            <label>Random Question 1</label><br>

            <input
                type="number"
                name="q1"
            >

            <br>
    
            <label>Random Question 2</label><br>

            <input
                type="number"
                name="q2"
            >

            <br>
            
            <label>Random Question 3</label><br>

            <input
                type="number"
                name="q3"
            >

            <br>

            <button type="submit">
                Submit
            </button>
        </div>

    </form>

</div>

</body>
</html>
