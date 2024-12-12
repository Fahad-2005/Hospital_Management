<?php
include 'db.php';

// Handle dynamic doctor fetching
if (isset($_GET['action']) && $_GET['action'] === 'get_doctors' && isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    $stmt = $conn->prepare("SELECT doctor_id, name FROM doctor WHERE department_id = ?");
    $stmt->execute([$department_id]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($doctors as $doctor) {
        echo "<option value='" . $doctor['doctor_id'] . "'>" . $doctor['name'] . "</option>";
    }
    exit;
}

// Handle form submission for appointment scheduling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date']; // Assuming the appointment date-time is passed

    try {
        // Check if an appointment already exists for the doctor at the same date and time
        $stmt = $conn->prepare("SELECT COUNT(*) FROM appointment WHERE doctor_id = ? AND appointment_date = ?");
        $stmt->execute([$doctor_id, $appointment_date]);
        $existing_appointment = $stmt->fetchColumn();

        if ($existing_appointment > 0) {
            // Appointment already exists, show error message
            echo "<script>alert('Error: This doctor already has an appointment at this time.');</script>";
        } else {
            // No appointment conflict, insert new appointment
            $sql = "INSERT INTO appointment (doctor_id, patient_id, appointment_date) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$doctor_id, $patient_id, $appointment_date]);

            echo "<script>alert('Appointment scheduled successfully!');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
