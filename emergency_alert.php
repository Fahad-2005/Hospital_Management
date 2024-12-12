<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Send Alert</title>
    <style>
        body {
            background: rgb(105, 177, 243) no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            color: rgb(44, 38, 7);
        }
        img {
            display: block;
            margin: 0 auto;
            width: 20%;
        }
        .success-alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <img src="em.png" alt="Emergency">

    <div class="container">
        <h2>Send Emergency Alert</h2>

        <!-- Display Success Message if Available -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="success-alert">
                Alert sent successfully!
            </div>
        <?php endif; ?>

        <!-- Form to Send Alert -->
        <form action="send_alert.php" method="POST">
            <div class="mb-3">
                <label for="department_id" class="form-label">Select Department</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <?php
                    include 'db.php';
                    try {
                        // Fetch departments for dropdown
                        $stmt = $conn->query("SELECT department_id, name FROM departments");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['department_id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Error fetching departments</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="alert_message" class="form-label">Alert Message</label>
                <textarea class="form-control" id="alert_message" name="alert_message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Alert</button>
        </form>
    </div>
</body>
</html>
