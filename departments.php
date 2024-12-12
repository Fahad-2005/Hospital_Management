<?php
include 'db.php'; // Include the database connection

try {
    // Fetch all departments and their current alerts
    $stmt = $conn->query("SELECT department_id, name, alert FROM departments");
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Departments and Alerts</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            margin-top: 50px;
        }
        .alert-box {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .department-section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Departments and Doctors</h2>

        <!-- Loop through departments -->
        <?php foreach ($departments as $department): ?>
            <div class="department-section">
                <h3><?php echo htmlspecialchars($department['name']); ?></h3>

                <!-- Display alert for the department -->
                <?php if (!empty($department['alert'])): ?>
                    <div class="alert-box">
                        <strong>Alert:</strong> <?php echo htmlspecialchars($department['alert']); ?>
                    </div>
                <?php else: ?>
                    <p>No alerts for this department.</p>
                <?php endif; ?>

                <!-- Fetch and display doctors for this department -->
                <?php
                $doctor_stmt = $conn->prepare("SELECT name, email, specialization, phone_number FROM doctor WHERE department_id = ?");
                $doctor_stmt->execute([$department['department_id']]);
                $doctors = $doctor_stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <h5>Doctors in this department:</h5>
                <?php if (count($doctors) > 0): ?>
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Specialization</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($doctors as $doctor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($doctor['name']); ?></td>
                                    <td><?php echo htmlspecialchars($doctor['email']); ?></td>
                                    <td><?php echo htmlspecialchars($doctor['specialization']); ?></td>
                                    <td><?php echo htmlspecialchars($doctor['phone_number']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No doctors available in this department.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
