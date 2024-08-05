<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    // Increment likes in the database
    $sql = "UPDATE music SET likes = likes + 1 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Get the updated like count
        $sql = "SELECT likes FROM music WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $likes = $row['likes'];

        // Return JSON response with updated like count
        $response = array('success' => true, 'likes' => $likes);
        echo json_encode($response);
    } else {
        // Return JSON response on failure
        $response = array('success' => false);
        echo json_encode($response);
    }
}
?>
