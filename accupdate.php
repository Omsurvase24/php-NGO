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

// Initialize variables
$phone = $country = "";
$updateMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];

    // Prepare the SQL statement
    $sql = "UPDATE registration SET phone = ?, country = ? WHERE id = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("ssi", $phone, $country, $id);

    // Execute the statement
    if ($stmt->execute()) {
        $updateMessage = "Phone or Country updated successfully.";
    } else {
        $updateMessage = "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Registration</title>
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
            margin-top: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        .cont1{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Registration</h2>
        <?php if ($updateMessage): ?>
        <p><?php echo $updateMessage; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="id">User ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" >
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $country; ?>" >
            </div>
            <div class="btn-container">
                <input type="submit" value="Update" class="btn">
            </div>
        </form>
    </div>
    <div class="cont1">
    <a href="account.html">Go Back</a> 
        </div>
</body>
</html>

