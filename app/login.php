<?php
session_start();
if (isset($_SESSION['userID']))
    header("Location: ../app/home.php");
?>

<!doctype html>
<html lang="en">

<head>
    <title>DailyZen: Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/login.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
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

                    <form method="POST" action="../api/loginvalidate.php" class="p-2">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-input form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <button type="submit" id="login" class="btn btn-primary mt-4">Login</button>

                        <div class="mt-3">
                            <p> No account? <a class="link-opacity-100-hover" href="../app/register.php">Create One</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- send the data to backend for processing -->
    <script>
        $(document).ready(function() {
            $('form[action="../api/loginvalidate.php"]').on('submit', function(event) {
                event.preventDefault();

                var email = $('#email').val();
                var password = $('#password').val();
                
                $.post('../api/loginvalidate.php', {
                    email: email,
                    password: password
                }, function(response) {
                    var data = JSON.parse(response);
                    if (data.status === "success") {
                        // Redirect to home.php if login is successful
                        window.location.href = "../app/home.php";
                    } else {
                        // Show error message if login failed
                        $('#result').html(data.message);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>