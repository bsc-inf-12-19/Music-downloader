<?php
include('db.php');

$file = $_GET['file'];

// Fetch the record
$sql = "SELECT * FROM music WHERE filename=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $file);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filepath = 'assets/uploads/' . $row['filename'];

    if (file_exists($filepath)) {
        // Increment download count
        $updateSql = "UPDATE music SET downloads = downloads + 1 WHERE filename=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $file);
        $updateStmt->execute();

        // Serve the file for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Record not found.";
}
?>
