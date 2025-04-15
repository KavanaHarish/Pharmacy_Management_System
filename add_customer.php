<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customers (Name, Address, PhoneNumber, Email) 
            VALUES ('$name', '$address', '$phone', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "Customer added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Add Customer</h2>
<form method="post" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Address:</label><br>
    <input type="text" name="address" required><br><br>

    <label>Phone Number:</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <input type="submit" value="Add Customer">
</form>