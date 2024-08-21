<!doctype html>
<html lang="en">

<head>
    <title>DailyZen</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/quote.css">
    <link rel="stylesheet" href="../css/overlay.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Neuton:ital,wght@0,200;0,300;0,400;0,700;0,800;1,400&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Happiness', 'Workload Management', 'Anxiety Management'],
                ['2024.08.15', 5, 4, 5],
                ['2024.08.16', 3, 3, 2],
                ['2024.08.17', 4, 4, 4],
                ['2024.08.18', 3, 4, 5],
                ['2024.08.19', 3, 3, 4]
            ]);

            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body class="home-main">
    <main style="width: 100%;">
        <div class="navbar"></div>
        <div class="container-fluid custom-container">
            <div class="row block">
                <div class="col-12">
                    <h2>Good Morning, Taylor!</h2>
                </div>
            </div>

            <div class="row block">

                <div class="row align-items-center">
                    <div class="col-11">
                        <h2 class="heading w-100">Quote of the Day</h2>
                    </div>

                    <div class="col-1 d-flex justify-content-end">
                        <button id="home-quote-search-btn" class="">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <button class="btn-icon" id="previous-quote-btn">
                            <i class="bi bi-caret-left-fill"></i>
                        </button>
                    </div>

                    <div class="col-8">
                        <div class="">
                            <blockquote>
                                <p></p>
                                <p></p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <button class="btn-icon" id="next-quote-btn">
                            <i class="bi bi-caret-right-fill"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="overlay" class="overlay">
                <div class="overlay-content">
                    <input type="text" id="overlay-search-bar" placeholder="Search quote or author">
                    <div id="overlay-search-results" class="dropdown-content">
                        <div id="overlay-search-result-quote"></div>
                        <div id="overlay-search-result-author"></div>
                    </div>
                </div>
            </div>

            <div class="row block">
                <div class="row heading">
                    <h2>Add Today's Ratings</h2>
                </div>
                <div>
                    <form>
                        <div class="score-input">
                            <span class="score-label heading">Happiness</span>
                            <div class="score-options">
                                <input type="radio" id="happiness-1" name="happiness" value="1">
                                <label for="happiness-1" data-value="1"></label>

                                <input type="radio" id="happiness-2" name="happiness" value="2">
                                <label for="happiness-2" data-value="2"></label>

                                <input type="radio" id="happiness-3" name="happiness" value="3">
                                <label for="happiness-3" data-value="3"></label>

                                <input type="radio" id="happiness-4" name="happiness" value="4">
                                <label for="happiness-4" data-value="4"></label>

                                <input type="radio" id="happiness-5" name="happiness" value="5">
                                <label for="happiness-5" data-value="5"></label>
                            </div>
                        </div>

                        <div class="score-input">
                            <span class="score-label heading">Workload</span>
                            <div class="score-options">
                                <input type="radio" id="workload-1" name="workload" value="1">
                                <label for="workload-1" data-value="1"></label>

                                <input type="radio" id="workload-2" name="workload" value="2">
                                <label for="workload-2" data-value="2"></label>

                                <input type="radio" id="workload-3" name="workload" value="3">
                                <label for="workload-3" data-value="3"></label>

                                <input type="radio" id="workload-4" name="workload" value="4">
                                <label for="workload-4" data-value="4"></label>

                                <input type="radio" id="workload-5" name="workload" value="5">
                                <label for="workload-5" data-value="5"></label>
                            </div>
                        </div>

                        <div class="score-input">
                            <span class="score-label heading">Anxiety</span>
                            <div class="score-options">
                                <input type="radio" id="anxiety-1" name="anxiety" value="1">
                                <label for="anxiety-1" data-value="1"></label>

                                <input type="radio" id="anxiety-2" name="anxiety" value="2">
                                <label for="anxiety-2" data-value="2"></label>

                                <input type="radio" id="anxiety-3" name="anxiety" value="3">
                                <label for="anxiety-3" data-value="3"></label>

                                <input type="radio" id="anxiety-4" name="anxiety" value="4">
                                <label for="anxiety-4" data-value="4"></label>

                                <input type="radio" id="anxiety-5" name="anxiety" value="5">
                                <label for="anxiety-5" data-value="5"></label>
                            </div>
                        </div>

                        <div class="rating-btns">
                            <button type="submit" id="cancel-rating" class="">Cancel</button>
                            <button type="submit" id="add-rating" class="">Add Ratings</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row block">
                <div id="curve_chart" class="border" style="width: 100%; height: 500px; margin:0;"></div>
            </div>
        </div>
        </div>

</body>

</main>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom Script -->
<script>
    $(document).ready(function() {
        // Show overlay when button is pressed
        $('#home-quote-search-btn').on('click', function() {
            $('.overlay').css('display', 'flex');
        });

        // Close overlay when clicking outside of it
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.overlay-content, #home-quote-search-btn').length) {
                $('#overlay').hide();
            }
        });

        // Prevent closing overlay when clicking inside the overlay content
        $('.overlay-content').on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
<script src="../js/quote-fetch.js"></script>

<footer>
    <!-- place footer here -->
</footer>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>