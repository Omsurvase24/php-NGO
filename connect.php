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
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $password = $_POST['password'];

    // Prepare a query to check if the email already exists
    $checkEmailQuery = "SELECT email FROM registration WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the email already exists
    if ($stmt->num_rows > 0) {
        echo "Email already exists. Please choose a different email.";
    } else {
        // Prepare the SQL statement to insert data
        $insertQuery = "INSERT INTO registration (username, gender, phone, country, email, type, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssss", $username, $gender, $phone, $country, $email, $type, $password);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<html>
    <head>
        <title>Redirecting using Anchor Tags</title>
      </head>
    <body> 
     <a href="login.html">
         Click Here to Login
    </a>
    </body>
</html>
