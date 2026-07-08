<?php
session_start();
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sea World Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h2>Sea World Quiz</h2>

    <?php
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="post" action="result.php">

        <!-- Question 1 -->
        <div class="question">

            <label>Random Question 1</label>

            <div class="radio-group">
                <label>
                    <input type="radio" name="q1" value="True">
                    True
                </label>

                <label>
                    <input type="radio" name="q1" value="False">
                    False
                </label>
            </div>



        <!-- Question 2 -->


            <label>Random Question 2</label>

            <div class="radio-group">
                <label>
                    <input type="radio" name="q2" value="True">
                    True
                </label>

                <label>
                    <input type="radio" name="q2" value="False">
                    False
                </label>
            </div>



        <!-- Question 3 -->

            <label>Random Question 3</label>

            <div class="radio-group">
                <label>
                    <input type="radio" name="q3" value="True">
                    True
                </label>

                <label>
                    <input type="radio" name="q3" value="False">
                    False
                </label>
            </div>

        </div>

        <button type="submit">
            Submit
        </button>

    </form>


</div>

</body>
</html>
