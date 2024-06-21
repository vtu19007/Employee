<?php
$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'employee_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Employee deleted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: index.php');
?>
