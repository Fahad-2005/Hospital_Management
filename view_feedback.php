<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Feedback</title>
</head>
<body>
    <div class="container mt-5">
        <h2>View Feedback</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Feedback Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                try {
                    // Fetch all feedback from the database
                    $stmt = $conn->query("SELECT * FROM feedback");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['feedback_id']}</td>
                                <td>{$row['feedback_message']}</td>
                              </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='2'>Error: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
