# Bulk Record Insertion & CRUD Operations in PHP

This PHP project allows users to upload a CSV file to insert bulk records into the `organization` table. Additionally, it provides manual CRUD (Create, Read, Update, Delete) operations.

## Features

- Bulk record insertion using a CSV file
- Displays inserted records in a table format
- Inline editing and updating of records
- Record deletion functionality
- Batch processing for efficient bulk insertion
- Secure MySQL queries using prepared statements

## Technologies Used

- PHP
- MySQL
- HTML
- JavaScript (AJAX & jQuery)
- Bootstrap (optional for styling)

## Prerequisites

Before running the project, ensure you have:

- A web server (e.g., XAMPP, WAMP, LAMP, or MAMP)
- MySQL database
- PHP installed and configured

## Installation & Setup

### 1. Database Setup

Create a MySQL database and table using the following SQL script:

```sql
CREATE DATABASE my_database;
USE my_database;

CREATE TABLE organization (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Organization_Id VARCHAR(255) NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Country VARCHAR(255) NOT NULL,
    Founded YEAR NOT NULL,
    Industry VARCHAR(255) NOT NULL,
    Number_of_employees INT NOT NULL
);
```

### 2. Configure Database Connection

Update `dbcon.php` with your database credentials:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 3. Upload & Insert CSV Data

- Upload a CSV file with the following format:
  ```csv
  Organization_Id,Name,Country,Founded,Industry,Number_of_employees
  101,TechCorp,USA,2001,Technology,5000
  102,HealthPlus,UK,1998,Healthcare,1200
  ```
- The PHP script reads the file and inserts data into the `organization` table.

### 4. Manual CRUD Operations

- **Read:** Displays all records in an HTML table.
- **Update:** Click on editable fields, modify, and update the database using AJAX.
- **Delete:** Remove records using the delete button.

## Usage

1. Open the project folder in your web server.
2. Navigate to the main file (e.g., `index.php`) via browser.
3. Upload a CSV file and view the inserted records.
4. Use the inline editing feature to update records.
5. Click delete to remove a record from the database.

## Troubleshooting

- Ensure the database is set up correctly.
- Check file permissions if CSV uploads fail.
- Enable `display_errors` in PHP for debugging issues.

## License

This project is open-source and available for personal and educational use.
