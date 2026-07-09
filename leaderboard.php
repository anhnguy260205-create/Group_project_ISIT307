// Notice: the overall point in session does not update in this file.
// If you want to get the updated overall point, 
// you should use $overallPoint instead of $_SESSION["overallPoint"] in this file.
<?php
session_start();
// Retrieve the nickname and overall points from the session
$nickname = $_SESSION["nickname"] ?? "";
$overallPoint = ($_SESSION["overallPoint"] ?? 0) + ($_SESSION["currentPoint"] ?? 0);

if ($_SESSION["from"] == "result")
{
    $returnPage = "result.php";
}
else
{
    $returnPage = "index.php";
}
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
    <p>NickName: <?php echo $nickname ?? ""; ?></p>
    <?php echo "Overall Points: " . $overallPoint; ?>
    <a href="<?= $returnPage ?>" class="button">Return</a>

</div>

</body>

</html>