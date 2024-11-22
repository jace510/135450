<?php
// Database Connection
$conn = new mysqli('localhost', 'root', '', 'data');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the client ID from the URL
if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

    // Fetch the client's current data from the database
    $sql = "SELECT * FROM clients WHERE id = $client_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Client found, fetch the data
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    } else {
        die("Client not found.");
    }
} else {
    die("Client ID not provided.");
}

// Form handling: Update the client's data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update query
    $sql = "UPDATE clients SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $client_id";
    if ($conn->query($sql) === TRUE) {
        // Redirect to list page after successful update
        header('Location: /135450/index.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>Edit Client Details</h2>
        <a class="btn btn-secondary mb-4" href="/135450/index.php">Back to Clients List</a>

        <!-- Form to update client details -->
        <form action="edit.php?id=<?php echo $client_id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $address; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for some interactive features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p2ypFwFjwVhZsJZZXtGyNkC2v9MneGNeHtbkNVx8eC9xfHq" crossorigin="anonymous"></script>
</body>
</html>
