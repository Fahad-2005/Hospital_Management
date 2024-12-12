<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback_message = $_POST['feedback_message'];

    try {
        // Insert feedback into the database
        $stmt = $conn->prepare("INSERT INTO feedback (feedback_message) VALUES (?)");
        $stmt->execute([$feedback_message]);

        echo "<script>alert('Feedback submitted successfully!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
