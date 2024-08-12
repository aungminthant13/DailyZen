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
}

if (empty($emailErr) && empty($passwordErr)) {
    // connecting to database
    require_once '../api/dbinfo.php';
    $conn = new mysqli($host, $DBusername, $DBpassword, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT password FROM dailyzen.users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password);

    // Check if the user exists
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Login successful
            echo "Successfully Logged in!";
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
    if (!empty($emailErr)) echo $emailErr;
    if (!empty($passwordErr)) echo $passwordErr;
}

?>
