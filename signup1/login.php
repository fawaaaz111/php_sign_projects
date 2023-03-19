<?php

// variables to determine login , invalid login data entered, status
// bt default FALSE (helps to fire alert box to feedback the user)
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';

    // getting user interd info
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    // try to get given data related from database
    $sql = "SELECT * FROM `registeration` WHERE user_name = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
      // if mysqli query executed right ,then get relevant data (rows)
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            // data is present in database
            $login = 1;
            session_start();
            $_SESSION['user_name'] = $username;
            header("location: home.php");
        }
        else {
            // data is not found in data base
            $invalid = 1;
        }
    }
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>



<?php

// fire alerts box , at the top of the page, indicating the status of operations of log in success, or failure

  // if user insertion data was success
  if ($login) {
    echo '
        <div class="alert alert-primary" role="alert">
            Log in successfuly
        </div>';
  }
  
  // if log in operation failed
  if ($invalid) {
    echo '
        <div class="alert alert-danger" role="alert">
            Wrong data!
        </div>';
  }

?>
    <h1 class="text-center mt-5">Log In page</h1>

    <div class="container mt-5">
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter Your Name" name="user_name">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
    </div>

  </body>
</html>