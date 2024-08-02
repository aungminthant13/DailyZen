<!-- - get the data from login.php
- validate it using php
- connect to database
- validate with the database -->

<?php

function test_input($data)
{
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
    if (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters";
    }
}

// connecting to database
require_once '../api/dbinfo.php';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($emailErr) && empty($passwordErr)) {
    $query = "SELECT * FROM dailyzen.users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();
    $stmt->store_result();
    $row = $stmt->num_rows;

    if ($row > 0) {
        // Login successful
        echo "Successfully Logged in!";
    } else {
        // Invalid email or password
        echo "Invalid Login";
    }
    $stmt->close();
} else {
    if (!empty($emailErr)) echo $emailErr;
    if (!empty($passwordErr)) echo $passwordErr;
}

$conn->close();
?>