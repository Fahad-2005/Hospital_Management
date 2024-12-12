<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Doctors</title>
    <style>
        body {
            background: url('image.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Doctors</h2>
        <form action="manage_doctors.php" method="POST">
            <div class="mb-3">
                <label for="department_id" class="form-label">Select Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
    <option value="">Choose a department</option>
    <?php
    include 'db.php';
    // Fetch departments from the database
    $stmt = $conn->query("SELECT department_id, name FROM departments");
    while ($row = $stmt->fetch()) {
        echo "<option value='{$row['department_id']}'>{$row['name']}</option>";
    }
    ?>
</select>

            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Doctor</button>
        </form>
    </div>
</body>
</html>
