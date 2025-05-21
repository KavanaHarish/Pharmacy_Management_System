<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Prescription</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="number"], input[type="date"],, input[type="text"] textarea {
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
        <a href="prescriptions.php" class="back-arrow"><button>←</button></a>
        <?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current prescription details
    $sql = "SELECT * FROM Prescription WHERE PrescriptionID = $id";
    $result = $conn->query($sql);
    $prescription = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $_POST['Customer_ID'];
        $medicine_id = $_POST['Medicine_ID'];
        $prescription_date = $_POST['PrescriptionDate'];
        $dosage = $_POST['Dosage'];
        $duration = $_POST['Duration'];

        // Update prescription
        $update_sql = "UPDATE Prescription 
                       SET Customer_ID = '$customer_id', Medicine_ID = '$medicine_id', PrescriptionDate = '$prescription_date', 
                           Dosage = '$dosage', Duration = '$duration' 
                       WHERE PrescriptionID = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Prescription updated successfully.";
            header('Location: prescriptions.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No prescription ID provided.";
}

?>

<form method="POST" action="">
    <label for="customer_id">Customer ID:</label> 
            <input type="text" name="customer_id" id="customer_id" required>
            
            <label for="medicine_id">Medicine ID:</label>
             <input type="text" name="medicine_id" id="medicine_id" required>

            <label for="prescription_date">Prescription Date: </label>
            <input type="date" name="prescription_date" id="presription_date" required>
    
           <label for="dosage">Dosage:</label>  
           <input type="text" name="dosage" id="dosage" required>
            
           <label for="duration">Duration:</label> 
           <input type="text" name="duration" id="duration"required>
    
            <button type="submit" class="submit-btn">Update</button>
</form>
    </div>
    </body>
    </html>
