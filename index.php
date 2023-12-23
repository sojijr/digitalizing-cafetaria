<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['login'])) {
    $MatricNo = $_POST['MatricNo'];
    $Password = md5($_POST['Password']);

    $sql= "SELECT * FROM studentdetails WHERE StudentMatricNo = '$MatricNo'";
    $result =$conn->query($sql);

    $user_matched = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($user_matched > 0) {

        $sql= "SELECT * FROM studentdetails WHERE StudentMatricNo = '$MatricNo' && Password = '$Password'";
        $result =$conn->query($sql);

        $user_matched = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($user_matched > 0) {
            $_SESSION['loginUser'] = $row['StudentMatricNo'];
            header("location: dashboard");
        } else {
            echo "<script>alert('Invalid Details!')</script>";
        }
    } else {
        $_SESSION['loginUser'] = $MatricNo;
        header("location: dashboard");
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/satoshiFontStyle.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="main-container">
        <div class="box">
            <div class="box1">
                <div class="logo">
                    <img src="images/BU_logo.jpg" alt="Logo">
                </div>
                <div class="digitalizing">Digitalizing<br>Cafeteria</div>
                <div class="tagline">Making food better...</div>
            </div>
            <div class="login-container">
                <form class="form-section" method="POST">
                    <div class="other1">
                        <p class="title">Login</p>
                        <p class="subtitle">Enter your details</p>
                    </div>
                    <div class="form-input-section">
                        <div class="input-section">
                            <label for="matricNo" class="input-label">Matric No.</label>
                            <div class="input-box">
                                <input type="text" name="MatricNo" placeholder="Enter your Matric No." required>
                            </div>
                        </div>
                        <div class="input-section">
                            <label for="password" class="input-label">Password</label>
                            <div class="input-box">
                                <input type="password" id="Password" name="Password" placeholder="Enter your Password"
                                    required>
                                <i id="password-toggle" class="far fa-eye"></i>
                            </div>
                        </div>
                        <button name="login" class="login-button">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>