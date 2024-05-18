<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Donation List</h1>

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

    // Fetch data from the "donation" table joined with "registration" table
    $sql = "SELECT donation.name, donation.email, donation.amount, donation.currency, donation.social_sector, donation.donation_type, donation.message
            FROM donation";
    $result = $conn->query($sql);
    ?>

    <table>
        <tr>
            
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Social Sector</th>
            <th>Donation Type</th>
            <th>Message</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["amount"]."</td>";
                echo "<td>".$row["currency"]."</td>";
                echo "<td>".$row["social_sector"]."</td>";
                echo "<td>".$row["donation_type"]."</td>";
                echo "<td>".$row["message"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No donations found</td></tr>";
        }
        ?>
    </table>
    <a href="adminindex.html">Go Back</a>

    <?php
    // Close the connection
    $conn->close();
    ?>
</body>
</html>
