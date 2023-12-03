<?php
error_reporting(0);
include('include/dbConnect.php');
session_start();

if (empty($_SESSION['loginUser'])) {
    header("location: login");
    exit();
}

$sql = "SELECT * FROM `studentdetails` WHERE StudentMatricNo = '".$_SESSION['loginUser']."'";
$result = $conn->query($sql);

if ($result) {
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $digitalTicketNo = $row['DigitalTicketNo'];
    }
}

$apiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=';

// Concatenate the ticket number with the API URL
$fullApiUrl = $apiUrl . urlencode($digitalTicketNo);

$imageData = file_get_contents($fullApiUrl);

header('Content-Type: image/png');

echo $imageData;
