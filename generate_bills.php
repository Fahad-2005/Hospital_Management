<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $amount = $_POST['total_amount']; // Assume the amount is passed from the form

    try {
        // Step 1: Check if a bill already exists for the given appointment
        $stmt = $conn->prepare("SELECT COUNT(*) FROM bill WHERE appointment_id = ?");
        $stmt->execute([$appointment_id]);
        $existing_bill = $stmt->fetchColumn();

        if ($existing_bill > 0) {
            // Step 2: If a bill exists, show an alert and exit
            echo "<script>alert('Error: A bill has already been generated for this appointment.');</script>";
        } else {
            // Step 3: Insert a new bill for the appointment
            $stmt = $conn->prepare("INSERT INTO bill (appointment_id, total_amount) VALUES (?, ?)");
            $stmt->execute([$appointment_id, $amount]);

            // Step 4: Show success message
            echo "<script>alert('Bill generated successfully!');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
