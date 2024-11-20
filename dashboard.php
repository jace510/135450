<?php
// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!--Bootstrap link css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <form class="form-group">
        <div class="mb-3 bg p-5 rounded">
            <h2 class="text-center mt-5">Dashboard</h2>
            <p>Welcome</p>
        </div>
        <p>You are logged in!</p>
    <a href="login.php">Logout</a>
    </form>
   </div> 