<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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

    if ($image) {
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', gender='$gender', image='$image' WHERE id=$id";
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email', gender='$gender' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: index.php');
}
?>
