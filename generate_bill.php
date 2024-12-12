<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Generate Bill</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Generate Bill</h2>
        <form action="generate_bills.php" method="POST">
            <!-- Appointment Dropdown -->
            <div class="mb-3">
                <label for="appointment_id" class="form-label">Select Appointment</label>
                <select class="form-select" id="appointment_id" name="appointment_id" required>
                    <option value="">Select Appointment</option>
                    <?php
                    include 'db.php';
                    $stmt = $conn->query("SELECT appointment_id, appointment_date FROM appointment");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . $row['appointment_id'] . "'>Appointment on " . $row['appointment_date'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Bill Amount -->
            <div class="mb-3">
    <label for="total_amount" class="form-label">Total Amount</label>
    <input type="number" class="form-control" id="total_amount" name="total_amount" step="0.01" required>
</div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Generate Bill</button>
        </form>
    </div>
</body>
</html>
