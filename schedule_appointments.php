<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Schedule Appointment</title>
    <style>
        body {
            background: rgb(105, 177, 243) no-repeat center center fixed;
            background-size: cover;
        }
    </style>
    <script>
        // Function to fetch doctors dynamically based on selected department
        function fetchDoctors(departmentId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `schedule_appointment.php?action=get_doctors&department_id=${departmentId}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById('doctor_id').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Schedule Appointment</h2>
        <form action="schedule_appointment.php" method="POST">
            <!-- Department Dropdown -->
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-select" id="department_id" name="department_id" onchange="fetchDoctors(this.value)" required>
                    <option value="">Select Department</option>
                    <?php
                    include 'db.php';
                    $stmt = $conn->query("SELECT department_id, name FROM departments");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . $row['department_id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Doctor Dropdown -->
            <div class="mb-3">
                <label for="doctor_id" class="form-label">Doctor</label>
                <select class="form-select" id="doctor_id" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                </select>
            </div>

            <!-- Patient Dropdown -->
            <div class="mb-3">
                <label for="patient_id" class="form-label">Patient</label>
                <select class="form-select" id="patient_id" name="patient_id" required>
                    <?php
                    $stmt = $conn->query("SELECT patient_id, name FROM patient");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . $row['patient_id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Appointment Date -->
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Schedule Appointment</button>
        </form>
    </div>
</body>
</html>
