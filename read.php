<?php
$conn = new mysqli('localhost', 'root', '', 'employee_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['first_name'] . "</td>
                <td>" . $row['last_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td><img src='uploads/" . $row['image'] . "' width='100'></td>
                <td>
                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No employees found</td></tr>";
}

$conn->close();
?>
