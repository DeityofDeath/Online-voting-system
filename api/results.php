<?php
include("connect.php");
session_start();

$sql = "SELECT votes, COUNT(*) as vote_count FROM vote GROUP BY votes ORDER BY vote_count DESC";
$result = $connect->query($sql);

echo <<<HTML
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

h2,h1 {
    background-color: #007BFF;
    color: white;
    text-align: center;
    padding: 20px;
    margin: 0;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #007BFF;
    color: white;
}

p {
    text-align: center;
    margin-top: 20px;
}

p.voted, p.not-voted {
    font-weight: bold;
}

canvas {
    display: block;
    margin: 20px auto;
}

.pie-chart {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
#download-results,
        .back-to-home {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .back-to-home {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .back-to-home:hover,
        #download-results:hover {
            background-color: #2075d1;
        }

        .button-container {
            text-align: center;
        }

        footer {
        background-color: #333;
        padding: 10px;
        text-align: center;
        color: #fff;
        }
        .voter-stats-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 5px 5px 15px rgba(53, 136, 214, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
        }

        .voter-stats-container h2 {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin: 0;
        }

        .voter-stats-content {
            text-align: left;
            padding: 10px;
        }

    </style>
</head>
        <h1>Student Election Results</h1>
<body>
HTML;

if ($result === false) {
    die("Error executing vote results query: " . $connect->error);
}

$dataLabels = [];
$dataValues = [];

if ($result->num_rows > 0) {
    echo "<h2>Vote Results</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Candidate Name</th><th>Vote Count</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $dataLabels[] = $row["votes"];
        $dataValues[] = $row["vote_count"];

        echo "<tr><td>" . $row["votes"] . "</td><td>" . $row["vote_count"] . "</td></tr>";
    }

    echo "</table>";

    echo "<div class='pie-chart'>";
    echo "<canvas id='results-pie-chart' width='400' height='400'></canvas>";
    echo "</div>";

    $dataJSON = json_encode($dataLabels);
    $countsJSON = json_encode($dataValues);

    echo <<<HTML
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const labels = $dataJSON;
            const counts = $countsJSON;

            const ctx = document.getElementById('results-pie-chart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.8)',
                            'rgba(0, 150, 136, 0.8)',
                            'rgba(231, 76, 60, 0.8)',
                        ],
                        borderColor: [
                            'rgba(0, 123, 255, 1)',
                            'rgba(0, 150, 136, 1)',
                            'rgba(231, 76, 60, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        });
    </script>
    HTML;

} else {
    echo "<h2>No votes casted yet.</h2>";
}

$sqlTotalVoters = "SELECT COUNT(*) as total_voters FROM users";
$resultTotalVoters = $connect->query($sqlTotalVoters);

if ($resultTotalVoters === false) {
    die("Error executing total voters query: " . $connect->error);
}

if ($resultTotalVoters->num_rows > 0) {
    $rowTotalVoters = $resultTotalVoters->fetch_assoc();
    $totalVoters = $rowTotalVoters['total_voters'];

    $sqlVoted = "SELECT COUNT(*) as voted_count FROM users WHERE status = 1";
    $resultVoted = $connect->query($sqlVoted);

    if ($resultVoted === false) {
        die("Error executing voted query: " . $connect->error);
    }

    if ($resultVoted->num_rows > 0) {
        $rowVoted = $resultVoted->fetch_assoc();
        $votedCount = $rowVoted['voted_count'];

        $notVotedCount = $totalVoters - $votedCount;

        $votedPercentage = ($totalVoters > 0) ? ($votedCount / $totalVoters) * 100 : 0;
        $notVotedPercentage = ($totalVoters > 0) ? ($notVotedCount / $totalVoters) * 100 : 0;

        echo <<<HTML
        <div class="voter-stats-container">
        <h2>Voter Statistics</h2>
        <div class="voter-stats-content">
        <p>Total Voters: $totalVoters</p>
        <p class="voted">Voted: $votedCount ($votedPercentage%)</p>
        <p class="not-voted">Not Voted: $notVotedCount ($notVotedPercentage%)</p>
        </div>
        </div>
        HTML;
    } else {
        echo "Error calculating voted and not voted percentages.";
    }
} else {
    echo "No voters found.";
}


echo <<<HTML
<div class="button-container">
        <a href="#" id="download-results">Download Results Report</a>
        <br>
        <a href="../home/home.html" class="back-to-home">Back to Home</a>
    </div>

    <footer>
        <p class="footer">&copy; 2023 Online Voting System. All rights reserved.</p>
    </footer>

    <script src="./res.js"></script>
</body>

</html>
HTML;
?>
