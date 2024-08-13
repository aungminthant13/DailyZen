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
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$password = htmlspecialchars($_POST['password']);

// error checking
$first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";

// Validate email
if (empty($email)) {
    $emailErr = "Email is required";
} else {
    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
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

if (empty($first_nameErr) && empty($last_nameErr) && empty($emailErr) && empty($passwordErr) && empty($emailExistsErr)) {
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert data to database
    $query = "INSERT INTO dailyzen.users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    if (!empty($emailErr)) {
        echo $emailErr . "<br>";
    } elseif (!empty($first_nameErr)) {
        echo $first_nameErr . "<br>";
    } elseif (!empty($last_nameErr)) {
        echo $last_nameErr . "<br>";
    } elseif (!empty($passwordErr)) {
        echo $passwordErr . "<br>";
    } elseif (!empty($emailExistsErr)) {
        echo $emailExistsErr . "<br>";
    }
    
}

$conn->close();
?>
