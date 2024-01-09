<?php
  session_start();
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit;
  }
  // Include database file
  include 'connect.php';
  $fetch = new DbConfig();
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  
     
?> 
<!DOCTYPE html>
<html>

<head>
  <!-- Add Bootstrap CSS link here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
  <?php include './nav.php' ?>
    <div class="container mt-4">
        <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
    </div> 
    <div class="container mt-4">
    <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="card">
                    <div class="card-body">
                    <?php 
                        $custom = $fetch->displayId($id); 
                        foreach ($custom as $customers) {
                    ?>
                     <div class="text-center">
                         <img src="./uploads/<?php echo $customers['image'] ?>. "    alt="Profile Image" style="max-width: 150px; max-height: 150px; border: 1px solid #ccc; border-radius: 50%;">
                     </div>
                        <!-- <h5 class="card-title">ID: <?php echo $customers['id'] ?></h5> -->

                        <h5 class="card-title">First Name: <?php echo $customers['First Name'] ?></h5>
                        <h5 class="card-title">Last Name: <?php echo $customers['Last Name'] ?></h5>
                        <h5 class="card-title">Email: <?php echo $customers['email'] ?></h5>
                        <h5 class="card-title">Gender: <?php echo $customers['Gender'] ?></h5>
                        <h5 class="card-title">DOB: <?php echo $customers['DOB'] ?></h5>
                        <a href="update.php?id=<?php echo $customers['id']; ?>" class="btn btn-warning">Update</a><br><br>
                        <a href="delete.php?id=<?php echo $customers['id']; ?>" class="btn btn-danger">Delete</a>

                        <?php 
                        }
                        ?>
                    </div>
                  </div>
                </div>
    </div>


        
            
    </div>
    
</body>
</html>


  
   