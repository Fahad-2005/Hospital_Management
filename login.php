<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    try {
        // Validate user credentials
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
        $stmt->execute([$email, $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // Validate password
            // Store user session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: dashboard.html"); // Redirect to admin dashboard
                exit;
            } elseif ($role === 'doctor') {
                header("Location: dashboard_doc.html"); // Redirect to doctor dashboard
                exit;
            } else {
                header("Location: dashboard_patient.html"); // Redirect to patient dashboard
                exit;
            }
        } else {
            echo "<script>alert('Invalid email or Password!');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

