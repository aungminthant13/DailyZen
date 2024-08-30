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

            data.slice(-5).forEach((item) => {
                dataTable.addRow([
                    item.score_date,
                    item.happiness,
                    item.workload_management,
                    item.anxiety_management,
                ]);
            });

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
                    width: "60%",
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