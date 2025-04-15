<?php
include 'db_connect.php';

$sql = "SELECT * FROM customers";
$result = mysqli_query($conn, $sql);
?>

<h2>Customer Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['CustomerID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['PhoneNumber'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No customers found.</td></tr>";
    }
    ?>
</table>