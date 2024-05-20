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
    <main class="md:grid grid-cols-3 w-full bg-white gap-4 md:max-w-[1040px]">
      <section
        class="bg-[#E8EEFA] col-span-1 py-8 md:pr-8 text-[#093697] md:pl-12 flex flex-col md:inline-block items-center"
      >
        <div class="mb-16">
          <img src="./images/BU_logo.jpg" alt="logo" class="w-24" />
        </div>

        <div class="flex gap-2 my-8 text-black">
          <img src="./images/image-5.png" alt="avatar" />
          <p class="flex flex-col text-base font-medium">
          <?php echo $StudentName ?>
            <span class="font-normal text-sm"><?php echo $MatricNo ?></span>
          </p>
        </div>

        <div>
          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 pl-2 text-xl font-medium profile"
          >
            <img src="./images/user.png" alt="" />
            <p>Profile</p>
          </div>
          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 pl-2 text-xl font-medium allergy"
          >
            <img src="./images/touchscreen.png" alt="" />
            <p>Allergy Selection</p>
          </div>
          <div
            class="flex cursor-pointer mb-4 gap-2 py-2 pl-2 text-xl font-medium ticket"
          >
            <img src="./images/ticket.png" alt="" />
            <p>Ticket</p>
          </div>
        </div>

        <button
          class="flex my-6 mt-20 gap-2 text-[#AF8B0F] bg-white w-fit py-3 px-4 rounded-lg text-xl font-medium logout"
        >
          <img src="./images/fi-logout.png" alt="" />
          <p>Logout</p>
        </button>
      </section>

      <section class="welcome-section p-10 col-span-2">
        <h1 class="text-4xl font-bold mb-4">
          Welcome, <span><?php echo $StudentName ?>!</span>
        </h1>
        <div class="bg-[#AF8B0F] h-[300px] p-4 rounded-xl text-white text-xl">
          <p>Notice board</p>
        </div>
      </section>

      <section
        class="profile-section hidden col-span-2 p-10 flex flex-col justify-center"
      >
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Matric No.</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
            php stuff
          </p>
        </div>
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Allergies</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
            php stuff
          </p>
        </div>
        <div class="mb-4">
          <p class="text-xl font-medium mb-3">Digital Ticket No.</p>
          <p
            class="text-lg border-2 border-[#093697] rounded-xl bg-[#E8EEFA] py-3 px-4"
          >
            php stuff
          </p>
        </div>
      </section>

      <section
        class="allergy-section hidden p-16 col-span-2 flex flex-col justify-center"
      >
        <form method="POST" class="">
          <div class="flex flex-col mb-4">
            <label for="item" class="text-[1.49rem] font-semibold mb-2"
              >Item</label
            >
            <select
              id="item"
              class="text-lg rounded-2xl border-2 border-[#093697] bg-[#E8EEFA] py-3 px-4"
            >
              <option value="" disabled selected>Select</option>
              <option value="">Milk</option>
              <option value="">Egg</option>
              <option value="">Peanut</option>
              <option value="">Wheat</option>
            </select>
          </div>
          <div class="flex flex-col mb-4">
            <label for="item" class="text-[1.49rem] font-semibold mb-2"
              >Foods</label
            >
            <select
              id="item"
              class="text-lg rounded-2xl border-2 border-[#093697] bg-[#E8EEFA] py-3 px-4"
            >
              <option value="" disabled selected>Select</option>
              <option value="">Rice and Gbadun</option>
              <option value="">Potato and Eggsauce</option>
              <option value="">Moi Moi</option>
              <option value="">Egusi soup</option>
            </select>
          </div>
          <button
            type="submit"
            class="bg-[#AF8B0F] text-white mt-4 px-5 py-3 text-xl rounded-2xl hover:bg-[#AF8E2A]"
          >
            Update Selection
          </button>
        </form>
      </section>

      <section
        class="ticket-section hidden col-span-2 flex flex-col justify-center items-center w-full"
      >
        <div></div>
        <button
          class="bg-[#AF8B0F] mb-3 text-white mt-4 px-5 py-3 text-xl rounded-2xl hover:bg-[#AF8E2A]"
        >
          Digital Ticket No.
        </button>
        <div class="grid grid-cols-2 gap-2">
          <button
            class="bg-[#093697] text-white px-3 py-2 rounded-xl flex items-center gap-2 text-lg"
          >
            <img src="./images/fi-download.png" alt="download" />Download
          </button>
          <button
            class="bg-[#093697] text-white px-3 py-2 rounded-xl flex items-center gap-2 text-lg"
          >
            <img src="./images/group.png" alt="download" />Print
          </button>
        </div>
      </section>
    </main>
    <script src="./js/dash.js"></script>
</body>

</html>