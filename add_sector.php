<?php
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ngo";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $sector_id = $_POST['sector_id'];
    $sector_name = $_POST['sector_name'];

    // Prepare the SQL statement
    $sql = "INSERT INTO social_sector (sector_id, sector_name) VALUES (?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("ss", $sector_id, $sector_name);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Sector added successfully.";
        // After successful sector addition
        header("Location: donate.html?sector_id=$sector_id&sector_name=$sector_name");

    } else {
        echo "Error adding sector: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

?>
