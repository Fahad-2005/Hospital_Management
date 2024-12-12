<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Bills</title>
</head>
<body>
    <div class="container mt-5">
        <h2>View Bills</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Appointment ID</th>
                    <th>Amount</th>
                    <th>Generated At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                try {
                    // Fetch all bills
                    $stmt = $conn->query("SELECT * FROM bill");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['bill_id']}</td>
                                <td>{$row['appointment_id']}</td>
                                <td>{$row['total_amount']}</td>
                                <td>{$row['generated_at']}</td>
                              </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='4'>Error: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
