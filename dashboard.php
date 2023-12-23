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
  <link rel="stylesheet" href="css/satoshiFontStyle.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="desktop">
    <div class="div">
      <div class="overlap">
        <div class="frame"><img class="babcocklogo" src="images/BU_logo.jpg" /></div>
        <div class="frame-wrapper">
          <div class="frame-2">
            <div class="frame-3">
              <img class="image" src="images/image-5.png" />
              <div class="frame-4">
                <div class="text-wrapper"><?php echo $StudentName ?>
                </div>
                <div class="text-wrapper-2">
                  <?php echo $MatricNo ?>
                </div>
              </div>
            </div>
            <div class="frame-5">
              <img class="img" src="images/user.png" />
              <div class="text-wrapper-3"><a href="profile">Profile </a></div>
            </div>
            <div class="frame-6">
              <img class="img" src="images/touchscreen.png" />
              <div class="text-wrapper-3"><a href="allergie">Allergie Selection</a></div>
            </div>
            <div class="frame-6">
              <img class="ticket" src="images/ticket.png" />
              <div class="text-wrapper-3"><a href="ticket">Ticket</a></div>
            </div>
          </div>
        </div>
        <div class="frame-7">
          <div class="div-wrapper">
            <div class="frame-login">
              <img class="img" src="images/fi-logout.png" />
              <div class="text-wrapper-4"><a href="logout">Logout</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="home-section">
        <div class="frame-8">
          <div class="text-wrapper-5">Welcome,
            <?php echo $StudentName ?>!
          </div>
        </div>
        <div class="overlap-group">
          <div class="text-wrapper-6">Notice board</div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>