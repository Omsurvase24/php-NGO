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
    <h1>User List</h1>

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

    // Fetch data from the "registration" table
    $sql = "SELECT * FROM registration";
    $result = $conn->query($sql);
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Email</th>
            <th>Type</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["gender"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "<td>".$row["country"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["type"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found</td></tr>";
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

