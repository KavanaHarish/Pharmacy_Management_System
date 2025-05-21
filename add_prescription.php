<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="number"], input[type="date"], input[type="text"],textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body class="form-page">
    <?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $medicine_id = $_POST['medicine_id'];
    $prescription_date = $_POST['prescription_date'];
    $dosage = $_POST['dosage'];
    $duration = $_POST['duration'];

    // Insert new prescription
    //$sql = "INSERT INTO Prescription (Customer_ID, Medicine_ID, PrescriptionDate, Dosage, Duration)
            //VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare("INSERT INTO Prescription (Customer_ID, Medicine_ID, PrescriptionDate, Dosage, Duration)
                        VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $customer_id, $medicine_id, $prescription_date, $dosage, $duration);

    //if ($conn->query($sql) === TRUE) {
      //  echo "New prescription added successfully.";
    //} else {
      //  echo "Error: " . $conn->error;
    //}

   if ($stmt->execute()) {
    echo "<p style='color:green;'>New prescription added successfully.</p>";
    } else {
    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close(); 
}

?>
<div class="container">
        <a href="prescriptions.php" class="back-arrow"><button>←</button></a>
        <h2>Add Prescription</p></h2>
        <form method="post" action="add_prescription.php">
            <label for="customer_id">Customer ID:</label> 
            <input type="number" name="customer_id" id="customer_id" required>
            
            <label for="medicine_id">Medicine ID:</label>
             <input type="number" name="medicine_id" id="medicine_id" required>

            <label for="prescription_date">Prescription Date: </label>
            <input type="date" name="prescription_date" id="presription_date" required>
    
           <label for="dosage">Dosage:</label>  
           <input type="text" name="dosage" id="dosage" required>
            
           <label for="duration">Duration:</label> 
           <input type="text" name="duration" id="duration"required>
    
            <button type="submit" class="submit-btn">Add</button>
</form>
</div>
</body>
</html>