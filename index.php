<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Database Management</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <h1>Database Management</h1>

    <button class="btn" id="toggleFormBtn">Insert New Record</button>

    <!-- Record InsertionForm -->
    <div id="formContainer" class="form-container hidden">

        <h2>Insert New Record</h2>

        <form action="insert.php" method="post" id="insertForm">

            <label for="Organization_Id">Organization Id:</label>
                <input type="text" id="Organization_Id" name="Organization_Id" required><br>

            <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" required><br>

            <label for="Country">Country:</label>
                <input type="text" id="Country" name="Country" required><br>

            <label for="Founded">Founded:</label>
                <input type="text" id="Founded" name="Founded" required><br>

            <label for="Industry">Industry:</label>
                <input type="text" id="Industry" name="Industry" required><br>

            <label for="Number_of_employees">Number of Employees:</label>
                <input type="text" id="Number_of_employees" name="Number_of_employees" required><br>

            <input type="submit" value="Insert Record">

        </form>

    </div>

    <!-- Bulk Insertion -->
    <div class="bulk-insert-container">
   
        <h2>Bulk Insert from CSV</h2>
        
        <form id="bulkInsertForm" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required><br>
            <input type="submit" value="Upload CSV">
        </form>

    </div>

    <!-- View Records -->
    <h2>View Records</h2>
    <div id="recordsTable">
        <?php
       
        include 'dbcon.php';

        // Fetch and display all records
        $result = $conn->query("SELECT * FROM organization ORDER BY id ASC");

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
        ?>
    </div>

   
</body>

</html>