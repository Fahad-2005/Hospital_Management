<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username=$_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    try {
        // If the role is admin, check if there is already an admin
        if ($role === 'admin') {
            // Check if there is already an admin in the database
            $stmt = $conn->query("SELECT COUNT(*) AS admin_count FROM users WHERE role = 'admin'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // If an admin already exists, prevent creating another admin
            if ($result['admin_count'] > 0) {
                // die("Error: Only one admin is allowed."); 
                echo "<script>alert('Error: Only one admin is allowed');</script>";
            }
        }

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (email,username, password, role) VALUES (?, ?,?, ?)");
        $stmt->execute([$email,$username, $password, $role]);

        echo "<script>alert('User registered successfully!');</script>";
        // Redirect to login or dashboard page
        header("login.php"); // Redirect to login page after registration
        exit;

    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
