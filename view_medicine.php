<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Medicines</title>
</head>
<body>
    <div class="container mt-5">
        <h2>View Medicines</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                try {
                    // Fetch all medicines from the database
                    $stmt = $conn->query("SELECT * FROM medicine");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $availability = $row['quantity'] > 0 ? "In Stock" : "Out of Stock";
                        echo "<tr>
                                <td>{$row['medicine_id']}</td>
                                <td>{$row['medicine_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$availability}</td>
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
