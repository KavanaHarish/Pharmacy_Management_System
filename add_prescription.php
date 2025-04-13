<?php
include 'db.php';

// Fetch customers and medicines
$customers = $conn->query("SELECT CustomerID, Name FROM customers");
$medicines = $conn->query("SELECT MedicineID, Name FROM medicines");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Prescription</title>
</head>
<body>
    <h2>Add New Prescription</h2>
    <form method="POST">
        Customer:
        <select name="customer_id" required>
            <option value="">Select</option>
            <?php while ($row = $customers->fetch_assoc()): ?>
                <option value="<?= $row['CustomerID'] ?>"><?= $row['Name'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        Medicine:
        <select name="medicine_id" required>
            <option value="">Select</option>
            <?php while ($row = $medicines->fetch_assoc()): ?>
                <option value="<?= $row['MedicineID'] ?>"><?= $row['Name'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        Prescription Date: <input type="date" name="prescription_date" required><br><br>
        Dosage: <input type="text" name="dosage" required><br><br>
        Duration: <input type="text" name="duration" required><br><br>

        <input type="submit" name="submit" value="Add Prescription">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $customer_id = $_POST['customer_id'];
        $medicine_id = $_POST['medicine_id'];
        $prescription_date = $_POST['prescription_date'];
        $dosage = $_POST['dosage'];
        $duration = $_POST['duration'];

        $sql = "INSERT INTO prescriptions (CustomerID, MedicineID, PrescriptionDate, Dosage, Duration)
                VALUES ('$customer_id', '$medicine_id', '$prescription_date', '$dosage', '$duration')";

        if ($conn->query($sql) === TRUE) {
            echo "Prescription added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>