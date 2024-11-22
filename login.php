<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to index.php if the user is already logged in
    header('Location: /135450/index.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'data');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the query to check if the email exists in the database
    $sql = "SELECT * FROM register WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user is found with the provided email
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify the password against the stored hash
        if (password_verify($password, $user['password'])) {
            // If password is correct, start a session and store user details
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to the index page after successful login
            header('Location: /135450/index.php');
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   <div class="container">
        <form class="form-group" action="login.php" method="POST">
            <div class="mb-3 bg p-5 rounded">
                <h2 class="text-center mt-5">Login</h2>

                <!-- Display error message if there is one -->
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <label for="email" class="form-label mt-4 fw-semibold">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>

                <label for="password" class="form-label mt-3 fw-semibold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <button type="submit" class="form-control btn btn-primary mt-3">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
