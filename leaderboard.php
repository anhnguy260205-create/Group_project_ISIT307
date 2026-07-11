<?php
session_start();
$nickname = $_SESSION["nickname"];
$returnPage = $_SESSION["from"];
$allResults = file("data/leaderBoard.txt");
$currentPoint = $_SESSION["currentPoint"] ?? 0;
$overallPoint = ($_SESSION["overallPoint"] ?? 0) + $currentPoint;
$found = false;
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
            // Check if the nickname in the leaderboard matches the current user's nickname
            if ($line[0] == $nickname) {
                $players[] = [
                "name" => $line[0],
                "score" => $line[1] + $overallPoint
                ];
                $found = true;
            }
            else{
                // Add other player to the end of the $players array.
                $players[] = [
                    "name" => $line[0],
                    "score" => $line[1]
                ];
            }
            // Check if user click either sort_name or sort_score button
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                switch ($_POST["sort"]) {
                    case "sort_name":
                        // Sort players by their name 
                        usort($players, function ($a, $b) {
                            return strcasecmp(trim($a["name"]), trim($b["name"]));
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

        if ($found == false) {
            // If the user is not found in the leaderboard text file, add them with their overall points
            $players[] = [
                "name" => $nickname,
                "score" => $overallPoint
            ];
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