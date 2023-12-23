<?php
error_reporting(0);
include('include/dbConnect.php');
session_start();
if (empty($_SESSION['loginUser'])) {
    header("location: index");
    exit();
}

$sql = "SELECT * FROM `studentdetails` WHERE StudentMatricNo = '".$_SESSION['loginUser']."'";

$result = $conn->query($sql);
if($result) {
    $rows= mysqli_num_rows($result);
    if($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $MatricNo = $row['StudentMatricNo'];
        $StudentName = $row['StudentName'];
        $DigitalTicketNo = $row['DigitalTicketNo'];
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
  <link rel="stylesheet" href="css/ticket-style.css">
  <title>Ticket</title>
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
              <img class="img" src="images/user.png" />
              <div class="text-wrapper-3"><a href="profile">Profile</a></div>
            </div>
            <div class="frame-6">
              <img class="img" src="images/touchscreen.png" />
              <div class="text-wrapper-3"><a href="allergie">Allergie Selection</a></div>
            </div>
            <div class="frame-7">
              <img class="ticket" src="images/ticket-w.png" />
              <div class="text-wrapper-4"><a href="ticket">Ticket</a></div>
            </div>
          </div>
        </div>
        <div class="frame-8">
          <div class="div-wrapper">
            <div class="frame-login">
              <img class="img" src="images/fi-logout.png" />
              <div class="text-wrapper-5"><a href="logout">Logout</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="overlap-barcode">
        <img id="myImage" class="overlap" src="displayQR" />
        <div class="overlap-2">
          <div class="text-wrapper-6">Digital ticket no.:
            <?php echo $DigitalTicketNo ?>
          </div>
        </div>
        <button class="overlap-3" id="downloadBtn" onclick="downloadImage()">
          <span class="text-wrapper-7"><img class="img" src="images/fi-download.png" />Download</span>
        </button>
        <button onclick="printDiv()" class="overlap-4"><span class="text-wrapper-6"><img class="group"
              src="images/group.png" />Print</span></button>
      </div>
    </div>
  </div>

  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="js/download.js"></script>
</body>

</html>