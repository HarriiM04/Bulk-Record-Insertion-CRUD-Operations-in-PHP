<?php
include 'dbcon.php';

if (isset($_FILES['csv_file']['tmp_name'])) {
    $uploadedFile = $_FILES['csv_file']['tmp_name'];

    // Open the uploaded file
    $inputCsv = fopen($uploadedFile, 'r');
    if ($inputCsv === false) {
        echo "Error opening the uploaded CSV file.";
        exit;
    }

    // Prepare the SQL statement
    $query = $conn->prepare("INSERT INTO organization (Organization_Id, Name, Country, Founded, Industry, Number_of_employees) VALUES (?, ?, ?, ?, ?, ?)");

    // Begin transaction
    $conn->begin_transaction();

    try {
        $header = fgetcsv($inputCsv); // Skip the header row
        $batchSize = 100; // Number of records to insert per batch
        $counter = 0;

        while (($row = fgetcsv($inputCsv)) !== false) { //reads each row
            // Bind parameters
            $query->bind_param("sssssi", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
            $query->execute();
            $counter++; //records count

            if ($counter % $batchSize == 0) {
                // Commit the current batch
                $conn->commit();
                // Start a new transaction for the next batch
                $conn->begin_transaction();
            }
        }

        // Commit any remaining records
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error inserting records: " . $e->getMessage();
    }

    fclose($inputCsv);

    // Fetch and display all records
    $result = $conn->query("SELECT * FROM organization");

    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Organization Id</th><th>Name</th><th>Country</th><th>Founded</th><th>Industry</th><th>Number of Employees</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . htmlspecialchars($row['id']) . "'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td class='editable' data-field='Organization_Id'>" . htmlspecialchars($row['Organization_Id']) . "</td>";
        echo "<td class='editable' data-field='Name'>" . htmlspecialchars($row['Name']) . "</td>";
        echo "<td class='editable' data-field='Country'>" . htmlspecialchars($row['Country']) . "</td>";
        echo "<td class='editable' data-field='Founded'>" . htmlspecialchars($row['Founded']) . "</td>";
        echo "<td class='editable' data-field='Industry'>" . htmlspecialchars($row['Industry']) . "</td>";
        echo "<td class='editable' data-field='Number_of_employees'>" . htmlspecialchars($row['Number_of_employees']) . "</td>";
        echo "<td>
                <button class='edit-btn'>Update</button> |
                <button class='delete-btn'>Delete</button>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Error: No file uploaded.";
}
?>
