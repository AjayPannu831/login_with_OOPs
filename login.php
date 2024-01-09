<?php
include 'connect.php';

$login2 = new DbConfig();

if (isset($_POST['submit'])) {
    $login2->login();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Login</title>
</head>

<body>
    <?php include './nav.php' ?>
    <div class="container">
        <h1 class="text-center">Login</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="useremail" class="form-label">Email</label>
                <input type="text" class="form-control" id="useremail" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div><br>

            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
    </div>

</body>

</html>
