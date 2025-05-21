<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="number"], input[type="date"], textarea {
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
        <a href="sales.php" class="back-arrow"><button>←</button></a><?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current sale details
    $sql = "SELECT * FROM Sales WHERE SaleID = $id";
    $result = $conn->query($sql);
    $sale = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prescription_id = $_POST['prescription_id'];
        $sale_date = $_POST['sale_date'];
        $quantity_sold = $_POST['quantity_sold'];
        $total_price = $_POST['total_price'];

        // Update sale details
        $update_sql = "UPDATE Sales 
                       SET Prescription_ID = '$prescription_id', SaleDate = '$sale_date', 
                           QuantitySold = '$quantity_sold', TotalPrice = '$total_price' 
                       WHERE SaleID = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Sale updated successfully.";
            header('Location: sales.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No sale ID provided.";
}

?>

<form method="POST" action="">
            <label for="prescription_id">Prescription ID: </label>
            <input type="number" name="prescription_id" id="prescription_id" required>
    
            <label for="sale_date">Sale Date: </label>
            <input type="date" name="sale_date" id="sale_date"required>

            <label for="quantity_sold">Quantity Sold: </label>
            <input type="number" name="quantity_sold" id="quantity_sold" required>

            <label for="total_price">Total Price: </label>
            <input type="number" name="total_price" id="total_price"required>
    
            <button type="submit" class="submit-btn">Update</button>

</form>
    </div>
    </body>
    </html>