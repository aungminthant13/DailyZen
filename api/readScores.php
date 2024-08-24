<?php

session_start();
if (!isset($_SESSION['userID']))
    header("Location: ../app/login.php");

require_once '../api/dbinfo.php'; //Task 4

$userID = $_SESSION['userID'];
// Create connection
$conn = new mysqli($host, $DBusername, $DBpassword, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Prepared Statement
if ($stmt = $conn->prepare("SELECT score_date, happiness, workload_management, anxiety_management FROM user_daily_scores WHERE user_id=?")) {
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $all_rows = $result->fetch_all(MYSQLI_ASSOC);
}
$json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
echo $json_string;

/* close connection */
//$conn->close();