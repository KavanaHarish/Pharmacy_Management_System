<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        
        input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="email"]:focus, textarea:focus {
            border-color: #6a5acd;
            outline: none;
        }
    </style>
</head>
<body class="form-page"></body>
    <?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prescription_id = $_POST['prescription_id'];
    $sale_date = $_POST['sale_date'];
    $quantity_sold = $_POST['quantity_sold'];
    $total_price = $_POST['total_price'];

    // Insert new sale
    $sql = "INSERT INTO Sales (Prescription_ID, SaleDate, QuantitySold, TotalPrice)
            VALUES ('$prescription_id', '$sale_date', '$quantity_sold', '$total_price')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Sale added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

?>
<div class="container">
        <a href="sales.php" class="back-arrow"><button>←</button></a>
        <h2>Add Sale</h2>
        <form action="add_sale.php" method="post">

            <label for="prescription_id">Prescription ID: </label>
            <input type="number" name="prescription_id" id="prescription_id" required>
    
            <label for="sale_date">Sale Date: </label>
            <input type="date" name="sale_date" id="sale_date"required>

            <label for="quantity_sold">Quantity Sold: </label>
            <input type="number" name="quantity_sold" id="quantity_sold" required>

            <label for="total_price">Total Price: </label>
            <input type="number" name="total_price" id="total_price"required>
    
            <button type="submit" class="submit-btn">Add</button>
    </form>
</div>
</body>
</html>