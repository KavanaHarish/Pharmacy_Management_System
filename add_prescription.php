<?php
include 'db_connect.php';

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $medicine_id = $_POST['medicine_id'];
    $dosage = $_POST['dosage'];
    $instructions = $_POST['instructions'];

    $sql = "INSERT INTO prescriptions (CustomerID, MedicineID, Dosage, Instructions)
            VALUES ('$customer_id', '$medicine_id', '$dosage', '$instructions')";

    if (mysqli_query($conn, $sql)) {
        echo "Prescription added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch customers and medicines for dropdowns
$customers = mysqli_query($conn, "SELECT CustomerID, Name FROM customers");
$medicines = mysqli_query($conn, "SELECT MedicineID, Name FROM medicines");
?>

<h2>Add Prescription</h2>

<form method="post">
    <label>Customer:</label><br>
    <select name="customer_id" required>
        <option value="">--Select Customer--</option>
        <?php while ($row = mysqli_fetch_assoc($customers)) { ?>
            <option value="<?= $row['CustomerID'] ?>"><?= $row['Name'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Medicine:</label><br>
    <select name="medicine_id" required>
        <option value="">--Select Medicine--</option>
        <?php while ($row = mysqli_fetch_assoc($medicines)) { ?>
            <option value="<?= $row['MedicineID'] ?>"><?= $row['Name'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Dosage:</label><br>
    <input type="text" name="dosage" required><br><br>

    <label>Instructions:</label><br>
    <input type="text" name="instructions"><br><br>

    <input type="submit" value="Add Prescription">
</form>