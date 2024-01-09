<?php
  
  // Include database file
  include 'connect.php';
  $customerObj = new DbConfig();
  // Delete record from table
  if(isset($_GET['id']) && !empty($_GET['id'])) {
      $deleteId = $_GET['id'];
      $customerObj->deleteRecord($deleteId);
  }
     
?> 