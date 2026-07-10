<?php

session_start();
$returnPage = "index.php";
$allResults = file("data/leaderBoard.txt");

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
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <?php
        // Stored the sorted array  
        $players = [];
        // Loop through all the line in the leadBoard file to get data
        for ($i = 0; $i < count($allResults); $i++) {
            $line = explode(",", trim($allResults[$i]));
            // Add a new player to the end of the $players array.
            $players[] = [
                "name" => $line[0],
                "score" => $line[1]
            ];
            // Check if user click either sort_name or sort_score button
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                switch ($_POST["sort"]) {
                    case "sort_name":
                        // Sort players by their name 
                        usort($players, function ($a, $b) {
                            return strcmp($a["name"], $b["name"]);
                        });
                        break;
                    case "sort_score":
                        // Sort players by their score
                        usort($players, function ($a, $b) {
                            return $b["score"] - $a["score"];// descending: highest score first
                        });
                        break;

                }
            }


        }
        foreach ($players as $player) {
            echo "<p>" . htmlspecialchars($player["name"]) . " : " . htmlspecialchars($player["score"]) . "</p>";
        }
        ?>
        <form method="POST" action="">
            <div style="display: flex; gap: 10px;">
                <button type="submit" name="sort" value="sort_name">Sort Name</button>
                <button type="submit" name="sort" value="sort_score">Sort Score</button>
            </div>
        </form>

        <a href="<?= $returnPage ?>" class="button">Return</a>

    </div>

</body>

</html>