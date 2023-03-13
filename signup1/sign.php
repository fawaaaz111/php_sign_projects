<?php

// to track sing up operation process, default is FALSE, if later success , then convert it to TRUE
$success = 0;
$user = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';

    // getting user interd info
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    // before insert data in database, make sure no similar user is already exist
    $sql = "SELECT * FROM `registeration` WHERE user_name = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
      // if mysqli query executed right ,then get relevant data (rows)
        $num = mysqli_num_rows($result);

        if ($num > 0) {
          // swith user exist status to TRUE
            $user = 1;
        }
        else {
          // in no duplicate data in database, insert this valid data
            $sql = "INSERT INTO `registeration` (user_name, password)
            VALUES ('$username', '$password')";
            
            $result = mysqli_query($con, $sql);

            if ($result) {
              // swith user data insertion status to TRUE
                $success = 1;
            }
            else {
                die(mysqli_errno($con));
            }
        }
    }
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>




<?php

  // if user alrady in data base
if ($user) {
  echo '
      <div class="alert alert-danger" role="alert">
          Already sign up
      </div>';
}

// if sign up operation worked
if ($success) {
  echo '
      <div class="alert alert-primary" role="alert">
          Sing up successful
      </div>';
}

?>



    <h1 class="text-center">Sing up page</h1>

    <div class="container mt-5">
        <form action="sign.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter Your Name" name="user_name">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

  </body>
</html>