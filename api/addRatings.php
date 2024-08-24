<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// get database info to connect
require_once '../api/dbinfo.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve and sanitize the input values
    $userID = $_SESSION['userID'];
    $happiness = isset($_POST['happiness']) ? (int)$_POST['happiness'] : null;
    $workload = isset($_POST['workload']) ? (int)$_POST['workload'] : null;
    $anxiety = isset($_POST['anxiety']) ? (int)$_POST['anxiety'] : null;

    // If the form has blanks
    if ($happiness === null || $workload === null || $anxiety === null) {
        echo json_encode(['status' => 'error', 'message' => 'All ratings must be filled out']);
        exit();
    }

    // Connect to the database
    $conn = new mysqli($host, $DBusername, $DBpassword, $database);

    // Check the connection // returns error if fails
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
        exit();
    }

    // Check if there is already a rating for the user for today
    $stmt = $conn->prepare("SELECT * FROM user_daily_scores WHERE user_id = ? AND DATE(score_date) = CURDATE();");
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a record for today exists, update the scores
        $stmt = $conn->prepare("UPDATE user_daily_scores SET happiness = ?, workload_management = ?, anxiety_management = ?, score_date = CURDATE() WHERE user_id = ? AND score_date = CURDATE();");
        $stmt->bind_param('iiii', $happiness, $workload, $anxiety, $userID);
    } else {
        // If no record for today exists, insert a new one
        $stmt = $conn->prepare("INSERT INTO user_daily_scores (user_id, happiness, workload_management, anxiety_management, score_date) VALUES (?, ?, ?, ?, CURDATE());");
        $stmt->bind_param('iiii', $userID, $happiness, $workload, $anxiety);
    }

    // Execute the query (either update or insert)
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Ratings added/updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add/update ratings']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}
?>
