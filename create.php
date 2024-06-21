<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'employee_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO employees (first_name, last_name, email, gender, image) VALUES ('$first_name', '$last_name', '$email', '$gender', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Employee added successfully.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: index.php');
}
?>
