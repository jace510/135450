<?php
// Start a session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare a SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT id, name, password FROM Register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Bind results
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid email.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!--Bootstrap link css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <form class="form-group" action="connect.php">
        <div class="mb-3 bg p-5 rounded">
            <h2 class="text-center mt-5">Login</h2>
            <label for="exampleFormControlInput1" class="form-label mt-4 fw-semibold">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            <label for="exampleFormControlInput1" class="form-label mt-3 fw-semibold">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput1">
            <input class="form-check-input mt-3" type="checkbox" id="inlineFormCheck">
            <label class="form-check-label mt-3" for="inlineFormCheck">Remember me</label>
            <input type="submit" class="form-control btn-color mt-3 id="exampleFormControlInput1">
        </div>
    </form>
   </div> 
    
    
    
    
    <!--Bootstrap link js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>