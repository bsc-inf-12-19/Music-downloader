<?php
session_start();
include('admin_header.php');
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $filename = $_FILES['filename']['name'];
    $poster = $_FILES['poster']['name'];

    move_uploaded_file($_FILES['filename']['tmp_name'], "assets/uploads/$filename");
    move_uploaded_file($_FILES['poster']['tmp_name'], "assets/uploads/$poster");

    $sql = "INSERT INTO music (title, artist, filename, poster) VALUES ('$title', '$artist', '$filename', '$poster')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error uploading music.";
    }
}
?>

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
    font-weight: bold;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

form input[type="text"],
form input[type="file"] {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

form button {
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

form button:hover {
    background-color: #45a049;
}

.error {
    color: red;
    font-size: 14px;
    text-align: center;
    margin-bottom: 15px;
}
</style>

<div class="container">
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <h2><i class='fa-solid fa-upload'></i> Upload Music</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title" required>

        <label for="artist">Artist</label>
        <input type="text" id="artist" name="artist" placeholder="Artist" required>

        <label for="filename">Music File (.mp3)</label>
        <input type="file" id="filename" name="filename" accept=".mp3" required>

        <label for="poster">Poster Image</label>
        <input type="file" id="poster" name="poster" accept="image/*" required>

        <button type="submit">Upload</button>
    </form>
</div>

<?php include('templates/footer.php'); ?>
