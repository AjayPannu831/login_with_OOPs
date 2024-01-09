<?php
class DbConfig{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'form';

    public $conn;

    public function __construct(){
        
            $this->conn = new mysqli($this->server,$this->user,$this->password,$this->database);
            if(!$this->conn){
                echo 'Cannot connect to database';
            }
        }
    

		
		// Insert customer data into customer table
		public function insertData()
		{
			$fname = $this->conn->real_escape_string($_POST['fname']);
			$lname = $this->conn->real_escape_string($_POST['lname']);
			$email = $this->conn->real_escape_string($_POST['email']);
			$password = $this->conn->real_escape_string($_POST['password']);
			$cpassword = $this->conn->real_escape_string($_POST['cpassword']);
			$gender = $this->conn->real_escape_string($_POST['Gender']);
			$dob = $this->conn->real_escape_string($_POST['dob']);
			$image = $this->conn->real_escape_string($_FILES['image']['name']);
			$target = "uploads/" . basename($image);
	
			// Move the uploaded image to the 'uploads' directory
			move_uploaded_file($_FILES['image']['tmp_name'], $target);
	
			$existuser = "SELECT * FROM `stu` WHERE `email` = '$email'";
			$result = $this->conn->query($existuser);
			$existnum = $result->num_rows;
	
			if($existnum > 0){
				echo "<script>alert('User already exists with this email');</script>";
			}
			else{
				if($password == $cpassword){
					// Hash the password using password_hash
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	
					$sql = "INSERT INTO `stu`(`First Name`, `Last Name`, `email`, `password`, `image`, `Gender`, `DOB`) VALUES ('$fname','$lname','$email','$hashedPassword','$image','$gender','$dob')";
					$result = $this->conn->query($sql);
	
					if ($result) {
						echo "<script>confirm('Signup successfully! Please login.');</script>";
						echo "<script>window.location.href='login.php';</script>";
					}
				}
				else{
					echo "<script>alert('Passwords do not match');</script>"; 
				}
			}
		}

		public function login()
		{
			$email = $this->conn->real_escape_string($_POST["email"]);
			$enteredPassword = $this->conn->real_escape_string($_POST["password"]);

			$existuser = "SELECT * FROM `stu` WHERE `email` = '$email'";
			$result = $this->conn->query($existuser);

			if ($result->num_rows == 1) {
				$data = $result->fetch_assoc();

				// Check if the entered password matches the hashed password using password_verify
				if (password_verify($enteredPassword, $data["password"])) {
					session_start();
					$_SESSION['loggedin'] = true;
					$_SESSION['logged_in_id'] = $data["id"];
					$_SESSION['username'] = $data['First Name'];
					$_SESSION['useremail'] = $data['email'];

					header("location: welcome.php");
				} else {
					echo "<script>alert('Invalid Email or Password');</script>";
				}
			} else {
				echo "No records found for the given email";
			}
		}


		public function login_ajax()
		{
			$email = $this->conn->real_escape_string($_POST["email"]);
			$enteredPassword = $this->conn->real_escape_string($_POST["password"]);

			$existuser = "SELECT * FROM `stu` WHERE `email` = '$email'";
			$result = $this->conn->query($existuser);

			if ($result->num_rows == 1) {
				$data = $result->fetch_assoc();

				// Check if the entered password matches the hashed password using password_verify
				if (password_verify($enteredPassword, $data["password"])) {
					session_start();
					$_SESSION['loggedin'] = true;
					$_SESSION['logged_in_id'] = $data["id"];
					$_SESSION['username'] = $data['First Name'];
					$_SESSION['useremail'] = $data['email'];
					echo '1';
				} 
			} else {
				echo "No records found for the given email";
			}
		}


		// Fetch customer records for show listing
		public function FetchData()
		{
		    $sql = "SELECT * FROM stu";
		    $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}
		// // Fetch single data for edit from customer table
		public function displayId($id)
		{
		    $sql = "SELECT * FROM stu WHERE id = '$id'";
		    $result = $this->conn->query($sql);
		    if ($result->num_rows > 0) {
                $data = array();
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
			return $data;
		    }else{
			echo "Record not found";
		    }
		}

		// // Update customer data into customer table
		public function updateRecord()
		{
			// ... (your existing code)

			$id = $this->conn->real_escape_string($_SESSION['logged_in_id']);
			$old_password = $this->conn->real_escape_string($_POST['old_password']);
			$fname = $this->conn->real_escape_string($_POST['fname']);
			$lname = $this->conn->real_escape_string($_POST['lname']);
			$email = $this->conn->real_escape_string($_POST['email']);
			$password = $this->conn->real_escape_string($_POST['password']);
			$cpassword = $this->conn->real_escape_string($_POST['cpassword']);
			$gender = $this->conn->real_escape_string($_POST['Gender']);
			$dob = $this->conn->real_escape_string($_POST['dob']);
			$image = $this->conn->real_escape_string($_FILES['image']['name']);
			$target = "uploads/" . basename($image);

			// Move the uploaded image to the 'uploads' directory
			move_uploaded_file($_FILES['image']['tmp_name'], $target);

			// Fetch the current user data
			$currentUserData = $this->displayId($id);

			if (password_verify($old_password, $currentUserData[0]["password"])) {
				// Old password matches, proceed with the update

				if ($password === $cpassword) {
					// Hash the password using password_hash
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					$sql = "UPDATE `stu` SET `id`='$id',`First Name`='$fname',`Last Name`='$lname',`email`='$email',`password`='$hashedPassword',`image`='$image',`Gender`='$gender',`DOB`='$dob' WHERE id = '$id'";
					$result = $this->conn->query($sql);

					if ($result) {
						echo "<script>confirm('Data updated successfully.');</script>";
						echo "<script>window.location.href='fetch.php';</script>";
					} else {
						echo "Registration updated failed, try again!";
					}
				} else {
					echo "<script>alert('Passwords do not match');</script>";
				}
			} else {
				echo "<script>alert('Old Password is incorrect');</script>";
			}
		}

		

		// // Delete customer data from customer table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM `stu` WHERE id = '$id'";
		    $sql = $this->conn->query($query);
		    if ($sql==true) {
                echo '<script>confirm("delete_record");</script>';
                echo '<script>window.location.href="fetch.php";</script>';
		    }else{
			    echo "Record does not delete try again";
		    }
		}
	}



?>