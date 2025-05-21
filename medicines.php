<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines - Pharmacy Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <a href="index.php" class="back-arrow"><button>←</button></a>
        <h2>Medicines List</h2>
        <a href="add_medicine.php" class="add-button">Add Medicine</a>
        <table class="medicines-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Manufacturer</th>
                    <th>Expiry Date</th>
                    <th>Stock Quantity</th>
                    <th>Unit Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <?php
        include('db.php');
                
                // Check if search is being performed
                if (isset($_GET['search']) && isset($_GET['search_query']) && !empty($_GET['search_query'])) {
                    $search_query = $conn->real_escape_string($_GET['search_query']);
                    $sql = "SELECT * FROM Medicines WHERE NAME LIKE '%$search_query%' OR Manufacturer LIKE '%$search_query%'";
                } else {
                    $sql = "SELECT * FROM Medicines";
                }
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['NAME']}</td>
                                <td>{$row['Manufacturer']}</td>
                                <td>{$row['ExpiryDate']}</td>
                                <td>{$row['StockQuantity']}</td>
                                <td>\${$row['UnitPrice']}</td>
                                <td class='actions'>
                                    <a href='update_medicine.php?id={$row['MedicineID']}' class='edit-btn'>Update</a>
                                    <a href='delete_medicine.php?id={$row['MedicineID']}' class='delete-btn'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-records'>No medicines found</td></tr>";
                }
                
                ?>
            </tbody>
    </table>

</body>
</html>