<?php
include 'dbcon.php';

if (isset($_POST['id']) && isset($_POST['fields'])) {
    $id = $_POST['id'];
    $fields = $_POST['fields'];

    
    $Query = []; // store query like-> UPDATE organization SET Name = ?, Country = ?, Founded = ? WHERE id = ?
    $types = ''; // store type 
    $values = []; // store actual values

    foreach ($fields as $field => $value) {
        $Query[] = "$field = ?";
        $types .= 's';
        $values[] = $value;
    }
    $Query = implode(', ', $Query); // it will convert an array to string
    $types .= 'i'; // for id type integer
    $values[] = $id; // it will add id of the selected row

  
    $query = $conn->prepare("UPDATE organization SET $Query WHERE id = ?");
    $query->bind_param($types, ...$values);
    if ($query->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record.";
    }
} else {
    echo "Invalid request.";
}
?>
