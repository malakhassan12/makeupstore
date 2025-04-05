<?php



session_start(); // Start session before accessing $_SESSION


// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sign_db') or die('Connection failed');

// This is an AJAX request, so no need for redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $Email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
    $Pass = isset($_POST['password']) ? $_POST['password'] : '';

    // Initialize response array
    $response = ['success' => false, 'message' => ''];

    if (!empty($Email) && !empty($Pass)) {
        // Check if the email exists in the database
        $check_email_in = mysqli_query($conn, "SELECT * FROM sign_form WHERE email = '$Email'");

        if (mysqli_num_rows($check_email_in) > 0) {
            // Email found, now check the password
            $check_pass_in = mysqli_query($conn , "SELECT password FROM sign_form WHERE email = '$Email'");
            $row = mysqli_fetch_assoc($check_pass_in);
            
            // Compare password (Assuming password is hashed in the DB)
            if ($Pass === $row['password']) {
                $response['success'] = true;
                $response['message'] = "User logged in successfully!";
            } else {
                $response['message'] = "Incorrect password!";
            }
        } else {
            $response['message'] = "Email not registered!";
        }
    } else {
        $response['message'] = "Please fill in all fields!";
    }

    // Return JSON response
    header('Content-Type: application/json'); 
    echo json_encode($response);

    exit();
}








?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css.map" rel="stylesheet">
    <link href="css/fontawesome.css" rel="stylesheet">
    <link href="css/major.css" rel="stylesheet">
    <link href="css/normaliz.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>

    <div class="regi">

        <div class="container text-center">

            <div class="signin">
    
                <div class="parent">
                    <div class="row">
                        <h2 style="font-weight: bold;font-size: 30px;">sign in</h2>
                    </div>

                    <br>

                    <form  class="signinform" id="signinform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    
                        <div class="row" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-envelope" ></i>
                                <input type="email" placeholder="" name="Email" id="Email" required>
                                <label for="Email" >Email</label>

                            </div>
                            <div class="wrongE">

                            </div>

                        </div>
                        <br>
                        <div class="row" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-lock" ></i>
                                <input type="password" placeholder="" name="password" id="password" required>
                                <label for="password" >Password</label>

                            </div>
                            <div class="wrongP">

                            </div>


                        </div>
                        <br>
                        <span style="display: flex; justify-content: end;"><a href="#" style="font-size: 18px; text-align: end;color: #c382af">recover password</a></span>
                        <div class="in">
                            <input type="submit" value="Sign in" name="submit" style="width: 100%;">
                        </div>    

                    </form>
                    <div class="res row text-center">
 
                    </div>
                    

                    <div class="row">
                        <span><p>----------or----------</p></span>
                        <div class="icons">
                            <div class="google">
                                <i class="fa-brands fa-google"></i>
                            </div>
    
                            <div class="facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
    
                        </div>
    
                    </div>

                    <br>
                    <div class="row">
                        <p>Don't have account yet? <a href="signup.html">Sign up</a></p>
                    </div>
    
                </div>
                
            </div>

        </div>

    </div>





    <script src="js/in.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
    <script src="js/jquery-1.12.4.min.js"></script>
</body>
</html>