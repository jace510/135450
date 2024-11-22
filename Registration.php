<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'data');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    $errors = [];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    // Check if email already exists in the database
    $sql = "SELECT * FROM register WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Email is already registered.";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password before saving it to the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique token for email verification
        $verification_token = bin2hex(random_bytes(16));

        // Insert user data into the database
        $insert_sql = "INSERT INTO register (name, email, password, verification_token, is_verified) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $is_verified = 0; // Account is not verified by default
        $insert_stmt->bind_param('ssssi', $name, $email, $hashed_password, $verification_token, $is_verified);

        if ($insert_stmt->execute()) {
            // Send verification email
            $verification_url = "http://localhost/135450/verify.php?token=" . $verification_token;
            $subject = "Email Verification";
            $message = "Please click on the following link to verify your email address: <a href='$verification_url'>$verification_url</a>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: no-reply@example.com" . "\r\n";

            // Send email
            if (mail($email, $subject, $message, $headers)) {
                // Redirect to a page indicating an email has been sent
                echo "Registration successful! Please check your email to verify your account.";
            } else {
                echo "Error sending verification email.";
            }
        } else {
            echo "Error registering user: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>Register</h2>

        <!-- Display errors if there are any -->
        <?php if (isset($errors) && !empty($errors)) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) { echo "<p>$error</p>"; } ?>
            </div>
        <?php } ?>

        <!-- Registration form -->
        <form action="registration.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <p class="mt-3">Already have an account? <a href="/135450/login.php">Login here</a></p>
    </div>
</body>
</html>


