<?php
 $Name = $_POST['Name'];
 $Email = $_POST['Email'];
 $Password = $_POST['Password'];

 //Database Connection
 $conn = new mysqli('localhost', 'root', '', 'data');
 if($conn->connect_error){
     die('Connection failed :'.$conn->connect_error);
 }
 else{
    $stmt = $conn->prepare("insert into Register(Name, Email, Password)VALUES (?, ?, ?)");
    }

 // Validate input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $Name = trim($_POST['Name']);
    $Email = trim($_POST['Email']);
    $Password = trim($_POST['Password']); // Assuming you want to store password

    // Check for empty fields
    if (empty($Name) || empty($Email) || empty($Password)) {
        die("All fields are required.");
    }

    // Validate email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash the password for security
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO Register (Name, Email, Password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $Name, $Email, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        echo "Record inserted successfully!"; 
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    
</body>
</html>