<?php
session_start();
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = $_SESSION["overallPoint"] ?? 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Leader Board</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <h2>Leader Board</h2>
    
    <?php
    // Display error message if any
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <p>Not Done Yet</p>

    <a href="result.php" class="button">Return</a>

</div>

</body>

</html>