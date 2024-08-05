<?php
session_start();
include('templates/header.php');
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 Most Downloaded Music</title>
    <style>
        body {
    font-family: Arial, sans-serif;
}

header {
    background-color: #333;
    color: white;
    padding: 15px 0;
    text-align: center;
}

nav ul {
    list-style-type: none;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}


        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #e9e9e9;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            color: #555;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Our Top 10 Most Downloaded Music</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Title</th>
                        <th>Artist Name</th>
                        <!-- <th>Number of Downloads</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM music ORDER BY downloads DESC LIMIT 10";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $position = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$position}</td>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td>{$row['artist']}</td>";
                            // echo "<td>{$row['downloads']}</td>";
                            echo "</tr>";
                            $position++;
                        }
                    } else {
                        echo "<tr><td colspan='4' class='no-data'>No music found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
</body>
</html>
