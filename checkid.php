<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
               body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }

        .error {
            margin-top: 20px;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Registration Form</h1>

    <?php
    $id = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the name from the form
        $name = $_POST["name"];

        // Connect to your database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ngo"; // Replace with your actual database name

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT id FROM registration WHERE username = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a row is found
        if ($result->num_rows > 0) {
            // Fetch the row data
            $row = $result->fetch_assoc();
            $id = $row["id"];
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="Submit">
    </form>

    <?php if ($id) : ?>
        <div class="result">The ID for '<?php echo $name; ?>' is: <?php echo $id; ?></div>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <div class="error">No matching name found in the registration table.</div>
    <?php endif; ?>

    <p><a href="volunteer.html">Go back to Volunteer Registration</a></p>
    <p><a href="donate.html">Go back to Donation</a></p>
    <p><a href="">Go back to Update Account</a></p>
    <p><a href="accdelete.php">Go back to Delete Account</a></p>
</body>
</html>


