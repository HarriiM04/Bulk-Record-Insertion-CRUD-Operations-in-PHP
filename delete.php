<?php
include 'dbcon.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = $conn->prepare("DELETE FROM organization WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();

    echo "Record deleted successfully.";
} else {
    echo "Invalid request.";
}
