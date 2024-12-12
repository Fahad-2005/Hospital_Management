<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_id = $_POST['department_id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    try {
        // Check if the email or phone already exists
        $check_duplicate = $conn->prepare("SELECT * FROM doctor WHERE email = ? OR phone_number = ?");
        $check_duplicate->execute([$email, $phone]);
        $duplicate = $check_duplicate->fetch();

        if ($duplicate) {
            throw new Exception("A doctor with the same email or phone number already exists.");
        }

        // Insert new doctor if no duplicates
        $sql = "INSERT INTO doctor (department_id, name, specialization, phone_number, email) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$department_id, $name, $specialization, $phone, $email]);

        echo "<script>alert('Doctor Added successfully!');</script>";
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

