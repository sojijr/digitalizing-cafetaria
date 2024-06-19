<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['login'])) {
    $MatricNo = $_POST['MatricNo'];
    $Password = md5($_POST['Password']);

        $sql= "SELECT * FROM studentdetails WHERE StudentMatricNo = '$MatricNo' && Password = '$Password'";
        $result =$conn->query($sql);

        $user_matched = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($user_matched > 0) {
            $_SESSION['loginUser'] = $row['StudentMatricNo'];
            header("location: dashboard");
        } else {
            echo "<script>alert('Invalid details')</script>";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link href="https://fonts.cdnfonts.com/css/satoshi?styles=135009,135005,135007,135002,135000" rel="stylesheet">
                
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
  </head>

  <body
    class="bg-[#f2f2f2] font-[Satoshi] min-h-screen max-w-screen flex justify-center items-center"
  >
    <main class="md:grid grid-cols-2 w-full bg-white gap-4 md:max-w-[900px]">
      <section
        class="bg-[#093697] py-8 md:pr-10 text-[#FEFEFE] md:pl-20 flex flex-col md:inline-block items-center"
      >
        <div class="mb-16 mt-5">
          <img src="./images/BU_logo.jpg" alt="logo" class="w-20" />
        </div>
        <h1 class="text-[56px] font-bold leading-tight mb-3">
          Digitalizing <br />Cafeteria
        </h1>
        <p class="text-[#fefefe80] font-light text-lg">Making food better...</p>
      </section>

      <section
        class="bg-white flex flex-col justify-center items-center md:items-start p-12"
      >
        <h2 class="text-[50px] font-bold">Login</h2>
        <p class="font-medium mb-5 mt-2 text-lg">Enter your details</p>

        <form action="" method="POST" class="mt-1 md:mt-8 mb-10">
          <div class="flex flex-col mb-4">
            <label for="MatricNo" class="text-lg font-medium mb-2"
              >Matric No.</label
            >
            <div class="border-2 rounded-2xl px-9 p-3 border-[#093697] bg-blue-100">
              <input
                class="outline-none border-none h-full w-full text-xl placeholder:font-light bg-blue-100"
                type="text"
                name="MatricNo"
                placeholder="Enter your Matric No."
                required
              />
            </div>
          </div>
          <div class="flex flex-col">
            <label for="password" class="text-lg font-medium mb-2"
              >Password</label
            >
            <div
              class="border-2 rounded-2xl px-9 p-3 border-[#093697] bg-blue-100 flex items-center"
            >
              <input
                class="outline-none border-none h-full bg-blue-100 w-full text-xl placeholder:font-light"
                type="password"
                id="password"
                name="Password"
                placeholder="Enter your Password"
                required
              />
              <i id="password-toggle" class="far fa-eye"></i>
            </div>
          </div>
          <button type="submit"
            name="login"
            class="bg-[#AF8B0F] text-white mt-8 px-5 py-2 text-xl rounded-2xl hover:bg-[#AF8E2A]"
          >
            Login
          </button>
        </form>
      </section>
    </main>
    <script>
      if (window.location.search.includes('logout=true')) {
            localStorage.clear();
            window.history.replaceState(null, null, window.location.pathname);
        }
      </script>
    <script src="./js/script.js"></script>
  </body>
</html>