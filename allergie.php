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
if($result) {
    $rows= mysqli_num_rows($result);
    if($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $MatricNo = $row['StudentMatricNo'];
        $StudentName = $row['StudentName'];
        $studentID = $row['StudentID'];
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
  <link rel="stylesheet" href="css/allergie-style.css">
  <title>Allergie Selection</title>
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
            <div class="div-wrapper">
              <div class="frame-6">
                <img class="img" src="images/touchscreen-w.png" />
                <div class="text-wrapper-4"><a href="allergie">Allergie Selection</a></div>
              </div>
            </div>
            <div class="frame-tick">
              <img class="ticket" src="images/ticket.png" />
              <div class="text-wrapper-3"><a href="ticket">Ticket</a></div>
            </div>
          </div>
        </div>
        <div class="frame-7">
          <div class="frame-8">
            <div class="frame-login">
              <img class="img" src="images/fi-logout.png" />
              <div class="text-wrapper-5"><a href="logout">Logout</a></div>
            </div>
          </div>
        </div>
      </div>
      <form method="POST">
        <div class="frame-9">
          <div class="frame-10">
            <div class="text-wrapper-6">Item</div>
            <select class="frame-12" name="allergie-items">
              <option value="" disabled selected>Select item</option>
              <option value="11">Milk</option>
              <option value="12">Egg</option>
              <option value="13">Peanut</option>
              <option value="14">Wheat</option>
            </select>
          </div>
          <div class="frame-10">
            <div class="text-wrapper-6">Foods</div>
            <select class="frame-12" name="allergie-foods">
              <option value="" disabled selected>Select food</option>
              <option value="21">Rice and Gbadun</option>
              <option value="22">Potato and Eggsauce</option>
              <option value="23">Moi Moi</option>
              <option value="24">Egusi soup</option>
            </select>
          </div>
          <button name="submit" class="button">Update selection</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>

<?php
include('include/dbConnect.php');

if(isset($_POST['submit'])) {
    $allergieItems = filter_input(INPUT_POST, 'allergie-items');
    $allergieFoods = filter_input(INPUT_POST, 'allergie-foods');

    $DigitalTicketNo = $MatricNo .$allergieFoods. $allergieItems;

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
    } else {
        if (!empty($allergieItems)) {
            $sql = "INSERT INTO studentallergies (StudentID, AllergieID)
                    VALUES ('$studentID', '$allergieItems')";

            if ($conn->query($sql)) {
                echo "<script>alert('Allergies Selected!');</script>";
            } else {
                echo "<script>alert('Unsuccessful Selection for AllergieItems!');</script>";
            }
        }

        if (!empty($allergieFoods)) {
            $sql = "INSERT INTO studentallergies (StudentId, AllergieID)
                    VALUES ('$studentID', '$allergieFoods')";

            if ($conn->query($sql)) {
                echo "<script>alert('Allergies Selected!');</script>";
            } else {
                echo "<script>alert('Unsuccessful Selection for AllergieFoods!');</script>";
            }
        }
        
        $sqlTicket = "UPDATE studentdetails 
              SET DigitalTicketNo = '$DigitalTicketNo'
              WHERE StudentID = '$studentID'";

        $conn->query($sqlTicket);
    }

    $conn->close();
}
?>