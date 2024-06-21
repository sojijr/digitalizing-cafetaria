<?php
error_reporting(0);
include('dbConnect.php');
session_start();
if (empty($_SESSION['loginUser'])) {
    header("location: ../");
    exit();
}

$sql = "SELECT * FROM `studentdetails` WHERE StudentMatricNo = '".$_SESSION['loginUser']."'";

$result = $conn->query($sql);
if($result) {
    $rows= mysqli_num_rows($result);
    if($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $studentID = $row['StudentID'];
        $DigitalTicketNo = $row['DigitalTicketNo'];
    }
}

if(isset($_POST['allergie-submit'])) {
    $allergieItems = filter_input(INPUT_POST, 'allergie-items');
    $allergieFoods = filter_input(INPUT_POST, 'allergie-foods');

    $DigitalTicketNo = $DigitalTicketNo .$allergieFoods. $allergieItems;

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
    } else {
        if (!empty($allergieItems)) {
            $sql = "INSERT INTO studentallergies (StudentID, AllergieID)
                    VALUES ('$studentID', '$allergieItems')";

            $success = $conn->query($sql);
            if(!$success) {
                echo "<script>alert('Error');</script>";
            }
        }

        if (!empty($allergieFoods)) {
            $sql = "INSERT INTO studentallergies (StudentId, AllergieID)
                    VALUES ('$studentID', '$allergieFoods')";

            $success = $conn->query($sql);
            if(!$success) {
                echo "<script>alert('Error');</script>";
            }
        }
        
        $sqlTicket = "UPDATE studentdetails 
              SET DigitalTicketNo = '$DigitalTicketNo'
              WHERE StudentID = '$studentID'";

        if($conn->query($sqlTicket)){
            echo "<script>alert('Allergies Selected!');";
            echo "window.location.href='../dashboard.php';</script>";
        } else {
            echo "<script>alert('Unsuccessful Selection!');</script>";
        }
    }

    $conn->close();
}
?>