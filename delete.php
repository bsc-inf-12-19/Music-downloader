<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM music WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
