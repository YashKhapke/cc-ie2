<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        /* ... Your existing CSS styles ... */
    </style>
</head>
<body>
    <header>
        <h1>Employee Management System</h1>
    </header>
    <div class="container">
        <h2>Employee List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
            <?php
            // Include the database connection configuration
            include('dbinfo.inc');
            
            // Create a connection to the database
            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            
            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Fetch and display employee records from the database
            $sql = "SELECT * FROM employees";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["position"] . "</td>";
                    echo "<td>
                            <a href='edit_employee.php?id=" . $row["id"] . "' class='btn'>Edit</a>
                            <a href='delete_employee.php?id=" . $row["id"] . "' class='btn'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employees found.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <a href="add_employee.php" class="btn" style="margin-top: 1rem;">Add Employee</a>
    </div>
</body>
</html>
