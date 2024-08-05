<?php
session_start();
include('admin_header.php');
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $filename = $_FILES['filename']['name'];
    $poster = $_FILES['poster']['name'];

    $sql = "UPDATE music SET title='$title', artist='$artist'";

    if ($filename) {
        move_uploaded_file($_FILES['filename']['tmp_name'], "assets/uploads/$filename");
        $sql .= ", filename='$filename'";
    }

    if ($poster) {
        move_uploaded_file($_FILES['poster']['tmp_name'], "assets/uploads/$poster");
        $sql .= ", poster='$poster'";
    }

    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error updating music.";
    }
} else {
    $sql = "SELECT * FROM music WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    <form method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <h2><i class='fa-solid fa-pen-to-square'></i> Edit Music</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title" value="<?php echo $row['title']; ?>" required>

        <label for="artist">Artist</label>
        <input type="text" id="artist" name="artist" placeholder="Artist" value="<?php echo $row['artist']; ?>" required>

        <label for="filename">Music File (.mp3)</label>
        <input type="file" id="filename" name="filename" accept=".mp3">

        <label for="poster">Poster Image</label>
        <input type="file" id="poster" name="poster" accept="image/*">

        <button type="submit">Update</button>
    </form>
</div>

<?php include('templates/footer.php'); ?>
