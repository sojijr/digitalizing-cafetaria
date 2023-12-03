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
        $MatricNo = $row['StudentMatricNo'];
        $StudentName = $row['StudentName'];
        $studentID = $row['StudentID'];
        $DigitalTicketNo = $row['DigitalTicketNo'];

        $sqlAllergy = "SELECT a.AllergieName FROM `studentallergies` sa
                       INNER JOIN `allergies` a ON sa.AllergieID = a.AllergieID
                       WHERE sa.StudentID = '$studentID'";
        $resultAllergy = $conn->query($sqlAllergy);

        $allergieNames = array();
        while ($allergyRow = mysqli_fetch_assoc($resultAllergy)) {
            $allergieNames[] = $allergyRow['AllergieName'];
        }
    }
}

if (empty($StudentName)) {
    $StudentName = "User";
}

if (empty($MatricNo)) {
    $MatricNo = $_SESSION['loginUser'];
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/satoshiFontStyle.css">
  <link rel="stylesheet" href="css/profile-style.css">
  <title>Profile</title>
</head>

<body>
  <div class="desktop">
    <div class="div">
      <div class="overlap-group">
        <div class="frame"><img class="babcocklogo" src="images/BU_logo.jpg" /></div>
        <div class="frame-wrapper">
          <div class="frame-2">
            <div class="frame-3">
              <img class="image" src="images/image-5.png" />
              <div class="frame-4">
                <div class="text-wrapper"><?php echo $StudentName ?>
                </div>
                <div class="text-wrapper-2"><?php echo $MatricNo ?>
                </div>
              </div>
            </div>
            <div class="frame-5">
              <img class="img" src="images/user-w.png" />
              <div class="text-wrapper-3">Profile</div>
            </div>
            <div class="frame-6">
              <img class="img" src="images/touchscreen.png" />
              <div class="text-wrapper-4"><a href="allergie">Allergie Selection</div>
            </div>
            <div class="frame-tick">
              <img class="img" src="images/ticket.png" />
              <div class="text-wrapper-4"><a href="ticket">Ticket</a></div>
            </div>
          </div>
        </div>
        <div class="frame-7">
          <div class="div-wrapper">
            <div class="frame-login">
              <img class="img" src="images/fi-logout.png" />
              <div class="text-wrapper-5"><a href="logout">Logout</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="frame-8">
        <div class="frame-9">
          <div class="text-wrapper-6">Matric No.</div>
          <div class="frame-10">
            <div class="text-wrapper-7"><?php echo $MatricNo ?></div>
          </div>
        </div>
        <div class="frame-9">
          <div class="text-wrapper-6">Allergies</div>
          <div class="frame-10">
            <div class="text-wrapper-7">
              <?php echo empty($allergieNames) ? "No Allergies" : implode(", ", $allergieNames); ?>
            </div>
          </div>
        </div>
        <div class="frame-9">
          <div class="text-wrapper-6">Digital ticket no.</div>
          <div class="frame-10">
            <div class="text-wrapper-7">
              <?php echo $DigitalTicketNo ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>