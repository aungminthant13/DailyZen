// Load the Visualization API and the corechart package.
google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    // Fetch JSON data and process it
    fetch('../api/readScores.php')  // Replace with your JSON data URL
        .then(response => response.json())
        .then(data => {
            // Convert JSON data to a DataTable
            const dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Date');
            dataTable.addColumn('number', 'Happiness');
            dataTable.addColumn('number', 'Workload Management');
            dataTable.addColumn('number', 'Anxiety Management');

            // Add rows from JSON data
            data.slice(-5).forEach(item => {
                dataTable.addRow([item.score_date, item.happiness_score, item.workload_score, item.anxiety_score]);
            });

            // Set chart options
            const options = {

                width: '100%',  // Set width to 100% to make it responsive
                height: 400,
                chartArea: {
                    width: '70%',
                    height: '70%' }, // Adjust chart area

            };

            // Instantiate and draw the chart.
            const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        })
        .catch(error => console.error('Error fetching the JSON data:', error));
}