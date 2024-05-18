<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $v_id = $_POST["v_id"];
    $skills = $_POST["skills"];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ngo"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO volunteer (name, email, phone, v_id, skills) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiis", $name, $email, $phone, $id, $skills);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you for submitting your application!";
        echo "<br><br><br>";
        echo "<a href='indexu.html' target='_blank'>Click here to go to Index Page</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
