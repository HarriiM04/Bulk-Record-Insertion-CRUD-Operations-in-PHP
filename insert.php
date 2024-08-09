<?php
include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $Organization_Id = $_POST['Organization_Id'];
    $Name = $_POST['Name'];
    $Country = $_POST['Country'];
    $Founded = $_POST['Founded'];
    $Industry = $_POST['Industry'];
    $Number_of_employees = $_POST['Number_of_employees'];

   
    $query = $conn->prepare("INSERT INTO organization (Organization_Id, Name, Country, Founded, Industry, Number_of_employees) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("sssssi", $Organization_Id, $Name, $Country, $Founded, $Industry, $Number_of_employees);

    // Execute the statement
    if ($query->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query->error;
    }

    // Close statement and connection
    $query->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
