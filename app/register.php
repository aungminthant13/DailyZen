<!doctype html>
<html lang="en">
    <head>
        <title>DailyZen: Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
    <main>
            <!-- Logo at the top -->
            <div class="container-fluid text-center my-4">
                <img src="../img/logo.jpg" alt="DailyZen Logo" class="img-fluid" style="max-height: 100px;">
            </div>

            <div class="container">
                <div class="row border border-light-subtle rounded-2 p-4 w-100">
                    <!-- Image box -->
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <img src="../img/folklore.jpg" alt="Sample Image" class="img-fluid img-thumbnail">
                    </div>

                    <!-- Form box -->
                    <div class="col-md-8 d-flex justify-content-center align-items-center">
                        <form method="POST" class="col-md-10 p-2">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password1" name="password" placeholder="Password">
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>

                            <div class="d-flex justify-content-center mt-2">
                                <p> Don't have an account? <a class="link-opacity-100-hover" href="#">Register Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
