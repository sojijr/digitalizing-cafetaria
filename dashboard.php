<?php
error_reporting(0);
include('include/dbConnect.php');
session_start();
if (empty($_SESSION['loginUser'])) {
    header("location: ./");
    exit();
}

$sql = "SELECT * FROM `studentdetails` WHERE StudentMatricNo = '".$_SESSION['loginUser']."'";
$result = $conn->query($sql);

if($result) {
    $rows= mysqli_num_rows($result);
    if($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $studentID = $row['StudentID'];
        $MatricNo = $row['StudentMatricNo'];
        $StudentName = $row['StudentName'];
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

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
  </head>

<body
    class="font-[Satoshi] bg-blue-100 min-h-screen max-w-screen flex justify-center items-center"
  >
    <main
      class="md:grid grid-cols-3 w-full h-full md:h-fit bg-white gap-4 md:max-w-[1000px] relative"
      >
    <section
        class="flex md:hidden justify-between items-center px-3 h-[8vh] shadow-md"
      >
        <div class="flex items-center gap-3">
          <img src="./images/logo.jpg" alt="" class="w-8" />
          <h3 class="text-lg font-medium">Digitalizing Cafeteria</h3>
        </div>
        <img src="./images/icon-menu.svg" id="menu" alt="" />
      </section>
    
      <section
        class="menubar absolute top-0 right-0 h-full p-4 pt-5 shadow-md md:shadow-none rounded-lg md:rounded-none md:static bg-[#E8EEFA] hidden col-span-1 md:py-8 md:pr-8 text-[#093697] md:pl-12 flex flex-col md:inline-block md:items-center"
      >
        <img
          src="./images/icon-menu-close.svg"
          alt="close"
          id="close"
          class="md:hidden w-8 self-end"
        />
        <div class="mb-7 hidden md:inline-block">
          <img src="./images/logo.jpg" alt="logo" class="w-24" />
        </div>

        <div class="flex gap-2 my-6 text-black ml-2 md:ml-0">
          <img
          src="./images/image-5.png"
          alt="avatar"
          class="hidden md:inline-block"
          />
          <p class="text-[21px] flex flex-col font-medium">
          <?php echo $StudentName ?>
            <span class="font-normal text-sm"><?php echo $MatricNo ?></span>
          </p>
        </div>

        <div class="mt-4">
        <div
            class="flex cursor-pointer mb-4 gap-2 py-2 px-2 text-xl font-medium dashboard"
          >
            <p><i class="fas fa-home"></i> Dashboard</p>
          </div>

          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 px-2 text-xl font-medium profile"
          >
            <p><i class="fas fa-user"></i> Profile</p>
          </div>

          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 px-2 text-xl font-medium allergy"
          >
            <p><i class="fa-solid fa-hand-pointer"></i> Allergy Selection</p>
          </div>

          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 px-2 text-xl font-medium ticket"
          >
            <p><i class="fa-solid fa-ticket"></i> Ticket</p>
          </div>
        </div>

        <a href = "include/logout.php">
        <button
          type="submit"
          class="flex mt-auto justify-self-end my-6 mt-20 gap-2 text-[#AF8B0F] bg-white w-fit py-3 px-4 rounded-lg text-xl font-medium logout"
        >
          <p><i class="fa-solid fa-right-from-bracket"></i> Logout</p>
        </button>
        </a>
      </section>

      <!-- Welcome Section -->
      <section class="welcome-section p-10 col-span-2 h-[92vh] md:h-fit" data-section="welcome">
        <h1 class="text-4xl font-bold mb-4">
          Welcome, <span><?php echo $StudentName ?>!</span>
        </h1>
        <div class="bg-[#AF8B0F] h-[300px] p-4 rounded-xl text-white text-xl">
          <p>Notice board</p>
        </div>
      </section>

      <!-- Profile Section -->
      <section
        class="profile-section hidden col-span-2 p-10 flex flex-col justify-center h-[92vh] md:h-fit" data-section="profile"
      >
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Matric No.</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
          <?php echo $MatricNo ?>
          </p>
        </div>
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Allergies</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
          <?php echo empty($allergieNames) ? "No Allergies" : implode(", ", $allergieNames); ?>
          </p>
        </div>
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Digital Ticket No.</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
          <?php echo $DigitalTicketNo ?>
          </p>
        </div>
      </section>

      <!-- Allergy Section -->
      <section
        class="allergy-section hidden p-16 col-span-2 flex flex-col justify-center h-[92vh] md:h-fit" data-section="allergie"
      >
        <form method="POST" action="include/allergie.php" class="">
          <div class="flex flex-col mb-4">
            <label for="item" class="text-[1.49rem] font-semibold mb-2"
              >Item</label
            >
            <select
            name="allergie-items"
              class="text-lg rounded-2xl border-2 border-[#093697] bg-[#E8EEFA] py-3 px-4"
            >
              <option value="" disabled selected>Select</option>
              <option value="11">Milk</option>
              <option value="12">Egg</option>
              <option value="13">Peanut</option>
              <option value="14">Wheat</option>
            </select>
          </div>
          <div class="flex flex-col mb-4">
            <label for="item" class="text-[1.49rem] font-semibold mb-2"
              >Foods</label
            >
            <select
            name="allergie-foods"
              class="text-lg rounded-2xl border-2 border-[#093697] bg-[#E8EEFA] py-3 px-4"
            >
              <option value="" disabled selected>Select</option>
              <option value="21">Rice and Gbadun</option>
              <option value="22">Potato and Eggsauce</option>
              <option value="23">Moi Moi</option>
              <option value="24">Egusi soup</option>
            </select>
          </div>
          <button
            type="submit"
            name="allergie-submit"
            class="bg-[#AF8B0F] text-white mt-4 px-5 py-3 text-xl rounded-2xl hover:bg-[#AF8E2A]"
          >
            Update Selection
          </button>
        </form>
      </section>

      <!-- Ticket Section -->
      <section
        class="ticket-section hidden col-span-2 flex flex-col justify-center items-center w-full h-[92vh] md:h-fit" data-section="ticket"
      >
        <h1 class="text-4xl font-bold mb-7"></h1>
        <div class="qrContainer">
          <img src="displayQR.php" alt="qr code" id="myImage">
          <p
            class="bg-[#AF8B0F] mb-3 text-white mt-4 px-5 py-3 text-xl rounded-2xl hover:bg-[#AF8E2A]"
          >
            Digital Ticket No.: <?php echo $DigitalTicketNo ?>
          </p>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <button id="download"
            class="bg-[#093697] text-white px-3 py-2 rounded-xl flex items-center gap-2 text-lg" onclick="downloadImage()"
          >
          <i class="fa-solid fa-download"></i> Download
          </button>
          <button
            class="bg-[#093697] text-white px-3 py-2 rounded-xl flex items-center gap-2 text-lg" onclick=""
          >
          <i class="fa-solid fa-print"></i> Print
          </button>
        </div>
      </section>
    </main>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="./js/menu.js" defer></script>
    <script src="./js/dash.js" defer></script>
    <script src="./js/download.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.history.replaceState(null, null, 'dashboard');
        });
    </script>
</body>
</html>