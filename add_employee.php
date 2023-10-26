<?php
// Include the database connection configuration
include('dbinfo.inc');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];

    // Create a connection to the database
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert a new employee into the database
    $sql = "INSERT INTO employees (name, position) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $position);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: samplepage.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Your HTML and CSS ... -->
</head>
<body>
    <header>
        <!-- ... Your Header ... -->
    </header>
    <div class="container">
        <h2>Add Employee</h2>
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required><br>

            <input type="submit" class="btn" value="Add Employee">
        </form>
    </div>
</body>
</html>
