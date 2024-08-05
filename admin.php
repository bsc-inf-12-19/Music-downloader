<?php
session_start();
include('admin_header.php');
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Get the base URL of the website
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/";
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
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .search-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .search-container input {
        padding: 10px;
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
        background-color: #e9e9e9;
    }

    .actions a,
    .actions button {
        margin-right: 10px;
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
    }

    .actions .edit {
        background-color: #4CAF50;
    }

    .actions .delete {
        background-color: #f44336;
    }

    .actions .copy {
        background-color: #2196F3;
    }

    .actions .edit:hover {
        background-color: #45a049;
    }

    .actions .delete:hover {
        background-color: #e53935;
    }

    .actions .copy:hover {
        background-color: #1e88e5;
    }
</style>

<div class="container">
    <h2>Admin Dashboard: Uploaded Music</h2>

    <div class="search-container">
        <form method="GET" action="admin.php">
            <input type="text" name="search" placeholder="Search by title or artist">
        </form>
    </div>

    <button style="margin-bottom: 20px; padding: 5px 15px; background-color: #333; color: white; border-radius: 5px; cursor: pointer;"><a style="color:white; text-decoration:none" href="upload.php"> Upload New Music</a></button>

    <button style="margin-bottom: 20px; padding: 5px 15px; background-color: #333; color: white; border-radius: 5px; cursor: pointer;"><a style="color:white; text-decoration:none" href="top_downloads.php">View Top 10 Downloads</a></button>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM music WHERE title LIKE '%$search%' OR artist LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $downloadLink = $base_url . 'download.php?file=' . $row['filename'];
                        echo "<tr>";
                        echo "<td><img src='assets/uploads/{$row['poster']}' alt='{$row['title']}' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['artist']}</td>";
                        echo "<td class='actions'>";
                        echo "<a href='edit.php?id={$row['id']}' class='edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>";
                        echo "<a href='delete.php?id={$row['id']}' class='delete' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i> Delete</a>";
                        echo "<button onclick=\"copyLink('$downloadLink')\" class='copy'><i class='fa-solid fa-link'></i> Copy Link</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No music found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this music?");
    }

    function copyLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            alert('Link copied to clipboard');
        }, (err) => {
            alert('Failed to copy link');
        });
    }
</script>

<?php include('templates/footer.php'); ?>
