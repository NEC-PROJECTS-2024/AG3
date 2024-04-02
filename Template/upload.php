<?php
// Database connection details
$servername = "your_database_servername";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted and the file was uploaded without errors
    if (isset($_FILES["file-inp"]) && $_FILES["file-inp"]["error"] == 0) {
        // Get file details
        $fileName = $_FILES["file-inp"]["name"];
        $fileTmpName = $_FILES["file-inp"]["tmp_name"];

        // Read file contents
        $fileContent = file_get_contents($fileTmpName);

        // Insert data into the database
        $sql = "INSERT INTO resumes (filename, content) VALUES ('$fileName', '$fileContent')";

        if ($conn->query($sql) === TRUE) {
            echo "File uploaded and data stored successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

// Close the database connection
$conn->close();
