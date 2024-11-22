<?php
// Database Connection
$conn = new mysqli('localhost', 'root', '', 'data');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch client details for confirmation
    $sql = "SELECT name FROM clients WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if client exists
    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();

        // If form is submitted, delete client
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Delete query
            $delete_sql = "DELETE FROM clients WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param('i', $id);

            if ($delete_stmt->execute()) {
                // Redirect to the client list after deletion
                header('Location: /135450/index.php');
                exit();
            } else {
                echo "Error deleting client: " . $conn->error;
            }
        }
    } else {
        echo "Client not found.";
        exit();
    }
} else {
    echo "No client ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete the client <strong><?php echo htmlspecialchars($client['name']); ?></strong>?</p>
        
        <!-- Form to confirm deletion -->
        <form action="delete.php?id=<?php echo $id; ?>" method="POST">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="/135450/index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for some interactive features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p2ypFwFjwVhZsJZZXtGyNkC2v9MneGNeHtbkNVx8eC9xfHq" crossorigin="anonymous"></script>
</body>
</html>
