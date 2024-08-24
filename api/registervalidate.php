<?php
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// getting data
$email = test_input($_POST['email']);
$first_name = test_input($_POST['first_name']);
$last_name = test_input($_POST['last_name']);
$password = test_input($_POST['password']);

// error checking
$first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";

// Validate email
if (empty($email)) {
    $emailErr = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
}

// Validate first name
if (empty($first_name)) {
    $first_nameErr = "First name is required";
}

// Validate last name
if (empty($last_name)) {
    $last_nameErr = "Last name is required";
}

// Validate password
if (empty($password)) {
    $passwordErr = "Password is required";
} elseif (strlen($password) < 8) {
    $passwordErr = "Password must be at least 8 characters";
}

// connecting to database
require_once '../api/dbinfo.php';
$conn = new mysqli($host, $DBusername, $DBpassword, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email already exists
if (empty($emailErr)) {
    $check_query = "SELECT email FROM dailyzen.users WHERE email = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $emailErr = "Email already exists. Please use a different email.";
    }
    $check_stmt->close();
}

// Proceed if no errors
if (empty($first_nameErr) && empty($last_nameErr) && empty($emailErr) && empty($passwordErr)) {
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert data to database
    $query = "INSERT INTO dailyzen.users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $password);

    if ($stmt->execute()) {
        // Set session variables
        $_SESSION["userID"] = $conn->insert_id; // Get the ID of the newly inserted user
        $_SESSION["fname"] = $first_name;
        $_SESSION["lname"] = $last_name;
        $_SESSION["email"] = $email;

        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to register."]);
    }

    $stmt->close();
} else {
    // Return the first error found
    if (!empty($emailErr)) {
        $error_message = $emailErr;
    } elseif (!empty($first_nameErr)) {
        $error_message = $first_nameErr;
    } elseif (!empty($last_nameErr)) {
        $error_message = $last_nameErr;
    } elseif (!empty($passwordErr)) {
        $error_message = $passwordErr;
    }
    echo json_encode(["status" => "error", "message" => $error_message]);
}

$conn->close();
?>
