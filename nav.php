<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    $loggedin = true;
}else{
    $loggedin = false;
}
?>
<div class="">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                           <?php echo '<a class="nav-link active" aria-current="page" href="./welcome.php">Home</a>' ?>
                        </li>
                        
                    
                        <li class="nav-item">
                           <?php if($loggedin){ echo '<a class="nav-link" aria-current="page" href="./fetch.php">Profile</a>'; } ?>
                        </li>
                        <li class="nav-item">
                            <?php
                        if(!$loggedin){
                        echo '
                            <a class="nav-link" href="./signup.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">Login</a>
                        </li>'
                        ?>
                        </ul>
                        <?php
                        }
                        if($loggedin){
                            echo '

                         <ul class="navbar-nav d-flex"> 
                    
                            <li class="nav-item ">
                                <a class="nav-link" href="./logout.php">Logout</a>
                            </li>
                        </ul>';
                        }
                        ?>
                  
                </div>
            </div>
        </nav>
    </div>
    
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

