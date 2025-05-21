<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .search-container {
            margin: 30px 0;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 25px;
            border-radius: 10px;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .search-container input[type=text] {
            padding: 12px 15px;
            width: 70%;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .search-container button {
           padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 15px;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
        .search-options {
            margin: 10px 0;
        }
        .search-options label {
            color: white;
            font-size: 16px;
            margin-right: 15px;
            font-weight: bold;
        }
        .search-results {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
        }
        .search-results h3 {
            margin-top: 0;
            color: green;
        }
        .result-group {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ddd;
        }
        .result-section {
            margin-top: 15px;
        }
        .result-section h4 {
            margin-bottom: 10px;
            color: #4CAF50;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .result-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .no-results {
            color: white;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Pharma Buddy</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="?page=medicines">Medicines</a> |
        <a href="?page=customers">Customers</a> |
        <a href="?page=prescriptions">Prescriptions</a> |
        <a href="?page=sales">Sales</a>
    </nav>
    <hr>

    <div class="search-container">
        <form method="GET" action="index.php">
            <input type="text" name="search_query" placeholder="Search by customer name or medicine name..." 
                value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
            
            <div class="search-options">
                <input type="radio" id="search_customer" name="search_type" value="customer" <?php echo (isset($_GET['search_type']) && $_GET['search_type'] == 'customer') ? 'checked' : ''; ?>>
                <label for="search_customer">Customer Name</label>
                
                <input type="radio" id="search_medicine" name="search_type" value="medicine" <?php echo (isset($_GET['search_type']) && $_GET['search_type'] == 'medicine') ? 'checked' : ''; ?>>
                <label for="search_medicine">Medicine Name</label>
                
            </div>
            
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <div class="container">
        <?php
        include('db.php');

        if (isset($_GET['search']) && isset($_GET['search_query']) && !empty($_GET['search_query'])) {
            $search_query = $conn->real_escape_string($_GET['search_query']);
            $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'customer';
            
            echo "<div class='search-results'>";
            echo "<h3>Search Results for: " . htmlspecialchars($_GET['search_query']) . "</h3>";
            
            $found_results = false;
            
            // Search customers
            if ($search_type == 'customer') {
                // Find matching customers
                $sql = "SELECT * FROM customer WHERE Name LIKE '%$search_query%'";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    // For each matching customer, show all related data
                    while ($customer = $result->fetch_assoc()) {
                        $found_results = true;
                        $customer_id = $customer['CustomerID'];
                        
                        echo "<div class='result-group'>";
                        echo "<h4>Customer: " . $customer['Name'] . " (ID: " . $customer_id . ")</h4>";
                        
                        // Customer details
                        echo "<div class='result-section'>";
                        echo "<strong>Address:</strong> " . $customer['Address'] . "<br>";
                        echo "<strong>Phone:</strong> " . $customer['PhoneNumber'] . "<br>";
                        echo "<strong>Email:</strong> " . $customer['Email'] . "<br>";
                        echo "<a href='?page=customers&action=view&id=" . $customer_id . "'>View Customer Details</a> | ";
                        echo "<a href='?page=customers&action=edit&id=" . $customer_id . "'>Edit Customer</a>";
                        echo "</div>";
                        
                        // Find prescriptions for this customer
                        $sql_prescriptions = "SELECT p.*, m.NAME as medicine_name 
                                             FROM prescription p 
                                             LEFT JOIN medicines m ON p.Medicine_ID = m.MedicineID
                                             WHERE p.Customer_ID = $customer_id 
                                             ORDER BY p.PrescriptionDate DESC";
                        
                        $prescriptions = $conn->query($sql_prescriptions);
                        
                        echo "<div class='result-section'>";
                        echo "<h4>Prescriptions</h4>";
                        
                        if ($prescriptions && $prescriptions->num_rows > 0) {
                            while ($prescription = $prescriptions->fetch_assoc()) {
                                echo "<div class='result-item'>";
                                echo "<strong>ID:</strong> " . $prescription['PrescriptionID'] . " | ";
                                echo "<strong>Date:</strong> " . $prescription['PrescriptionDate'] . " | ";
                                echo "<strong>Medicine:</strong> " . $prescription['medicine_name'] . " | ";
                                echo "<strong>Dosage:</strong> " . $prescription['Dosage'] . " | ";
                                echo "<strong>Duration:</strong> " . $prescription['Duration'];
                                echo "<br><a href='?page=prescriptions&action=view&id=" . $prescription['PrescriptionID'] . "'>View Prescription Details</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='no-results'>No prescriptions found for this customer.</p>";
                        }
                        echo "</div>";
                        
                        // Find sales for this customer's prescriptions
                        $sql_sales = "SELECT s.*, p.PrescriptionID, m.NAME as medicine_name 
                                     FROM sales s 
                                     JOIN prescription p ON s.Prescription_ID = p.PrescriptionID 
                                     JOIN medicines m ON p.Medicine_ID = m.MedicineID
                                     WHERE p.Customer_ID = $customer_id 
                                     ORDER BY s.SaleDate DESC";
                        
                        $sales = $conn->query($sql_sales);
                        
                        echo "<div class='result-section'>";
                        echo "<h4>Sales History</h4>";
                        
                        if ($sales && $sales->num_rows > 0) {
                            while ($sale = $sales->fetch_assoc()) {
                                echo "<div class='result-item'>";
                                echo "<strong>Sale ID:</strong> " . $sale['SaleID'] . " | ";
                                echo "<strong>Date:</strong> " . $sale['SaleDate'] . " | ";
                                echo "<strong>Medicine:</strong> " . $sale['medicine_name'] . " | ";
                                echo "<strong>Quantity:</strong> " . $sale['QuantitySold'] . " | ";
                                echo "<strong>Total:</strong> $" . $sale['TotalPrice'];
                                echo "<br><a href='?page=sales&action=view&id=" . $sale['SaleID'] . "'>View Sale Details</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='no-results'>No sales history found for this customer.</p>";
                        }
                        echo "</div>";
                        
                        echo "</div>"; // End result-group
                    }
                }
            }
            
            // Search medicines
            if ($search_type == 'medicine') {
                // Find matching medicines
                $sql = "SELECT * FROM medicines WHERE NAME LIKE '%$search_query%'";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    // For each matching medicine, show all related data
                    while ($medicine = $result->fetch_assoc()) {
                        $found_results = true;
                        $medicine_id = $medicine['MedicineID'];
                        
                        echo "<div class='result-group'>";
                        echo "<h4>Medicine: " . $medicine['NAME'] . " (ID: " . $medicine_id . ")</h4>";
                        
                        // Medicine details
                        echo "<div class='result-section'>";
                        echo "<strong>Manufacturer:</strong> " . $medicine['Manufacturer'] . "<br>";
                        echo "<strong>Expiry Date:</strong> " . $medicine['ExpiryDate'] . "<br>";
                        echo "<strong>In Stock:</strong> " . $medicine['StockQuantity'] . " units<br>";
                        echo "<strong>Unit Price:</strong> $" . $medicine['UnitPrice'] . "<br>";
                        echo "<strong>Dosage:</strong> " . $medicine['Dosage'] . "<br>";
                        echo "<strong>Description:</strong> " . $medicine['Description'] . "<br>";
                        echo "<a href='?page=medicines&action=view&id=" . $medicine_id . "'>View Medicine Details</a> | ";
                        echo "<a href='?page=medicines&action=edit&id=" . $medicine_id . "'>Edit Medicine</a>";
                        echo "</div>";
                        
                        // Find prescriptions for this medicine
                        $sql_prescriptions = "SELECT p.*, c.Name as customer_name 
                                             FROM prescription p 
                                             LEFT JOIN customer c ON p.Customer_ID = c.CustomerID
                                             WHERE p.Medicine_ID = $medicine_id 
                                             ORDER BY p.PrescriptionDate DESC";
                        
                        $prescriptions = $conn->query($sql_prescriptions);
                        
                        echo "<div class='result-section'>";
                        echo "<h4>Prescribed To</h4>";
                        
                        if ($prescriptions && $prescriptions->num_rows > 0) {
                            while ($prescription = $prescriptions->fetch_assoc()) {
                                echo "<div class='result-item'>";
                                echo "<strong>Customer:</strong> " . $prescription['customer_name'] . " | ";
                                echo "<strong>Prescription ID:</strong> " . $prescription['PrescriptionID'] . " | ";
                                echo "<strong>Date:</strong> " . $prescription['PrescriptionDate'] . " | ";
                                echo "<strong>Dosage:</strong> " . $prescription['Dosage'] . " | ";
                                echo "<strong>Duration:</strong> " . $prescription['Duration'];
                                echo "<br><a href='?page=prescriptions&action=view&id=" . $prescription['PrescriptionID'] . "'>View Prescription Details</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='no-results'>No prescriptions found for this medicine.</p>";
                        }
                        echo "</div>";
                        
                        // Find sales for this medicine
                        $sql_sales = "SELECT s.*, c.Name as customer_name 
                                     FROM sales s 
                                     JOIN prescription p ON s.Prescription_ID = p.PrescriptionID 
                                     JOIN customer c ON p.Customer_ID = c.CustomerID
                                     WHERE p.Medicine_ID = $medicine_id 
                                     ORDER BY s.SaleDate DESC";
                        
                        $sales = $conn->query($sql_sales);
                        
                        echo "<div class='result-section'>";
                        echo "<h4>Sales History</h4>";
                        
                        if ($sales && $sales->num_rows > 0) {
                            while ($sale = $sales->fetch_assoc()) {
                                echo "<div class='result-item'>";
                                echo "<strong>Sale ID:</strong> " . $sale['SaleID'] . " | ";
                                echo "<strong>Customer:</strong> " . $sale['customer_name'] . " | ";
                                echo "<strong>Date:</strong> " . $sale['SaleDate'] . " | ";
                                echo "<strong>Quantity:</strong> " . $sale['QuantitySold'] . " | ";
                                echo "<strong>Total:</strong> $" . $sale['TotalPrice'];
                                echo "<br><a href='?page=sales&action=view&id=" . $sale['SaleID'] . "'>View Sale Details</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='no-results'>No sales history found for this medicine.</p>";
                        }
                        echo "</div>";
                        
                        echo "</div>"; // End result-group
                    }
                }
            }
            
            // If no results found
            if (!$found_results) {
                echo "<p class='no-results'>No results found for your search query. Please try a different customer or medicine name.</p>";
            }
            
            echo "</div>"; // End search-results
        }
        
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'medicines':
                    include('medicines.php');
                    break;
                case 'customers':
                    include('customers.php');
                    break;
                case 'prescriptions':
                    include('prescriptions.php');
                    break;
                case 'sales':
                    include('sales.php');
                    break;
                default:
                    echo "<p>Welcome to the Pharma Buddy. Select an option from the menu above to manage your pharmacy records.</p>";
            }
        } else {
            echo "<p>Welcome to the Pharma Buddy. Select an option from the menu above to manage your pharmacy records.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>