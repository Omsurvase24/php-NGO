<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn-container {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }
        .container1{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Account</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="btn-container">
                <input type="submit" value="Delete Account" class="btn">
            </div>
        </form>
    </div> 
    <a href="account.html">Go Back</a> 
</body>
</html>
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
    // Retrieve the account ID to be deleted
    $username = $_POST["username"];

    // Prepare the SQL statement
    $sql = "DELETE FROM registration WHERE username = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter to the statement
    $stmt->bind_param("s",$username);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Account deleted successfully.";
    } else {
        echo "Error deleting account: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>