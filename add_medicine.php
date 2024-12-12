<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['medicine_name'];
    $quantity = $_POST['quantity'];

    try {
        // Insert the new medicine into the database
        $stmt = $conn->prepare("INSERT INTO medicine (medicine_name, quantity) VALUES (?, ?)");
        $stmt->execute([$medicine_name, $quantity]);

        echo "<script>alert('Medicine added successfully!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
