<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard - SoundBeyond</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center; /* Center items vertically */
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .upload-button {
            background-color: #1e88e5; /* Blue color */
            color: white;
        }

        .upload-button:hover {
            background-color: #1976d2; /* Darker shade of blue on hover */
        }

        .dashboard-button {
            background-color: #1e88e5; /* Blue color */
            color: white;
        }

        .dashboard-button:hover {
            background-color: #1976d2; /* Darker shade of blue on hover */
        }

        .logout-button {
            background-color: #4CAF50; /* Green color */
            color: white;
        }

        .logout-button:hover {
            background-color: #45a049; /* Darker shade of green on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>SoundBeyond</h1>
        <nav>
            <ul>
                <li><a href="admin.php" class="dashboard-button"><i class="fa-solid fa-dashboard"></i></a></li>
                <li><a href="upload.php" class="upload-button"><i class="fa-solid fa-upload"></i></a></li>
                <li><a href="logout.php" class="logout-button"><i class="fa-solid fa-right-to-bracket"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Your main content here -->
    </main>
</body>
</html>
