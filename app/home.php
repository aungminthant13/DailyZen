<?php
session_start();
if (!isset($_SESSION['userID']))
    header("Location: ../app/login.php");
?>

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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Neuton:ital,wght@0,200;0,300;0,400;0,700;0,800;1,400&display=swap');
    </style>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="../js/homepage-chart.js"></script>
</head>

<body class="home-main">
    <div id="navbar" class="navbar">
        <div class="navbar-logo">
            <h2>DailyZen</h2>
        </div>
        <div class="navbar-items">
            <a href="#greeting">Home</a>
            <a href="#quote">Quote</a>
            <a href="#ratings">Today's Ratings</a>
            <a href="#dashboard">Dashboard</a>
        </div>


        <div class="logout btn-primary"><a href="../app/logout.php">Logout</a></div>

    </div>
    <main style="width: 100%;">
        <div class="container-fluid custom-container">
            <div id="greeting" class="row block">
                <div class="row">
                    <?php

                    $customDate = new DateTime('2024-08-29');

                    // Get the current hour
                    date_default_timezone_set('Asia/Bangkok');
                    $currentHour = $customDate->format('H');

                    // Determine the appropriate greeting
                    if ($currentHour >= 5 && $currentHour < 12) {
                        $greeting = "Good Morning";
                    } elseif ($currentHour >= 12 && $currentHour < 17) {
                        $greeting = "Good Afternoon";
                    } elseif ($currentHour >= 17 && $currentHour < 22) {
                        $greeting = "Good Evening";
                    } else {
                        $greeting = "Good Night";
                    }

                    // Display the greeting with the user's name
                    $name = $_SESSION["fname"] . " " . $_SESSION["lname"];
                    echo "<div class='col-8'>";
                    echo "<h2>$greeting, $name!</h2>";
                    echo "</div>";
                    ?>

                    <div class='col-4' style="text-align:end;">
                        <?php echo date("d-m-Y (D)") . "<br>" . date("h:i A") . "<br>"; ?>
                    </div>
                </div>
            </div>

            <div id="quote" class="row block">
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
                    <!-- Previous Button - Hidden on small screens -->
                    <div class="col-2 d-none d-md-flex align-items-center justify-content-center">
                        <button class="btn-icon previous-quote-btn" id="previous-quote-btn">
                            <i class="bi bi-caret-left-fill"></i>
                        </button>
                    </div>

                    <!-- Quote block - Takes full width on small screens, 8 columns on larger screens -->
                    <div class="col-12 col-md-8">
                        <blockquote>
                            <p>quote text goes here</p>
                            <p>author name goes here</p>
                        </blockquote>
                    </div>

                    <!-- Next Button - Hidden on small screens -->
                    <div class="col-2 d-none d-md-flex align-items-center justify-content-center">
                        <button class="btn-icon next-quote-btn" id="next-quote-btn">
                            <i class="bi bi-caret-right-fill"></i>
                        </button>
                    </div>
                </div>

                <!-- Buttons for small screens - Shown only on small screens -->
                <div class="row d-flex d-md-none">
                    <!-- Both columns should take half of the screen width each (col-6) -->
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <button class="btn-icon previous-quote-btn" id="previous-quote-btn">
                            <i class="bi bi-caret-left-fill"></i>
                        </button>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-start">
                        <button class="btn-icon next-quote-btn" id="next-quote-btn">
                            <i class="bi bi-caret-right-fill"></i>
                        </button>
                    </div>
                </div>

            </div>


            <div id="overlay" class="overlay">
                <div class="overlay-content">
                    <div style="display: flex; align-items: center;">
                        <input type="text" id="overlay-search-bar" placeholder="Search quote or author">
                        <button id="overlay-search-btn"><i class="bi bi-search"></i></button>
                    </div>
                    <div id="overlay-search-results" class="dropdown-content">
                    </div>
                </div>
            </div>


            <div id="ratings" class="row block">
                <div class="row heading">
                    <h2>Add Today's Ratings</h2>
                </div>
                <div>
                    <form method="POST" action="../api/addRatings.php">
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
                            <span class="score-label heading">Workload Management</span>
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
                            <span class="score-label heading">Anxiety Management</span>
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
                            <button id="cancel-rating" class="">Cancel</button>
                            <button type="submit" id="add-rating" class="">Add Ratings</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="dashboard" class="row block">
                <h2 class="heading">Ratings of the last 5 days</h2>
                <div id="chart_div" style="width: 100%; height: 70%; margin:0;"></div>
                <div id="alert_div" class="alert alert-danger mx-auto" style="width: 60%; display: none;">
                </div>

                <div style="text-align: center;"><a href="../app/chart.php">View all time ratings here</a></div>
            </div>
        </div>
        </div>

</body>

</main>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom Script -->
<script src="../js/quote-fetch.js"></script>
<script src="../js/quote-overlay.js"></script>
<script src="../js/send-ratings.js"></script>
<script src="../js/navbar.js"></script>
<!-- <script src="../js/keyboard-shortcuts.js"></script> -->


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