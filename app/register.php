<?php
session_start();
if (isset($_SESSION['userID']))
    header("Location: ../app/home.php");
?>

<!doctype html>
<html lang="en">

<head>
    <title>DailyZen: Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/login.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="body">
    <main class="container">
        <div class="main">
            <div class="formbox col-12 col-lg-5">
                <div class="col-12">
                    <div>
                        <h1>DailyZen</h1>
                    </div>
                    <!-- <div style="text-align: left;">
                        <h5>Login</h5>
                    </div> -->
                    <div id="result" class="">

                    </div>

                    <form method="POST" action="../api/registervalidate.php" class="p-2">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" id="register" class="btn btn-primary w-100">Register</button>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <p>Already have an account? <a class="link-opacity-100-hover" href="../app/login.php">Login Here</a></p>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('form[action="../api/registervalidate.php"]').on('submit', function(event) {
                event.preventDefault(); // prevent the default form submission
                var email = $('#email').val();
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var password = $('#password').val();

                $.post('../api/registervalidate.php', {
                    email: email,
                    first_name: first_name,
                    last_name: last_name,
                    password: password
                }, function(response) {
                    var data = JSON.parse(response)
                    if (data.status === "success"){
                        window.location.href = "../app/home.php";
                    } else {
                        $('#result').html(data.message);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>