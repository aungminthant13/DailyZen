<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// getting data
$form_username = htmlspecialchars($_POST['username']);
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

// error checking
$usernameErr = $first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";

// Validate username
if (empty($form_username)) {
    $usernameErr = "Username is required";
} else {
    $form_username = test_input($form_username);
}

// Validate first name
if (empty($first_name)) {
    $first_nameErr = "First name is required";
} else {
    $first_name = test_input($first_name);
}

// Validate last name
if (empty($last_name)) {
    $last_nameErr = "Last name is required";
} else {
    $last_name = test_input($last_name);
}

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

// Check for unique username
$usernameCheckErr = "";
if (empty($usernameErr)) {
    $query = "SELECT * FROM dailyzen.users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $form_username);

    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $usernameCheckErr = "Username already taken";
    }
    $stmt->close();
}

if (empty($usernameErr) && empty($first_nameErr) && empty($last_nameErr) && empty($emailErr) && empty($passwordErr) && empty($usernameCheckErr)) {
    $query = "INSERT INTO dailyzen.users (username, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $form_username, $first_name, $last_name, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    if (!empty($usernameErr)) echo $usernameErr;
    if (!empty($first_nameErr)) echo $first_nameErr;
    if (!empty($last_nameErr)) echo $last_nameErr;
    if (!empty($emailErr)) echo $emailErr;
    if (!empty($passwordErr)) echo $passwordErr;
    if (!empty($usernameCheckErr)) echo $usernameCheckErr;
}

$conn->close();
?>
