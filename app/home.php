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
                        <button class="btn-icon" id="previous-quote">
                            <i class="bi bi-caret-left-fill"></i>
                        </button>
                    </div>

                    <div class="col-8">
                        <div class="">
                            <blockquote>
                                <p>Everything you lose is a step you take</p>
                                <p>Taylor Allison Swift</p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <button class="btn-icon" id="next-quote">
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
                <div class="row heading"><h2>Add Today's Ratings</h2></div>

            </div>
        </div>
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