<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the alert message and department ID from the form
    $alert_message = $_POST['alert_message'];
    $department_id = $_POST['department_id'];

    try {
        // Fetch the department name
        $stmt = $conn->prepare("SELECT name FROM departments WHERE department_id = ?");
        $stmt->execute([$department_id]);
        $department = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$department) {
            echo "<script>alert('Error: No department found with the selected ID.');</script>";
        } else {
            $department_name = $department['name'];

            // Update the alert in the departments table
            $update_stmt = $conn->prepare("UPDATE departments SET alert = ? WHERE department_id = ?");
            $update_stmt->execute([$alert_message, $department_id]);

            // Success message
            echo "<script>alert('Emergency alert sent successfully to the " . $department_name . " department!');</script>";
            header("Location: departments.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
