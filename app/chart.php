<?php
session_start();
if (!isset($_SESSION['userID']))
    header("Location: ../app/login.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>DailyZen: Chart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        .alert {
            display: none;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .home-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 20px; /* Space between button and heading */
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
        }

        .header-container h1 {
            margin: 0;
        }
    </style>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Fetch JSON data and process it
            fetch("../api/readScores.php") // Replace with your JSON data URL
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log("Fetched data:", data); // Log fetched data

                    const dataTable = new google.visualization.DataTable();
                    dataTable.addColumn("string", "Date");
                    dataTable.addColumn("number", "Happiness");
                    dataTable.addColumn("number", "Workload Management");
                    dataTable.addColumn("number", "Anxiety Management");

                    data.forEach((item) => {
                        dataTable.addRow([
                            item.score_date,
                            item.happiness,
                            item.workload_management,
                            item.anxiety_management,
                        ]);
                    });

                    // Check if there are at least 3 scores to calculate averages
                    if (data.length >= 3) {
                        const averages = {
                            happiness: calculateAverage(
                                data.slice(-3).map((item) => item.happiness)
                            ),
                            workload: calculateAverage(
                                data.slice(-3).map((item) => item.workload_management)
                            ),
                            anxiety: calculateAverage(
                                data.slice(-3).map((item) => item.anxiety_management)
                            ),
                        };

                        console.log("Averages:", averages); // Log calculated averages

                        // Display alert if any average is below 1.5
                        if (
                            averages.happiness < 1.5 ||
                            averages.workload < 1.5 ||
                            averages.anxiety < 1.5
                        ) {
                            const alertDiv = document.getElementById("alert_div");
                            alertDiv.textContent =
                                "Warning: The average of the last 3 readings in one or more categories is below 1.5. Please seek professional assistance.";
                            alertDiv.style.display = "block"; // Show the alert div
                        }
                    }

                    const options = {
                        width: "100%",
                        height: 400,
                        chartArea: {
                            width: "70%",
                            height: "70%"
                        },
                    };

                    const chart = new google.visualization.LineChart(
                        document.getElementById("chart_div")
                    );
                    chart.draw(dataTable, options);
                })
                .catch((error) =>
                    console.error("Error fetching the JSON data:", error)
                );
        }

        function calculateAverage(numbers) {
            if (numbers.length === 0) return 0;
            const total = numbers.reduce((sum, value) => sum + value, 0);
            return total / numbers.length;
        }
    </script>
</head>

<body>
    <!-- Header Container -->
    <div class="header-container">
        <!-- Home Button -->
        <a href="../app/home.php" class="home-button">Back to Homepage</a>
        <!-- Page Heading -->
        <h1>Rating Entries Overtime</h1>
    </div>

    <div id="alert_div" class="alert alert-danger w-60 mx-auto" role="alert"></div>
    <div id="chart_div" style="width: 100%; height: 500px; margin: 0"></div>
</body>

</html>
