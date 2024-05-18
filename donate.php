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

// Initialize a variable to store the prompt message
$promptMessage = "";

// Check if the donation form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    $social_sector = $_POST['social_sector'];
    $donation_type = $_POST['donation_type'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $sql = "INSERT INTO donation (name, email,id, amount, currency, social_sector, donation_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("ssiissss", $name, $email,$id, $amount, $currency, $social_sector, $donation_type, $message);

    // Execute the statement
    if ($stmt->execute()) {
        $promptMessage = "Donation successful. Thank you for your contribution.";
    } else {
        $promptMessage = "Error saving donation: " . $stmt->error;
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
    <title>Donation Page</title>
    <style>
        btn{
            text-align: center;
            padding: auto;
            height: 10%;
            position: relative;
            border-radius: 5px;
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <h1>Donation initiated successfully</h1>
    <br><br>
    <div class="btn">
    <a href="indexu.html">
        <button>Continue</button>
    </a>
    </div>
    <?php if ($promptMessage): ?>
    <script>
        // Display prompt message using JavaScript
        alert("<?php echo $promptMessage; ?>");
    </script>
    <?php endif; ?>
</body>
</html>

