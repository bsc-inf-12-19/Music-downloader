<?php
session_start();

if (isset($_POST['confirm'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or home page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Logout - MP3 Downloader</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #555;
        }

        .confirm-buttons {
            display: flex;
            justify-content: center;
        }

        .confirm-buttons button {
            margin: 0 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .confirm-buttons button:hover {
            background-color: #f2f2f2;
        }

        .confirm-buttons button.yes {
            background-color: #4CAF50;
            color: white;
        }

        .confirm-buttons button.no {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Logout Confirmation</h2>
        <p>Are you sure you want to logout?</p>
        <div class="confirm-buttons">
            <form method="POST" action="logout.php">
                <button type="submit" name="confirm" class="yes">Yes, Logout</button>
            </form>
            <button onclick="goBack()" class="no">No, Cancel</button>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
