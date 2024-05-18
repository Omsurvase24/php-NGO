<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            margin-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter User ID</h2>

        <form method="GET">
            <div class="form-group">
                <label for="user_id">ID:</label>
                <input type="text" id="user_id" name="id" required>
            </div>
            <input type="submit" value="Get Details">
        </form>

        <?php
        if (isset($_GET['id'])) {
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

            $id = $_GET['id'];
            

            // Prepare the SQL statement to retrieve user, donation, and volunteer details
            $sql = "SELECT registration.username, registration.email, registration.phone, registration.country, donation.amount, donation.currency, volunteer.phone, volunteer.skills
                    FROM registration 
                    LEFT JOIN donation ON registration.id = donation.id
                    LEFT JOIN volunteer ON registration.id = volunteer.v_id
                    WHERE registration.id = $id";

            // Execute the query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display user details in a table
                echo "<h2>User Details</h2>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Country</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['country'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Display donation details
                echo "<h2>Donation Details</h2>";
                echo "<table>";
                echo "<tr><th>Amount</th><th>Currency</th></tr>";

                // Reset the result pointer to retrieve donation details
                $result->data_seek(0);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['currency'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Display volunteer details
                echo "<h2>Volunteer Details</h2>";
                echo "<table>";
                echo "<tr><th>Contact</th><th>Skills</th></tr>";

                // Reset the result pointer to retrieve volunteer details
                $result->data_seek(0);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['skills'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "<a href='account.html' target='_blank'>Go Back</a>"; 
            } else {
                echo "No records found for the given ID.";
            }

            // Close the connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

