<?php
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// getting data
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

// error checking
$emailErr = $passwordErr = "";

// Validate email
if (empty($email)) {
    $emailErr = "Email is required";
} else {
    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
}

// Validate password
if (empty($password)) {
    $passwordErr = "Password is required";
} else {
    $password = test_input($password);
}

if (empty($emailErr) && empty($passwordErr)) {
    // connecting to database
    require_once '../api/dbinfo.php';
    $conn = new mysqli($host, $DBusername, $DBpassword, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT id, first_name, last_name, email, password FROM dailyzen.users WHERE email = ?";
    $stmt = $conn->prepare($query);

    // Check if prepare() failed
    if ($stmt === false) {
        die("MySQL prepare statement error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userID, $first_name, $last_name, $email, $hashed_password);

    // Check if the user exists
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Login successful, set session variables
            $_SESSION["userID"] = $userID;
            $_SESSION["fname"] = $first_name;
            $_SESSION["lname"] = $last_name;
            $_SESSION["email"] = $email;

            echo "Successfully Logged in!" . "<br>";

            // Redirect to the home page
            // header("Location: ../app/home.php");
            exit(); // Stop further script execution after redirect
        } else {
            // Invalid password
            echo "Invalid Login";
        }
    } else {
        // Invalid email
        echo "Invalid Login";
    }

    $stmt->close();
    $conn->close();
} else {
    if (!empty($emailErr)) {
        echo $emailErr . "<br>";
    } elseif (!empty($passwordErr)) {
        echo $passwordErr . "<br>";
    }
}
?>
