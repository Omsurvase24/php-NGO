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

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to check the login credentials and role
    $userQuery = "SELECT * FROM registration WHERE email = ? AND password = ?";
    $adminQuery = "SELECT * FROM admin WHERE email = ? AND password = ?";

    // Prepare and execute the user query
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("ss", $email, $password);
    $userStmt->execute();
    $userResult = $userStmt->get_result();

    // Prepare and execute the admin query
    $adminStmt = $conn->prepare($adminQuery);
    $adminStmt->bind_param("ss", $email, $password);
    $adminStmt->execute();
    $adminResult = $adminStmt->get_result();

    // Check if the login credentials are valid for users
    if ($userResult->num_rows > 0) {
        // Redirect to the index.html page for users
        header("Location: indexu.html");
        exit();
    }

    // Check if the login credentials are valid for admins
    if ($adminResult->num_rows > 0) {
        // Redirect to the adminindex.html page for admins
        header("Location: adminindex.html");
        exit();
    }

    // Invalid login credentials
    echo "Invalid login credentials. Go back and re-enter credentials.";

    // Close the statements
    $userStmt->close();
    $adminStmt->close();
}

// Close the connection
$conn->close();
?>




