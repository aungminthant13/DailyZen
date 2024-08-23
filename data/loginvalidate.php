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
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
        exit();
    }

    $query = "SELECT id, first_name, last_name, email, password FROM dailyzen.users WHERE email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "MySQL prepare statement error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userID, $first_name, $last_name, $email, $hashed_password);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION["userID"] = $userID;
            $_SESSION["fname"] = $first_name;
            $_SESSION["lname"] = $last_name;
            $_SESSION["email"] = $email;

            echo json_encode(["status" => "success", "message" => "Successfully Logged in!"]);
            exit();
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid Login"]);
            exit();
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid Login"]);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    $error_message = !empty($emailErr) ? $emailErr : $passwordErr;
    echo json_encode(["status" => "error", "message" => $error_message]);
    exit();
}
?>
