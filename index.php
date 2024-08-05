<?php include('templates/header.php'); ?>
<?php include('db.php'); ?>

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
    width: 90%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

form {
    text-align: center;
    margin-bottom: 20px;
}

form input[type="text"] {
    padding: 10px;
    width: 60%;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #333;
    color: white;
    cursor: pointer;
}

form button:hover {
    background-color: #45a049;
}

.music-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.music-item {
    flex: 1 1 calc(20% - 20px);
    margin: 10px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    text-align: center;
    background-color: #fff;
}

.music-item img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 10px;
}

.music-item h3 {
    margin: 10px 0;
}

.music-item p {
    color: #555;
}

.music-item audio {
    width: 100%;
    margin: 10px 0;
}

.music-item a {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    cursor: pointer;
}

.music-item a:hover {
    background-color: #45a049;
}

.error {
    color: red;
}

@media (max-width: 1200px) {
    .music-item {
        flex: 1 1 calc(25% - 20px);
    }
}

@media (max-width: 992px) {
    .music-item {
        flex: 1 1 calc(33.33% - 20px);
    }
}

@media (max-width: 768px) {
    .music-item {
        flex: 1 1 calc(50% - 20px);
    }
}

@media (max-width: 576px) {
    .music-item {
        flex: 1 1 100%;
    }
}
</style>
<head>
<link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
</head>
<div class="container">
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search by title or artist">
        <button type="submit"><i class="fa-solid fa-magnifying-glass" style="color:white"></i></button>
    </form>

    <div class="music-list">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM music WHERE title LIKE '%$search%' OR artist LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='music-item'>";
                echo "<img src='assets/uploads/{$row['poster']}' alt='{$row['title']}' />";
                echo "<h3>{$row['title']}</h3>";
                echo "<p><b>Artist:</b> {$row['artist']}</p>";
                // echo "<audio controls>
                //         <source src='assets/uploads/{$row['filename']}' type='audio/mpeg'>
                //         Your browser does not support the audio element.
                //       </audio>";
                echo "<a href='download.php?file={$row['filename']}'><i class='fa-solid fa-download'></i> Download</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No music found.</p>";
        }
        ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>
