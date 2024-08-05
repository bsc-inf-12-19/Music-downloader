<?php
include('db.php');

$sql = "SELECT title, artist, downloads FROM music ORDER BY downloads DESC LIMIT 10";
$result = $conn->query($sql);

$titles = [];
$artists = [];
$downloads = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titles[] = $row['title'];
        $artists[] = $row['artist'];  // Add artist to the response
        $downloads[] = (int)$row['downloads'];  // Ensure downloads are integers
    }
}

header('Content-Type: application/json');
echo json_encode(['titles' => $titles, 'artists' => $artists, 'downloads' => $downloads]);
?>
