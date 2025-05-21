<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="text"], input[type="number"], input[type="date"], textarea {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .error-message {
            color: #d9534f;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }
        .success-message {
            color: #5cb85c;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body class="form-page">
    <div class="container">
        <a href="medicines.php" class="back-arrow"><button>←</button></a>
        <h2>Update Medicine</h2>
        <?php
            include('db.php');

            if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];

    // Fetch current medicine details
    $sql = "SELECT * FROM medicines WHERE MedicineID = $id";
    $result = $conn->query($sql);
    $medicines = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['NAME']);
        $manufacturer = trim($_POST['Manufacturer']);
        $expiry_date = $_POST['ExpiryDate'];
        $stock_quantity = (int)$_POST['StockQuantity'];
        $unit_price = (float)$_POST['UnitPrice'];
        $dosage = trim($_POST['Dosage']);
        $description = trim($_POST['Description']);

        // Update Medicine details
        $update_sql = "UPDATE medicines SET Name = '$name', Manufacturer = '$manufacturer', ExpiryDate = '$expiry_date', StockQuantity = $stock_quantity, UnitPrice = $unit_price, Dosage = '$dosage', Description = '$description' WHERE MedicineID = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<div class='success-message'>Medicine updated successfully.</div>";
            header('Location: medicines.php');
            exit();
        } else {
            echo "<div class='error-message'>Error updating record: " . $conn->error . "</div>";
        }
    }
} else {
    echo "<div class='error-message'>No medicine ID provided.</div>";
    exit();
}
?>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" name="NAME" id="name" value="<?= htmlspecialchars($medicines['NAME']) ?>" required>

            <label for="manufacturer">Manufacturer:</label>
            <input type="text" name="Manufacturer" id="manufacturer" value="<?= htmlspecialchars($medicines['Manufacturer']) ?>">

            <label for="expiry_date">Expiry Date:</label>
            <input type="date" name="ExpiryDate" id="expiry_date" value="<?= $medicines['ExpiryDate'] ?>">

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" name="StockQuantity" id="stock_quantity" value="<?= $medicines['StockQuantity'] ?>">

            <label for="unit_price">Unit Price:</label>
            <input type="number" step="0.01" name="UnitPrice" id="unit_price" value="<?= $medicines['UnitPrice'] ?>">

            <label for="dosage">Dosage:</label>
            <input type="text" name="Dosage" id="dosage" value="<?= htmlspecialchars($medicines['Dosage']) ?>">

            <label for="description">Description:</label>
            <textarea name="Description" id="description" rows="3"><?= htmlspecialchars($medicines['Description']) ?></textarea>

            <button type="submit" class="submit-btn">Update Medicine</button>
        </form>
    </div>
</body>
</html>
