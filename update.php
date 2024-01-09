<?php
  session_start();
  if (!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] != true) {
    header('location: login.php');
    exit;
  }
  // Include database file
  include 'connect.php';
  $customerObj = new DbConfig();

  // Edit customer record

  if(isset($_POST['update'])) {
    $customerObj->updateRecord();
  }  
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
    <script>
      function validateForm() {
        // Validate first form section
        var fname = document.getElementById('fname').value;
        var lname = document.getElementById('lname').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var cpassword = document.getElementById('cpassword').value;
        var file1 = document.getElementById('file').value;
        var dob1 = document.getElementById('dob').value;
        var gender1 = document.querySelector('input[name="Gender"]:checked');

        document.getElementById('fnameError').innerText = fname ? '' : 'Please enter First Name';
        document.getElementById('lnameError').innerText = lname ? '' : 'Please enter Last Name';
        document.getElementById('emailError').innerText = email ? '' : 'Please enter Email';
        document.getElementById('passwordError').innerText = password ? '' : 'Please enter Password';
        document.getElementById('cpasswordError').innerText = cpassword ? '' : 'Please enter Confirm Password';
        document.getElementById('fileError').innerText = file1 || document.getElementById('file').hasAttribute('readonly') ? '' : 'Please select an Image';
        document.getElementById('dobError').innerText = dob1 ? '' : 'Please select Date of Birth';

        if (gender1) {
            document.getElementById('genderError').innerText = '';
        } else {
            document.getElementById('genderError').innerText = 'Please select Gender';
        }

        if (
            document.getElementById('fnameError').innerText ||
            document.getElementById('lnameError').innerText ||
            document.getElementById('emailError').innerText ||
            document.getElementById('passwordError').innerText || 
            document.getElementById('cpasswordError').innerText || 
            document.getElementById('dobError').innerText ||
            document.getElementById('genderError').innerText
        ) {
            // If there are errors, prevent form submission
            return false;
        }

        // If no errors, allow form submission
        return true;
        }

    </script>
</head>
<body>
    <?php include 'nav.php' ?>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data" name="form" onsubmit="return validateForm()">

            <div id="firstSection">
            <?php 
            if(isset($_SESSION['logged_in_id']) && !empty($_SESSION['logged_in_id'])) {
                $editId = $_SESSION['logged_in_id'];
                $custom = $customerObj->displayId($editId);
             
                foreach ($custom as $customers) {
                ?>
                
                <!-- First Name Input -->
                <div class="mb-3 mt-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $customers['First Name'] ?>">
                    <span id="fnameError" class="text-danger"></span>
                </div>

                <!-- Last Name Input -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $customers['Last Name'] ?>">
                    <span id="lnameError" class="text-danger"></span>
                </div>

                <!-- Email Input -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $customers['email'] ?>">
                    <span id="emailError" class="text-danger"></span>
                </div>

                <!-- Old Password Input -->
                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" required>
                    <span id="oldPasswordError" class="text-danger"></span>
                </div>

                <!-- New Password Input -->
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span id="passwordError" class="text-danger"></span>
                </div>

                <!-- Confirm New Password Input -->
                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword">
                    <span id="cpasswordError" class="text-danger"></span>
                </div>

                

                <!-- Image Input (Second Section) -->
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="file">
                    <span id="fileError" class="text-danger"></span>
                    <img src="uploads/<?php echo $customers['image']; ?>" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
                </div>

                <!-- Date of Birth Input -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob"  value="<?php echo $customers['DOB'] ?>">
                    <span id="dobError" class="text-danger"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender:</label><br>
                    <input type="radio" name="Gender" value="Male" <?php echo ($customers['Gender'] === 'Male') ? 'checked' : ''; ?>> Male
                    <input type="radio" name="Gender" value="Female" <?php echo ($customers['Gender'] === 'Female') ? 'checked' : ''; ?>> Female
                    <input type="radio" name="Gender" value="Other" <?php echo ($customers['Gender'] === 'Other') ? 'checked' : ''; ?>> Other
                    <span id="genderError" class="text-danger"></span>
                </div>

                

                <button type="submit" class="btn btn-primary" name="update" >Update</button>

                <?php 
                }
            }?>

            </div>
            
        </form>
    </div>
</body>
</html>