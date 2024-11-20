<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!--Bootstrap link css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <form class="form-group" action="connect.php" method="post">
        <div class="mb-3 bg p-5 rounded">
            <h2 class="text-center mt-5">Registration</h2>
            <label for="exampleFormControlInput1" class="form-label mt-4 fw-semibold">Name</label>
            <input type="text" class="form-control" id="Name" name="Name" placeholder="johndoe">
            <label for="exampleFormControlInput1" class="form-label mt-4 fw-semibold">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com">
            <label for="exampleFormControlInput1" class="form-label mt-3 fw-semibold">Password</label>
            <input type="password" class="form-control" id="Password" name="Password">
            <label for="exampleFormControlInput1" class="form-label mt-3 fw-semibold">Confirm Password</label>
            <input type="password" class="form-control" id="Password">
            <input class="form-check-input mt-3" type="checkbox" id="inlineFormCheck">
            <label class="form-check-label mt-3" for="inlineFormCheck">Agree to Terms & Conditions</label>
            <input type="submit" class="form-control btn-color mt-3" id="exampleFormControlInput1">
        </div>
    </form>
   </div> 
    
    
    
    
    <!--Bootstrap link js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>