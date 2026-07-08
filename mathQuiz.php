<?php
session_start();
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;
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
