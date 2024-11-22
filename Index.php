<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center">
            <h2>List of Clients</h2>
            <a class="btn btn-primary" href="/135450/create.php">New Client</a>
        </div>
        <br>
        
        <!-- Table Section -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database Connection
                    $conn = new mysqli('localhost', 'root', '', 'data');
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM clients";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    // Reading Data of Each Row
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['phone'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm me-2' href='/135450/edit.php?id=" . $row['id'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/135450/delete.php?id=" . $row['id'] . "'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody> 
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNrsdn3lGHZToFNbMYeWQuW1myI1F9+YXsu5OLKc57SIovjCu8xE08LLsAc8HIe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGcb4yrLIhc+kqsFP+LY8GQ2qFe7hZLl9z5ftUS3Rn0E4K4w8BOhpAJ3U5I" crossorigin="anonymous"></script>
</body>
</html>
