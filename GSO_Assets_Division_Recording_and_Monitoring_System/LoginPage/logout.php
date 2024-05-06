<?php
require('./../database/connection.php');

session_start();

date_default_timezone_set('Asia/Manila');
$date_now = date('Y-m-d');
$time_now = date('H:i:s');
$logout_action = 'Logout';
$employeeid = $_SESSION['employeeID'];
$user['firstName'] = $_SESSION['firstName'];

$query = "INSERT INTO activity_log (employeeid, firstname, date_log, time_log, action) values (?, ?, ?, ?, ?)";
$stmt = $connect->prepare($query);
$stmt->bind_param('issss', $employeeid, $_SESSION['firstName'], $date_now, $time_now, $logout_action);
$stmt->execute();

// Function to display modal with redirect
function displayModalWithRedirect($message, $redirectPage) {
    echo '<div id="myModal" class="modal-background">
            <div class="modal-content">
                <div class="modal-message">' . $message . '</div>
                <button class="ok-button" onclick="redirectToPage(\'' . $redirectPage . '\')">OK</button>
            </div>
          </div>';
}

// JavaScript function to redirect to a page
echo '<script type="text/javascript">
    function redirectToPage(page) {
        window.location.href = page;
    }
</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link  href="../dist/img/baguiologo.png" rel="icon">
    <link rel="apple-touch-icon" href="img/baguiologo.png">
    <style>
        /* Style the modal background */
        .modal-background {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
          z-index: 1;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        /* Style the modal content for both modals */
         .modal-content {
           background-color: #ffffff; /* White background */
           color: black;
           padding: 20px;
           border-radius: 5px;
           text-align: center;
           z-index: 2;
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
         }

        /* Style the OK button */
        .ok-button {
          background-color: #0074E4; /* Blue background color for OK button */
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          margin-top: 10px; /* Add margin to separate the message and the button */
        }
    </style>
</head>
<body>
    <?php
    // Call the function to display modal with redirect
    displayModalWithRedirect("You have Logged Out", "login.php");
    ?>
</body>
</html>